<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Checkout Page 
add_action( 'woocommerce_checkout_process', 'infusedwoo_validate_tc_checkout',10, 1);
add_action( 'woocommerce_review_order_before_submit', 'infusedwoo_gdpr_tc_checkout', 20, 0 );

// Registration Forms
add_action( 'woocommerce_register_form', 'infusedwoo_gdpr_tc_wcreg', 10, 1 );
add_action( 'signup_extra_fields', 'infusedwoo_gdpr_tc_reg', 10, 1 );
add_action( 'register_form', 'infusedwoo_gdpr_tc_reg', 10, 1 );
add_filter( 'wpmu_validate_user_signup', 'infusedwoo_gdpr_tc_reg_validate', 10, 1 );
add_filter( 'registration_errors', 'infusedwoo_gdpr_tc_reg1_validate', 10, 1 );

// TC Agree Actions
add_action( 'infusedwoo_payment_complete','infusedwoo_monitor_tc_agreement_order', 10, 1 );
add_action( 'after_signup_user', 'infusedwoo_monitor_tc_agreement_user', 10, 1);
add_action( 'user_register', 'infusedwoo_monitor_tc_agreement_userid',10,1);
add_action( 'template_redirect', 'infusedwoo_check_tc_updates');

// My Account
add_filter( 'woocommerce_account_menu_items', 'infusedwoo_gdpr_menu_items', 10, 1 );

// Cookie Policy
add_action( 'wp_head', 'infusedwoo_gdpr_cookie_script', 10, 0 );

// GDPR Links
add_action( 'parse_request', 'infusedwoo_gdpr_links',10,1 );
add_action( 'init', 'infusedwoo_gdpr_my_account_endpoint' );
add_action( 'woocommerce_account_iw-preferences_endpoint', 'infusedwoo_ma_my_preferences' );
add_action( 'woocommerce_account_iw-data_endpoint', 'infusedwoo_ma_my_data' );

// ajax
add_action( 'wp_ajax_iwgdpr_dl_data', 'infusedwoo_gdpr_dldata', 10, 0 );
add_action( 'wp_ajax_iwgdpr_upd_data', 'infusedwoo_gdpr_upddata', 10, 0 );
add_action( 'wp_ajax_iw_gdpr_gen_token', 'infusedwoo_gdpr_gen_token', 10, 0 );
add_action( 'wp_ajax_iw_gdpr_links_iwcfield', 'infusedwoo_gdpr_links_iwcfield', 10, 0 );

function infusedwoo_gdpr_links_iwcfield() {
	if(isset($_POST['cfield']))
		update_option( 'infusedwoo_gdpr_links_iwcfield', $_POST['cfield'] );
	exit();
}

function infusedwoo_get_admin_token() {
	$admin_token = get_option( 'infusedwoo_postapi_token', '' );
	if(!$admin_token) {
		$admin_token = wp_generate_password( 10, false, false );
		update_option( 'infusedwoo_postapi_token', $admin_token );
	}

	return $admin_token;
}

function infusedwoo_gdpr_gen_token($email="", $cfield="", $return = false) {
	if(empty($email)) {
		$email = isset($_POST['email']) ? $_POST['email'] : "";
	}

	if(empty($email)) {
		return false;
	}

	// Check if user exists in WP
	$user = get_user_by('email', $email);
	if(isset($user->ID) && $user->ID > 0) $user_id = $user->ID;
	else {
		$user_fields = array(
			'user_email' => $email,
			'user_login' => $email,
			'user_pass' => wp_generate_password( 15 )
		);
		$user_id = wp_insert_user($user_fields);
	}


	$user_b64 = base64_encode($user_id);
	$generate = bin2hex(openssl_random_pseudo_bytes(15));

	$lifetime = get_option('iw_gdpr_link_expires', '72' );
	set_transient( 'iw_usertok_' . $generate, $user_b64, $lifetime * 24*3600 );

	$token = "{$generate}_{$user_b64}";

	if($return) {
		return $token;
	}

	if($cfield) {
		// find user:
		global $iwpro;

		if($iwpro->ia_app_connect()) {
			$c = $iwpro->app->dsFind('Contact',1,0,'Email',$email,array('Id'));
			$cid = isset($c[0]['Id']) ? $c[0]['Id'] : 0;

			if($cid) {
				$iwpro->app->dsUpdate('Contact',$cid,array($cfield => $token));
			}
		}
	}



	echo json_encode(array('token' => $token));
	exit();

}

