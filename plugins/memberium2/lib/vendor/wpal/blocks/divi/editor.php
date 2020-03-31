<?php
/**
 * Copyright (c) 2020 David J Bullock
 * Web Power and Light
*/

 if (! defined( 'ABSPATH' ) ) { die(); }  class wpalm4is_p2ux_1c {  public $builder_slug;  public $script_version = '1.0.4';  public $to_json = array();  public $omitted_blocks = array();  function __construct( $builder_slug) { $this->builder_slug = $builder_slug; $this->to_json['WPAL_BLOCKS_SETTINGS_TITLE'] = WPAL_BLOCKS_SETTINGS_TITLE; $this->to_json['WPAL_BLOCKS_PREFIX'] = WPAL_BLOCKS_PREFIX; $this->to_json['WPAL_BLOCKS_KEYS_REMOVED_TEXT'] = WPAL_BLOCKS_KEYS_REMOVED_TEXT; $this->to_json['tags'] = wpalm4is_vhdsv0f()->wpalm4is_j9uoxyzi7sre( $builder_slug );  add_filter('wpal/blocks/'.$builder_slug.'/control/config/', array( $this, 'wpalm4is_xbwv1d'), 10, 1 ); $this->to_json['controls'] = wpalm4is_vhdsv0f()->wpalm4is_s79cg3i( $this->builder_slug );  $this->omitted_blocks = apply_filters( 'wpal/blocks/'.$builder_slug.'/settings/omitted_blocks', array( 'et_pb_column' ) );  add_action('et_builder_ready', array( $this, 'init' ), 9999 );  add_action(is_admin() ? 'admin_enqueue_scripts' : 'wp_enqueue_scripts', array( $this, 'wpalm4is_db60fuegp' ), 9999 ); }  function init(){ $divi_modules = array(); foreach ( $GLOBALS['shortcode_tags'] as $tag => $func ) { if ( is_array( $func ) ) { if ( $func[0] instanceof ET_Builder_Element || $func[0] instanceof ET_Builder_Module ) { $divi_modules[$tag] = $func; remove_shortcode( $tag, $func ); } } } if ( !empty($divi_modules) ){ foreach ( $divi_modules as $tag => $func ) { $et_pb_element = $func[0]; $et_pb_render = $func[1]; $et_pb_element->settings_modal_toggles['custom_css']['toggles']['wpal-blocks'] = array( 'title' => WPAL_BLOCKS_SETTINGS_TITLE, 'priority' => 100 ); if ( !isset($et_pb_element->fields_unprocessed[WPAL_BLOCKS_PREFIX . '_anymembership'] ) ){ $controls = $this->wpalm4is_s45j3g( $this->to_json['controls'], $et_pb_element, $tag ); if ( is_array($controls) && !empty($controls) ){ $et_pb_element->fields_unprocessed = array_merge( $et_pb_element->fields_unprocessed, $controls ); } } add_shortcode( $tag, function( $atts, $content, $function_name ) use ( $et_pb_element, $et_pb_render ) { $result = $et_pb_element->$et_pb_render( $atts, $content, $function_name ); return $result; }); } } }  function wpalm4is_xbwv1d( $config ){ $divi_config = array(); if ( is_array($config) && !empty($config) ){ foreach( $config as $index => $field ) { $type = ( isset($field['type']) && $field['type'] > '' ) ? $field['type'] : false; $name = ( isset($field['name']) && $field['name'] > '' ) ? $field['name'] : false; $desc = ( isset($field['description']) && $field['description'] > '' ) ? $field['description'] : false; $sanitize = ( isset($field['sanitize']) && $field['sanitize'] > '' ) ? $field['sanitize'] : false; if ( $type && $name ){ switch ($type) { case 'checkbox': $divi_config[$name] = array( 'wpald' => 'toggle', 'wpald_level' => ( isset($field['level']) && $field['level'] > '' ) ? $field['level'] : '', 'wpald_toggles' => ( isset($field['toggles']) && is_array($field['toggles']) ) ? $field['toggles'] : false, 'type' => 'yes_no_button', 'label' => $field['label'], 'options' => array( 'off' => ( isset($field['label_off']) && $field['label_off'] > '' ) ? $field['label_off'] : __( 'Off', 'wpal_blocks' ), 'on' => ( isset($field['label_on']) && $field['label_on'] > '' ) ? $field['label_on'] : __( 'On', 'wpal_blocks' ), ), 'default' => ( isset($field['default']) && (int) $field['default'] > 0 ) ? 'on' : 'off', ); break; case 'textarea': $divi_config[$name] = array( 'wpald' => 'textarea', 'type' => 'text', 'label' => $field['label'], 'default' => '' ); break; case 'text': $divi_config[$name] = array( 'wpald' => 'text', 'type' => 'text', 'label' => $field['label'], 'default' => '' ); break; case 'SELECT2': $divi_config[$name] = array( 'wpald' => 'select2', 'type' => 'text', 'label' => $field['label'], ); break; default: break; } if ( $desc ){ $divi_config[$name]['description'] = $desc; } if ( $sanitize ){ $divi_config[$name]['sanitize'] = $sanitize; } $divi_config[$name]['additional_att'] = ( isset($field['additional_att']) && $field['additional_att'] > '' ) ? $field['additional_att'] : $name; $divi_config[$name]['option_category'] = ( isset($field['option_category']) && $field['option_category'] > '' ) ? $field['option_category'] : 'configuration'; $divi_config[$name]['tab_slug'] = ( isset($field['tab_slug']) && $field['tab_slug'] > '' ) ? $field['tab_slug'] : 'custom_css'; $divi_config[$name]['toggle_slug'] = ( isset($field['toggle_slug']) && $field['toggle_slug'] > '' ) ? $field['toggle_slug'] : 'wpal-blocks'; } } } return $divi_config; }  function wpalm4is_db60fuegp(){ $handle = 'wpal-blocks-divi-editor'; wp_register_style( 'select2css_divi', plugin_dir_url( __FILE__ ) . '/select2/select2_divi.css', false, $this->script_version, 'all' ); wp_register_script( 'select2_divi', plugin_dir_url( __FILE__ ) . '/select2/select2_divi-min.js', array( 'jquery' ), $this->script_version, true ); wp_register_script( $handle, plugin_dir_url( __FILE__ ) . '/editor.js', array('jquery', 'select2_divi'), $this->script_version, true ); wp_enqueue_style( 'select2css_divi' ); wp_enqueue_script( 'select2_divi' ); wp_enqueue_script( $handle ); wp_localize_script( $handle, 'wpald_params', $this->to_json ); }  function wpalm4is_lmdx4rv65q( $options ){ $data = false; if ( $options ){ $data = array(); foreach ($options as $value => $label) { $data[] = array( 'id' => $value, 'text' => $label ); } } return $data; }  function wpalm4is_s45j3g($controls, $et_pb_element, $tag){ $omitted = ( in_array( $tag, $this->omitted_blocks ) ) ? true : false; return ($omitted) ? false : $controls; } }
