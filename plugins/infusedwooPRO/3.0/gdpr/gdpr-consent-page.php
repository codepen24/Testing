<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$uid = $user_id;

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

$user = get_user_by( 'ID', $uid );
	$email = $user->user_email;
	$manual = new IW_UserConsent_Trigger;
	$manual->user_email = $email;
	$manual->merger = new IW_Automation_MergeFields($manual, array());

$updated = 0;

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

	$updated = 1;
}

?>

<!DOCTYPE html>
<html style="background-color: #eff0f1">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Contact Preferences</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <style type="text/css">
    	

    </style>
  </head>
  <body >
  <section class="section">
    <div class="container">
      <div class="card" style="width: 500px; margin:auto;">
		  <header class="card-header">
		    <p class="card-header-title">
		      My Contact Preferences
		    </p>
		  </header>
		  <div class="card-content">
		    <div class="content">
		       <form method="POST">
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
									<div class="box">
										<h3><?php echo $settings['title']; ?></h3>
										<input type='hidden' value='0' name='<?php echo 'iw_consent_' . $t->ID; ?>'>
									<?php echo_infusedwoo_tc(1,$sign_up_status,0,$consent_settings['label'],('iw_consent_' . $t->ID)); ?>
									</div>
									<?php
								}
							}
					?>


					<?php if(tc_enabled_in_region($uid)) { ?>
						<div class="box">
							<h3><?php echo $utc_title; ?></h3>

							 <?php echo $utc_intro; ?> (<?php echo $tc_date; ?>)
							 <?php echo_infusedwoo_tc() ?>
						</div>
					<?php } else if($agree_date) { ?>
						<div class="box">
							<h3>Terms of Service</h3>
							<?php echo_infusedwoo_tc(1,1) ?>
						</div>
					<?php }  ?>

				
		    </div>
		    <div>
		    	<?php if($updated) { ?>

		    		<article class="message is-success">
					  <div class="message-body">
					    Saved Preferences
					  </div>
					</article>
		    	<?php } ?>
		    	<article class="message is-danger" style="display: none;">
				  <div class="message-body">
				    You must agree to our terms to proceed
				  </div>
				</article>
		    	<center>
		  		<button type="submit" class="button is-medium is-primary updpref" style="">
			   	 <span>Update My Preferences</span>
			  	</button>  	
			  	</center>
		    </div>
		  </div>
		  
		</div>
		</form>
    </div>
  </section>
  <script type="text/javascript">
  	jQuery('.updpref').click(function() {
  		var tc_checked = jQuery('[name=iw_tc_agree]').is(':checked');

  		if(!tc_checked) {
  			jQuery('.message').hide();
  			jQuery('.is-danger').show();
  			return false;
  		} else {
  			jQuery('.is-danger').hide();
  		}

  		
  	});

  </script>
  </body>
</html>