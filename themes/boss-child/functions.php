<?php
/**
 * @package Boss Child Theme
 * The parent theme functions are located at /boss/buddyboss-inc/theme-functions.php
 * Add your own functions in this file.
 */

/**
 * Sets up theme defaults
 *
 * @since Boss Child Theme 1.0.0
 */
function boss_child_theme_setup() {
	 /**
	 * Makes child theme available for translation.
	 * Translations can be added into the /languages/ directory.
	 * Read more at: http://www.buddyboss.com/tutorials/language-translations/
	 */

	// Translate text from the PARENT theme.
	load_theme_textdomain( 'boss', get_stylesheet_directory() . '/languages' );

	// Translate text from the CHILD theme only.
	// Change 'boss' instances in all child theme files to 'boss_child_theme'.
	// load_theme_textdomain( 'boss_child_theme', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'boss_child_theme_setup' );

/**
 * Enqueues scripts and styles for child theme front-end.
 *
 * @since Boss Child Theme  1.0.0
 */
function boss_child_theme_scripts_styles() {
	/**
	 * Scripts and Styles loaded by the parent theme can be unloaded if needed
	 * using wp_deregister_script or wp_deregister_style.
	 *
	 * See the WordPress Codex for more information about those functions:
	 * http://codex.wordpress.org/Function_Reference/wp_deregister_script
	 * http://codex.wordpress.org/Function_Reference/wp_deregister_style
	 */

	/*
	* Styles
	*/
	// Change version here from time to version number.
	wp_enqueue_style( 'boss-child-custom', get_stylesheet_directory_uri() . '/css/custom.css', array(), time() );
}
add_action( 'wp_enqueue_scripts', 'boss_child_theme_scripts_styles', 9999 );


/****************************** CUSTOM FUNCTIONS ******************************/

// Add your own custom functions here

/**
 * Displays Nav bar on members pages. Update page IDs according the use.
 */
function wdl_all_members_nav() {

	global $post;

	$page_id = 0;

	if ( ! empty( $post->ID ) ) {
		$page_id = $post->ID;
	}

	ob_start();

	$options = get_option( 'tcg_global_settings' );

	$tabs = array(
		'0' => array(
			'id'    => 0,
			'title' => __( 'All Members', 'boss' ),
		),
	);

	if ( isset( $options['leaderboard'] ) && ! empty( $options['leaderboard'] ) ) {
		$leaderboard_post_id = $options['leaderboard'];
		if ( function_exists( 'icl_object_id' ) ) {
			$leaderboard_post_id = icl_object_id( $options['leaderboard'], 'page', false, ICL_LANGUAGE_CODE );
		}

		$tabs[] = array(
			'id'    => $leaderboard_post_id, // Leaderboard
			'title' => '',
		);
	}
	if ( isset( $options['members_map'] ) && ! empty( $options['members_map'] ) ) {
		$member_post_id = $options['members_map'];
		if ( function_exists( 'icl_object_id' ) ) {
			$member_post_id = icl_object_id( $options['members_map'], 'page', false, ICL_LANGUAGE_CODE );
		}

		$tabs[] = array(
			'id'    => $member_post_id, // Map
			'title' => '',
		);
	}
	?>
  <style type="text/css">
	/* We don't want page title on these pages */
	.page .entry-header {
	  display: none;
	}
	.dir-page-entry {
	  border-bottom: none;
	}
	.item-list-tabs {
	  margin: 0 70px;
	  padding-left: 0 !important;
	  padding-right: 0 !important;
	}
	.type-page .item-list-tabs {
	  margin: 0;
	}
	.item-list-tabs li {
	  width: 33.3%;
	  margin: 0 !important;
	}
	.dir-form .item-list-tabs .wdl-selected a {
	  color: #00a6dc;
	}
	@media screen and (max-width: 480px) {
	  .item-list-tabs {
		padding-left: 30px !important;
		padding-right: 30px !important;
	  }
	  .item-list-tabs li {
		width: 100%;
		margin: 7px 0 10px !important;
	  }
	}
  </style>
  <div class="entry-buddypress-content">
	<div id="buddypress">
	  <div class="dir-form">
		<div class="item-list-tabs" role="navigation">
			<ul>
			  <?php
				foreach ( $tabs as $tab ) {

					$selected = '';
					if ( $page_id == $tab['id'] ) {
						$selected = 'selected wdl-selected';
					}

					$href  = $tab['id'] ? get_permalink( $tab['id'] ) : bp_get_members_directory_permalink();
					$title = $tab['id'] ? get_the_title( $tab['id'] ) : $tab['title'];
					echo '<li class="' . $selected . '">
                    <a href="' . $href . '">' . $title . '</a>
                </li>';
				}
				?>
			</ul>
		</div><!-- .item-list-tabs -->
	  </div>
	</div>
  </div>
	<?php
	return ob_get_clean();
}
add_shortcode( 'wpdevlms_all_members_nav', 'wdl_all_members_nav' );


function wpdevlms_search_interests() {
}
add_action( 'wp_enqueue_scripts', 'wpdevlms_search_interests' );


/**
 * Registers Webinar CPT
 */
function wpdevlms_register_webinar_cpts() {

	/**
	 * Post Type: Webinars.
	 */

	$labels = array(
		'name'          => __( 'Webinars', 'boss' ),
		'singular_name' => __( 'Webinar', 'boss' ),
	);

	$args = array(
		'label'               => __( 'Webinars', 'boss' ),
		'labels'              => $labels,
		'description'         => '',
		'public'              => true,
		'publicly_queryable'  => true,
		'show_ui'             => true,
		'show_in_rest'        => false,
		'rest_base'           => '',
		'has_archive'         => 'webinars',
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'exclude_from_search' => false,
		'capability_type'     => 'post',
		'map_meta_cap'        => true,
		'hierarchical'        => false,
		'rewrite'             => array(
			'slug'       => 'webinars',
			'with_front' => true,
		),
		'query_var'           => true,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'author' ),
		'taxonomies'          => array( 'category', 'post_tag' ),
	);

	register_post_type( 'tcg_webinar', $args );
}
add_action( 'init', 'wpdevlms_register_webinar_cpts' );