function infusedwoo_gdpr_upddata() {
	global $iwpro;

	$user = wp_get_current_user();
	$user_id = $user->ID;
 	$email = $user->user_email;

	foreach($_POST as $k => $v) {
		$field_bits = explode(':', $k);
		$valid = true;

		$old = $v['old'];
		$new = $v['value'];

		if($field_bits[0] == 'InfContact') {
			$error = "";

			if($field_bits[1] == 'Birthday') {
				if(strtotime($new) < 100) {
					$valid = false;		
					$error = "Date format must be YYYY-MM-DD";
				} else {
					$new = date('Y-m-d',strtotime($new));
				}
			}

			if($valid) {
				if(!is_user_logged_in()) {
					$valid = false;
					$error = "You are not anymore logged-in";
				} else if($iwpro->ia_app_connect()) {
					$c = $iwpro->app->dsFind('Contact', 1, 0, 'Email', $email, array('Id'));

					if(isset($c[0]['Id'])) {
						$cid = $c[0]['Id'];
						$iwpro->app->dsUpdate('Contact',$cid,array($field_bits[1] => $new));

						$iwpro->app->dsAdd('ContactAction', array(
							'ActionDescription' => 'InfusedWoo: Customer Self Data Update',
							'ContactId' => $cid,
							'ActionType' => 'Other',
							'CreationNotes' => "Customer updated {$field_bits[1]} from [ $old ] to [ $new ]"
						));
					} else {
						$valid = false;
						$error = "Cannot find record in the database";
					}
					
				} else {
					$valid = false;
					$error = "Error connecting to our database servers.";
				}
			}
		} else if($field_bits[0] == 'WPUserMeta') {
			update_user_meta( $user_id, $field_bits[1], $new );
		}

		if(!$valid) {
			echo json_encode(array('error' => $error));
		} else {
			echo json_encode(array('success' => 1));
		}
	}

	exit();
}

function infusedwoo_gdpr_dldata() {
	if(!get_option('infusedwoo_gdpr_data_dl')) {
		return false;
	}
	header('Content-disposition: attachment; filename=mydata'. time() .'.json');
	header('Content-type: application/json');
	
	$pdata = array();

	if(is_user_logged_in()) {
		$pdata = infusedwoo_fetch_pdata();
		echo json_encode($pdata);
	}

	exit();
}

function infusedwoo_fetch_pdata() {
	global $iw_manual, $iwpro;
	$pfields = get_option('infusedwoo_data_pfields', array());
	$gdpr_data_nonempty = get_option('infusedwoo_gdpr_data_nonempty');

	$pdata = array();
	if(is_user_logged_in()) {
		$iw_manual = new IW_PageVisit_Trigger;
		$user = wp_get_current_user();
		$iw_manual->user_email = $user->user_email;
		$iw_manual->merger = new IW_Automation_MergeFields($iw_manual, array());
		
		$ifields = array();

		foreach($pfields as $k => $p) {
			if(is_array($p)) {
				foreach($p as $kk => $vv) {
					$field_bits = explode(':',$kk);
					if($field_bits[0] == 'InfContact') {
						$ifields[] = $field_bits[1];
					}
				}
			} 
		}

		$iw_manual->search_infusion_contact_id();
		$cid = $iw_manual->infusion_contact_id;

		if($cid) {
			// Preload
			if($iwpro->ia_app_connect()) {
				$vals = $iwpro->app->dsLoad('Contact',(int) $cid,$ifields);

				if(is_array($vals)) foreach($ifields as $v) {
					$val = isset($vals[$v]) ? $vals[$v] : "";

					if($val && $v = 'Birthday') $val = date('Y-m-d', strtotime($val));
					$iw_manual->merger->save_to_cache('InfContact', $v, $val);
				}
			}
		}

		foreach($pfields as $k => $p) {
			if(is_array($p)) {
				$pdata[$k] = array();
				foreach($p as $kk => $vv) {
					$val = stripslashes($iw_manual->merger->merge_text("{{{$kk}}}"));

					if($val || !$gdpr_data_nonempty)
						$pdata[$k][$kk] = array(
							'label' => $vv,
							'value' => $val
						);
				}
			} else {
				$val = stripslashes($iw_manual->merger->merge_text("{{{$k}}}"));
				if($val || !$gdpr_data_nonempty)
					$pdata[$k] = array(
							'label' => $p,
							'value' => $val
					);
			}
		}
	}

	return $pdata;
}

