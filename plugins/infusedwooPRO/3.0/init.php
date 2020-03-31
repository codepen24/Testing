<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
	
define('INFUSEDWOO_3_DIR', INFUSEDWOO_PRO_DIR . "3.0/");
define('INFUSEDWOO_3_URL', INFUSEDWOO_PRO_URL . "3.0/");

// 3.0 New Modules

include(INFUSEDWOO_3_DIR . "/automation-recipes/automation-recipes.php");
include(INFUSEDWOO_3_DIR . "/myaccount-functions/myaccount-functions.php");
include(INFUSEDWOO_3_DIR . "/gdpr/gdpr-implement.php");