<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// ORDER COMPLETE HOOKS

add_action('woocommerce_order_status_changed', 'ia_woocommerce_check_paystatus', 10, 3);

// Hook Backup when woocommerce_order_status_changed fails.
if(!has_action( 'woocommerce_payment_complete', 'ia_woocommerce_payment_complete' )) {
	add_action('woocommerce_payment_complete', 'ia_woocommerce_payment_complete');
}

add_action('woocommerce_checkout_update_order_meta', 'ia_woocommerce_new_order', 10, 1);

add_action('woocommerce_order_actions', 'ia_add_ordersync_action');
add_action('woocommerce_order_action_iw_order_sync', 'ia_admin_manual_sync_order' );


function ia_woocommerce_payment_complete_force($order_id) {
	ia_woocommerce_payment_complete( $order_id, true); 
}

function ia_add_ordersync_action($actions) {
	$actions['iw_order_sync'] =  __( 'Sync Order to Infusionsoft', 'infusedwoo' );
	return $actions;
}

function ia_admin_manual_sync_order($order) {
	$order_id = $order->get_id();
	$paid_statuses = apply_filters('woocommerce_order_is_paid_statuses', array('processing', 'completed'));
	if($order->is_paid() || in_array($order->get_status(), $paid_statuses)) {
		ia_woocommerce_payment_complete( $order_id );
	} else {
		ia_woocommerce_payment_complete( $order_id, false, true);
	}

	$order->add_order_note("Order manually synced to Infusionsoft via Woo Order Actions.");
}

function ia_woocommerce_check_paystatus($order_id, $old_status, $new_status) {
	$order =  wc_get_order($order_id);
	$paid_statuses = apply_filters('woocommerce_order_is_paid_statuses', array('processing', 'completed'));

	if($order->is_paid() && !in_array($old_status, $paid_statuses)) {
		update_post_meta( $order_id, 'infusionsoft_needs_syncing', 1);

		remove_action( 'woocommerce_payment_complete', 'ia_woocommerce_payment_complete' );
		
		ia_woocommerce_payment_complete( $order_id );
	}
}

function ia_woocommerce_new_order($order_id) {
	$create_early_invoice = apply_filters( 'infusedwoo_create_early_invoice', false );
	$paid_statuses = apply_filters('woocommerce_order_is_paid_statuses', array('processing', 'completed'));

	if($create_early_invoice) {
		$order = wc_get_order($order_id);
		$order_status = $order->get_status();

		if(!in_array($order_status, $paid_statuses)) {
			ia_woocommerce_payment_complete( $order_id, false, true);
		}
	}
}