function infusedwoo_gdpr_cookie_script() {
	$enabled_cookie_alert = get_option('infusedwoo_cookie_alert', 0);
	$enabled_eu_only = get_option('infusedwoo_cookie_euonly', 0);
	$cookie_intro = get_option('infusedwoo_cookiealert_msg', 'Our website uses cookies to make your browsing experience better. By using our site you agree to our use of cookies. [link]Learn more[/link]');
	$cookie_title = get_option( 'infusedwoo_cookiealert_title', 'Cookie Policy' );
	$style = get_option( 'infusedwoo_cookiealert_style', 'dark' );
	$link = site_url() . '/iw-data/cookie-policy';

	$show = true;

	if(!isset($_GET['iw-cookie-alert'])) {
		if(!$enabled_cookie_alert) $show = false;
		if($show && is_user_logged_in() && !tc_enabled_in_region()) $show = false;
		if($show && $enabled_eu_only && !infusedwoo_is_in_eu()) $show = false;
	
		if(is_checkout()) $show = false;
	}
	
	if($style == 'orange') {
		$bg = "#eb6c44";
		$button = "#f5d948";
		$text = "#ffffff";
	} else if($style == 'light') {
		$bg = "#edeff5";
		$button = "#4b81e8";
		$text = "#838391";
	} else {
		$bg = "#000";
		$button = "#f1d600";
		$text = "#ffffff";
	}
	

	if(!$show) return true;

	$cookie_intro = apply_filters( 'infusedwoo_cookiealert_msg', $cookie_intro );

	$cookie_intro = str_replace('[link]', '<a class="cc-link" href="'.$link.'" target="_blank">', $cookie_intro);
	$cookie_intro = str_replace('[/link]', '</a>', $cookie_intro);

	$dismiss = apply_filters( 'infusedwoo_cookiealert_dismiss',__('Got it!','woocommerce'));
	$decline = apply_filters( 'infusedwoo_cookiealert_dismiss',__('Decline','woocommerce'));
	$agree = apply_filters( 'infusedwoo_cookiealert_dismiss',__('Allow Cookies','woocommerce'));
	?>
		<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
		<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.js"></script>
		<script>
		window.addEventListener("load", function(){
		window.cookieconsent.initialise({
		  "palette": {
		    "popup": {
		      "background": <?php echo json_encode($bg); ?>,
		      "text": <?php echo json_encode($text); ?>
		    },
		    "button": {
		      "background": <?php echo json_encode($button); ?>
		    }
		  },
    	  revokable:true,
		  "theme": "edgeless",
		  "content": {
		  	"message": <?php echo json_encode($cookie_intro); ?>,
		  	"link": '',
		  	"allow": <?php echo json_encode($agree); ?>,
		  	"deny": <?php echo json_encode($decline); ?>,
		  	"dismiss": <?php echo json_encode($dismiss); ?>
		  },
		  "cookie": {
		  	name: 'iw_cookie_bar_response',
		  	path: '/',
		  	domain: <?php echo json_encode($_SERVER["HTTP_HOST"]); ?>
		  }
		})});
		</script>
	<?php
}

function infusedwoo_enable_data_management() {
	if(get_option('infusedwoo_gdpr_data_view')) {
		if(get_option('infusedwoo_gdpr_data_euonly')) {
			$c = "";
			if(is_user_logged_in()) {
				// Get country
				$uid = get_current_user_id();
				$c = get_user_meta($uid, 'billing_country', true );
				$c = $c ? $c : ''; 

			}

			$in_eu = infusedwoo_is_in_eu($c);

			return $in_eu;
		} else {
			return true;
		}
	} else {
		return false;
	}
}

function infusedwoo_ma_my_data() {
	if(infusedwoo_enable_data_management())
		include 'gdpr-my-data-page.php';
}

function infusedwoo_ma_my_preferences() {
	include 'gdpr-my-preferences-page.php';
}

