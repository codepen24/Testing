<?php
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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME','transcul_members2');

/** MySQL database username */
define( 'DB_USER','transcul_ms2');

/** MySQL database password */
define( 'DB_PASSWORD','123TCGSupport!');

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define( 'WP_MEMORY_LIMIT', '196M' );


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'd=Wm6P8BT[~o09tCv4{z39nTcaNq>|_^8hwE3!u!qK!ZXg`8E7&N%)G~|1OE|_sV' );
define( 'SECURE_AUTH_KEY',  '*><9ij!:o`<nqt7FN|7X5J7bhHQY4BHTiC!vU?:Lth4t/* :TJQ.(At{=3_aG1ou' );
define( 'LOGGED_IN_KEY',    '(rRSQjWbJq$M6TV#^-tmKYAH,nPvg Fc-R/U$([Al{J@?w9n0EVS!IzAWlc_Vk7x' );
define( 'NONCE_KEY',        'j6JF-Ow#fV~?6h^$v*p=1X={$=XbSPg|g;dxx)&=|8f{-A]Z.% J;%rSY3/yU`3%' );
define( 'AUTH_SALT',        'S2J-xs[/UjrEt*(>yXS#vI0sBGE?21P)7Yv;BUbiqs1ZcYx<n<!d#Ld!/ 3+h)s6' );
define( 'SECURE_AUTH_SALT', '_$,H6o#M! ?*U*iKBu8|/&O2aU#T_0^_qt]XVe,d^R,,Id.<J6`qob$1WBj9.9<|' );
define( 'LOGGED_IN_SALT',   'NSo9h5taF`Kqy8GdYXz_A,,hL`~]jJmTv&u1Sr>B>>Ae$Ag5{>OnfcD6GyPPI9L`' );
define( 'NONCE_SALT',       'Dk{~OLbBV4-xKGsT)yP H^%@bk-~XY_M?&=0sb|6SRh#/hrZ`Cby6B>-UuxY3`P*' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
define('WP_CACHE_KEY_SALT', 'oPCkBG0TFPkELO1uSd3cXw');
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
