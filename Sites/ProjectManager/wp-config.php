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
define('DB_NAME', 'ProjectManager');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'rCWXb|9k.e~R`y1W=[~zQ;k7Af@(8dMKS$l}yi1XY^x#)Mh/tAx>N@;cD3|cC`RB');
define('SECURE_AUTH_KEY',  '$Tr`4oRMq5QaTrmy$8pcelJMt7*.#X[ABOR.ISqe3Cg^W1u{|cE$wEzNQJ?qWZ>f');
define('LOGGED_IN_KEY',    '7:^WND+$n[O?6] QcZza33b;T7X+WK}X*m!,iStHqWX^eFHJfyqvPE6D`AH|qaD-');
define('NONCE_KEY',        'IVjGCtDyC|7oJEN!su%!*b9=A4. ZT~gB`+O7k1W%QR;EvPhFB,Vu$|KzB{JKXr<');
define('AUTH_SALT',        'jY@I[k|^PU#_1v&HY%4 $3od_3y&C(a:QrkzP*pU*Zz9nQBx~AKQUoYMJZ&{-V{M');
define('SECURE_AUTH_SALT', 'O17L`j<5^XZmW^<aC>tI3.?-$wvmsxP6EPv6AG^vq+[daQ!j7=O/Q-K6Nl8yPIcw');
define('LOGGED_IN_SALT',   'A<L)3l./e1)Bx?pAPL&Q:V]jM>y5S`X]-x:QNMu 6/~E*`Hkg&xA@8/I24MfAw>d');
define('NONCE_SALT',       'W-~Z/5)9yUmN3ptRZCe,FwLSR~yS;)=PKDb`7ETEf).N&3Lx.5Wrt=+?OCH4YAb:');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