function infusedwoo_gdpr_menu_items( $items ) {
	$new_items = array();
	$menu_title = apply_filters( 'infusdwoo_ma_data_title', __( 'My Data', 'woocommerce' ));
	$mypref_title = apply_filters( 'infusdwoo_ma_preferences_title', __( 'My Preferences', 'woocommerce' ));
	$put_b4 = apply_filters( 'infusdwoo_ma_data_b4_to','customer-logout');

	foreach($items as $k => $v) {
		if($k == $put_b4) {
			if(infusedwoo_enable_data_management()) {
				$new_items['iw-data'] = $menu_title;
			}
			
			if(infusedwoo_enable_data_management()) {
				$new_items['iw-preferences'] = $mypref_title;
			}
		}
		$new_items[$k] = $v;
	}

   
    return $new_items;
}

function infusedwoo_gdpr_my_account_endpoint() {
	add_rewrite_endpoint( 'iw-data', EP_PAGES );
	add_rewrite_endpoint( 'iw-preferences', EP_PAGES );
}
 



function infusedwoo_check_tc_updates() {
	$current_uri = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$terms_uri = get_option('infusedwoo_tc_link');

	if(iw_UrlsTheSame($current_uri, $terms_uri)) return true;

	if(is_user_logged_in()) {
		$require_utc = get_option('infusedwoo_utc_req');
		if($require_utc && tc_enabled_in_region()) {
			$get = array('from' => $current_uri);
			$updates_uri = get_site_url() . '/iw-data/terms_updates?' . http_build_query($get);
			header("Location: $updates_uri");
			exit();
		}
	}
}

function infusedwoo_user_auth($parsed=array(),$token_ind=false, $request_token=true) {
	if(is_user_logged_in()) {
		$user_id = get_current_user_id();
	} else if($token_ind !== false) {
		$token = isset($parsed[$token_ind]) ? $parsed[$token_ind] : "";
		if(empty($token)) return false;

		$token_bits = explode('_', $token);
		

		// Check token 
		$check = get_transient( 'iw_usertok_' . $token_bits[0] );

		if(!isset($token_bits[1]) || !$token_bits[1])
			return false;

		if(!is_numeric(base64_decode($token_bits[1]))) {
			return false;
		}

		if($check == $token_bits[1]) {
			$user_id = base64_decode($token_bits[1]);


		} else {
			$user_id = false;
		}
	} else {
		$user_id = false;
	}

	if(!$user_id && $request_token) {
		$current_uri = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$requested_uri = str_replace($token, '', $current_uri);
		include 'gdpr-request-token.php';
		return false;
	}

	return $user_id;
}

function infusedwoo_gdpr_links($query) {
	$endpoint = 'iw-data';
	if(substr($query->request, 0, strlen($endpoint)) === $endpoint) {
		$parsed = explode('/', $query->request);
		infusedwoo_gdpr_views($parsed);
		exit();
	}
}

function infusedwoo_gdpr_views($parsed) {
	if(isset($parsed[1]) && $parsed[1] == 'terms_updates') {
		if(isset($parsed[2]) && $parsed[2] == 'agree') {
			$user_id = infusedwoo_user_auth($parsed,3);
			$token = isset($parsed[3]) ? $parsed[3] : 0;
			if($user_id) {
				infusedwoo_tc_agree_actions($user_id);
				$proceed = isset($_GET['from']) ? $_GET['from'] : site_url();

				header("Location: $proceed");
			}
		} else {
			$user_id = infusedwoo_user_auth($parsed,2);
			$token = isset($parsed[2]) ? $parsed[2] : 0;
			if($user_id) {
				include 'gdpr-terms-update.php';
			}	
		}
	} else if(isset($parsed[1]) && $parsed[1] == 'cookie-policy') {
		include 'gdpr-cookie-policy.php';

	} else if(isset($parsed[1]) && $parsed[1] == 'consent') {
		$user_id = infusedwoo_user_auth($parsed,2);
		$token = isset($parsed[2]) ? $parsed[2] : 0;
		if($user_id) {
				include 'gdpr-consent-page.php';
			}

	} else if(isset($parsed[1]) && $parsed[1] == 'saved_cart') {
		$user_id = infusedwoo_user_auth($parsed,2);
		$token = isset($parsed[2]) ? $parsed[2] : 0;
		if($user_id) {
			$user = get_user_by( 'ID', $user_id );
			ia_restore_cart($user->user_email, wc_get_cart_url());
		}
	} else if(isset($parsed[1]) && $parsed[1] == 'gen_token') {
		$admin_token = isset($parsed[2]) ? $parsed[2] : "";
		$cfield = isset($parsed[3]) ? $parsed[3] : "";
		$email = isset($_POST['Email']) ? $_POST['Email'] : '';

		if(empty($email) && isset($_GET['Email'])) {
			$email = $_GET['Email'];
		}

		if(empty($email) && isset($_POST['contactId'])) {
			global $iwpro;
			$iwpro->ia_app_connect();
			$c = $iwpro->app->dsLoad('Contact', (int) $_POST['contactId'],array('Email'));

			$email = $c['Email'];
		}

		if(empty($email)) return false;

		if(!empty($admin_token) && $admin_token == infusedwoo_get_admin_token()) {

			infusedwoo_gdpr_gen_token($email,$cfield);
			exit();
		}
	}

}


