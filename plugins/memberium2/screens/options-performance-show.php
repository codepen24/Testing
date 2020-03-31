<?php
 if (!defined('ABSPATH' ) ) { die(); } $vwpalm4is_ne17fdv8uw4 = wpalm4is_xb7t0i6pzn::wpalm4is_s0xuab5fq6hy('settings'); echo '<form method="POST" action="">'; wp_nonce_field(MEMBERIUM_LIB, 'memberium_options_nonce' ); echo '<ul>'; echo '<h3>Cache Tuning</h3>'; wpalm4is_yf0g75hqk184::wpalm4is_kdfb73nti6c('Maximum Contact Cache Age', 'max_contact_age', $vwpalm4is_ne17fdv8uw4['max_contact_age'], array('min' => 0, 'help_id' => 1189, 'style' => 'text-align:right;width:80px;', 'units' => 'seconds' ) ); wpalm4is_yf0g75hqk184::wpalm4is_kdfb73nti6c('Session Inactivity Timeout', 'session_timeout', $vwpalm4is_ne17fdv8uw4['session_timeout'], array('min' => 0, 'help_id' => 1200, 'style' => 'text-align:right;width:80px;', 'units' => 'seconds' ) ); echo '<hr>'; echo '<h3>Misc Settings</h3>'; wpalm4is_yf0g75hqk184::wpalm4is_ak_b1tzs8('Remove Accented Characters', 'plaintext_db', 13296, $vwpalm4is_ne17fdv8uw4['plaintext_db'] ); echo '<hr>'; echo '<h3>Login-Time Synchronization</h3>'; echo '<p>Please review the online documentation, or contact support <em>before</em> activating these features.</p>'; wpalm4is_yf0g75hqk184::wpalm4is_ak_b1tzs8('Synchronize Affiliate Records', 'sync_affiliate', 2686, $vwpalm4is_ne17fdv8uw4['sync_affiliate'] ); wpalm4is_yf0g75hqk184::wpalm4is_ak_b1tzs8('Synchronize Tag Dates', 'sync_tag_details', 4038, $vwpalm4is_ne17fdv8uw4['sync_tag_details'] ); wpalm4is_yf0g75hqk184::wpalm4is_ak_b1tzs8('Synchronize eCommerce Records', 'sync_ecommerce', 2689, $vwpalm4is_ne17fdv8uw4['sync_ecommerce'] ); wpalm4is_yf0g75hqk184::wpalm4is_ak_b1tzs8('Sync Meta Updates', 'sync_meta_updates', 9639, $vwpalm4is_ne17fdv8uw4['sync_meta_updates'] ); wpalm4is_yf0g75hqk184::wpalm4is_ak_b1tzs8('MicroCache Compatible Sessions', 'microcache_compat_session', 9641, $vwpalm4is_ne17fdv8uw4['microcache_compat_session'] ); echo '</ul>'; echo '<p><input type="submit" value="Update" class="button-primary"></p>'; echo '</form>';
