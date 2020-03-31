<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class IW_IsInEU_Condition extends IW_Automation_Condition {
	function get_title() {
		return 'If user is in EU Region';
	}

	function allowed_triggers() {
		return array(
				'IW_AddToCart_Trigger',
				'IW_PageVisit_Trigger',
				'IW_Purchase_Trigger',
				'IW_UserAction_Trigger',
				'IW_OrderCreation_Trigger',
				'IW_Purchase_Trigger',
				'IW_Checkout_Trigger',
				'IW_UserConsent_Trigger'
			);
	}

	function on_class_load() {
		
	}

	function display_html($config = array()) {
		$html = '';
		return $html;
	}

	function validate_entry($conditions) {
		
	}


	function test($config, $trigger) {
		return infusedwoo_is_in_eu();
	}
}

iw_add_condition_class('IW_IsInEU_Condition');