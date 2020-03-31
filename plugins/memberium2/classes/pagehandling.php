<?php
/**
 * Copyright (c) 2018-2020 David J Bullock
 * Web Power and Light, LLC
 * https://webpowerandlight.com
 * support@webpowerandlight.com
 *
 */

 if (!defined('ABSPATH') ) { die(); } final class wpalm4is_ecij596 { static function wpalm4is_c5dwtgi() { if (! headers_sent() ) { nocache_headers(); header('Cache-Control: no-cache, max-age=0, must-revalidate, no-store'); header('Pragma: no-cache'); header('Expires: 0'); } } static function wpalm4is_unzi48cwdat() { if (! headers_sent() ) { wpalm4is_ecij596::wpalm4is_c5dwtgi(); if (! is_user_logged_in() ) { $name = 'wordpress_logged_in_' . md5($_SERVER['REMOTE_ADDR']); $value = 'memberium%7C' . time() . '%7C' . sha1($name) . '%7C' . sha1(time() ); setcookie ($name, $value, 180, '/'); } } } }
