<?php
/**
 * Copyright (c) 2018-2020 David J Bullock
 * Web Power and Light, LLC
 * https://webpowerandlight.com
 * support@webpowerandlight.com
 *
 */

 if (! defined('ABSPATH') ) { die(); } final class wpalm4is_wma271c { static function wpalm4is_x2u4lviwcrj3() { $vwpalm4is_bxtch_ = time() + 180; if (! wp_next_scheduled('memberium_scanmakepass') ) { wp_schedule_event($vwpalm4is_bxtch_, '3min', 'memberium_scanmakepass'); } if (! wp_next_scheduled('memberium_maintenance') ) { wp_schedule_event($vwpalm4is_bxtch_ + 15, 'hourly', 'memberium_maintenance'); } if (! wp_next_scheduled('memberium_maintenance12') ) { wp_schedule_event($vwpalm4is_bxtch_ + 30, 'twicedaily', 'memberium_maintenance12'); } if (! wp_next_scheduled('memberium_license_check') ) { wp_schedule_event($vwpalm4is_bxtch_ + 45, 'daily', 'memberium_license_check'); } update_option('memberium_cron', $vwpalm4is_bxtch_); } static function wpalm4is_j1rf_3t6() { $vwpalm4is_qs6lbv3o = array( 'memberium_license_check', 'memberium_maintenance', 'memberium_maintenance12', 'memberium_scanmakepass', ); foreach($vwpalm4is_qs6lbv3o as $vwpalm4is_t73g12) { wp_clear_scheduled_hook($vwpalm4is_t73g12); } delete_option('memberium_cron'); } static function wpalm4is_y_w4js7k() { } }
