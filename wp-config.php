<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'tpots-technology_db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '|+2Y>C)P14(rk#3I3cG(wh9Vix^fwGP4OP)2arYhj(6 3?;fOd| zxCxy!^+7Ix*' );
define( 'SECURE_AUTH_KEY',  '.0^|*8{%MuL`DJ%g.Q>_RA1B|u$4LtINdz&Tfx-_!ou!IYiu1hyTbNCr@u(CNa,4' );
define( 'LOGGED_IN_KEY',    'VvN/;(lVyyrXJ8(BwO&srhLkTT<v>IUvf7zIuQ@EkhQp&48UA?AM&>_[psU<Kn,%' );
define( 'NONCE_KEY',        'XP{9*~oauR|Cfq, x).p/nE|}==a,f;bW<=PJ|[mh# KD~)~.<v1O.{!G$@n2DAm' );
define( 'AUTH_SALT',        '?$[Y(}uN^+O{A%6M&5wz9>Gm^Evx>#v*)+:/W#]mrKLH&N*(6~ m-$:zPUyPYZ7S' );
define( 'SECURE_AUTH_SALT', 'M[Yh0pB n6]abq4!8j/.d^$,0~vqfo]Tkis{+)gm:{$~%^pqW>7iPd(o$ChP2sEe' );
define( 'LOGGED_IN_SALT',   'G~8U_/P1O(OH_Fr6<vepg)^*X%9B3o)y_Tj-ipsaq R>`;Pqc{40)`(m#iVheMog' );
define( 'NONCE_SALT',       'sTV0>4~YX;?X573FYi_NL}zje}/rc?V519Taf[Zf#T[oY10ueZEY1qPH_M*j}e(/' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
