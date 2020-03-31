<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$uid = get_current_user_id();

if($_POST) {
	if(isset($_POST['iw_tc_agree'])) {
		infusedwoo_tc_agree_actions($uid);
	}
}

$link = get_option('infusedwoo_tc_link','');
$utc_title = get_option('infusedwoo_utc_title','Updates to our Terms and Conditions');
$utc_intro = get_option('infusedwoo_utc_msg','There were updates to our [link]Terms and Conditions[/link]. Please read and agree to our new terms and conditions.');
	$$utc_intro = get_option('infusedwoo_tc_msg', 'I have read and agree to the [link]Terms of Service[/link]');
	$utc_intro = apply_filters( 'infusedwoo_tc_msg', $utc_intro );

	$utc_intro = str_replace('[link]', '<a href="'.$link.'" target="_blank">', $utc_intro);
	$utc_intro = str_replace('[/link]', '</a>', $utc_intro);

$tc_date = get_option('infusedwoo_tc_date');

$intro = get_option('infusedwoo_tc_msg', 'I have read and agree to the [link]Terms of Service[/link]');
	$intro = apply_filters( 'infusedwoo_tc_msg', $intro );

	$intro = str_replace('[link]', '', $intro);
	$intro = str_replace('[/link]', '', $intro);

$require_utc = get_option('infusedwoo_utc_req');

$agree_date = get_user_meta( $uid, 'infusedwoo_tc_agree_date', true );

$topics =  iw_get_recipes('IW_UserConsent_Trigger');


?>
<style type="text/css">
	.tc-reqd {
		border: 2px solid red;
	}
</style>
<?php 
	$user = get_user_by( 'ID', $uid );
	$email = $user->user_email;
	$manual = new IW_UserConsent_Trigger;
	$manual->user_email = $email;
	$manual->merger = new IW_Automation_MergeFields($manual, array());

		
	if($_POST) { 

		foreach($_POST as $k => $v) {
			if(strpos($k, 'iw_consent_') !== false) {
				$consent_topic_id = (int) str_replace('iw_consent_', '', $k);
				$current_subscription = $manual->get_signup_status($consent_topic_id);

				if(!$current_subscription && $_POST[$k]) {
					$manual->log_stats($consent_topic_id, 'Gave consent via Woocommerce My Account Page');
					$manual->run_action($consent_topic_id);
				} else if($current_subscription && !$_POST[$k]) {
					$manual->revoke_user($consent_topic_id);
					update_user_meta( $uid, 'iw_consent_topic_' . $consent_topic_id, 0);
				}
			}
		}

	?>
	<div class="woocommerce-message" role="alert"><?php _e('Account details changed successfully.', 'woocommerce'); ?></div>
<?php } ?>
<form method="POST" class="iw-my-preferences">
<?php if(tc_enabled_in_region()) { ?>
	<fieldset class="tc">
		<h3><?php echo $utc_title; ?></h3>

		 <?php echo $utc_intro; ?> (<?php echo $tc_date; ?>)
		 <?php echo_infusedwoo_tc() ?>
	</fieldset>
<?php } else if($agree_date) { ?>
	<fieldset class="tc">
		<h3>Terms of Service</h3>
		<?php echo_infusedwoo_tc(1,1) ?>
	</fieldset>
<?php }  ?>

<?php 
	foreach($topics as $t) {
		$settings = iwar_get_recipe_settings($t->ID);
		$config = $settings['config'];
		$conditions	= isset($config['conditions']) ? $config['conditions'] : array();
		$consent_settings = get_post_meta( $t->ID, 'consent_settings', true );

		$show_checkout = $consent_settings['show_checkout'];
		$show_reg = $consent_settings['show_reg'];
		$show_eu = $consent_settings['show_eu'];

		$sign_up_status = $manual->get_signup_status($t->ID);

		// Show unchecked consent if conditions are met
		if($sign_up_status === false && count($conditions) > 0) {
			$sign_up_status = 0;
			foreach($conditions as $k => $cond) {
				if(class_exists($cond['condition'])) {
					$test_condition = new $cond['condition'];
					$conf = isset($cond['config']) ? $cond['config'] : array();
					$test_condition->recipe_id_proc = $t->ID;
					$test_condition->sequence_id = $k;
					if(!$test_condition->test($conf, $manual)) {
						$sign_up_status = false;
						break;
					}
				}
			}
		}

		if($sign_up_status !== false) {
			?>
			<fieldset class="tc">
				<h3><?php echo $settings['title']; ?></h3>
				<input type='hidden' value='0' name='<?php echo 'iw_consent_' . $t->ID; ?>'>
			<?php echo_infusedwoo_tc(1,$sign_up_status,0,$consent_settings['label'],('iw_consent_' . $t->ID)); ?>
			</fieldset>
			<?php
		}
	}
?>

<button type="submit" class="woocommerce-Button button" name="save_pref_details" value="Save changes">Save changes</button>
</form>
<script>
	jQuery('[name=save_pref_details]').click(function() {
		if(jQuery('[name=iw_tc_agree]').length && !jQuery('[name=iw_tc_agree]').is(':checked')) {
			jQuery('.tc').addClass('tc-reqd');
		}
	});
</script>

