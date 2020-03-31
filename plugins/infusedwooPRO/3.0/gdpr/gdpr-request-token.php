<?php

if(isset($token_bits)) {
	$user_id = base64_decode($token_bits[1]);
	if($user_id) {
		$user = get_user_by( 'ID', $user_id );
		$email = $user->user_email;

		$ob_email = mask_email($email);
	}
}

$submitted = false;

if($_POST) {
	if ( 
	    ! isset( $_POST['request_token_nonce'] ) 
	    || ! wp_verify_nonce( $_POST['request_token_nonce'], 'request_token' ) 
	) {

	   $submitted = 'invalid';
	} else {

	   $new_token = infusedwoo_gdpr_gen_token($email,'',true);
	   $submitted = 'done';
	   $new_link = $_POST['requested_uri'] . $new_token; 
	
	   wp_mail( $email, 'The Link you have Requested', 'Here is the Link you have requested. ' . $new_link );
	}
	
}

function mask($str, $first, $last) {
    $len = strlen($str);
    $toShow = $first + $last;
    return substr($str, 0, $len <= $toShow ? 0 : $first).str_repeat("*", $len - ($len <= $toShow ? 0 : $toShow)).substr($str, $len - $last, $len <= $toShow ? 0 : $last);
}

function mask_email($email) {
    $mail_parts = explode("@", $email);
    $domain_parts = explode('.', $mail_parts[1]);

    $mail_parts[0] = mask($mail_parts[0], 2, 1); // show first 2 letters and last 1 letter
    $domain_parts[0] = mask($domain_parts[0], 2, 1); // same here
    $mail_parts[1] = implode('.', $domain_parts);

    return implode("@", $mail_parts);
}


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<!DOCTYPE html>
<html style="background-color: #eff0f1">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Link has Expired</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.1/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.7/js/all.js"></script>
    <style type="text/css">
    	

    </style>
  </head>
  <body >
  <section class="section">
    <div class="container">

      	<article class="message is-medium" style="max-width: 600px; margin:auto;">
		  <div class="message-header">
		    <p>This Link has Expired</p>
		    <button class="delete is-medium" aria-label="delete"></button>
		  </div>
		  <div class="message-body">
		    Unfortunately, this link has already expired. No worries, click the button below and we will send you a valid new link of the same page you have requested.
		    <br><br>
		    <form method="POST">
		    	<input type="hidden" name="request-tok" />
		    	<input type="hidden" name="requested_uri" value="<?php echo $requested_uri ?>" />
		    	<?php wp_nonce_field('request_token','request_token_nonce'); ?>
		   
		    <center>
		    <?php if($submitted == 'done') { ?>

		    	<article class="message is-success">
				  <div class="message-body">
				    Successfully Sent New Link to <?php echo $ob_email; ?>
				  </div>
				</article>

		    <?php } else if($submitted == 'invalid') { ?>
		    	<article class="message is-danger">
				  <div class="message-body">
				    Unsuccessful. There was an error.
				  </div>
				</article>
		    <?php } else { ?>
		    	<button type="submit" class="button is-medium is-success request-token" style="">
			   	 <span>Yes! Send me a Fresh Link</span>
			  	</button>

		    <?php  } ?>

			</center>
			</form>
		  </div>
		</article>
    </div>
  </section>
  <script>
  	


  </script>
  </body>
</html>