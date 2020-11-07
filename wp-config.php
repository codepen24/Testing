
Currently editing: 
/home/transculturalgro/public_html/wp-config.php
 Encoding: 
utf-8
  Switch to Code Editor    Save
<?php
// define( 'WP_DEBUG', true );
// define('WP_CACHE', true /* Modified by NitroPack */ ); // Added by WP Rocket
// // Added by WP Rocket
// // //Added by WP-Cache Manager
// // Added by WP Rocket
// //Added by WP-Cache Manager
define( 'WP_MEMORY_LIMIT', '512M' );
// /** Enable W3 Total Cache */
// //Added by WP-Cache Manager

/** Enable W3 Total Cache */
 // Added by WP-Cache Manager

/** Enable W3 Total Cache */
 // Added by WP-Cache Manager

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

/*
 * cPanel & WHM® Site Software
 *
 * Core updates should be disabled entirely by the cPanel & WHM® Site Software
 * plugin, as Site Software will provide the updates.  The following line acts
 * as a safeguard, to avoid automatically updating if that plugin is disabled.
 *
 * Allowing updates outside of the Site Software interface in cPanel & WHM®
 * could lead to DATA LOSS.
 *
 * Re-enable automatic background updates at your own risk.
 */
 // Added by WP-Cache Manager
// define( 'WPCACHEHOME', '/home/transculturalgro/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME','transcul_dev');

/** MySQL database username */
define( 'DB_USER','transcul_wp');