/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_shortcode( 'mp_custom_woocommerce_orders_1', 'mp_custom_woocommerce_orders_callback_1' );

function mp_custom_woocommerce_orders_callback_1() {   
    return "freds test"; 
}

add_shortcode( 'mp_custom_woocommerce_orders', 'mp_custom_woocommerce_orders_callback' );

function mp_custom_woocommerce_orders_callback() {
	$current_user = wp_get_current_user();
	if ( $current_user ) {
		$consumer_key         = 'ck_9a3870a61922cd14c984a1979699a4dfd5ca3ffd';
		$consumer_secret      = 'cs_e0b14fe4e8a6fb9138a3eba060c919fa866b0d9e';
		$result               = '';
		$customer_details_url = '/wp-json/wc/v2/customers/?email=';
		$info_site_url        = 'https://transculturalgroup.com';
		$valid_order          = 0;
		$current_site_url     = get_site_url();

		$api_response = wp_remote_get(
			$info_site_url . $customer_details_url . $current_user->user_email . '&consumer_key=' . $consumer_key . '&consumer_secret=' . $consumer_secret
		);

		$body = json_decode( $api_response['body'] );
		if ( isset( $body[0]->id ) && $body[0]->id > 0 ) {
			$order_details_url = '/wp-json/wc/v2/orders/?customer=';

			$api_response = wp_remote_get(
				$info_site_url . $order_details_url . $body[0]->id . '&consumer_key=' . $consumer_key . '&consumer_secret=' . $consumer_secret
			);

			$body = json_decode( $api_response['body'] );
			if ( ! empty( $body ) ) {
				$i = 0;
				if ( ! empty( $_GET['mp_order_id'] ) && ( $mp_order_id = filter_var( $_GET['mp_order_id'], FILTER_SANITIZE_NUMBER_INT ) ) ) {
					foreach ( $body as $key => $order ) {
						if ( $order->id == $mp_order_id ) {
							$valid_order = 1;
						}
					}
					if ( $valid_order ) {
						$single_order_details_url = '/wp-json/wc/v2/orders/' . $mp_order_id;
						$api_response             = wp_remote_get(
							$info_site_url . $single_order_details_url . '?consumer_key=' . $consumer_key . '&consumer_secret=' . $consumer_secret
						);
						$order_body               = json_decode( $api_response['body'] );

						$result .= '<p>' . __( 'Order', 'boss' ) . ' #' . $order_body->number . ' ' . __( 'was', 'boss' ) . ' ' . __( 'placed', 'boss' ) . ' ' . __( 'on', 'boss' ) . ' ' . date( 'F j, Y', strtotime( $order_body->date_created ) ) . ' .' . __( 'and', 'boss' ) . '. ' . __( 'is', 'boss' ) . ' ' . __( 'currently', 'boss' ) . ' ' . __( ucfirst( $order_body->status ), 'boss' ) . '.</p>';

						$result  .= '<section class="woocommerce-order-details"><h2 class="woocommerce-order-details__title">' . __( 'Order details', 'boss' ) . '</h2><table class="woocommerce-table woocommerce-table--order-details shop_table order_details"><thead><tr><th class="woocommerce-table__product-name product-name">' . __( 'Product', 'boss' ) . '</th><th class="woocommerce-table__product-table product-total">' . __( 'Total', 'boss' ) . '</th></tr></thead><tbody>';
						$subtotal = 0;
						foreach ( $order_body->line_items as $line_item ) {
							$result   .= '<tr class="woocommerce-table__line-item order_item"><td class="woocommerce-table__product-name product-name"> ' . $line_item->name . ' <strong class="product-quantity">× ' . $line_item->quantity . ' </strong></td><td class="woocommerce-table__product-total product-total"><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' . $order_body->currency . '</span> ' . $line_item->subtotal . ' </span></td></tr>';
							$subtotal += $line_item->subtotal;
						}
						$result .= '</tbody><tfoot><tr>
						<th scope="row">' . __( 'Subtotal', 'boss' ) . ':</th><td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' . $order_body->currency . '</span> ' . number_format( $subtotal, 2 ) . '</span></td></tr><tr><th scope="row">' . __( 'Discount', 'boss' ) . ':</th>
						<td>-<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' . $order_body->currency . '</span> ' . $order_body->discount_total . '</span></td></tr><tr><th scope="row">' . __( 'Total', 'boss' ) . ':</th><td><span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol">' . $order_body->currency . '</span> ' . $order_body->total . '</span></td></tr></tfoot></table></section>';
					} else {
						return '<ul><li>' . __( 'Invalid Order.', 'boss' ) . '</li></ul>';
					}
				} else {
					global $wp;
					foreach ( $body as $key => $order ) {
						$order_details[ $i ]['link']   = add_query_arg( 'mp_order_id', $order->id, home_url( $wp->request ) );
						$order_details[ $i ]['date']   = $order->date_created;
						$order_details[ $i ]['number'] = $order->number;
						$order_details[ $i ]['total']  = $order->total . ' ' . $order->currency;
						$order_details[ $i ]['status'] = __( ucfirst( $order->status ), 'boss' );
						$i++;
					}
					$result .= '<table style="width: 100%;" id="mp_order_table">';
					$result .= '<thead><tr>';
					$result .= '<th style="padding: 1em;">' . __( 'Order No.', 'boss' ) . '</th>';
					$result .= '<th style="padding: 1em;">' . __( 'Date', 'boss' ) . '</th>';
					$result .= '<th style="padding: 1em;">' . __( 'Total', 'boss' ) . '</th>';
					$result .= '<th style="padding: 1em;">' . __( 'Status', 'boss' ) . '</th>';
					$result .= '<th >' . __( 'Action', 'boss' ) . '</th>';
					$result .= '</tr></thead><tbody>';
					foreach ( $order_details as $key => $value ) {
						$result .= '<td style="padding-left: 5px !important;">' . $value['number'] . '</td>';
						$result .= '<td>' . date( 'F j, Y', strtotime( $value['date'] ) ) . '</td>';
						$result .= '<td>' . $value['total'] . '</td>';
						$result .= '<td>' . $value['status'] . '</td>';
						$result .= '<td><a href="' . $value['link'] . '" >' . __( 'View Order', 'boss' ) . '</a></td></tr>';
					}
					$result .= '</tbody></table>';
					$result .= '<script>jQuery(\'#mp_order_table\').dataTable( { "scrollX": true, "lengthChange": false, "searching": false, "oLanguage": { "sInfo": "' . __( 'Showing', 'boss' ) . ' _START_ ' . __( 'to', 'boss' ) . ' _END_ ' . __( 'of', 'boss' ) . ' _TOTAL_ ' . __( 'entries', 'boss' ) . '", "oPaginate": { "sFirst": "' . __( 'First', 'boss' ) . '", "sPrevious": "' . __( 'Previous', 'boss' ) . '", "sNext": "' . __( 'Next', 'boss' ) . '",  "sLast": "' . __( 'Last', 'boss' ) . '" } } } );</script>';
				}
			}
		} else {
			return '<ul><li>' . __( 'No order found', 'boss' ) . '</li></ul>';
		}
	}
	return $result;
}