function ia_woocommerce_payment_complete( $order_id, $force = false, $mark_unpaid = false) {
	global $woocommerce;
	global $iwpro;
	
	$sync_status = implode('|', array(
			time(),
			WOOCOMMERCE_VERSION,
			INFUSEDWOO_PRO_VER
		));

	add_post_meta( $order_id, 'infusionsoft_sync_attempt', $sync_status);

	$order = wc_get_order( $order_id );	

	$is_locked = get_post_meta( $order_id, 'infusedwoo_lock', true );
	if($is_locked) {
		$order->add_order_note("There was an attempt to sync order to Infusionsoft. But there is still an active process editing the order. Remove infusedwoo_lock meta if this was a mistake.");	
		return false;
	}

	// Lock this order - to avoid duplication:
	add_post_meta( $order_id, 'infusedwoo_lock', 1 );

	$purchase_goal = apply_filters( 'infusedwoo_cpn_goal', 'woopurchase' );
	$coupon_goal = apply_filters( 'infusedwoo_cpn_goal', 'woocoupon' );
	$action_log = array();
	$mark_unpaid 	  = apply_filters( 'infusedwoo_pc_mark_unpaid', $mark_unpaid, $order_id );
	$mark_unpaid_only = apply_filters( 'infusedwoo_pc_mark_unpaid_only', false);

	
	if(!$iwpro->ia_app_connect()) {
		$apperrormsg = $iwpro->settings['apperrormsg'];
		$order->add_order_note("CRITICAL: Not sent to infusionsoft due to {$apperrormsg}");	
		delete_post_meta( $order_id, 'infusedwoo_lock');
		return false;
	}		

	$email = $order->get_billing_email();

	$contact = $iwpro->app->dsFind('Contact',5,0,'Email',$email,array('Id'));
	$contact = $contact[0];	
	
	if ($contact['Id'] != null && $contact['Id'] != 0 && $contact != false){
		$contactId = (int) $contact['Id']; 
	} else {				
		$contactinfo	= array();	
		$contactinfo['Email'] = $email;
		$contactId  = $iwpro->app->addCon($contactinfo);
	}

	$contactId = apply_filters( 'infusedwoo_get_contactid', $contactId, $order);			
	
	$products = $order->get_items(); 
	
	update_post_meta( $order_id, 'infusionsoft_contact_id', $contactId );

	$as = (int) $iwpro->success_as;
	if($as > 0) {
		$iwpro->app->runAS($contactId, $as);
		$action_log[] = "Ran Action # $as";
	}

	$iwpro->app->achieveGoal($purchase_goal, "any", $contactId);		
	$action_log[] = "Triggered Goal: $purchase_goal, any";
	
	$saveOrders = $iwpro->settings['saveOrders'];
	
	$payment_method = $order->get_payment_method();
	$used_coup = $order->get_used_coupons();
	
	$pending_payment = get_post_meta($order_id, 'infusionsoft_order_pending', true );

	if($saveOrders == "yes" && $payment_method != "infusionsoft" && !$pending_payment) {

		// MAKE SURE BILLING AND SHIPPING ADDRESS IS CORRECT
		// Company Selector
		$compId = 0;
		$b_company = stripslashes($order->get_billing_company());
		if(!empty($b_company)) {
			$company 		= $iwpro->app->dsFind('Company',5,0,'Company',$b_company,array('Id')); 
			$company 		= $company[0];
			
			if ($company['Id'] != null && $company['Id'] != 0 && $company != false){							
				$compId = $company['Id'];						
			} else {
				$companyinfo = array('Company' => $b_company);
				$compId = $iwpro->app->dsAdd("Company", $companyinfo);
			}
		}

		$contactinfo = array();
		if($order->get_billing_first_name()) $contactinfo['FirstName'] = $order->get_billing_first_name();
		if($order->get_billing_last_name()) $contactinfo['LastName'] = $order->get_billing_last_name();
		if($order->get_billing_phone()) $contactinfo['Phone1'] = $order->get_billing_phone();
		if($order->get_billing_address_1()) $contactinfo['StreetAddress1'] = $order->get_billing_address_1();
		if($order->get_billing_address_2()) $contactinfo['StreetAddress2'] = $order->get_billing_address_2();
		if($order->get_billing_city()) $contactinfo['City'] = $order->get_billing_city();
		if($order->get_billing_state()) $contactinfo['State'] = $order->get_billing_state();
		if($order->get_billing_country()) $contactinfo['Country'] = iw_to_country($order->get_billing_country());
		if($order->get_billing_postcode()) $contactinfo['PostalCode'] = $order->get_billing_postcode();
		if($order->get_shipping_address_1()) $contactinfo['Address2Street1'] = $order->get_shipping_address_1();
		if($order->get_shipping_address_2()) $contactinfo['Address2Street2'] = $order->get_shipping_address_2();
		if($order->get_shipping_city()) $contactinfo['City2'] = $order->get_shipping_city();
		if($order->get_shipping_state()) $contactinfo['State2'] = $order->get_shipping_state();
		if($order->get_shipping_country()) $contactinfo['Country2'] = iw_to_country($order->get_shipping_country());
		if($order->get_shipping_postcode()) $contactinfo['PostalCode2'] = $order->get_shipping_postcode();
		if(!empty($b_company)) $contactinfo['Company'] = $b_company;
		if(!empty($compId)) $contactinfo['CompanyID'] = $compId;

		$infusedwoo_contact_update = apply_filters( 'infusedwoo_contact_update', true );
		$contactinfo = apply_filters( 'infusedwoo_contact_updateinfo', $contactinfo, $order);	
		if($iwpro->overwriteBD != "yes" && $infusedwoo_contact_update) $iwpro->app->dsUpdate("Contact",$contactId,$contactinfo);
		
		if($payment_method != "infusionsoft") {
			// CHECK AFFILIATE			
					
			$returnFields = array('AffiliateId');
			$referrals = $iwpro->app->dsFind('Referral',1000,0,'ContactId',(int) $contactId,$returnFields);
			$num = count($referrals);
			if($num > 0  && is_array($referrals)) $is_aff = $referrals[$num-1]['AffiliateId'];
			else $is_aff = 0;	

			$is_aff = apply_filters( 'infusedwoo_get_affiliateid', $is_aff, $order);	

			// BREAK IF INVOICE ALREADY CREATED
			$ifs_inv = get_post_meta($order_id, 'infusionsoft_invoice_id', true );
			if($ifs_inv > 0 && !$force) {
				delete_post_meta( $order_id, 'infusedwoo_lock');
				return true;
			}
			
			// CREATE INVOICE
			
			$orderDate = date('Ymd\TH:i:s', current_time('timestamp'));

			$order_num = $order->get_order_number();
			if(empty($order_num)) $order_num = $order_id;

			$order_title = apply_filters( 'infusedwoo_infusion_order_title', "Woocommerce Order # {$order_num}", $order );
			$inv_id = (int) $iwpro->app->blankOrder($contactId,$order_title,$orderDate,0,$is_aff);
			update_post_meta($order_id, 'infusionsoft_invoice_id', $inv_id);
			$calc_totals = 0;
			
			$products = $order->get_items(); 
			// PRODUCT LINE


			foreach($products as $product) {
				$sku = "";
				$id  =  (int) $product['product_id'];
				$vid =  (int) $product['variation_id'];				
				
				$pid     = (int) get_post_meta($id, 'infusionsoft_product', true);
				
				if($vid != 0)   $sku = get_post_meta($vid, '_sku', true);
				if(empty($sku)) $sku = get_post_meta($id, '_sku', true);
				$sdesc = '';


				if( empty($pid) ) {
					if(!empty($sku)) {
						$ifsproduct = $iwpro->app->dsFind('Product',1,0,'Sku',$sku, array('Id'));
						$ifsproduct = $ifsproduct[0];
						if(!empty($ifsproduct)) $pid = (int) $ifsproduct['Id'];
						else if($iwpro->settings['addsku'] == "yes") {
							$productname  = get_the_title($product['product_id']);
							$productprice = $product['line_total'];								
							$newproduct = array('ProductName' 	=> $productname,
												'ProductPrice'  => $productprice,
												'Sku'     		=> $sku);
							$pid = (int) $iwpro->app->dsAdd("Product", $newproduct);
						} else $pid = 0;
					} else $pid = 0;						
				} 
				// set product description
				$pdesc = ''; 
				if($pid == 0) $pdesc .= $product['name'] . " ";

				if($vid != 0) {
					$variation = wc_get_product($vid);

					$attribs = $variation->get_variation_attributes();
					$var_parent = wc_get_product($variation->get_parent_id());
					$all_attribs = $var_parent->get_attributes();

					$attribs_txt = array();

					foreach($attribs as $k => $v) {
						$key = str_replace('attribute_', '', $k);
						if(empty($v)) $v = $product->get_meta($key,true);
						if(isset($all_attribs[$key])) {
							$label = isset($all_attribs[$key]['name']) ? $all_attribs[$key]['name'] : $all_attribs[$key];
							$attribs_txt[] = "$label: $v";
						}
					}

					$var_sku = get_post_meta($vid, '_sku', true);
					if(!empty($var_sku)) $attribs_txt[] = "SKU: $var_sku";
					
					$pdesc .= implode(", ", $attribs_txt);
				} 

				$pdesc = apply_filters( 'infusedwoo_product_item_desc', $pdesc, $product['name'], $pid );
				$pid = apply_filters( 'infusedwoo_product_inf_product', $pid, $product, $order );
		
				$qty 	= (int) $product['qty'];
				$price 	= ((float) $product['line_total']) / ((float) $product['qty']);
				$price  = apply_filters( 'infusedwoo_product_price_calc', $price, $order, $product );
				
				if(!$mark_unpaid) {
					$action_log = iw_run_success_actions($product, $contactId, $order_id, $action_log);		
				}

				$iwpro->app->addOrderItem($inv_id, $pid, 4, round($price,2), $qty, $pdesc, $sdesc);
				$calc_totals += $qty * $price;		
			}	
			
			// SHIPPING LINE
			$s_method = (string) $order->get_shipping_method();  
			$s_total  = (float)  $order->get_total_shipping();
			$s_total  = apply_filters( 'infusedwoo_shipping_price_calc', $s_total, $order );


			if($s_total > 0.0) {
				$iwpro->app->addOrderItem($inv_id, 0, 1, round($s_total,2), 1, $s_method,$s_method);
				$calc_totals += $s_total;
			}

			// Custom Fees
			$fees = $order->get_fees();
			if(count($fees) > 0) foreach($fees as $fee) {
				$subtotal = isset($fee['line_subtotal']) ? $fee['line_subtotal'] : $fee['line_total'];

				$fee_amount = (float) $subtotal;
				$fee_amount = apply_filters( 'infusedwoo_fee_price_calc', $fee_amount, $order, $fee );

				$fee_amount_rounded = round($fee_amount, 2);

				$iwpro->app->addOrderItem($inv_id, 0, 13, $fee_amount_rounded, 1, $fee['name'], $fee['name']);
				$calc_totals += $fee_amount;
			}

			// TAX LINE
			$tax = (float) $order->get_total_tax();
			$tax = apply_filters( 'infusedwoo_tax_price_calc', $tax, $order );

			if($tax > 0.0) {
				$iwpro->app->addOrderItem($inv_id, 0, 2, round($tax,2), 1, 'Tax','');
				$calc_totals += $tax;
			}
			
			//coupon line
			$discount = (float) ($calc_totals - $order->get_total());
			$discount = apply_filters( 'infusedwoo_discount_price_calc', $discount, $order );

			if ( round($discount,2) > 0.00  ) {
			  $coupon_desc = "Discount";
			  if(is_array($used_coup)) $coupon_desc = implode(",", $used_coup);
			  $iwpro->app->addOrderItem($inv_id, 0, 7, -round($discount,2), 1, $coupon_desc, 'Woocommerce Coupon Code');
			  $calc_totals -= $discount;		  
			} 

			//Add Order Notes				
			$jobid  = $iwpro->app->dsLoad("Invoice",$inv_id, array("JobId"));
			$jobid  = (int) $jobid['JobId'];
			$modify_order = array("JobNotes" => $order->get_customer_note(), 'OrderType' => 'Online');

			if($order->get_shipping_first_name() && $order->get_shipping_first_name() != $order->get_billing_first_name())
				$modify_order['ShipFirstName'] = $order->get_shipping_first_name();

			if($order->get_shipping_last_name() && $order->get_shipping_last_name() != $order->get_billing_last_name())
				$modify_order['ShipLastName'] = $order->shipping_last_name;

			if($order->get_shipping_company() && $order->get_shipping_company() != $order->get_billing_company())
				$modify_order['ShipCompany'] = $order->get_shipping_company();

			$modify_order = apply_filters( 'infusedwoo_modify_order', $modify_order, $order_id );
			$iwpro->app->dsUpdate("Job",$jobid, $modify_order);

			
			if(!$mark_unpaid) {
				$method = $order->get_payment_method_title();
				
				$totals = (float) $iwpro->app->amtOwed($inv_id);

				if(!$mark_unpaid_only) {
					$iwpro->app->manualPmt($inv_id, $totals, $orderDate, $method, "Woocommerce Checkout",false);
				}
			} else {
				update_post_meta($order_id, 'infusionsoft_order_pending', 1);
			}

			update_post_meta($order_id, 'infusionsoft_order_id', $jobid);
			update_post_meta($order_id, 'infusionsoft_affiliate_id', $is_aff);
			$appname = isset($iwpro->machine_name) ? $iwpro->machine_name : "";
			update_post_meta($order_id, 'infusionsoft_view_order', "https://$appname.infusionsoft.com/Job/manageJob.jsp?view=edit&ID=$jobid");
				
		}				
	} else {
		if($pending_payment) {
			delete_post_meta( $order_id, 'infusionsoft_order_pending' );
			$method = $order->get_payment_method_title();
			$inv_id = get_post_meta($order_id, 'infusionsoft_invoice_id', true );
				
			$totals = (float) $iwpro->app->amtOwed($inv_id);
			
			if(!$mark_unpaid_only) {
				$iwpro->app->manualPmt($inv_id, $totals, date('Ymd\TH:i:s', current_time('timestamp')), $method, "Woocommerce Checkout",false);
			}
		}

		foreach($products as $product) {
			$action_log = iw_run_success_actions($product, $contactId, $order_id, $action_log);	
		}		
	}

	
	// TRIGGER GOAL IF COUPON CODE IS USED:

	if (function_exists('ia_save_cart')) ia_save_cart($email, "");

	if(is_array($used_coup)) { 
		foreach($used_coup as $c) {
			$iwpro->app->achieveGoal($coupon_goal, $c, $contactId);	
			$action_log[] = "Triggered Goal: $coupon_goal, $c";
		}
	}

	$order->add_order_note("Infusionsoft Automation\n" . implode("\n", $action_log));

	delete_post_meta( $order_id, 'infusionsoft_needs_syncing' );
	do_action( 'infusedwoo_payment_complete', $order_id, $contactId );
	delete_post_meta( $order_id, 'infusedwoo_lock');
}


