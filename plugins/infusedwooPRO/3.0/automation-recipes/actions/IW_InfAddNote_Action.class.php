<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class IW_InfAddNote_Action extends IW_Automation_Action {
	function get_title() {
		return "Add a Note to Contact in Infusionsoft";
	}

	function allowed_triggers() {
		return array(
				'IW_AddToCart_Trigger',
				'IW_HttpPost_Trigger',
				'IW_OrderCreation_Trigger',
				'IW_OrderStatusChange_Trigger',
				'IW_PageVisit_Trigger',
				'IW_Purchase_Trigger',
				'IW_UserAction_Trigger',
				'IW_WishlistEvent_Trigger',
				'IW_WooSubEvent_Trigger',
				'IW_Checkout_Trigger',
				'IW_UserConsent_Trigger'
			);
	}

	function display_html($config = array()) {
		$content = isset($config['content']) ? $config['content'] : '';
		$title = isset($config['title']) ? $config['title'] : '';



		$html = '<table style="margin-top: 5px;">';
		$html .= '<tr>';
		$html .= '<td>Note Title</td>';
		$html .= '<td><input name="title" type="text" value="'.$title.'" placeholder="Note Title" style="width: 280px;" class="iwar-mergeable" />';
		$html .= '<i class="fa fa-compress merge-button merge-overlap" aria-hidden="true" title="Insert Merge Field" ></i></td>';
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td valign="top">Note Content </td>';
		$html .= '<td><textarea style="width:100%; height; 150px !important;" name="content" class="iwar-mergeable">'.$content.'</textarea><i class="fa fa-compress merge-button merge-overlap" aria-hidden="true" title="Insert Merge Field" ></i></td>';
		$html .= '</tr>';
		$html .= '</table>';

		return $html;
	}

	function validate_entry($config) {
		if(empty($config['title'])) {
			return "Please enter a note title.";
		}
	}

	function process($config, $trigger) {
		if(isset($trigger->user_email) && !empty($trigger->user_email)) {
			if(!isset($trigger->infusion_contact_id)) {
				$trigger->search_infusion_contact_id(true);
			}

			if(!empty($trigger->infusion_contact_id)) {
				global $iwpro;

				if($iwpro->ia_app_connect()) {
					$iwpro->app->dsAdd('ContactAction', array(
						'ActionDescription' => $trigger->merger->merge_text($config['title']),
						'ContactId' => $trigger->infusion_contact_id,
						'ActionType' => 'Other',
						'CreationNotes' => $trigger->merger->merge_text($config['content'])
					));
				}
			} 
		} 
	}

	function infusedwoo_data_src_infusion_tags() {
		global $iwpro;

		if(!$iwpro->ia_app_connect()) return false;
		$tags = $iwpro->app->dsFind('ContactGroup',100,0,'GroupName',"%{$_GET['term']}%", array('Id','GroupName'));

		$result = array();
		foreach($tags as $tag) {
			$result[] = array(
					'label' => $tag['GroupName'] . " [ {$tag['Id']} ]",
					'value' => $tag['Id'],
					'id' => $tag['Id']
				);
		}

		echo json_encode($result);
		exit();

	}
}

iw_add_action_class('IW_InfAddNote_Action');