function mp_enqueue_scripts() {
	wp_enqueue_style( 'mp-datatable', get_stylesheet_directory_uri() . '/css/jquery.dataTables.min.css', false );
    wp_enqueue_script( 'mp-datatable', get_stylesheet_directory_uri() . '/js/jquery.dataTables.min.js', array( 'jquery' ), true );
    wp_enqueue_script('my-match-height-js', get_stylesheet_directory_uri() . '/js/jquery.matchHeight.js', array('jquery'), false );
    wp_enqueue_script('custom_js', get_stylesheet_directory_uri() . '/js/js-customs_27.js', array('my-match-height-js'), false );
}

add_action( 'wp_enqueue_scripts', 'mp_enqueue_scripts' );




// Custom shortcode to be added on the Nav menu under "My Profile" tab as this will redirect 
// the link to the "Profile users" page and not the "Profile Group" page
// Use Shortcode [custom_url_user] 
// -----------------------------------------------------------------------------------------

function user_profile_shrt_c_redirect() {
    $user_prof_url = wp_get_current_user()->data->user_nicename;
    // var_dump(wp_get_current_user()->data->user_nicename);
    $the_user_prof_url = str_replace(' ', '-', $user_prof_url);
    return $the_user_prof_url;
}
add_shortcode('custom_url_user', 'user_profile_shrt_c_redirect');