function iw_run_success_actions($product, $contactId, $order_id, $action_log = array()) {
	global $iwpro;
	$purchase_goal = apply_filters( 'infusedwoo_cpn_goal', 'woopurchase' );

	$sku = "";
	$id  =  (int) $product['product_id'];
	$vid =  (int) $product['variation_id'];

	if($vid != 0)   $sku = get_post_meta($vid, '_sku', true);
	if(empty($sku)) $sku = get_post_meta($id, '_sku', true);

	$tag    = get_post_meta($id, 'infusionsoft_tag', 	true);
	$email  = get_post_meta($id, 'infusionsoft_email', 	true);
	$action = get_post_meta($id, 'infusionsoft_action', true);				

	if(is_array($action)) {
		foreach($action as $a) {
			$iwpro->app->runAS($contactId, $a);
			$action_log[] = "Ran Action # $a";
		}
	} else if(!empty($action)) {
		$iwpro->app->runAS($contactId, (int) $action);
		$action_log[] = "Ran Action # $action";
	}

	if(is_array($tag)) {
		foreach($tag as $t) {
			$iwpro->app->grpAssign($contactId, $t);
			$action_log[] = "Applied Tag # $t";
		}
	} else if(!empty($tag)) {
		$iwpro->app->grpAssign($contactId, (int) $tag);
		$action_log[] = "Applied Tag # $tag";
	}

	if(is_array($email)) {
		foreach($email as $e) {
			$iwpro->app->sendTemplate(array($contactId), $e);
			$action_log[] = "Sent Email # $e";
		}
	} else if(!empty($email)) {
		$iwpro->app->sendTemplate(array($contactId), (int) $email);
		$action_log[] = "Sent Email # $email";
	}

	if(!empty($sku) && preg_match("/^[A-Za-z0-9]+$/", $sku)) {
		$iwpro->app->achieveGoal($purchase_goal, $sku, $contactId);	
		$action_log[] = "Triggered Goal: $purchase_goal, $sku";
	}

	do_action( 'infusedwoo_product_purchase', $product, $contactId, $order_id );

	return $action_log;
	
}





?>