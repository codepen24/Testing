<?php
/**
 * Copyright (c) 2012-2020 David J Bullock
 * Web Power and Light, LLC
 * https://webpowerandlight.com
 * support@webpowerandlight.com
 *
 */

 if (! defined('ABSPATH') ) { die(); } final class wpalm4is_i_v8swtu { static function wpalm4is_c5ev3lt() { $vwpalm4is_agvwtn = get_option('m4is/seeder/tag', 0); $vwpalm4is_cshmxpk = get_option('m4is/seeder/page', 0); $vwpalm4is_yd79gu = get_option('m4is/seeder/last_run', 0); if (! $vwpalm4is_agvwtn) { return; } if (time() - $vwpalm4is_yd79gu < 5) { return; } } private static function wpalm4is_hqw91037z($vwpalm4is_cshmxpk, $vwpalm4is_agvwtn) { if (empty($vwpalm4is_agvwtn) ) { return; } global $i2sdk; $vwpalm4is_e8ns965uk = 1000; $vwpalm4is__mnral5zjy = 'Contact'; $vwpalm4is_cshmxpk = (int) $vwpalm4is_cshmxpk; $vwpalm4is_mseywfvazo1 = $i2sdk->isdk; $vwpalm4is_mq3gv6sdxeu = wpalm4is_l9n25d::wpalm4is_qpf_6x7($vwpalm4is__mnral5zjy, FALSE); $vwpalm4is_huym27 = 0; $vwpalm4is_dd4j20qwmn_ = wpalm4is_xb7t0i6pzn::wpalm4is_mz346l5qyv('appname'); $vwpalm4is_fqzgw57 = array('Groups' => $vwpalm4is_agvwtn); $vwpalm4is_kmqnwo6cu5 = $vwpalm4is_mseywfvazo1->dsQuery($vwpalm4is__mnral5zjy, $vwpalm4is_e8ns965uk, $vwpalm4is_cshmxpk, $vwpalm4is_fqzgw57, $vwpalm4is_mq3gv6sdxeu); foreach($vwpalm4is_kmqnwo6cu5 as $row) { memberium_app()->wpalm4is_xnfg7oiy0kwt($row, false); } if (count($vwpalm4is_kmqnwo6cu5) < $vwpalm4is_e8ns965uk) { update_option('m4is/seeder/page', 0, false); } else { update_option('m4is/seeder/page', ($vwpalm4is_cshmxpk + 1), false); } } }