add_action('user_register', 'save_geolocation', 10, 1 );

function save_geolocation($user_id) {
    if(isset($_POST['billing_address_1']) && !empty($_POST['billing_address_1'])) {
        $address = $_POST['billing_address_1'] .','. $_POST['billing_address_2'] .','. $_POST['billing_city'] .','. $_POST['billing_state'] .','. $_POST['billing_country'] .','. $_POST['billing_postcode'];
        $geo_coords = convert_address_to_geolocation($address);

        if(!empty($geo_coords['latitude']) && !empty($geo_coords['longitude'])) {
            update_user_meta($user_id, '_wpdevlms_coords', array('lat' => $geo_coords['latitude'], 'lon' => $geo_coords['longitude']));
        }
    } elseif(isset($_POST['billing_address_1']) && empty($_POST['billing_address_1']) && empty($_POST['billing_address_2'])) {
        // We are deleting this data to respect GDPR.
        delete_user_meta($user_id, '_wpdevlms_coords');
    }
}

add_action('xprofile_updated_profile', 'bp_save_geolocation', 10, 5);

function bp_save_geolocation($user_id, $posted_field_ids, $errors, $old_values, $new_values) {
    if(isset($new_values[13]) && !empty($new_values[13]['value'])) {
        $address = $new_values[9]['value'] .','. $new_values[10]['value'] .','. $new_values[11]['value'] .','. $new_values[263]['value'] .','. $new_values[13]['value'] .','. $new_values[12]['value'];
        $geo_coords = convert_address_to_geolocation($address);
        if(!empty($geo_coords['latitude']) && !empty($geo_coords['longitude'])) {
            update_user_meta($user_id, '_wpdevlms_coords', array('lat' => $geo_coords['latitude'], 'lon' => $geo_coords['longitude']));
        }
    }
}

