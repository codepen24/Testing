<?php
/**
 * Copyright (c) 2012-2020 David J Bullock
 * Web Power and Light, LLC
 * https://webpowerandlight.com
 * support@webpowerandlight.com
 *
 */

 if (! defined('ABSPATH') ) { die(); } final class wpalm4is_dwxz4hdjns { static function wpalm4is__4dnt_r($vwpalm4is_tcon6xrp = 0, $vwpalm4is_o_6p9tyav = 0) { $vwpalm4is_tcon6xrp = $vwpalm4is_tcon6xrp == 0 ? get_current_user_id() : (int) $vwpalm4is_tcon6xrp; $vwpalm4is_o_6p9tyav = (int) $vwpalm4is_o_6p9tyav; if (function_exists('badgeos_get_users_points') ) { $vwpalm4is_hb84ktco7rj = badgeos_get_users_points($vwpalm4is_tcon6xrp); } elseif (function_exists('gamipress_get_user_points') ) { $vwpalm4is_hb84ktco7rj = gamipress_get_user_points($vwpalm4is_tcon6xrp); } else { $vwpalm4is_x3e6m_hobj = empty($vwpalm4is_o_6p9tyav) ? '_memberium_points' : "_memberium_{$vwpalm4is_o_6p9tyav}_points"; $vwpalm4is_hb84ktco7rj = get_user_meta($vwpalm4is_tcon6xrp, $vwpalm4is_x3e6m_hobj, true); } return (int) $vwpalm4is_hb84ktco7rj; } static function wpalm4is__7euk2($vwpalm4is_tcon6xrp = 0, $vwpalm4is_wbyra6z = 0, $vwpalm4is_o_6p9tyav = 0) { $vwpalm4is_tcon6xrp = $vwpalm4is_tcon6xrp == 0 ? get_current_user_id() : (int) $vwpalm4is_tcon6xrp; $vwpalm4is_wbyra6z = (int) $vwpalm4is_wbyra6z; $vwpalm4is_o_6p9tyav = (int) $vwpalm4is_o_6p9tyav; if ($vwpalm4is_tcon6xrp == 0) { return false; } $vwpalm4is_o_6p9tyav = self::wpalm4is_aa5bnteqr($vwpalm4is_o_6p9tyav); if (function_exists('badgeos_update_users_points') ) { $vwpalm4is_e50x2jnv9g1 = badgeos_update_users_points($vwpalm4is_tcon6xrp, $vwpalm4is_wbyra6z); badgeos_log_users_points($vwpalm4is_tcon6xrp, $vwpalm4is_wbyra6z, $vwpalm4is_e50x2jnv9g1, 0, 0); } elseif (function_exists('gamipress_update_user_points') ) { $vwpalm4is_e50x2jnv9g1 = gamipress_update_user_points($vwpalm4is_tcon6xrp, $vwpalm4is_wbyra6z); gamipress_log_user_points($vwpalm4is_tcon6xrp, $vwpalm4is_wbyra6z, $vwpalm4is_e50x2jnv9g1, 0, 0); } else { $vwpalm4is_x3e6m_hobj = empty($vwpalm4is_o_6p9tyav) ? '_memberium_points' : "_memberium_{$vwpalm4is_o_6p9tyav}_points"; $vwpalm4is_e50x2jnv9g1 = $vwpalm4is_wbyra6z + self::wpalm4is__4dnt_r($vwpalm4is_tcon6xrp); update_user_meta($vwpalm4is_tcon6xrp, $vwpalm4is_x3e6m_hobj, $vwpalm4is_e50x2jnv9g1); } return $vwpalm4is_e50x2jnv9g1; } static function wpalm4is_sjr4yna53d($vwpalm4is_xnx425r3, $vwpalm4is__lstjamupz = null, $vwpalm4is_d5kqsi90y = '') { $vwpalm4is_tcon6xrp = isset($vwpalm4is_xnx425r3['user_id']) ? (int) $vwpalm4is_xnx425r3['user_id'] : get_current_user_id(); $vwpalm4is_o_6p9tyav = isset($vwpalm4is_xnx425r3['type']) ? (int) $vwpalm4is_xnx425r3['type'] : ''; $vwpalm4is_hb84ktco7rj = self::wpalm4is__4dnt_r($vwpalm4is_tcon6xrp, $vwpalm4is_o_6p9tyav); return $vwpalm4is_hb84ktco7rj; }    private static function wpalm4is_aa5bnteqr($vwpalm4is_b4pziutvs9c5 = null) { if (empty($vwpalm4is_b4pziutvs9c5) ) { return ''; } if (function_exists('gamipress_update_user_points') ) { $vwpalm4is_o_6p9tyav = gamipress_get_points_type($vwpalm4is_o_6p9tyav); } else { $vwpalm4is_o_6p9tyav = (string) $vwpalm4is_b4pziutvs9c5; } return $vwpalm4is_o_6p9tyav; } }
