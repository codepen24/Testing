<?php
 /**
 * Copyright (c) 2016-2020 David J Bullock
 * Web Power and Light, LLC
 * https://webpowerandlight.com
 * support@webpowerandlight.com
 *
 */

 if (!defined('ABSPATH') ) { die(); } add_action('admin_notices', 'wpalm4is_y9wmo5j0x'); function wpalm4is_y9wmo5j0x() { $vwpalm4is_us6m05lfn = '5.4'; $vwpalm4is_a8lwtivhe = false; $vwpalm4is_owab4ku_zc = version_compare(phpversion(), $vwpalm4is_us6m05lfn, '<'); $vwpalm4is_wk9wy1hpmn = ! function_exists('curl_version'); $vwpalm4is_uaycnh1k = ! extension_loaded('IonCube Loader'); $vwpalm4is_a8lwtivhe = $vwpalm4is_owab4ku_zc || $vwpalm4is_uaycnh1k; if ($vwpalm4is_a8lwtivhe) { echo '<div class="notice notice-error" style="height:200px;">'; echo '<img style="margin-right:20px;margin-top:10px;margin-bottom:60px;border-radius:10px;" src="https://memberium.com/wp-content/uploads/2014/09/memberium-home-illustration6.png" height=85 width=62 align=left />'; echo '<h3>Memberium Install Alert</h3>'; echo '<p style="color:red;font-weight:bold;">Memberium has been temporarily disabled.</p>'; if ($vwpalm4is_owab4ku_zc) { echo '<p><strong>PHP ', $vwpalm4is_us6m05lfn, ' or newer is required.</strong>  You are running PHP v', phpversion(), '.</p>'; } if ($vwpalm4is_wk9wy1hpmn) { echo '<p><strong>The PHP CURL extension is required</strong>, but is not installed or available.</p>'; } if ($vwpalm4is_uaycnh1k) { echo '<p><strong>The IonCube PHP extension is required</strong>, but is not installed or available.</p>'; } echo '<p>'; echo '<strong>PHP Version:</strong> ', phpversion(), ' / ', php_sapi_name(), '<br>'; echo '<strong>Path:</strong> ', ABSPATH, '<br>'; echo '<strong>System:</strong> ', php_uname(), '<br>'; echo '<strong>Modules Loaded:</strong> ', implode(', ', get_loaded_extensions() ), '<br>'; echo '</p>'; echo '<p><a target="_blank" href="https://www.memberium.com/?p=11721">Click Here to Learn More</a></p>'; echo '</div>'; } }
