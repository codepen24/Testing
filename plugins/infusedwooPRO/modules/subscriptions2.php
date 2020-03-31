<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

////// PRICES FILTER
if(version_compare( WOOCOMMERCE_VERSION, '3.0', '>=' )) {
	add_filter('woocommerce_product_get_regular_price', 'ia_woocommerce_sub_regular_price', 10, 2 );
	add_filter('woocommerce_product_get_price', 'ia_woocommerce_sub_price', 10, 2 );
	add_filter('woocommerce_get_price_html', 'ia_woocommerce_sub_filter', 10, 2 );
	add_filter('woocommerce_cart_item_price', 'ia_woocommerce_sub_filter', 10, 2 );
} else {
	add_filter('woocommerce_get_regular_price', 'ia_woocommerce_sub_regular_price', 10, 2 );
	add_filter('woocommerce_get_price', 'ia_woocommerce_sub_price', 10, 2 );
	add_filter('woocommerce_get_price_html', 'ia_woocommerce_sub_filter', 10, 2 );
	add_filter('woocommerce_cart_item_price', 'ia_woocommerce_sub_filter', 10, 2 );
}

////// CART OVERRIDES
add_action('woocommerce_after_cart_totals', 'ia_woocommerce_after_cart', 10, 0 );	

////// SHIPPING OVERRIDE
add_filter('woocommerce_cart_shipping_packages', 'ia_cart_packages_filter', 10, 1 );

///// CHECKOUT OVERRIDE
add_action('woocommerce_after_checkout_form', 'ia_woocommerce_after_checkout', 10, 2);	
add_action('woocommerce_review_order_before_payment', 'ia_woocommerce_before_order_total', 10, 2 );	
add_filter('woocommerce_available_payment_gateways', 'ia_woocommerce_pg_filter', 10, 2);


///// ORDER OVERRIDES	
add_action('woocommerce_order_details_after_order_table', 'ia_woocommerce_order_items_table', 10, 1 );
add_action('woocommerce_email_after_order_table', 'ia_woocommerce_email_table', 10, 1);

///// ALWAYS SHOW PAYMENT FIELDS IF THERE IS A SUBSCRIPTION ITEM
add_filter( 'woocommerce_order_needs_payment', 'ia_subs_show_payment_fields', 10, 1 );
add_filter( 'woocommerce_cart_needs_payment',  'ia_subs_show_payment_fields', 10, 1 );

////// UPDATE ON COUPON APPLY
add_filter( 'woocommerce_update_order_review_fragments', 'ia_update_order_review', 10, 1 );




