<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class IW_UserConsent_Trigger extends IW_Automation_Trigger {	
	public $is_hidden = true;

	function trigger_when() {
		
	}

	public function get_desc() {
		return 'when a specfic action is made by customer in woocommerce';
	}


	function get_title() {
		return 'User Consent Trigger';
	}
	function get_icon() {
		return '<i class="fa fa-user" style="position:relative; left: 3px;"></i>';
	}

	function get_contact_email() {
		$post_email_source = array('Email','email','billing_email','inf_field_Email','Contact0Email');
		$post_email = "";
		foreach($post_email_source as $src) {
			if(isset($_POST[$src]) && !empty($_POST[$src])) {
				$post_email = $_POST[$src];
			}
		}

		if(is_user_logged_in()) {
			$user = wp_get_current_user();
			$email = $user->user_email;
			if(empty($email)) $email = get_user_meta($user->ID, 'billing_email', true);

			return $email;
		} else if(!empty($post_email)) {
			return $post_email;
		} else {
			return WC()->session->get('session_email');
		}	
	}

	public function run_action($recipe_id) {
		global $iwpro;
		parent::run_action($recipe_id);


		$settings = iwar_get_recipe_settings($recipe_id);
		$consent_settings = get_post_meta( $recipe_id, 'consent_settings', true );

		$tag = isset($consent_settings['tag']['value']) ? $consent_settings['tag']['value'] : false;

		// IS Apply Tag
		if($tag && $iwpro->ia_app_connect()) {
			$this->search_infusion_contact_id();
			$cid = $this->infusion_contact_id;

			if($cid) {
				$iwpro->app->grpAssign($cid, (int) $tag);
				$iwpro->app->dsAdd('ContactAction', array(
						'ActionDescription' => 'User gave consent to a Topic',
						'ContactId' => $cid,
						'ActionType' => 'Other',
						'CreationNotes' => ("User gave Consent to: " . $settings['title'] . ': ' . $consent_settings['label'])
				));	
			}
		}

		// WP Apply Meta
		$this->search_wp_user_id();
		if($this->wp_user_id) {
			update_user_meta( $this->wp_user_id, 'iw_consent_topic_' . $recipe_id, time() );
		} 
	}

	public function revoke_user($recipe_id) {
		global $iwpro;
		$settings = iwar_get_recipe_settings($recipe_id);
		$consent_settings = get_post_meta( $recipe_id, 'consent_settings', true );

		$tag = isset($consent_settings['tag']['value']) ? $consent_settings['tag']['value'] : false;

		// IS Apply Tag
		if($tag && $iwpro->ia_app_connect()) {
			$this->search_infusion_contact_id();
			$cid = $this->infusion_contact_id;

			if($cid) {
				$iwpro->app->grpRemove($cid, (int) $tag);
				$iwpro->app->dsAdd('ContactAction', array(
						'ActionDescription' => 'User removed consent from a Topic',
						'ContactId' => $cid,
						'ActionType' => 'Other',
						'CreationNotes' => ("User removed their consent from: " . $settings['title'] . ': ' . $consent_settings['label'])
				));	
			}
		}

		// WP Apply Meta
		$this->search_wp_user_id();
		if($this->wp_user_id) {
			delete_user_meta( $this->wp_user_id, 'iw_consent_topic_' . $recipe_id);
		} 
	}

	function get_signup_status($recipe_id) {
		global $iwpro;

		$this->search_wp_user_id();
		$user_id = $this->wp_user_id;
		$consent_settings = get_post_meta( $recipe_id, 'consent_settings', true );
		$tag = isset($consent_settings['tag']['value']) ? $consent_settings['tag']['value'] : false;
		$consent = get_user_meta( $user_id, 'iw_consent_topic_' . $recipe_id, true );
		if($consent === '') $consent = false;

		if($tag && $iwpro->ia_app_connect()) {
			$this->search_infusion_contact_id();
			$cid = $this->infusion_contact_id;

			if($cid) {
				$c = $iwpro->app->dsLoad('Contact', $cid, array('Groups'));
				$current_tags = explode(",", $c['Groups']);

				$tag_status = in_array($tag,$current_tags);

				if($tag_status) return 1;
				else if(!$tag_status && !$consent) return $consent;
				else return 0;
			} else {
				return $consent;
			}
		} else {
			return $consent;
		}
	}

}

iw_add_trigger_class('IW_UserConsent_Trigger');