/** MySQL database password */
define( 'DB_PASSWORD',')*d&LLCv');

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', 'rdWj3h6YAajuqROdeHoNkkA6FOzp68YQzoRwfYKh7xAGgWT0yFvjewwFMwq0Fzjx' );
define( 'SECURE_AUTH_KEY', 'uW6Um1Sb0gLOq5ZwJYslzIDhkJGBoeS5XJcnd0aMDirEAIp5_DSlEu1FxgjFLqhp' );
define( 'LOGGED_IN_KEY', '86yk2naYoSvzReoWsXkfrao5emxqzAPoOWv76wwVCAVMGYCfOQ0HOHPZTSgma_tn' );
define( 'NONCE_KEY', 'QMgaH9zF_y6OrVI31gHbbnQY6Int6qb1jY7_2dA9UjalWHhS38W7S9l4OGQVlTNO' );
define( 'AUTH_SALT', '9iKUpw282cSZb9N4MC42Fn0TC59CLYRIV53ZckMqEZp3WFxBdr7gACmBns4IuxUw' );
define( 'SECURE_AUTH_SALT', 'U61rULY1DjXqmUxlmFpgqi_jBPhBniI6cQHCbQDbHDi1AauSTlW9Si_i0ONvnr_f' );
define( 'LOGGED_IN_SALT', 'HtRbGJca3Qz_nsE18ed4AyHs6zQwcZkLdNJ5WFj_jg7QgXNavikRIeqaIMJwL4ic' );
define( 'NONCE_SALT', 'u1Qk60zDxIxlIpF_2hSpU3iCmh0y_KYXO3EQg56YOzFeo0X0Exn5x480aEhChzYP' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
define( 'WP_CACHE_KEY_SALT', 'kXCIL7i6fkUdHiK23vlToQ' );
define('WP_CACHE_KEY_SALT', 'fXwk/LJH+XCY7Z7EnGUeYQ');
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
 define( 'WP_DEBUG', false );
 /* Siteguarding Block 44B280167949-START */require_once '/home/transculturalgro/public_html/webanalyze/firewall/firewall.php';/*
 Siteguarding Block 44B280167949-END */
	// define( 'WP_DEBUG', true );
	// define('WP_CACHE', true); // Added by WP Rocket
	// // Added by WP Rocket
	// // //Added by WP-Cache Manager
	// // Added by WP Rocket
	// //Added by WP-Cache Manager
	define( 'WP_MEMORY_LIMIT', '512M' );
	// /** Enable W3 Total Cache */
	// //Added by WP-Cache Manager

	/** Enable W3 Total Cache */
	// Added by WP-Cache Manager

	/** Enable W3 Total Cache */
	// Added by WP-Cache Manager

	/**
	 * The base configuration for WordPress
	 *
	 * The wp-config.php creation script uses this file during the
	 * installation. You don't have to use the web site, you can
	 * copy this file to "wp-config.php" and fill in the values.
	 *
	 * This file contains the following configurations:
	 *
	 * * MySQL settings
	 * * Secret keys
	 * * Database table prefix
	 * * ABSPATH
	 *
	 * @link https://codex.wordpress.org/Editing_wp-config.php
	 *
	 * @package WordPress
	 */

	/*
	* cPanel & WHM® Site Software
	*
	* Core updates should be disabled entirely by the cPanel & WHM® Site Software
	* plugin, as Site Software will provide the updates.  The following line acts
	* as a safeguard, to avoid automatically updating if that plugin is disabled.
	*
	* Allowing updates outside of the Site Software interface in cPanel & WHM®
	* could lead to DATA LOSS.
	*
	* Re-enable automatic background updates at your own risk.
	*/
	// Added by WP-Cache Manager
	// define( 'WPCACHEHOME', '/home/transculturalgro/public_html/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager

	// ** MySQL settings - You can get this info from your web host ** //
	/** The name of the database for WordPress */
	define( 'DB_NAME','transcul_dev');

	/** MySQL database username */
	define( 'DB_USER','transcul_wp');

	/** MySQL database password */
	define( 'DB_PASSWORD',')*d&LLCv');

	/** MySQL hostname */
	define( 'DB_HOST', 'localhost' );

	/** Database Charset to use in creating database tables. */
	define( 'DB_CHARSET', 'utf8' );

	/** The Database Collate type. Don't change this if in doubt. */
	define( 'DB_COLLATE', '' );

	/**#@+
	 * Authentication Unique Keys and Salts.
	 *
	 * Change these to different unique phrases!
	 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
	 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
	 *
	 * @since 2.6.0
	 */
	define( 'AUTH_KEY', 'rdWj3h6YAajuqROdeHoNkkA6FOzp68YQzoRwfYKh7xAGgWT0yFvjewwFMwq0Fzjx' );
	define( 'SECURE_AUTH_KEY', 'uW6Um1Sb0gLOq5ZwJYslzIDhkJGBoeS5XJcnd0aMDirEAIp5_DSlEu1FxgjFLqhp' );
	define( 'LOGGED_IN_KEY', '86yk2naYoSvzReoWsXkfrao5emxqzAPoOWv76wwVCAVMGYCfOQ0HOHPZTSgma_tn' );
	define( 'NONCE_KEY', 'QMgaH9zF_y6OrVI31gHbbnQY6Int6qb1jY7_2dA9UjalWHhS38W7S9l4OGQVlTNO' );
	define( 'AUTH_SALT', '9iKUpw282cSZb9N4MC42Fn0TC59CLYRIV53ZckMqEZp3WFxBdr7gACmBns4IuxUw' );
	define( 'SECURE_AUTH_SALT', 'U61rULY1DjXqmUxlmFpgqi_jBPhBniI6cQHCbQDbHDi1AauSTlW9Si_i0ONvnr_f' );
	define( 'LOGGED_IN_SALT', 'HtRbGJca3Qz_nsE18ed4AyHs6zQwcZkLdNJ5WFj_jg7QgXNavikRIeqaIMJwL4ic' );
	define( 'NONCE_SALT', 'u1Qk60zDxIxlIpF_2hSpU3iCmh0y_KYXO3EQg56YOzFeo0X0Exn5x480aEhChzYP' );

	/**#@-*/

	/**
	 * WordPress Database Table prefix.
	 *
	 * You can have multiple installations in one database if you give each
	 * a unique prefix. Only numbers, letters, and underscores please!
	 */
	define( 'WP_CACHE_KEY_SALT', 'kXCIL7i6fkUdHiK23vlToQ' );
	$table_prefix = 'wp_';

	/**
	 * For developers: WordPress debugging mode.
	 *
	 * Change this to true to enable the display of notices during development.
	 * It is strongly recommended that plugin and theme developers use WP_DEBUG
	 * in their development environments.
	 *
	 * For information on other constants that can be used for debugging,
	 * visit the Codex.
	 *
	 * @link https://codex.wordpress.org/Debugging_in_WordPress
	 */
	define( 'WP_DEBUG', false );
	define( 'WP_DEBUG_LOG', false );
if ( defined( 'WP_DEBUG_LOG' ) && WP_DEBUG_LOG ) {
	ini_set( 'error_log', WP_CONTENT_DIR . '/debug.log' );
}

	// define('WP_HOME','http://www.transculturalgroup.com');
	// define('WP_SITEURL','http://www.transculturalgroup.com');

	/* That's all, stop editing! Happy blogging. */

	/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

	/** Sets up WordPress vars and included files. */
	require_once ABSPATH . 'wp-settings.php';


	// define('WP_HOME','https://101.100.216.62/en');
	// define('WP_SITEURL','https://101.100.216.62/en');

# Disables all core updates. Added by SiteGround Autoupdate:
define( 'WP_AUTO_UPDATE_CORE', false );

@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system