////// PRICES FILTER
function ia_woocommerce_sub_regular_price($price, $product) {
	$product_id = (int) method_exists($product, 'get_id') ? $product->get_id() : $product->id;
	$ifstype  = get_post_meta($product_id, 'infusionsoft_type', true);			
	
	if($ifstype == 'Subscription') {
		$sid = (int) get_post_meta($product_id, 'infusionsoft_sub', 	true);			
		$trial = (int) get_post_meta($product_id, 'infusionsoft_trial', 	true);	
		$sign_up_fee = get_post_meta($product_id, 'infusionsoft_sign_up_fee', 	true);
		
		if($trial > 0) {
			return $sign_up_fee;
		} else {
			$sub = ia_get_sub_from_is($sid);
			return ($sub['Price'] + $sign_up_fee);
		}
		
	} else return $price;	
}
function ia_woocommerce_sub_price($price, $product = null) {
	$ifstype  = get_post_meta($product->get_id(), 'infusionsoft_type', true);
	$product_id = (int) method_exists($product, 'get_id') ? $product->get_id() : $product->id;			
	
	$onsale = (isset($product) && $product->get_sale_price('edit') != $product->get_regular_price('edit') && $product->get_sale_price('edit') == $price);
	if($ifstype == 'Subscription' && !$onsale) {
		$sid = (int) get_post_meta($product_id, 'infusionsoft_sub', true);			
		$trial = (int) get_post_meta($product_id, 'infusionsoft_trial', true);	
		$sign_up_fee = get_post_meta($product_id, 'infusionsoft_sign_up_fee', 	true);
		
		if($trial > 0) {
			return $sign_up_fee;
		} else {
			$sub = ia_get_sub_from_is($sid);
			return ($sub['Price'] + $sign_up_fee);
		}

	} else return $price;	
}
function ia_woocommerce_sub_filter( $price, $product ){		
	global $iwpro;

	$prod_id = method_exists($product, 'get_id') ? $product->get_id() : (isset($product->id) ? $product->id : $product['product_id']);
	$ifstype  = get_post_meta($prod_id, 'infusionsoft_type', true);			
	
	if($ifstype == 'Subscription') {
		if(!$iwpro->ia_app_connect()) return;
		
		$sid = (int) get_post_meta($prod_id, 'infusionsoft_sub', 	true);			
		$trial = (int) get_post_meta($prod_id, 'infusionsoft_trial', 	true);	
		$sign_up_fee =  get_post_meta($prod_id, 'infusionsoft_sign_up_fee', true);

		$sub = ia_get_sub_from_is($sid);
		
		$stringCycle = '';
		switch($sub['DefaultCycle']) {						
				case 1: $stringCycle = 'year'; break;						
				case 2: $stringCycle = 'month'; break;						
				case 3: $stringCycle = 'week'; break;						
				case 6: $stringCycle = 'day'; break;					
			}	
		$addS = '';					
		if($sub['DefaultFrequency'] > 1) $addS = 's';
		$stringCycle = __("{$stringCycle}{$addS}",'woocommerce');
		
		if($sub['DefaultFrequency'] == 1) $freq = '';
		else $freq = "{$sub['DefaultFrequency']} ";

		$nsub = $iwpro->app->dsLoad('SubscriptionPlan', $sid, array('NumberOfCycles'));
		$ncycles = isset($nsub['NumberOfCycles']) ? $nsub['NumberOfCycles'] : 0;

		$ncycle_str = "";
		if($ncycles > 0) {
			$naddS = $ncycles > 1 ? 's' : '';
			$ncycle_str = " for $ncycles {$stringCycle}";
		}

		$price_override  = get_post_meta($prod_id, 'iw_override_price_html', true);

		if(!empty($price_override)) {
			$price_override = str_replace('{price}', $price, $price_override);
			return $price_override;
		}	 
		
		if($trial > 0) {
			if($sign_up_fee > 0) {
				return wc_price($sub['Price']) . " / {$freq}{$stringCycle}{$ncycle_str} " . __("with a {$trial}-day trial and a ",'woocommerce') . wc_price($sign_up_fee) . __(" sign-up fee",'woocommerce'); 
			} else {
				return wc_price($sub['Price']) . " / {$freq}{$stringCycle}{$ncycle_str} " . __("with a {$trial}-day free trial",'woocommerce'); 
			}
		} else {
			if($sign_up_fee > 0) {
				return wc_price($sub['Price']) . " / {$freq}{$stringCycle}{$ncycle_str} " . __("with a ",'woocommerce') . wc_price($sign_up_fee) . __(" sign-up fee",'woocommerce'); 
			} else {
				return  $price . " / {$freq}{$stringCycle}{$ncycle_str}"; 
			}
			
		}
		
		
	} else return $price;
}

////// CART OVERRIDES
function ia_woocommerce_after_cart() {
	global $iwpro;
	if($iwpro->has_sub()) {
	?>			
		<script>
			jQuery('.cart_totals > h2').text('<?php _e('Total Amount You Pay Right Now', 'woocommerce'); ?>');			
		</script>			
	<?php
	}
}


////// SHIPPING OVERRIDE
function ia_cart_packages_filter($packages) {
	global $iwpro;

	if($iwpro->has_sub()) {
		global $woocommerce;
		$newpackages = $packages;
		
		
		foreach($packages as $k => $package) {
		
			$package_count = count($package['contents']);

			// REMOVE NON SHIPABBLE ITEMS
			foreach($package['contents'] as $tok => $content) {
				if(!$content['data']->needs_shipping()) {
					unset($package['contents'][$tok]);
					$package_count--;
				}
			}

			foreach($package['contents'] as $tok => $content) {		
				$pid = (int) $content['product_id'];
				if(empty($pid)) { 
					$pid = (int) $content['data']['id'];							
				}
				
				$ifstype  = get_post_meta($pid, 'infusionsoft_type', true);

				$trialdays = get_post_meta($pid, 'infusionsoft_trial', true);
				if($ifstype == 'Subscription' && ($package_count > 1 || ($trialdays > 0 && count($newpackages) > 1))) {							
						$newpackages[$k]['contents_cost'] -= $content['line_total'];
						unset($newpackages[$k]['contents'][$tok]);
						
						$totalpack = count($newpackages);
						$newpackages[$totalpack] = $newpackages[0];					
						
						$newpackages[$totalpack]['contents'] = array();
						$newpackages[$totalpack]['contents'][$tok] = $content;
						$newpackages[$totalpack]['contents_cost'] = $content['line_total'];
						$newpackages[$totalpack]['trialdays'] = (int) $trialdays;
						$package_count--;
				} else if($ifstype == 'Subscription') {		
					$newpackages[$k]['trialdays'] = (int) $trialdays;	
					break;
				}
			}
		}

		// MAKE SURE NO EMPTY PACKAGE:

		$return_packages = array();
		foreach($newpackages as $k => $n) {
			if(count($n['contents']) != 0) $return_packages[] = $newpackages[$k];
		}
		
		return $return_packages;
	} else return $packages;
}



