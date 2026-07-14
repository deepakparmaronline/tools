<?php
define( 'WP_CACHE', true );

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u667065465_98XqE' );

/** Database username */
define( 'DB_USER', 'u667065465_5NXKS' );

/** Database password */
define( 'DB_PASSWORD', 'UWKPFPdAon' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '1HM<.UpVKN:=1PJTMM1.[5DUE6n/6kW#6%A>PE{~6Ky!W=O>+5sSF?{{8TGP:[iT' );
define( 'SECURE_AUTH_KEY',   '-82l_Wtl4v`ytbm*]qSmHKyhyQMP;W.;sJw;iIJChCUekt`[]<T2)5I10R:JS@w2' );
define( 'LOGGED_IN_KEY',     'CVs3;v/&aUVyE+dy&+{iE%!(w;L8z>H@R4qSS8=Slx)G472&^DyP0hM;kc=ImF7W' );
define( 'NONCE_KEY',         '*YDmS}3JY)qKfI+t<Uxr@x{#]XZ8M<nRoA&OQ>V)*>g)g$N#T@G0^@T)i_Ut}~y`' );
define( 'AUTH_SALT',         '`?u`%DFl%`cL3.U^.LZ$(?j$k=9J8i3K+5~:eoc!<hTM(Xni}mALq3J|`{hOfQRb' );
define( 'SECURE_AUTH_SALT',  'FA+w+%/5d5E%6f6/7GRWP~8&Bss^k_?,-L!z[E]vpxly?rNO18H*g$L4/-b>ssO6' );
define( 'LOGGED_IN_SALT',    '}]q4p7WY0sK0yp2|XJoO[<#-Un#*$TES?k[plXUe}iLF{FF<H}#_w-V=N8es-Zhx' );
define( 'NONCE_SALT',        'ne=>K+bO)-`xw Sq8661U0w,rH-NT]F2gSnY~3=SFCb)rpelQ2DbJVtWlB</Ej{C' );
define( 'WP_CACHE_KEY_SALT', '9fP@&NkQ2o*7.}0cil@^(m#;7/;jAAh<n CLS}g#D<L~/;Y`p+jxur*;;P8HAWQy' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '9b73dc3db5fd270ecdf961b4da5396e8' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
