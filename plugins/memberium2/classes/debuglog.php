<?php
/**
 * Copyright (c) 2018-2020 David J Bullock
 * Web Power and Light, LLC
 * https://webpowerandlight.com
 * support@webpowerandlight.com
 *
 */

 if (!defined('ABSPATH') ) { die(); } final class wpalm4is_ldji6rauz { static function wpalm4is_n9x25y3b($vwpalm4is_rs76aqhfcu5z = '', $vwpalm4is_xsxnaocd3j8f = '', $vwpalm4is_vwmsk_yxp = 0, $vwpalm4is_k_jdoq4w = '', $vwpalm4is_n0wrho_2u = NULL) { if (isset($_GET['doing_wp_cron']) ) { return; } if (is_admin() ) { return; } global $user; $vwpalm4is_be0vd5l74fyp = $_SERVER['REMOTE_ADDR'] . '::' . isset($_SERVER['REQUEST_TIME_FLOAT']) ? $_SERVER['REQUEST_TIME_FLOAT'] : $_SERVER['REQUEST_TIME']; $vwpalm4is_biblegoq6c = $vwpalm4is_be0vd5l74fyp . ' :: ' . microtime(true); $vwpalm4is_biblegoq6c .= ' :: ' . (function_exists('get_current_user_id') ? get_current_user_id() : 0); if (function_exists('current_filter') ) { $vwpalm4is_biblegoq6c .= ' :: ' . current_filter(); } $vwpalm4is_biblegoq6c .= ' :: '; $vwpalm4is_biblegoq6c .= basename($vwpalm4is_rs76aqhfcu5z) . ' -> ' . $vwpalm4is_xsxnaocd3j8f . ' -> ' . $vwpalm4is_vwmsk_yxp . " :: "; if (isset($vwpalm4is_n0wrho_2u) ) { $vwpalm4is_biblegoq6c .= $vwpalm4is_k_jdoq4w . ' = '; if (is_array($vwpalm4is_n0wrho_2u) || is_object($vwpalm4is_n0wrho_2u) ) { $vwpalm4is_biblegoq6c .= print_r($vwpalm4is_n0wrho_2u, true); } elseif (is_bool($vwpalm4is_n0wrho_2u) ) { $vwpalm4is_biblegoq6c .= $vwpalm4is_n0wrho_2u ? 'True' : 'False'; } else { $vwpalm4is_biblegoq6c .= $vwpalm4is_n0wrho_2u; } } else { $vwpalm4is_biblegoq6c .= $vwpalm4is_k_jdoq4w; } $vwpalm4is_biblegoq6c .= "\n"; if (MEMBERIUM_DEBUGLOG == 'error_log:') { error_log($vwpalm4is_biblegoq6c); } elseif (MEMBERIUM_DEBUGLOG > '') { file_put_contents(MEMBERIUM_DEBUGLOG, $vwpalm4is_biblegoq6c, FILE_APPEND); } else { echo nl2br($vwpalm4is_biblegoq6c); } } }
