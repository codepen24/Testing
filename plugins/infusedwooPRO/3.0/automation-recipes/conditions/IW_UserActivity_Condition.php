<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class IW_UserActivity_Condition extends IW_Automation_Condition {
	function get_title() {
		return 'If the user does this activity ...';
	}

	function allowed_triggers() {
		return array(
				'IW_UserAction_Trigger'
			);
	}

	function on_class_load() {
		
	}

	function display_html($config = array()) {
		$activity = isset($config['activity']) ? $config['activity'] : '';

		$actions = array(
				'wp_login' => 'User logs in',
				'wp_logout' => 'User logs out',
				'reachedcheckout' => 'User attempts payment',
				'cartemptied' => 'User emptied cart',
				'user_register' => 'User registers to wordpress',
				'tc_agree'	=> 'User Agrees to Terms'
				//'billing' => 'User Changes Billing Information',
				//'shipping' => 'User Changes Shipping Information',
			);

		$html = '<select name="activity" autocomplete="off">';
		foreach ($actions as $k => $v) {
			$html .= '<option value="'.$k.'" '.($k == $activity ? 'selected' : '').'>'.$v.'</option>';
		}

		$html .= '</select>';
		return $html;
	}

	function validate_entry($conditions) {

	}


	function test($config, $trigger) {
		if(isset($trigger->event)) return $trigger->event == $config['activity'];		
	}
}

iw_add_condition_class('IW_UserActivity_Condition');