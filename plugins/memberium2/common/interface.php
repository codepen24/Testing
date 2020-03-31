<?php
/**
 * Copyright (c) 2012-2020 David J Bullock
 * Web Power and Light
 */



if (! defined('ABSPATH') ) {
	die();
}


function memb_doShortcode($content, $do_regular_shortcodes = true) {
	return do_shortcode($content);
}


function memb_getLoggedIn() {
	return is_user_logged_in();
}

function memb_hasAllTags($tags, $contact_id = false) {
	return wpalm4is_l9n25d::wpalm4is_tuymrtz($tags, $contact_id);
}

function memb_hasAnyTags($tags, $contact_id = false){
	if ($contact_id) {
		$session = memberium_app()->wpalm4is_hfr9iw_m0na3($contact_id);
	}
	else {
		$session = false;
	}
	return wpalm4is_l9n25d::wpalm4is_vodyxmki9r($tags, $session);
}

function memb_hasAnyMembership() {
	return memberium_app()->wpalm4is_qt45jry()->wpalm4is_icj_l3hsqkr();
}

function memb_hasMembership($level) {
	return memberium_app()->wpalm4is_qt45jry()->wpalm4is_u9r5mi($level);
}

function memb_hasMembershipLevel($level) {
	return memberium_app()->wpalm4is_qt45jry()->wpalm4is_mhbc5x($level);
}

function memb_isPostProtected($post) {
	return memberium_app()->wpalm4is_qt45jry()->wpalm4is_nerhi93($post);
}

function memb_hasPostAccess($post_id) {
	return memberium_app()->wpalm4is_qt45jry()->wpalm4is_soqlemn8fp($post_id);
}

function memb_is_loggedin() {
	return is_user_logged_in();
}


function memb_getUserField($field_name, $user_id = 0) {
	return wpalm4is_xamhc3q6o::wpalm4is_i0lc6wz8j4s($field_name, $user_id);
}

function memb_setUserField($field_name, $value, $user_id = 0) {
	return wpalm4is_xamhc3q6o::wpalm4is_nj4cd0pr_feo($field_name, $value, $user_id);
}


function memb_overrideProhibitedAction($action) {
	return memberium_app()->wpalm4is_qt45jry()->wpalm4is_id8234wv0hg($action);
}


function memb_get_affiliate_field($fieldname = '', $sanitize = FALSE) {
	return memberium_app()->wpalm4is_qt45jry()->wpalm4is_l1aphyb9m($fieldname, $sanitize);
}

function memb_changeContactPassword($password, $contact_id = false) {
	return memberium_app()->wpalm4is_mel79kz2sa($password, $contact_id);
}

function memb_changeContactEmail($email, $user_id, $force_username = false) {
	return memberium_app()->wpalm4is_m0poxmrk5shj($user_id, $email, 0, $force_username);
}

function memb_getContactField($fieldname = '', $sanitize = FALSE) {
	return memberium_app()->wpalm4is_qt45jry()->wpalm4is_pfjn0pa($fieldname, $sanitize);
}

function memb_getContactId() {
	return wpalm4is_xamhc3q6o::wpalm4is_sxkjpbr0vhs3();
}

function memb_getContactIdByUserId($user_id) {
	return wpalm4is_bd5uye4ng3l::wpalm4is_titrm5z4($user_id);
}

function memb_getUserIdByContactId($contact_id) {
	return wpalm4is_bd5uye4ng3l::wpalm4is_v6egzl2n7($contact_id);
}

function memb_loadContactById($contact_id) {
	return wpalm4is_bd5uye4ng3l::wpalm4is_cad0k_3hp7m($contact_id);
}

function memb_syncContact($contact_id = 0, $cascade = false) {
	return memberium_app()->wpalm4is_kfhs9u7mp0o4($contact_id, $cascade);
}

function memb_setTags($tags = '', $contact_id = false, $force = false) {
	return memberium_app()->wpalm4is_yp5awiqcv($tags, $contact_id, $force);
}

function memb_getReceipt($args = array()) {
	return memberium_app()->wpalm4is_isej8k2uc9($args);
}

function memb_setContactField($key = '', $value = '', $contact_id = 0) {
	if (empty($key) ) {
		return false;
	}
	return memberium_app()->wpalm4is_wvcz6opb($key, $value, $contact_id);
}

function memb_getSession($user_id) {
	return memberium_app()->get_session($user_id);
}


function memb_getMembershipMap(){
	return wpalm4is_xb7t0i6pzn::wpalm4is_s0xuab5fq6hy('memberships');
}

function memb_getTagMap( $cache_bust = false, $negatives = false ){
	return memberium_app()->wpalm4is_d35w2jzaf($cache_bust,$negatives);
}

function memb_getContactFieldsMap(){
	global $i2sdk;
	return $i2sdk->getInfusionsoftFieldsByTable( 'Contact' );
}



function doMemberiumLogin($username, $password = '', $idempotent = false) {
	return memberium_app()->wpalm4is_qt45jry()->wpalm4is_lpry54o16($username, $password, $idempotent);
}

function memb_setSSOMode($mode = true) {
	return memberium_app()->wpalm4is_f9gafxo( (boolean) $mode);
}

function memb_getAppName() {
	return wpalm4is_xb7t0i6pzn::wpalm4is_mz346l5qyv('appname');
}

function memb_getPostSettings($post_id) {
	return wpalm4is_icnysx85::wpalm4is_uy0q42lmi($post_id);
}
