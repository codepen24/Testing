<?php
/**
 * Copyright (c) 2012-2020 David J Bullock
 * Web Power and Light
 */

 if (! defined('ABSPATH') ) { die(); }  final class wpalm4is_tasl1rknjbz extends WP_Widget { function __construct() { parent::__construct( 'foo_widget',  __('Memberium Login', 'memberium'),  array('description' => __('Memberium Login Widget', 'memberium'),)  ); }   function wpalm4is_b_pdxagtk($vwpalm4is_g87myl0d, $vwpalm4is_xiesf0aq1jgp) { echo $vwpalm4is_g87myl0d['before_widget']; if (! empty($vwpalm4is_xiesf0aq1jgp['title']) ) {  } echo '<h3 class="widget-title">', __('Login', 'memberium'), '</h3>'; echo do_shortcode('[memb_loginform]'); echo $vwpalm4is_g87myl0d['after_widget']; }  function form($vwpalm4is_xiesf0aq1jgp) { $title = ! empty($vwpalm4is_xiesf0aq1jgp['title']) ? $vwpalm4is_xiesf0aq1jgp['title'] : __('New title', 'wpalm4is_v9ef67'); ?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Hide When Logged In:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p>
		<?php
 }  function wpalm4is_jrcdf1($vwpalm4is_gbfgjhewi, $vwpalm4is_qb31ect7uw) { $vwpalm4is_xiesf0aq1jgp = array(); $vwpalm4is_xiesf0aq1jgp['title'] = (! empty($vwpalm4is_gbfgjhewi['title']) ) ? strip_tags($vwpalm4is_gbfgjhewi['title']) : ''; return $vwpalm4is_xiesf0aq1jgp; } }
