<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class IW_UserAction_Trigger extends IW_Automation_Trigger {	
	function trigger_when() {
		add_action('woocommerce_checkout_process', array($this,'pressed_checkout_button'),10,0);
		add_action('woocommerce_cart_is_empty', array($this,'cart_emptied'));
		add_action('wp_login', array($this,'wp_login'),10,2);
		add_action('user_register', array($this,'user_register'));
		add_action('wp_logout', array($this,'wp_logout'));
		add_action('infusedwoo_user_agrees_to_tc', array($this,'tc_agree'));
	}

	public $merge_handlers = array(
			'HTTPPost' => array('HTTP Post Value', 'merge_handler_post_value')
		);

	public function get_desc() {
		return 'when a specfic action is made by customer in woocommerce';
	}


	function get_title() {
		return 'User Action Trigger';
	}
	function get_icon() {
		return '<i class="fa fa-user" style="position:relative; left: 3px;"></i>';
	}

	function get_contact_email() {
		if($this->event == 'wp_login') {
			$user = $this->pass_vars[1];
			return $user->user_email;
		} else if($this->event == 'tc_agree') {
			$user_id = $this->pass_vars[0];
			$user = get_user_by( 'ID', $user_id );
			return $user->user_email;
		} else {
			$post_email_source = array('Email','email','billing_email','inf_field_Email','Contact0Email');
			$post_email = "";
			foreach($post_email_source as $src) {
				if(isset($_POST[$src]) && !empty($_POST[$src])) {
					$post_email = $_POST[$src];
				}
			}

			if(is_user_logged_in()) {
				$user = wp_get_current_user();
				$email = get_user_meta($user->ID, 'billing_email', true);
				if(empty($email)) $email = $user->user_email;

				return $email;
			} else if(!empty($post_email)) {
				return $post_email;
			} else {
				$session = WC()->session;
				if($session && method_exists($session, 'get')) {
					return WC()->session->get('session_email');
				}
			}
		}
	}


	function trigger_reached_checkout() {
		if(is_user_logged_in()) {
			$pass_vars = func_get_args();
			$this->pass_vars = $pass_vars;
			$this->event = 'reachedcheckout';

			$this->trigger();
		}
	}

	function pressed_checkout_button() {
		$pass_vars = func_get_args();
		$this->pass_vars = $pass_vars;
		$this->event = 'reachedcheckout';

		$this->trigger();
	}

	function cart_emptied() {
		$pass_vars = func_get_args();
		$this->pass_vars = $pass_vars;
		$this->event = 'cartemptied';

		$this->trigger();
	}

	function wp_login() {
		$pass_vars = func_get_args();
		$this->pass_vars = $pass_vars;
		$this->event = 'wp_login';

		$this->trigger();
	}

	function user_register() {
		$pass_vars = func_get_args();
		$this->pass_vars = $pass_vars;
		$this->event = 'user_register';
		$this->trigger();
	}

	function tc_agree() {
		$pass_vars = func_get_args();
		$this->pass_vars = $pass_vars;
		$this->event = 'tc_agree';
		$this->trigger();
	}

	function wp_logout() {
		$pass_vars = func_get_args();
		$this->pass_vars = $pass_vars;
		$this->event = 'wp_logout';

		$this->trigger();
	}





	function get_log_details() {
		return "Event " . $this->event;
	}

	function merge_fields() {
		return array('HTTPPost' => array());
	}

	function merge_handler_post_value($key) {
		return isset($_POST[$key]) ? $_POST[$key] : "";
	}
}

iw_add_trigger_class('IW_UserAction_Trigger');