function infusedwoo_monitor_tc_agreement_userid($userid) {
	$user = get_user_by('ID',$userid);

	if(isset($_POST['iw_tc_agree'])) {
		infusedwoo_tc_agree_actions($userid);
	}

	// Check for Consent Agreements
	foreach($_POST as $k => $v) {
		if(strpos($k, 'iw_consent_') !== false) {
			$consent_topic_id = (int) str_replace('iw_consent_', '', $k);

			$manual = new IW_UserConsent_Trigger;
			$manual->merger = new IW_Automation_MergeFields($manual, array());
			$manual->user_email = $user->user_email;
			$manual->log_stats($consent_topic_id, 'Gave consent via Woocommerce Checkout');
			$manual->run_action($consent_topic_id);
		}
	}
}

function infusedwoo_monitor_tc_agreement_user($user) {
	$user = get_user_by('login',$user);
	if(isset($_POST['iw_tc_agree'])) {
		if($user) {
		   infusedwoo_tc_agree_actions($user->ID);
		}
	}

	// Check for Consent Agreements
	foreach($_POST as $k => $v) {
		if(strpos($k, 'iw_consent_') !== false) {
			$consent_topic_id = (int) str_replace('iw_consent_', '', $k);

			$manual = new IW_UserConsent_Trigger;
			$manual->merger = new IW_Automation_MergeFields($manual, array());
			$manual->user_email = $user->user_email;
			$manual->log_stats($consent_topic_id, 'Gave consent via Woocommerce Checkout');
			$manual->run_action($consent_topic_id);
		}
	}
}

function infusedwoo_monitor_tc_agreement_order($result) {
	$user_id = 0;

	$order = wc_get_order($result);
	$user_id = $order->get_user_id();

	if($user_id) {
		$user = get_user_by( 'ID', $user_id );
		$email = $user->user_email;
	} else {
		$email = $order->get_billing_email();
	}

	if(isset($_POST['iw_tc_agree'])) {
		update_post_meta( $order->get_id(), 'infusedwoo_tc_agree_date', current_time( 'Y-m-d' ));

		if($user_id) {
			infusedwoo_tc_agree_actions($user_id);
		}
	}

	// Check for Consent Agreements
	foreach($_POST as $k => $v) {
		if(strpos($k, 'iw_consent_') !== false) {
			$consent_topic_id = (int) str_replace('iw_consent_', '', $k);

			$manual = new IW_UserConsent_Trigger;
			$manual->merger = new IW_Automation_MergeFields($manual, array());
			$manual->user_email = $email;
			$manual->log_stats($consent_topic_id, 'Gave consent via Woocommerce Checkout');
			$manual->run_action($consent_topic_id);
		}
	}
}

function infusedwoo_tc_agree_actions($user_id) {
	update_user_meta( $user_id, 'infusedwoo_tc_agree_date', current_time( 'Y-m-d' ));
	do_action( 'infusedwoo_user_agrees_to_tc', $user_id );
}

function infusedwoo_gdpr_tc_reg1_validate($wp_error) {
	if(!is_admin()) {
		$enabled = get_option('infusedwoo_tc_reg', 0);

		if($enabled && tc_enabled_in_region()) {
			if(!isset($_POST['iw_tc_agree'])) {
				$terms_error = __('You must agree to our terms of service to proceed.', 'woocommerce');
				$terms_error = apply_filters( 'infusedwoo_tc_error_msg', $terms_error );

				$wp_error->add('iw_tc_agree',$terms_error);
			}
		}
	}

	return $wp_error;
}


