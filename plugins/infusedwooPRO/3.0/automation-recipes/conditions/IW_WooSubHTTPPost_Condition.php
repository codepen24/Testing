<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class IW_WooSubHTTPPost_Condition extends IW_Automation_Condition {
	function get_title() {
		return 'If an HTTP POST event is triggered for this subscription';
	}

	function allowed_triggers() {
		return array(
				'IW_WooSubEvent_Trigger'
			);
	}

	function on_class_load() {
		
	}

	function display_html($config = array()) {
		global $iwpro;
		$key = substr($iwpro->apikey, 0,6);
		return '<i style="font-size: 10pt;">
				To trigger an HTTP POST, please ping the following URL with the [SUB_ID] replaced with the actual Woocommerce Subscription ID:<br><br>

				<textarea readonly style="width:100%">'. admin_url( 'admin-ajax.php?action=iw_wcsubevent_trig&key='.$key.'&sub_id=[SUB_ID]' ).'</textarea>
			</i>';


	}

	function validate_entry($conditions) {

	}


	function test($config, $trigger) {
		return $trigger->sub_event == 'http_post';
	}
}

iw_add_condition_class('IW_WooSubHTTPPost_Condition');