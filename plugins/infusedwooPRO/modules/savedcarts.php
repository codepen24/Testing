<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $ia_sc_db_version;
$ia_sc_db_version = "1.0";

function ia_sc_db_install() {
	global $wpdb;
	global $ia_sc_db_version;

	$installed_ver = get_option( "ia_sc_db_version" );

	if( $installed_ver != $ia_sc_db_version ) {   
		$table_name = $wpdb->prefix . "ia_savedcarts";
		  
		$sql = "CREATE TABLE $table_name (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  updated datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  email tinytext NOT NULL,
		  cartcontent longtext NOT NULL,
		  hash VARCHAR(20) DEFAULT '' NOT NULL,
		  UNIQUE KEY id (id)
		);";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );

		update_option( "ia_sc_db_version", $ia_sc_db_version );
	}
}

function ia_sc_db_check() {
    global $ia_sc_db_version;
    if (get_site_option( 'ia_sc_db_version' ) != $ia_sc_db_version) {
        ia_sc_db_install();
    }
}

function ia_save_cart($email, $cart_contents) {
	if(isset($email) && !empty($email)) {

		global $wpdb;
		$user = get_user_by( 'email', $email );

		if(isset($user->ID) && $user->ID > 0) $user_id = $user->ID;
		else {
			if(apply_filters( 'infusedwoo_sc_generate_user', false )) {
				$user_fields = array(
					'user_email' => $email,
					'user_login' => $email,
					'user_pass' => wp_generate_password( 15 )
				);
				$user_id = wp_insert_user($user_fields);
			} else {
				return false;
			}
			
		}


		$ia_savedcarts = $wpdb->prefix . "ia_savedcarts";

		$check = $email;
		$exists = $wpdb->get_var( $wpdb->prepare(
	    	"SELECT COUNT(*) FROM `$ia_savedcarts` WHERE `email` = %s", $email
	  	));

	  	if(!$exists) {
	  		$exists = $wpdb->get_var( $wpdb->prepare(
		    	"SELECT COUNT(*) FROM `$ia_savedcarts` WHERE `email` = %s", $user_id
		  	));
		  	$check = $user_id;
	  	}

	  	if($exists) {
			$wpdb->update( 
				$ia_savedcarts, 
				array( 'cartcontent' => serialize($cart_contents), 'updated' => current_time('mysql', 1), 'email' => $user_id), 
				array( 'email' => $check ), 
				array( '%s'), 
				array( '%s' )
			);
	  	} else {
	  		// generate hash
	  		$hash_exists = true;
	  		do {
	  			$hash = wp_generate_password(20, false);
	  			$hash_exists = (bool) $wpdb->get_var( $wpdb->prepare(
			    	"SELECT COUNT(*) FROM `$ia_savedcarts` WHERE `hash` = %s", $hash
			  	));
	  		} while($hash_exists);

	  		$wpdb->insert( 
				$ia_savedcarts, 
				array( 'cartcontent' => serialize($cart_contents), 'email' => $user_id, 'hash' => $hash, 'updated' => current_time('mysql', 1)),  
				array( '%s','%s','%s','%s') 
			);
	  	}
	}
}

function ia_retrieve_cart($email) {
	global $wpdb;
	$user = get_user_by( 'email', $email );
	$user_id = isset($user->ID) ? $user->ID : 0;

	$ia_savedcarts = $wpdb->prefix . "ia_savedcarts";
	$cart = $wpdb->get_results( 
		"
			SELECT * 
			FROM `$ia_savedcarts`
			WHERE `email` = '$email' OR `email` = '$user_id'
		", ARRAY_A
	);

	if(count($cart) > 0) {
		return $cart[0];
	} else {
		return array();
	}
}

function ia_restore_cart($email="", $uri="") {
	global $woocommerce;
	global $wpdb;
	$ia_savedcarts = $wpdb->prefix . "ia_savedcarts";

	$email = $email ? $email : (isset($_GET['ia_saved_cart']) ? $_GET['ia_saved_cart'] : '');

	if(!empty($email)) {
		if ( ! isset($woocommerce->cart ) || $woocommerce->cart == '' ) {
		    $woocommerce->cart = new WC_Cart();
		}

		
		$user = get_user_by( 'email', $email );
		$user_id = $user->ID;
		$user_id = isset($user->ID) ? $user->ID : 0;

		if(empty($uri)) {
			$uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
			$uri = "http://{$_SERVER['HTTP_HOST']}{$uri_parts[0]}";
		}
		

		$saved_cart = $wpdb->get_var( $wpdb->prepare(
			    	"SELECT cartcontent FROM `$ia_savedcarts` WHERE `email` LIKE %s OR `email` = '$user_id'", $email
			  	));

		if(!empty($saved_cart)) {
			$saved_cart = unserialize($saved_cart);

			//$woocommerce->cart->empty_cart();

			if(!WC()->session->has_session())
					WC()->session->set_customer_session_cookie(true);

			WC()->session->set('session_email', $email);
				
			WC()->session->set('cart', $saved_cart);

			/*foreach ( $saved_cart as $cart_item_key => $values ){
				$id = (string) $values['product_id'];
				$var_id = isset($values['variation_id']) ? $values['variation_id'] : '';
				$variation = isset($values['variation']) ? $values['variation'] : '';
				$quant= (int) $values['quantity'];
				$woocommerce->cart->add_to_cart( $id, $quant, $var_id, $variation);
			}*/

			
			$get = $_GET;
			unset($get['ia_saved_cart']);
			$get['saved_cart_loaded'] = $_GET['ia_saved_cart'];
			header("Location: " . "{$uri}?saved_cart_loaded");
			exit();
		}
	}
}

add_action('template_redirect', 'ia_restore_cart');

ia_sc_db_check();

?>