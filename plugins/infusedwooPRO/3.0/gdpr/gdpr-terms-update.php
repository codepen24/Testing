<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$link = get_option('infusedwoo_tc_link','');
$utc_title = get_option('infusedwoo_utc_title','Updates to our Terms and Conditions');
	$utc_title = apply_filters( 'infusedwoo_utc_title', $utc_title );
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

	$agree_link = site_url() . '/iw-data/terms_updates/agree'

?>

<!DOCTYPE html>
<html style="background-color: #eff0f1">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $utc_title; ?></title>
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
		      <?php echo $utc_title; ?>
		    </p>
		  </header>
		  <div class="card-content">
		    <div class="content">
		        <?php echo $utc_intro; ?>
		      (<?php echo $tc_date; ?>)
		    </div>
		    <div>
		    	
		    </div>
		  </div>
		  <footer class="card-footer">
		    <a href="<?php echo $agree_link . ($token ? "/$token" : "") . '?' . http_build_query($_GET); ?>" class="card-footer-item is-success"><?php echo $intro; ?> </a>
		  </footer>
		</div>
    </div>
  </section>
  </body>
</html>