///// CHECKOUT OVERRIDE
function ia_woocommerce_after_checkout() {
	global $iwpro;

	if($iwpro->has_sub()) {
	?>			
		<script>
			jQuery('h3#order_review_heading').text('<?php _e('Total Amount You Pay Right Now', 'woocommerce'); ?>');			
		</script>			
	<?php
	}
}


function ia_woocommerce_before_order_total() {		
	global $iwpro;

	if($iwpro->has_sub()) {
		global $woocommerce;
		if(!$iwpro->ia_app_connect()) return;
		$sub_notes = array();
		
		$packages = $woocommerce->shipping->packages;
		$selected_shipping = $woocommerce->session->chosen_shipping_method;

		foreach($woocommerce->cart->cart_contents as $key => $item) {
			$ifstype  = get_post_meta($item['product_id'], 'infusionsoft_type', true);
			if($ifstype == 'Subscription') {	
				$shipping_fee = 0;

				foreach($packages as $i =>$package) {
					foreach($package['contents'] as $content) {
						if(($content['product_id'] == $item['product_id']) && $content['data']->needs_shipping()) {
							$selected_shipping = isset( WC()->session->chosen_shipping_methods[ $i ] ) ? WC()->session->chosen_shipping_methods[ $i ] : '';
							$shipping_fee += $package['rates'][$selected_shipping]->cost;

							if(is_array($package['rates'][$selected_shipping]->taxes)) {
								foreach($package['rates'][$selected_shipping]->taxes as $tax) 
									$shipping_fee += $tax;
							}
						}
					}
				}  					

				$sid = (int) get_post_meta($item['product_id'], 'infusionsoft_sub', 	true);			
				$trial = (int) get_post_meta($item['product_id'], 'infusionsoft_trial', 	true);	

				$incl_disc = get_post_meta($item['product_id'], 'infusionsoft_sub_incl_disc', true);
				$incl_ship = get_post_meta($item['product_id'], 'infusionsoft_sub_incl_ship', true);
				
				$sub = ia_get_sub_from_is($sid);
				$thisprod = wc_get_product($item['product_id']);
				$stringCycle = '';
				
				
				switch($sub['DefaultCycle']) {						
						case 1: 
							$stringCycle = 'year'; 	
							$no_of_years = $sub['DefaultFrequency'] ? $sub['DefaultFrequency'] : 1;
							$nextbill = (strtotime("+$no_of_years year", time())-time())/(24*3600); 
							break;						
						case 2: 
							$stringCycle = 'month'; 
							$no_of_months = $sub['DefaultFrequency'] ? $sub['DefaultFrequency'] : 1;
							$nextbill = (strtotime("+$no_of_months month", time())-time())/(24*3600); 
							break;						
						case 3: $stringCycle = 'week'; 	$nextbill = $sub['DefaultFrequency']*7; break;						
						case 6: $stringCycle = 'day';  	$nextbill = $sub['DefaultFrequency']*1; break;					
					}

				if($trial > 0) $nextbill = $trial;		


				$addS = '';					
				if($sub['DefaultFrequency'] > 1) $addS = 's';						
				if($sub['DefaultFrequency'] == 1) $freq = '';						
				else $freq = "{$sub['DefaultFrequency']} ";			
				
				if($thisprod->is_on_sale()) $sub_price = $thisprod->get_sale_price();
				else $sub_price = $sub['Price'];				

				remove_filter('woocommerce_product_get_price', 'ia_woocommerce_sub_price');
				if(version_compare( WOOCOMMERCE_VERSION, '3.2.1', '<' ))  {
					if($incl_disc != 'no') $sub_price = WC()->cart->get_discounted_price( $item, $sub_price, false );
				} else if($incl_disc != 'no') {

					$applied_coupons = WC()->cart->get_applied_coupons();

					if(count($applied_coupons) > 0) {
						$cart = new WC_Cart;

						$key = $cart->add_to_cart($item['product_id'],1);
						$cart->cart_contents[$key]['data']->set_price($sub_price);
						

						foreach($applied_coupons as $c) {
							$cart->set_applied_coupons($c);
						}

						$cart->calculate_totals();
						$sub_price = $cart->cart_contents[$key]['line_total'];
					}
					
				}

				
				$tot_price = wc_get_price_including_tax($thisprod, array('qty' => $item['quantity'], 'price' => $sub_price)); 
				add_filter('woocommerce_product_get_price', 'ia_woocommerce_sub_price',10,2);
			
				if($incl_ship != 'no') $subtotal = $tot_price + $shipping_fee;
				else $subtotal = $tot_price;

				
				if($trial == 0)		$nextbilldate =  time() + $nextbill*24*60*60;
				else 				$nextbilldate =  time() + $trial*24*60*60;

				$nsub = $iwpro->app->dsLoad('SubscriptionPlan', $sid, array('NumberOfCycles'));
				$ncycles = isset($nsub['NumberOfCycles']) ? $nsub['NumberOfCycles'] : 0;

				$ncycle_str = "";
				if($ncycles > 0) {
					$naddS = $ncycles > 1 ? 's' : '';
					$ncycle_str = " for $ncycles {$stringCycle}{$naddS}";
				} 
				
				$sub_note  = " every {$freq}{$stringCycle}{$addS}{$ncycle_str}"; 


				$sub_notes[$item['product_id']]  = array(
						 'id' 			=> (int) $sid,
						 'qty'	 		=> (int) $item['quantity'],
						 'nextbill' 	=> (int) $nextbill,
						 'program'		=> $sub['ProgramName'],
						 'price' 		=> ((float) $subtotal / $item['quantity']), 
						 'nextbilldate' => $nextbilldate,
						 'cycle'		=> $sub['DefaultCycle'],
						 'freq'			=> $sub['DefaultFrequency'],
						 'ncycles'		=> $ncycles,
						 'sub' 			=> "{$sub['ProgramName']} x {$item['quantity']}",
						 'cycle_html'	=>  __($sub_note, 'woocommerce'), 

					 );	
			}			
		}
		if(session_id() == '') {
	            session_start();
	        }
		$_SESSION['ifs_woo_subs'] 	= $sub_notes;	
	?>
	<div class="ia_subscription_items">
	<h3><?php _e('Take note of the following recurring charges', 'woocommerce') ?></h3>
	
	<table class="shop_table">
	<thead>
			<tr>
			<th><?php _e('Subscription', 'woocommerce') ?></th>
			<th><?php _e('Price', 'woocommerce') ?></th>
			<th><?php _e('Billing Cycle', 'woocommerce') ?></th>
			<th><?php _e('Next Bill Date', 'woocommerce') ?></th>
			</tr>			
	<thead>
	
	<tbody>
		<?php foreach($sub_notes as $sub_note) { ?>
			<tr>
			<td><?php echo $sub_note['sub']; ?></td>
			<td><b><?php echo wc_price($sub_note['price'] * $sub_note['qty']); ?></b></td>
			<td><b><?php echo $sub_note['cycle_html']; ?></b></td>
			<td><b><?php echo date('M j, Y', $sub_note['nextbilldate']); ?></b></td>
			</tr>
				
		<?php } ?>
	</tbody>
	</table>
	</div>
	<?php
	
	} else {
		if(session_id() == '') {
	            session_start();
	        }
	        
		if(isset($_SESSION['ifs_woo_subs'])) unset($_SESSION['ifs_woo_subs']);
	}
}
function ia_woocommerce_pg_filter($value) {	
	global $iwpro;

	if($iwpro->has_sub()) {
		$newpg = array();
		foreach($value as $k => $pg) {
			if($k == 'infusionsoft') { 
				$newpg[$k] = $pg;
				break;
			}
		}
		
		return $newpg;
	} else {
		return $value;
	}
	
}