function convert_address_to_geolocation($address) {

    $address = str_replace(" ", "+", $address);

    $url = "https://maps.googleapis.com/maps/api/geocode/json?address=$address&key=AIzaSyAuCyF6692En9NmPI6HODsQyIUygyBMt6c"; 
    $google_api_response = wp_remote_get( $url );    

    $results = json_decode( $google_api_response['body'] ); //grab our results from Google
    $results = (array) $results; //cast them to an array
 
    $status = $results["status"]; //easily use our status
    $location_all_fields = (array) $results["results"][0];
    $location_geometry = (array) $location_all_fields["geometry"];
    $location_lat_long = (array) $location_geometry["location"];
   
    if( $status == 'OK'){
        $latitude 	= $location_lat_long["lat"];
        $longitude 	= $location_lat_long["lng"];
    }else{
        $latitude 	= '';
        $longitude 	= '';
    }
    $return = array(
                'latitude'  => $latitude,
                'longitude' => $longitude

                );
    return $return;
}


// Adding of default "Avatar/Profile" picture globally if users has not set any 
// ____________________________________________________________________________

add_filter( 'avatar_defaults', 'new_gravatar' );
    function new_gravatar ($avatar_defaults) {
    $myavatar = 'https://members.transculturalgroup.com/wp-content/uploads/2019/12/default_global_avatar-200x200.png';
    $avatar_defaults[$myavatar] = "Default Gravatar";
    return $avatar_defaults;
}

// Adding of "My Order" tab on my My Profile page 
// ______________________________________________

//bp_core_new_nav_item(
//  array(
//      'name' => __('Messages', 'buddypress'),
//      'slug' => $bp->messages->slug,
//      'position' => 50,
//      'show_for_displayed_user' => false,
//      'screen_function' => 'messages_screen_inbox',
//      'default_subnav_slug' => 'inbox',
//      'item_css_id' => $bp->messages->id
//    )
//);

function ibenic_buddypress_tab() {
  global $bp;
  bp_core_new_nav_item( array( 
        'name' => __( 'My Orders', 'ibenic' ), 
        'slug' => 'woo-orders', 
        'position' => 100,
        'screen_function' => 'my_order_res_func',
        'show_for_displayed_user' => true,
        'item_css_id' => 'my_order_res_func'
  ) );
  
}
add_action( 'bp_setup_nav', 'ibenic_buddypress_tab', 1000 );

function my_order_res_func () {
    add_action( 'bp_template_title', 'ibenic_buddypress_recent_posts_title' );
    add_action( 'bp_template_content', 'ibenic_buddypress_recent_posts_content' );
    bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

function ibenic_buddypress_recent_posts_title() {
  _e( 'Orders', 'ibenic' );
}

function ibenic_buddypress_recent_posts_content() {
  $woo_orders_1 = do_shortcode('[badgeos_achievements_list type="subscription" limit="50" orderby="title" order="ASC" wpms="false"]');
  $woo_orders_2 = do_shortcode('[mp_custom_woocommerce_orders]');
  echo $woo_orders_1;
  echo $woo_orders_2;
}

// Adding of "My Achievements" tab on my My Profile page 
// ______________________________________________

//bp_core_new_nav_item(
//  array(
//      'name' => __('Messages', 'buddypress'),
//      'slug' => $bp->messages->slug,
//      'position' => 50,
//      'show_for_displayed_user' => false,
//      'screen_function' => 'messages_screen_inbox',
//      'default_subnav_slug' => 'inbox',
//      'item_css_id' => $bp->messages->id
//    )
//);

function my_achievements_func_tab() {
  global $bp;
  bp_core_new_nav_item( array( 
        'name' => __( 'My Achievements', 'ibenic' ), 
        'slug' => 'prof-achievements', 
        'position' => 101,
        'screen_function' => 'my_achievements_func',
        'show_for_displayed_user' => true,
        'item_css_id' => 'my_achievements_func'
  ) );
  
}
add_action( 'bp_setup_nav', 'my_achievements_func_tab', 1000 );

function my_achievements_func () {
    add_action( 'bp_template_title', 'my_achievements_func_title' );
    add_action( 'bp_template_content', 'my_achievements_func_content' );
    bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

function my_achievements_func_title() {
  _e( 'Achievements', 'ibenic' );
}

function my_achievements_func_content() {
  $prof_achievements = do_shortcode('[badgeos_achievements_list type="badge" limit="50" orderby="title" order="ASC" wpms="false"]');
  echo $prof_achievements; 
}
