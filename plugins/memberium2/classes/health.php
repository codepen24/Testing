<?php
/**
* Copyright (c) 2018-2020 David J Bullock
* Web Power and Light, LLC
* https://webpowerandlight.com
* support@webpowerandlight.com
*
*/

 if (! defined('ABSPATH') ) { header('Location: /'); die(); } final class wpalm4is_iewz_0kfnx5d { static function wpalm4is_tk34_98dyh() { self::wpalm4is_jugxqp670va(); self::wpalm4is_ur0nb86q(); self::wpalm4is_i4nomg8d0(); self::wpalm4is_g96a7np(); self::wpalm4is_ik9fcd5xv(); self::wpalm4is_l1scdlqph7if(); self::wpalm4is_uqeihrgbatl(); self::wpalm4is_miqn3p4f6m9(); self::wpalm4is_mf1wxzac(); self::wpalm4is_r1y_gnk9shux(); self::wpalm4is_x9msf2du4(); self::wpalm4is_zc0s2wvoa(); self::wpalm4is_z6fk4a_(); self::wpalm4is_a3db2hjzrog(); self::wpalm4is_pt6ro9aycjn(); self::wpalm4is_dj4m7w(); self::wpalm4is_iw3rua_i8(); self::wpalm4is_qobdfle(); self::wpalm4is__yxk26t(); self::wpalm4is_bruht8i3e2(); self::wpalm4is_z58u9y4si(); }  private static function wpalm4is_qv9klefqu() { return base64_decode('aHR0cHM6Ly9tZW1iZXJpdW0uY29tLw==');  }  private static function wpalm4is_jugxqp670va() { $vwpalm4is_qs6lbv3o = get_option('cron', array() ); $vwpalm4is_rn1mz0sk = array( 'memberium_license_check' => 1, 'memberium_maintenance' => 1, ); foreach($vwpalm4is_qs6lbv3o as $vwpalm4is_ndxvp20 => $vwpalm4is_x1folrs) { if (is_array($vwpalm4is_x1folrs) ) { foreach($vwpalm4is_x1folrs as $k2 => $v2) { unset($vwpalm4is_rn1mz0sk[$k2]); } } } if (! empty($vwpalm4is_rn1mz0sk) ) { $vwpalm4is_pl2e5v7_ = '<h3>Cron Failure</h3>' . '<p>Memberium has detected that your WordPress maintenance system is experiencing problems.  ' . 'This may cause problems getting software updates, renewing your license, generating member passwords, or other maintenance functions.</p>' . '<p>The following Memberium cron functions are not being run:</p>'; foreach($vwpalm4is_rn1mz0sk as $vwpalm4is_ndxvp20 => $vwpalm4is_x1folrs) { $vwpalm4is_pl2e5v7_ .= "<p>{$vwpalm4is_ndxvp20}</p>"; } $vwpalm4is_pl2e5v7_ .= 'If this message does not go away after a few page loads, then please contact <a href="https://memberium.com/support/">Memberium support</a> for assistance to further diagnose and fix this issue.</p>'; $vwpalm4is_d970qtm24wc = 'notice notice-error'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } private static function wpalm4is_ur0nb86q() { if (defined('MEMBERIUM_BETA') && MEMBERIUM_BETA == 1) { $vwpalm4is_pl2e5v7_ = '<h3>Development Mode</h3>' . '<p>Memberium is running in development mode.</p>'; $vwpalm4is_d970qtm24wc = 'notice notice-info'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } private static function wpalm4is_i4nomg8d0() {  if (! MEMBERIUM_DEBUG) { if (in_array(strtolower(ini_get('display_errors') ), array(1, 'on', 'true') ) ) { $vwpalm4is_pl2e5v7_ = '<h3>Security Vulnerability Detected</h3>' . '<p>Memberium has detected that your website is misconfigured to display errors to the browser. ' . 'This can be caused by several things, including a misconfigured cpanel or php.ini setting, or another ' . 'plugin or theme on your site turning the setting back on.</p>' . '<p>Leaving this setting in place will create a security risk for your server, as well as potential problems with logins and cookies failing.</p>' . 'If you would like assistance, please contact <a href="https://memberium.com/support/">Memberium support</a> to further diagnose and help fix this issue.</p>'; $vwpalm4is_d970qtm24wc = 'notice notice-error'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } } private static function wpalm4is_g96a7np() { $vwpalm4is_x3e6m_hobj = 'file_permissions'; if (! is_writable(MEMBERIUM_HOME) ) { if (! get_option("memberium/notice/{$vwpalm4is_x3e6m_hobj}", false) ) { $vwpalm4is_x0fxvezds = wpalm4is_yf0g75hqk184::wpalm4is_nx5ruvo3kc2($vwpalm4is_x3e6m_hobj); $vwpalm4is_pl2e5v7_ = '<h3>File Permissions</h3>' . '<p>Memberium updates disabled due to lack of file permissions.</p>' . '<div><p><a class="button-primary" href="'. $vwpalm4is_x0fxvezds .'">Hide this Notice</a></p></div>'; $vwpalm4is_d970qtm24wc = 'notice notice-warning'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } } private static function wpalm4is_ik9fcd5xv() {  if (defined('WP_HTTP_BLOCK_EXTERNAL') && constant('WP_HTTP_BLOCK_EXTERNAL') == 1) { $vwpalm4is_dp12sk3u = defined('WP_ACCESSIBLE_HOSTS') ? strtolower(constant('WP_ACCESSIBLE_HOSTS') ) : ''; $vwpalm4is_otnom59c = array_filter(explode(',', $vwpalm4is_dp12sk3u) ); $vwpalm4is_otnom59c = array_filter($vwpalm4is_otnom59c); $appname = wpalm4is_xb7t0i6pzn::wpalm4is_mz346l5qyv('appname'); $vwpalm4is__mgjnuabrzvx = array( 'licenseserver.webpowerandlight.com', "{$appname}.infusionsoft.com" ); foreach($vwpalm4is__mgjnuabrzvx as $k => $vwpalm4is_x1folrs) { if (in_array($vwpalm4is_x1folrs, $vwpalm4is_otnom59c) ) { unset($vwpalm4is__mgjnuabrzvx[$k]); } } if (! empty($vwpalm4is__mgjnuabrzvx) ) { $vwpalm4is_ifcsd5 = trim($vwpalm4is_dp12sk3u . "," . implode(',', $vwpalm4is__mgjnuabrzvx), ','); $vwpalm4is_d970qtm24wc = 'notice notice-error'; $vwpalm4is_pl2e5v7_ = '<h3>External Hosts Blocked</h3>' . '<p>Memberium has detected that you are blocking access to external hosts, through your wp-config.php file.' . 'You will either need to remove the <strong>WP_HTTP_BLOCK_EXTERNAL</strong> setting, or add our hosts to the <strong>WP_ACCESSIBLE_HOSTS</strong> setting.' . 'Leaving this problem unaddressed will cause your plugin to stop working.</p>' . "<p style='font-family:\"courier new\",monospace;font-size:120%;'>define('WP_ACCESSIBLE_HOSTS', '" . $vwpalm4is_ifcsd5 . "');</p>" . '<p>If you would like assistance, please contact <a href="https://memberium.com/support/">Memberium Support.</a></p>'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } } private static function wpalm4is_uqeihrgbatl() {  $vwpalm4is_a6ajr1x_kh = wpalm4is_rvrqgfe5ns_::wpalm4is_m1ufj92cv45(); if (empty($vwpalm4is_a6ajr1x_kh['valid']) ) { $vwpalm4is_pl2e5v7_ = '<h3>Invalid License</h3>' . '<p>You do not have a valid <strong>Memberium</strong> license for this install.</p>'; $vwpalm4is_d970qtm24wc = 'notice notice-error'; echo "<div class='{$vwpalm4is_d970qtm24wc}'>{$vwpalm4is_pl2e5v7_}</div>"; } } private static function wpalm4is_l1scdlqph7if() { if (defined('LEARNDASH_VERSION') ) { $vwpalm4is_u0m2_o = LEARNDASH_VERSION; $vwpalm4is_x3e6m_hobj = 'learndash_version_' . $vwpalm4is_u0m2_o; if (get_option("memberium/notice/{$vwpalm4is_x3e6m_hobj}", false) ) { return; } if (version_compare($vwpalm4is_u0m2_o, 3, '<') ) { $vwpalm4is_x0fxvezds = wpalm4is_yf0g75hqk184::wpalm4is_nx5ruvo3kc2($vwpalm4is_x3e6m_hobj); $vwpalm4is_pl2e5v7_ = '<h3>Oudated LearnDash Version Detected</h3>' . "<p>Memberium has detected that you are running an old version ({$vwpalm4is_u0m2_o}) of LearnDash.</p>" . "<p>Please update your LearnDash plugin to version 3.0 or later.</p>" . '<div><p><a class="button-primary" href="'. $vwpalm4is_x0fxvezds .'">Hide this Notice</a></p></div>'; $vwpalm4is_d970qtm24wc = 'notice notice-error'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } } private static function wpalm4is_miqn3p4f6m9() {  $vwpalm4is_ruhnw63r = wp_convert_hr_to_bytes(WP_MEMORY_LIMIT); if ($vwpalm4is_ruhnw63r <= 41943040) { $vwpalm4is_x3e6m_hobj = 'memory_warning'; if (! get_option("memberium/notice/{$vwpalm4is_x3e6m_hobj}", false) ) { $vwpalm4is_vxv5ahjbq = WP_MEMORY_LIMIT; $vwpalm4is_x0fxvezds = wpalm4is_yf0g75hqk184::wpalm4is_nx5ruvo3kc2($vwpalm4is_x3e6m_hobj); $vwpalm4is_d970qtm24wc = 'notice notice-error'; $vwpalm4is_pl2e5v7_ = '<h3>Possible Low Memory Issue</h3>' . '<p>Memberium has detected that your site is configured with a memory limit of ' . $vwpalm4is_vxv5ahjbq . '</p>' . '<p>You can increase your WordPress memory limit by adding or updating the following line in your wp-config.php:</p>' . '<code>define(\'WP_MEMORY_LIMIT\', \'64M\');</code>' . '<p>For sites with many or complex plugins or themes, you may want to set it to 96M, 128M, 160M or more.</p>' . '<div><p><a class="button-primary" href="'. $vwpalm4is_x0fxvezds .'">Hide this Notice</a></p></div>'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } } private static function wpalm4is_mf1wxzac() { if (! extension_loaded('mbstring') ) { $vwpalm4is_d970qtm24wc = 'notice notice-info'; $vwpalm4is_pl2e5v7_ = '<h3>Multibyte Encoding</h3>' . "<p>We've detected that your server is missing the PHP MBString module.  " . "The MBString module makes it possible ot handle acccented and international characters without corruption.</p>" . '<p>Memberium can run without this module, but it may cause data corruption from Infusionsoft if the records contain international characters.</p>' . '<p>To fix this issue please contact your webhost and have them add MBString support to your PHP system.</p>'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } private static function wpalm4is_r1y_gnk9shux() {  global $wpdb; $vwpalm4is_cevdqnb5lzm = 'SHOW STORAGE ENGINES;'; $vwpalm4is_ss713erkxf0w = $wpdb->get_results($vwpalm4is_cevdqnb5lzm, ARRAY_A); $vwpalm4is_r35sbw8oi7lx = false; $vwpalm4is_cz7f6uew = false; if (is_array($vwpalm4is_ss713erkxf0w) ) { foreach($vwpalm4is_ss713erkxf0w as $vwpalm4is_hs69ar) { $vwpalm4is_hs69ar['Engine'] = strtolower($vwpalm4is_hs69ar['Engine']); $vwpalm4is_hs69ar['Support'] = strtolower($vwpalm4is_hs69ar['Support']); if ($vwpalm4is_hs69ar['Engine'] == 'innodb' && in_array($vwpalm4is_hs69ar['Support'], array('yes', 'default') ) ) { $vwpalm4is_cz7f6uew = true; } elseif ($vwpalm4is_hs69ar['Engine'] == 'myisam' && in_array($vwpalm4is_hs69ar['Support'], array('yes', 'default') ) ) { $vwpalm4is_r35sbw8oi7lx = true; } } } if ( (! $vwpalm4is_r35sbw8oi7lx) || (! $vwpalm4is_cz7f6uew) ) { $vwpalm4is_d970qtm24wc = 'notice notice-error'; $vwpalm4is_pl2e5v7_ = '<h3>Database Configuration Error</h3>' . '<p>Memberium has detected a database configuration error.  One or more of your database engines appears to be missing or disabled.</p>'; if (! $vwpalm4is_r35sbw8oi7lx){ $vwpalm4is_pl2e5v7_ .= '<p>Your <strong>MyISAM</strong> database storage engine is missing or disabled.</p>'; } if (! $vwpalm4is_cz7f6uew) { $vwpalm4is_pl2e5v7_ .= '<p>Your <strong>InnoDB</strong> database storage engine is missing or disabled.</p>'; } $vwpalm4is_pl2e5v7_ .= '<p>Please contact your webhost and notify them of this problem.  Proper operation of your Membership site will be affected until this is fixed.</p>'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } private static function wpalm4is_x9msf2du4() { $vwpalm4is_x3e6m_hobj = 'open_registration';  if (get_option('users_can_register', false) ) { if (! get_option("memberium/notice/{$vwpalm4is_x3e6m_hobj}", false) ) { $vwpalm4is_d970qtm24wc = 'notice notice-error'; $vwpalm4is_x0fxvezds = wpalm4is_yf0g75hqk184::wpalm4is_nx5ruvo3kc2($vwpalm4is_x3e6m_hobj); $vwpalm4is_pl2e5v7_ = '<h3>Open Registration Detected</h3>' . '<p>Memberium has detected that you have configured WordPress to allow any user to register.  ' . 'Generally for a membership site we recommend you disable this setting, and use Infusionsoft to handle new user registrations.</p>' . '<p>You can change this setting <a href="options-general.php">here</a>, by unchecking "<strong>Anyone can register</strong>".</p>' . '<div><p><a class="button-primary" href="'. $vwpalm4is_x0fxvezds .'">Hide this Notice</a></p></div>'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } } private static function wpalm4is_zc0s2wvoa() {   $vwpalm4is_geuwf7o3bgi = phpversion(); $vwpalm4is_x3e6m_hobj = 'php_version_' . $vwpalm4is_geuwf7o3bgi; if (get_option("memberium/notice/{$vwpalm4is_x3e6m_hobj}", false) ) { return; } $vwpalm4is_qile50s73k6y = false; $vwpalm4is_us2qliaxhe = array(); $vwpalm4is_fztd87a56 = array( '7.4' => array('active_support' => 'November 28, 2019', 'security_support' => 'November 28, 2022'), '7.3' => array('active_support' => 'December 6, 2020', 'security_support' => 'December 6, 2021'), '7.2' => array('active_support' => 'November 30, 2019', 'security_support' => 'December 30, 2020'), '7.1' => array('active_support' => 'December 1, 2018', 'security_support' => 'December 1, 2019'), '7.0' => array('active_support' => 'December 3, 2017', 'security_support' => 'December 3, 2018'), '5.6' => array('active_support' => 'December 31, 2016', 'security_support' => 'December 31, 2018'), '5.5' => array('active_support' => 'July 21, 2016', 'security_support' => 'July 21, 2016'), '5.4' => array('active_support' => 'September 3, 2015', 'security_support' => 'September 3, 2015'), '5.3' => array('active_support' => 'August 14, 2014', 'security_support' => 'August 14, 2014'), ); foreach($vwpalm4is_fztd87a56 as $vwpalm4is_u0m2_o => $vwpalm4is_t54afl06zr3) { if (version_compare($vwpalm4is_geuwf7o3bgi, $vwpalm4is_u0m2_o, '>=') ) { $vwpalm4is_us2qliaxhe = $vwpalm4is_t54afl06zr3; $vwpalm4is_us2qliaxhe['version'] = $vwpalm4is_u0m2_o; $vwpalm4is_yaw2ze4v = (bool) (time() < strtotime($vwpalm4is_t54afl06zr3['security_support']) ); $bugfix_updates = (bool) (time() < strtotime($vwpalm4is_t54afl06zr3['active_support']) ); $vwpalm4is_qile50s73k6y = (bool) ($vwpalm4is_yaw2ze4v || $bugfix_updates); break; } } if (! $vwpalm4is_qile50s73k6y) { $vwpalm4is_d970qtm24wc = 'notice notice-warning'; $vwpalm4is_pl2e5v7_ = '<h3>Older PHP Version Detected</h3>' . '<p>Memberium has detected that you are running an older version of PHP (<strong>PHP ' . $vwpalm4is_geuwf7o3bgi . '</strong>).' . '<p>You can learn more about <a href="https://secure.php.net/supported-versions.php" target="_blank">PHP support here</a></p>'; if (! $vwpalm4is_yaw2ze4v) { $vwpalm4is_pl2e5v7_ .= '<p>Support for this version of PHP was terminated on <strong>' . $vwpalm4is_t54afl06zr3['security_support'] . '</strong></p>'; $vwpalm4is_pl2e5v7_ .= '<p>Upgrading PHP is <em style="font-weight:bold;color:red;">strongly recommended</em> for best performance, security, and compatibility with future Memberium releases.</p>'; }  $vwpalm4is_pl2e5v7_ .= '<p><strong>To Fix This Issue:</strong></p>' . '<p>Please contact your web host to see if they support a newer version of PHP with IonCube support.</p>'; if (time() > strtotime($vwpalm4is_t54afl06zr3['security_support']) ) { $vwpalm4is_d970qtm24wc = 'notice notice-error'; }  echo "<div class='{$vwpalm4is_d970qtm24wc}'>{$vwpalm4is_pl2e5v7_}</div>"; } } private static function wpalm4is_z6fk4a_() { $vwpalm4is_x3e6m_hobj = 'windows_nt'; if (in_array(php_uname('s'), array('Windows NT') ) ) { if (! get_option("memberium/notice/{$vwpalm4is_x3e6m_hobj}", false) ) { $vwpalm4is_d970qtm24wc = 'notice notice-error'; $vwpalm4is_x0fxvezds = wpalm4is_yf0g75hqk184::wpalm4is_nx5ruvo3kc2($vwpalm4is_x3e6m_hobj); $vwpalm4is_pl2e5v7_ = '<h3>Operating System</h3>' . '<p>Memberium has detected that you are running on a Windows NT based web hosting plan.</p>' . '<p>We recommend using Linux based hosting for maximum compatibillity, performance, and reliability.</p>' . '<div><p><a class="button-primary" href="'. $vwpalm4is_x0fxvezds .'">Hide this Notice</a></p></div>'; echo "<div class=\"$vwpalm4is_d970qtm24wc is-dismissible\">$vwpalm4is_pl2e5v7_</div>"; } } } private static function wpalm4is_a3db2hjzrog() { if (defined('WP_ROCKET_VERSION') ) { $vwpalm4is_x3e6m_hobj = 'wprocket'; if (! get_option("memberium/notice/{$vwpalm4is_x3e6m_hobj}", false) ) { $vwpalm4is_d970qtm24wc = 'notice notice-warning'; $vwpalm4is_x0fxvezds = wpalm4is_yf0g75hqk184::wpalm4is_nx5ruvo3kc2($vwpalm4is_x3e6m_hobj); $vwpalm4is_pl2e5v7_ = '<h3>WP Rocket Detected</h3>' . '<p>Memberium has detected that you are using WP Rocket.</p>' . '<p>Plugins that cache your pages  will cause serious problems with your membership site.  ' . 'This plugin will cause personal pages and billing information to be deivered to the wrong member.</p>'. '<div><p><a class="button-primary" href="'. $vwpalm4is_x0fxvezds .'">Hide this Notice</a></p></div>'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } }  private static function wpalm4is_iw3rua_i8() { $vwpalm4is_x3e6m_hobj = 'cloudflare'; if (isset($_SERVER['HTTP_CF_RAY']) ) { if (! get_option("memberium/notice/{$vwpalm4is_x3e6m_hobj}", false) ) { $vwpalm4is_xegx2619i_z = self::wpalm4is_qv9klefqu(); $vwpalm4is_x0fxvezds = wpalm4is_yf0g75hqk184::wpalm4is_nx5ruvo3kc2($vwpalm4is_x3e6m_hobj); $vwpalm4is_pl2e5v7_ = '<h3>CloudFlare Warning</h3>' . '<p>Memberium has detected that you are using CloudFlare.</p>'. '<p>Please see the <a target="_blank" href="' . $vwpalm4is_xegx2619i_z . '?p=7904">Memberium online documentation</a> to ensure that your CloudFlare is properly configured.</p>' . '<div><p><a class="button-primary" href="'. $vwpalm4is_x0fxvezds .'">Hide this Notice</a></p></div>'; $vwpalm4is_d970qtm24wc = 'notice notice-warning'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } } private static function wpalm4is__yxk26t() {  if (defined('GD_VIP') && defined('REDIS_SOCKET') ) { $vwpalm4is_x3e6m_hobj = 'godaddy_hosting'; if (! get_option("memberium/notice/{$vwpalm4is_x3e6m_hobj}", false) ) { $vwpalm4is_x0fxvezds = wpalm4is_yf0g75hqk184::wpalm4is_nx5ruvo3kc2($vwpalm4is_x3e6m_hobj); $vwpalm4is_pl2e5v7_ = '<h3>Incompatible Hosting</h3>' . '<p>Memberium has detected that your site may be running on GoDaddy Managed WordPress hosting.</p>' . '<p>This hosting service has caching features which cannot be disabled, and may cause the wrong content to be delivered to your viewers.</p>' . '<p>For managed services, we recommend WP Engine.  If you wish to stay with GoDaddy, We recommend you transfer your site to GoDaddy\'s Cpanel hosting.</p>' . '<div><p><a class="button-primary" href="'. $vwpalm4is_x0fxvezds .'">Hide this Notice</a></p></div>'; $vwpalm4is_d970qtm24wc = 'notice notice-warning'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } } private static function wpalm4is_qobdfle() { $vwpalm4is_x3e6m_hobj = 'flywheel_hosting'; if (defined('FLYWHEEL_CONFIG_DIR') || defined('FLYWHEEL_DEFAULT_PROTOCOL') || defined('FLYWHEEL_PLUGIN_DIR') ) { if (! get_option("memberium/notice/{$vwpalm4is_x3e6m_hobj}", false) ) { $vwpalm4is_x0fxvezds = wpalm4is_yf0g75hqk184::wpalm4is_nx5ruvo3kc2($vwpalm4is_x3e6m_hobj); $vwpalm4is_d970qtm24wc = 'notice notice-warning'; $vwpalm4is_pl2e5v7_ = '<h3>FlyWheel Hosting</h3>' . '<p>Memberium has detected that your site may be running on FlyWheel WordPress hosting.</p>' . '<p>This hosting service has caching features which may cause the wrong content to be delivered to your viewers, or for functionality to break.  ' . 'We recommend reaching out to FlyWheel support and asking them to disable caching for any sensitive URL\'s.  ' . 'You can also enable development mode for short periods in order to disable all caching.<br /><br />' . 'Please contact FlyWheel Support or Memberium support if you have questions or need assistance.</p>' . '<div><p><a class="button-primary" href="'. $vwpalm4is_x0fxvezds .'">Hide this Notice</a></p></div>'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } } private static function wpalm4is_bruht8i3e2() { if (defined('MEPR_PLUGIN_NAME') ) { $vwpalm4is_pl2e5v7_ = '<h3>Conflicting Membership Plugin Installed</h3>' . '<p>MemberPress is installed. Please deactivate.</p>'; $vwpalm4is_d970qtm24wc = 'notice notice-error'; echo "<div class='{$vwpalm4is_d970qtm24wc}'>{$vwpalm4is_pl2e5v7_}</div>"; } } private static function wpalm4is_z58u9y4si() { if (defined('WPE_WHITELABEL') || isset($_SERVER['WPENGINE_PHPSESSIONS']) ) { $vwpalm4is_x3e6m_hobj = 'wpengine'; if (! get_option("memberium/notice/{$vwpalm4is_x3e6m_hobj}", false) ) { $vwpalm4is_x0fxvezds = wpalm4is_yf0g75hqk184::wpalm4is_nx5ruvo3kc2($vwpalm4is_x3e6m_hobj); $vwpalm4is_d970qtm24wc = 'notice notice-success'; $vwpalm4is_pl2e5v7_ = '<h3>WP Engine Optimization</h3>' . '<p><strong>Congratulations!</strong>  Memberium has detected that you are installed on the WP Engine Digital Experience Platform.' . '<p>In order to ensure that your webhooks and HTTP POSTs are delivered reliably, you need to disable the "Redirect Bots" option in your WP Engine dashboard.  ' . 'This setting is designed to optimize your site performance when bots are hitting it, but it can accidentally block HTTP POSTs and Webhooks.</p>' . '<p>You can find instructions on how to change this settings <a href="https://wpengine.com/support/redirecting-bots-how-this-benefits-you/" target="_blank">here</a>.</p>' . '<p>Once this step is complete, click the button below to hide this reminder.</p>' . '<div><p><a class="button-primary" href="'. $vwpalm4is_x0fxvezds .'">Stop Reminding Me</a></p></div>'; echo "<div class='{$vwpalm4is_d970qtm24wc} is-dismissible'>{$vwpalm4is_pl2e5v7_}</div>"; } } }  private static function wpalm4is_pt6ro9aycjn() { $vwpalm4is_cus6kn = array_diff(scandir(ABSPATH), array('.', '..') ); $vwpalm4is_j2i0_tkn7ap = in_array('debuglog.txt', $vwpalm4is_cus6kn); if ($vwpalm4is_j2i0_tkn7ap) { $vwpalm4is_pl2e5v7_ = '<h3>Security Vulnerability Detected</h3>'; $vwpalm4is_d970qtm24wc = 'notice notice-error'; $vwpalm4is_pl2e5v7_ .= '<p>Memberium has detected that there is a debuglog present in your top WordPress folder named debuglog.txt.  ' . 'Debug logs contain sensitive data and should be removed as soon as possible.</p>' . '<p>Please delete this file to remove this safety warning message.</p>'; echo "<div class='{$vwpalm4is_d970qtm24wc}'>{$vwpalm4is_pl2e5v7_}</div>"; } } private static function wpalm4is_dj4m7w() { $vwpalm4is_cus6kn = array_diff(scandir(ABSPATH), array('.', '..') ); $vwpalm4is_pmw1ojct = array(); foreach($vwpalm4is_cus6kn as $vwpalm4is_rs76aqhfcu5z) { $vwpalm4is_rs76aqhfcu5z = ABSPATH . $vwpalm4is_rs76aqhfcu5z; if (stripos(file_get_contents($vwpalm4is_rs76aqhfcu5z, false, null, 0, 256), '<?') !== false) { if (stripos(file_get_contents($vwpalm4is_rs76aqhfcu5z, false, null, 0, 256), 'phpinfo(') !== false) { $vwpalm4is_pmw1ojct[] = $vwpalm4is_rs76aqhfcu5z; } } } if (count($vwpalm4is_pmw1ojct) ) { $vwpalm4is_d970qtm24wc = 'notice notice-error'; $vwpalm4is_pl2e5v7_ = '<h3>Security Vulnerability Detected</h3>' . '<p>Memberium has detected that there is a phpinfo file present in your top level directory.  Please review the following files:</p>'; foreach($vwpalm4is_pmw1ojct as $vwpalm4is_rs76aqhfcu5z) { $vwpalm4is_pl2e5v7_ .= $vwpalm4is_rs76aqhfcu5z . '<br>'; } $vwpalm4is_pl2e5v7_ .= '<p>These files can expose sensitive server data putting your site at risk, and should be removed as soon as possible.</p>' . '<p>Please contact Memberium support if you would like assistance removing this file.</p>'; echo "<div class=\"$vwpalm4is_d970qtm24wc\">$vwpalm4is_pl2e5v7_</div>"; } } }