function infusedwoo_gdpr_tc_reg_validate($result) {
	if(!is_admin()) {
		$enabled = get_option('infusedwoo_tc_reg', 0);

		if($enabled && tc_enabled_in_region()) {
			if(!isset($_POST['iw_tc_agree'])) {
				$terms_error = __('You must agree to our terms of service to proceed.', 'woocommerce');
				$terms_error = apply_filters( 'infusedwoo_tc_error_msg', $terms_error );

				$result['errors']->add('iw_tc_agree',$terms_error);
			}
		}
	}

	return $result;
}

function infusedwoo_gdpr_tc_reg($wp_error) {
	$enabled = get_option('infusedwoo_tc_reg', 0);

	if($enabled && tc_enabled_in_region()) {
		if(isset($wp_error->errors['iw_tc_agree'])) {
			echo "<p class='error'>". $wp_error->errors['iw_tc_agree'][0] ."</p>";
		}
		echo_infusedwoo_tc();
		
	}
}

function infusedwoo_gdpr_tc_wcreg() {
	$enabled = get_option('infusedwoo_tc_my_acct', 0);

	if($enabled && tc_enabled_in_region()) {
		echo_infusedwoo_tc();
	}

	infusedwoo_gdpr_consent_items();
}

function infusedwoo_gdpr_tc_checkout() {
	$enabled_checkout = get_option('infusedwoo_tc_checkout', 0);

	if($enabled_checkout && tc_enabled_in_region()) {
		echo_infusedwoo_tc();
	}

	infusedwoo_gdpr_consent_items();
}

function infusedwoo_validate_tc_checkout() {
	$enabled_checkout = get_option('infusedwoo_tc_checkout', 0);
	$terms_error = __('You must agree to our terms of service to proceed.', 'woocommerce');
	$terms_error = apply_filters( 'infusedwoo_tc_error_msg', $terms_error );

	if($enabled_checkout && tc_enabled_in_region()) {
		if(!isset($_POST['iw_tc_agree'])) {
			wc_add_notice($terms_error,'error');	
		}
	}
}

function tc_enabled_in_region($userid = "") {
	// Check if user has already previously agreed.
	$country = "";
	$uid = $userid ? $userid : get_current_user_id();

	if($uid) {
		$agree_date = get_user_meta( $uid, 'infusedwoo_tc_agree_date', true );

		if(strtotime(get_option('infusedwoo_tc_date')) <= strtotime($agree_date)) {
			return false;
		}

		$country = get_user_meta( $uid, 'billing_country', true );
	}

	$enabled_eu_only = get_option('infusedwoo_tc_euonly', 0);

	if($enabled_eu_only) {
		return infusedwoo_is_in_eu($country);
	} else {
		return true;
	}
	
}

function infusedwoo_is_in_eu($c = "") {
	$eu_codes = array(
	    "BE", "BG", "CZ", "DK", "DE", "EE", "IE", "GR", "ES", "FR", "HR", "IT", "CY",
	    "LV", "LT", "LU", "HU", "MT", "NL", "AT", "PL", "PT", "RO", "SI", "SK", "FI",
	    "SE", "GB"
	);   

	$country = ""; 

	if(!empty($c)) {
		$country = $c;
	} else if(is_checkout() && isset($_POST['country'])) {
		$country = $_POST['country'];
	} else if(is_checkout() && isset($_POST['billing_country'])) {
		$country = $_POST['billing_country'];
	} else if(class_exists('WC_Geolocation')) {
		$geolocate = WC_Geolocation::geolocate_ip();
		$country = $geolocate['country'];
	}

	return in_array($country, $eu_codes);
}

function iw_UrlsTheSame($url1, $url2) {
    $mustMatch = array_flip(['host', 'path']);
    $defaults = ['path' => '/']; // if not present, assume these (consistency)
    $url1 = parse_url($url1) ? array_intersect_key(parse_url($url1), $mustMatch) : false;
    $url2 = array_intersect_key(parse_url($url2), $mustMatch);

    foreach($url1 as $k => $v) {
    	$v = strtolower($v);

    	if(substr($v, -1) == '/') {
    		$v = substr($v, 0, -1); 
    	}

    	$url1[$k] = $v;
    }

    foreach($url2 as $k => $v) {
    	$v = strtolower($v);

    	if(substr($v, -1) == '/') {
    		$v = substr($v, 0, -1); 
    	}

    	$url2[$k] = $v;
    }

    return $url1 === $url2;
}

