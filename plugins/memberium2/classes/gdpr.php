<?php
/**
 * Copyright (c) 2018-2020 David J Bullock
 * Web Power and Light, LLC
 * https://webpowerandlight.com
 * support@webpowerandlight.com
 *
 */

 if (!defined('ABSPATH') ) { die(); } final class wpalm4is_n_z7ot8q4p {    function wpalm4is_kvdmwen1($vwpalm4is_vywqn4x_td8) { $vwpalm4is_vywqn4x_td8['memberium2'] = array( 'exporter_friendly_name' => __('Memberium'), 'callback' => array('wpalm4is_n_z7ot8q4p', 'wpalm4is_so89sv'), ); return $vwpalm4is_vywqn4x_td8; } function wpalm4is_bmh8j1_ce73($vwpalm4is_ryrijxqud5lv) { $vwpalm4is_ryrijxqud5lv['memberium2'] = array( 'eraser_friendly_name' => __('Memberium'), 'callback' => array('wpalm4is_n_z7ot8q4p', 'wpalm4is_ozvqw4r5'), ); return $vwpalm4is_ryrijxqud5lv; } function wpalm4is_so89sv($vwpalm4is_dzqjf460, $vwpalm4is_cshmxpk = 1) { global $wpdb; $vwpalm4is_dzqjf460 = strtolower(trim ($vwpalm4is_dzqjf460) ); $vwpalm4is_n_bsw6d3x = get_user_by('email', $vwpalm4is_dzqjf460); $vwpalm4is_tcon6xrp = $vwpalm4is_n_bsw6d3x->ID; $vwpalm4is_s13i75n4ph = wpalm4is_bd5uye4ng3l::wpalm4is_titrm5z4($vwpalm4is_tcon6xrp); $vwpalm4is_cshmxpk = (int) $vwpalm4is_cshmxpk; $vwpalm4is_fxl0t5gnuz = array(); $vwpalm4is_n0wrho_2u = array();  $vwpalm4is_ougfb1hd = array( 'login_ip_address' => 'Login IP Address', 'last_login_time' => 'Last Login Time', 'login_count' => 'Login Count', ); foreach( (array) $vwpalm4is_ougfb1hd as $vwpalm4is_p536eja => $vwpalm4is_tbz0wc5kj37) { $vwpalm4is_x1folrs = get_user_meta($vwpalm4is_tcon6xrp, $vwpalm4is_p536eja, true); if (! empty($vwpalm4is_x1folrs) ) { $vwpalm4is_n0wrho_2u[] = array( 'name' => $vwpalm4is_tbz0wc5kj37, 'value' => $vwpalm4is_x1folrs, ); } }  if ($vwpalm4is_s13i75n4ph) { $vwpalm4is_jbucldi1t7q = wpalm4is_bd5uye4ng3l::wpalm4is_cad0k_3hp7m($vwpalm4is_s13i75n4ph); if (! empty($vwpalm4is_jbucldi1t7q) ) { foreach($vwpalm4is_jbucldi1t7q as $vwpalm4is_ndxvp20 => $vwpalm4is_x1folrs) { if (! empty($vwpalm4is_x1folrs) ) { $vwpalm4is_n0wrho_2u[] = array( 'name' => $vwpalm4is_ndxvp20, 'value' => $vwpalm4is_x1folrs, ); } } } } $vwpalm4is_d7f5y2u = 'memberium'; $vwpalm4is_d5hxe13lw = 'Memberium'; $vwpalm4is_ejr1zaxuk_ = "memberium-user"; $vwpalm4is_fxl0t5gnuz[] = array( 'group_id' => $vwpalm4is_d7f5y2u, 'group_label' => $vwpalm4is_d5hxe13lw, 'item_id' => $vwpalm4is_ejr1zaxuk_, 'data' => $vwpalm4is_n0wrho_2u, ); $vwpalm4is_n0wrho_2u = array(); $vwpalm4is_cevdqnb5lzm = 'SELECT DISTINCT `ipaddress` FROM `' . MEMBERIUM_DB_LOGINLOG . '` WHERE `username` = %s '; $vwpalm4is_cevdqnb5lzm = $wpdb->prepare($vwpalm4is_cevdqnb5lzm, $vwpalm4is_dzqjf460); $vwpalm4is_kmqnwo6cu5 = $wpdb->get_col($vwpalm4is_cevdqnb5lzm); if (is_array($vwpalm4is_kmqnwo6cu5) && ! empty($vwpalm4is_kmqnwo6cu5) ) { foreach($vwpalm4is_kmqnwo6cu5 as $row) { $vwpalm4is_n0wrho_2u[] = array ( 'name' => 'IP Address', 'value' => $row ); } $vwpalm4is_d7f5y2u = 'memberium-ip-history'; $vwpalm4is_d5hxe13lw = 'Memberium IP History'; $vwpalm4is_ejr1zaxuk_ = "memberium-ip-history"; $vwpalm4is_fxl0t5gnuz[] = array( 'group_id' => $vwpalm4is_d7f5y2u, 'group_label' => $vwpalm4is_d5hxe13lw, 'item_id' => $vwpalm4is_ejr1zaxuk_, 'data' => $vwpalm4is_n0wrho_2u, ); } $vwpalm4is_lpgsho8ri = true; return array( 'data' => $vwpalm4is_fxl0t5gnuz, 'done' => $vwpalm4is_lpgsho8ri, ); } function wpalm4is_ozvqw4r5($vwpalm4is_dzqjf460, $vwpalm4is_cshmxpk = 1) { global $wpdb; $vwpalm4is_dzqjf460 = strtolower(trim ($vwpalm4is_dzqjf460) ); $vwpalm4is_n_bsw6d3x = get_user_by('email', $vwpalm4is_dzqjf460); $vwpalm4is_tcon6xrp = $vwpalm4is_n_bsw6d3x->ID; $vwpalm4is_jpyj9czm0 = false; $vwpalm4is_cshmxpk = (int) $vwpalm4is_cshmxpk; $vwpalm4is_dd4j20qwmn_ = wpalm4is_xb7t0i6pzn::wpalm4is_mz346l5qyv('appname'); $vwpalm4is_s13i75n4ph = wpalm4is_bd5uye4ng3l::wpalm4is_titrm5z4($vwpalm4is_tcon6xrp); if ($vwpalm4is_s13i75n4ph) { $vwpalm4is_cevdqnb5lzm = 'DELETE FROM `' . MEMBERIUM_DB_CONTACTS . '` WHERE `appname` = %s AND `id` = %d '; $vwpalm4is_cevdqnb5lzm = $wpdb->prepare($vwpalm4is_cevdqnb5lzm, $vwpalm4is_dd4j20qwmn_, $vwpalm4is_s13i75n4ph); $vwpalm4is_jpyj9czm0 += $wpdb->query($vwpalm4is_cevdqnb5lzm);  $vwpalm4is_cevdqnb5lzm = 'DELETE FROM `' . MEMBERIUM_DB_CONTACTTAGS . '` WHERE `appname` = %s AND `contactid` = %d '; $vwpalm4is_cevdqnb5lzm = $wpdb->prepare($vwpalm4is_cevdqnb5lzm, $vwpalm4is_dd4j20qwmn_, $vwpalm4is_s13i75n4ph); $vwpalm4is_jpyj9czm0 += $wpdb->query($vwpalm4is_cevdqnb5lzm);   $vwpalm4is_fawi64knts = memberium_app()->wpalm4is_jpthq4u3xf($vwpalm4is_s13i75n4ph); if ($vwpalm4is_fawi64knts) { $vwpalm4is_cevdqnb5lzm = 'DELETE FROM `' . MEMBERIUM_DB_AFFILIATES . '` WHERE `appname` = %s AND `id` = %d '; $vwpalm4is_cevdqnb5lzm = $wpdb->prepare($vwpalm4is_cevdqnb5lzm, $vwpalm4is_dd4j20qwmn_, $vwpalm4is_fawi64knts); $vwpalm4is_jpyj9czm0 += $wpdb->query($vwpalm4is_cevdqnb5lzm); } } if ($vwpalm4is_tcon6xrp) { $vwpalm4is_cevdqnb5lzm = 'DELETE FROM `' . MEMBERIUM_DB_PAGETRACKING . '` WHERE `userid` = %d '; $vwpalm4is_cevdqnb5lzm = $wpdb->prepare($vwpalm4is_cevdqnb5lzm, $vwpalm4is_tcon6xrp); $vwpalm4is_jpyj9czm0 += $wpdb->query($vwpalm4is_cevdqnb5lzm); }  $vwpalm4is_cevdqnb5lzm = 'DELETE FROM `' . MEMBERIUM_DB_LOGINLOG . '` WHERE `appname` = %s AND `username` = %s'; $vwpalm4is_cevdqnb5lzm = $wpdb->prepare($vwpalm4is_cevdqnb5lzm, $vwpalm4is_dd4j20qwmn_, $vwpalm4is_dzqjf460); $vwpalm4is_jpyj9czm0 += $wpdb->query($vwpalm4is_cevdqnb5lzm);  return array( 'items_removed' => $vwpalm4is_jpyj9czm0, 'items_retained' => false, 'messages' => array(), 'done' => true, ); } }
