<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class IW_SetInfReferralPartner_Action extends IW_Automation_Action {
	function get_title() {
		return "Set Session Referral Partner (Infusionsoft)";
	}

	function allowed_triggers() {
		return array(
				'IW_Checkout_Trigger',
				'IW_AddToCart_Trigger',
				'IW_PageVisit_Trigger',
				'IW_UserAction_Trigger',
				'IW_OrderCreation_Trigger'
			);
	}

	function display_html($config = array()) {
		$type = isset($config['type']) ? $config['type'] : '';
		$value = isset($config['value']) ? $config['value'] : '';

		$html = '<select type="text" name="type">';
		$html .= '<option value="affid" '. ($type == 'affid' ? 'selected' : '') .'>Enter Referral Partner ID</option>';
		$html .= '<option value="affcode" '. ($type == 'affcode' ? 'selected' : '') .'>Enter Referral Partner Code</option></select>'; 
		$html .= '&nbsp;&nbsp;<input type="text" name="value" value="'.$value.'" placeholder="" class="iwar-mergeable" style="width: 150px;"  />';
		$html .= '<i class="fa fa-compress merge-button merge-overlap" aria-hidden="true" title="Insert Merge Field"></i>';
	
		return $html;
	}

	function validate_entry($config) {
		if(empty($config['value'])) {
			return 'Please enter a value';
		}
	}

	function process($config, $trigger) {
		$siteurl = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '';
		$siteurl = str_replace("http://","",$siteurl);
		$siteurl = str_replace("https://","",$siteurl);
		$siteurl = str_replace("www.","",$siteurl);


		if($config['type'] == 'affid') {
			setcookie("is_aff", $config['value'], (time()+365*24*3600), "/", $siteurl, 0); 
			setcookie("is_affcode", "", -1, "/", $siteurl, 0); 

			if(WC()->session) {
				WC()->session->set('iw_is_aff', $config['value']);
				WC()->session->set('iw_is_affcode', false);
			}
			

		} else {
			setcookie("is_affcode", $config['value'], (time()+365*24*3600), "/", $siteurl, 0);
			setcookie("is_aff", "", -1, "/", $siteurl, 0); 

			if(WC()->session) {
				WC()->session->set('iw_is_affcode', $config['value']);
				WC()->session->set('iw_is_aff', false);
			}
		}
	}
}

iw_add_action_class('IW_SetInfReferralPartner_Action');