function echo_infusedwoo_tc($enhanced=true, $checked=false, $reqd=1, $label="", $name="iw_tc_agree") {
	$link = get_option('infusedwoo_tc_link','');

	if(!$label) {
		$intro = get_option('infusedwoo_tc_msg', 'I have read and agree to the [link]Terms of Service[/link]');
		$intro = apply_filters( 'infusedwoo_tc_msg', $intro );

		$intro = str_replace('[link]', '<a href="'.$link.'" target="_blank">', $intro);
		$intro = str_replace('[/link]', '</a>', $intro);

		$label = $intro;
	} 

	

	?>
	<style type="text/css">
		.iwtc-enhanced {
		  position: relative;
		  min-height: 29px;
		  margin-bottom: 8px;
		  margin-top: 8px;
		}

		.iwtc-enhanced label.checker {
		  background-color: #fff;
		  border: 1px solid #ccc;
		  border-radius: 50%;
		  cursor: pointer;
		  height: 28px;
		  left: 0;
		  position: absolute;
		  top: 0;
		  width: 28px;
		  margin: 0;
		}

		.iwtc-enhanced label.checker:after {
		  border: 2px solid #fff;
		  border-top: none;
		  border-right: none;
		  content: "";
		  height: 6px;
		  left: 7px;
		  opacity: 0;
		  position: absolute;
		  top: 8px;
		  transform: rotate(-45deg);
		  width: 12px;

		}

		.iwtc-enhanced input[type="checkbox"] {
		  visibility: hidden;
		  position: absolute;
		  bottom: 0;
		  left: 0;
		}

		.iwtc-enhanced input[type="checkbox"]:checked + label.checker {
		  background-color: #66bb6a;
		  border-color: #66bb6a;
		}

		.iwtc-enhanced input[type="checkbox"]:checked + label.checker:after {
		  opacity: 1;
		}

		.iwtc-enhanced .label {
			display: block;
			margin: 0 0 0 33px;
			
		}


	</style>
	<div class="iwtc <?php echo $enhanced ? 'iwtc-enhanced' : '' ?>"><input type="checkbox" name="<?php echo $name ?>" id="<?php echo $name ?>" <?php echo $reqd ? 'required' : '' ?> <?php echo $checked ? 'checked' : '' ?> /><label class="checker" for="<?php echo $name ?>"></label>
		<label class="label"> 
		&nbsp;<?php echo $label ?> 

		<?php if($reqd) { ?>
			<font color=red>*</font></label>
		<?php } ?>
	</div>
	<?php
}

function infusedwoo_gdpr_consent_items() {
	$topics =  iw_get_recipes('IW_UserConsent_Trigger');

	foreach($topics as $t) {
		$settings = iwar_get_recipe_settings($t->ID);
		$config = $settings['config'];
		$conditions	= isset($config['conditions']) ? $config['conditions'] : array();
		$consent_settings = get_post_meta( $t->ID, 'consent_settings', true );

		$show_checkout = $consent_settings['show_checkout'];
		$show_reg = $consent_settings['show_reg'];
		$show_eu = $consent_settings['show_eu'];


		if($show_checkout) {
			if(!$show_eu || ($show_eu && infusedwoo_is_in_eu())) {
				// Test Conditions
				$show = true;

				$ct = new IW_UserConsent_Trigger;
				$ct->merger = new IW_Automation_MergeFields($ct, array());
				

				foreach($conditions as $k => $cond) {
					if(class_exists($cond['condition'])) {
						$test_condition = new $cond['condition'];
						$conf = isset($cond['config']) ? $cond['config'] : array();
						$test_condition->recipe_id_proc = $t->ID;
						$test_condition->sequence_id = $k;
						if(!$test_condition->test($conf, $ct)) {
							$show = false;
							break;
						}
					}
				}

				if(is_user_logged_in()) {
					$user_id = get_current_user_id();
					if($ct->get_signup_status($t->ID)) {
						$show = false;
					}
				}

				if($show) {
					echo_infusedwoo_tc(1,0,0,$consent_settings['label'],('iw_consent_' . $t->ID));
				}
			}
		}
	}
}

function iw_count_old_identifiable_records() {
	global $wpdb;
	$ci_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->comments WHERE `comment_author` LIKE 'InfusedWoo' AND `comment_content` LIKE '%@%'" );

	$ai_count = $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}ia_savedcarts WHERE `email` LIKE '%@%'" );

	return $ci_count + $ai_count;
}

