<?php
 if ( ! defined('ABSPATH') ) { die(); } if ( ! defined('PROFILE_BUILDER_VERSION') ) { return; } add_action('wppb_password_reset', 'wpalm4is_lmi3pf', 10, 2 ); function wpalm4is_lmi3pf( $vwpalm4is_tcon6xrp, $vwpalm4is_t15xztu_wb2 ) { $vwpalm4is_tcon6xrp = abs( intval( $vwpalm4is_tcon6xrp ) ); $vwpalm4is_s13i75n4ph = wpalm4is_bd5uye4ng3l::wpalm4is_titrm5z4( $vwpalm4is_tcon6xrp ); $vwpalm4is_zx43rky_j = wpalm4is_xb7t0i6pzn::wpalm4is_s0xuab5fq6hy( 'settings', 'password_field' ); if ($vwpalm4is_s13i75n4ph < 1 || empty($vwpalm4is_t15xztu_wb2) || empty($vwpalm4is_zx43rky_j) ) { return; } memberium_app()->wpalm4is_wvcz6opb($vwpalm4is_zx43rky_j, $vwpalm4is_t15xztu_wb2, $vwpalm4is_s13i75n4ph); }