/**
 * ORDER OVERRIDES
**/		




function ia_woocommerce_order_items_table($order) {
	$subs = get_post_meta( $order->get_id(), 'ia_subscriptions', true );
	
	if(!empty($subs)) {

	?>
		
		<table>
		<tbody>
		<h2><?php _e('Recurring Orders','woocommerce'); ?></h2>
		<table class="shop_table order_details">
		<thead>
		<tr>
		<th><?php _e('Subscription','woocommerce'); ?></th>
		<th><?php _e('Price','woocommerce'); ?></th>
		<th><?php _e('Billing Cycle','woocommerce'); ?></th>
		<th><?php _e('Next Bill Date','woocommerce'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php 
		
		foreach($subs as $sub) {
			switch($sub['cycle']) {						
				case 1: $stringCycle = 'year'; break;						
				case 2: $stringCycle = 'month'; break;						
				case 3: $stringCycle = 'week'; break;						
				case 6: $stringCycle = 'day'; break;					
			}		
			
			$addS = '';					
			if($sub['freq'] > 1) $addS = 's';	
				
			$sub_cycle = $sub['cycle_html'];	
			$sub_next  = date('M j, Y', $sub['nextbilldate']);	
		
		?>
		<tr>
			<td><?php echo $sub['program']; ?></td>
			<td><?php echo wc_price($sub['price']*$sub['qty']); ?></td>
			<td><?php echo $sub_cycle; ?></td>
			<td><?php echo $sub_next; ?></td>
		</tr>
				</tbody>
		</table>
	<?php 
		}
	} 
	
}


function ia_woocommerce_email_table($order) {
	$subs = get_post_meta( $order->get_id(), 'ia_subscriptions', true );
	
	if(!empty($subs)) {

	?>	
		<h2><?php _e('Recurring Orders','woocommerce'); ?></h2>
		<table cellspacing="0" cellpadding="6" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
		<thead>
		<tr>
		<th><?php _e('Subscription','woocommerce'); ?></th>
		<th><?php _e('Price','woocommerce'); ?></th>
		<th><?php _e('Billing Cycle','woocommerce'); ?></th>
		<th><?php _e('Next Bill Date','woocommerce'); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php 
		
		foreach($subs as $sub) {
			switch($sub['cycle']) {						
				case 1: $stringCycle = 'year'; break;						
				case 2: $stringCycle = 'month'; break;						
				case 3: $stringCycle = 'week'; break;						
				case 6: $stringCycle = 'day'; break;					
			}		
			
			$addS = '';					
			if($sub['freq'] > 1) $addS = 's';	
				
			$sub_cycle = $sub['cycle_html'];	
			$sub_next  = date('M j, Y', $sub['nextbilldate']);	
		
		?>
		<tr>
			<td><?php echo $sub['program']; ?></td>
			<td><?php echo wc_price($sub['price']*$sub['qty']); ?></td>
			<td><?php echo $sub_cycle; ?></td>
			<td><?php echo $sub_next; ?></td>
		</tr>
		</tbody>
		</table>
	<?php 
		}
	} 
	
}

function ia_subs_show_payment_fields($oldval) {
	global $iwpro;

	if(isset($iwpro) && $iwpro->has_sub()) {
		return true;
	} else {
		return $oldval;
	}
}

function ia_update_order_review($fragments) {
	global $iwpro;
	if(isset($iwpro) && $iwpro->has_sub()) {
		ob_start();
		ia_woocommerce_before_order_total();
		$html = ob_get_clean();
		$fragments['.ia_subscription_items'] = $html;
	}

	return $fragments;

}


///// HELPER FUNCTIONS
function ia_get_sub_from_is($sid) {
	global $iwpro;
	global $iw_cache;

	if(isset($iw_cache['subs'][$sid])) {
		return $iw_cache['subs'][$sid];
	} else {
		if(!$iwpro->ia_app_connect()) return;
		
		$returnFields = array('Id','ProgramName','DefaultPrice','DefaultCycle','DefaultFrequency');
		$sub = $iwpro->app->dsLoad('CProgram',$sid,$returnFields);
		
		$sub_price = $iwpro->ia_get_sub_price($sid, $sub['DefaultPrice']);
		$sub['Price'] = $sub_price;

		$iw_cache['subs'][$sid] = $sub;
		return $sub;
	}
}