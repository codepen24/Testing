<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class IW_WooSubEvent_Trigger extends IW_Automation_Trigger {
	public $is_advanced = true;

	function trigger_when() {
		add_action('woocommerce_scheduled_subscription_payment', array($this,'trigger_scheduled_subscription_payment'), 10, 1);
		add_action('woocommerce_subscription_renewal_payment_complete', array($this,'trigger_renewal_payment_complete'), 10, 1);
		add_action('woocommerce_subscription_payment_failed', array($this,'trigger_payment_failed'), 10, 1);
		add_action('woocommerce_subscription_payment_complete', array($this,'trigger_payment_complete'), 10, 1);
		add_action('woocommerce_subscription_renewal_payment_failed', array($this,'trigger_renewal_payment_failed'), 10, 1);
		add_action('woocommerce_subscription_status_updated', array($this,'trigger_status_changed'), 10, 3);

		add_action('woocommerce_scheduled_subscription_trial_end', array($this,'trigger_trial_end'), 10, 1);
		add_action('woocommerce_scheduled_subscription_end_of_prepaid_term', array($this,'trigger_end_of_prepaid_term'), 10, 1);

		add_action( 'wp_ajax_iw_wcsubevent_trig', array($this,'trigger_http_post'), 10,1 );
		add_action( 'wp_ajax_nopriv_iw_wcsubevent_trig', array($this,'trigger_http_post'), 10,1 );

	}

	public function get_desc() {
		return 'when an event happens related to a Woo Subscription';
	}


	function get_title() {
		return 'Woocommerce Subscription Event Trigger';
	}
	function get_icon() {
		return '<i class="fa fa-refresh" style="left: 2px; position: relative;"></i>';
	}

	function get_contact_email() {
		$s_key = $this->pass_vars[0];

		if(is_numeric($s_key)) {
			$subscription = wcs_get_subscription( $s_key );
		} else {
			$subscription = $s_key;
		}

		$this->log_details = "Subscription # " . $subscription->get_id();

		if(method_exists($subscription, 'get_billing_email')) {
			return $subscription->get_billing_email();
		} else {
			return $subscription->billing_email;
		}
	}

	function get_log_details() {
		return $this->log_details;
	}

	function get_user_cookie_ip() {

	}

	function trigger_http_post() {
		global $iwpro;
		$key = substr($iwpro->apikey, 0,6);
		$check_key = $_GET['key'];
		$check_sub_id = $_GET['sub_id'];

		if($check_key != $key) {
			echo "POST Request Forbidden";
			exit();
		} else if(empty($check_sub_id)) {
			echo "Missing sub_id parameter";
			exit();
		}

		if(!wcs_get_subscription($check_sub_id)) {
			echo 'Subscription does not exist';
			exit();
		}

		$this->pass_vars = array((int) $check_sub_id);
		$this->sub_event = 'http_post';
		echo 'Triggered HTTP POST event to Subscription # ' . $check_sub_id;

		$this->trigger();
		exit();
	}

	function __call($method, $args) {
		if(strpos($method, 'trigger_') !== false) {
			$this->pass_vars = $args;
			$this->sub_event = str_replace('trigger_', '', $method);

			$this->trigger();
		}
	}
}

iw_add_trigger_class('IW_WooSubEvent_Trigger');
