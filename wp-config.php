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
define('DB_NAME', 'bunerch');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', ')(*LKJ');

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
define('AUTH_KEY',         'wTrOaU6%dc`S,rtJYgi+BMyg%S6g/Y@0Mk|K%5u:8]~)Cvfpb87;%}~kL!/G,vZ@');
define('SECURE_AUTH_KEY',  'qG6L$5Kz]9q<E2ZiQlK2{`q@Y jVCrVEK%##p.qC.e;=bv2Uj-DDlg#sR`x8y0^}');
define('LOGGED_IN_KEY',    'lDJ7f^CB [T8Rvwn9>vDNC.;flz-azFnX>GGg&t[PQI/D4-x0?%V,>B%2Of9S:LK');
define('NONCE_KEY',        'KHzKMBh:IWC~0Yz]^k>D11.c(G8]%;ft#j!)v}{68m/t}w9TrO+/{02ZVI62vU]e');
define('AUTH_SALT',        '_QbjK;=RUVrB60~JbL^NKi<,!]|i1{.f%EtrS|b?|xjiNN}E$zISMiDj1qteT,dz');
define('SECURE_AUTH_SALT', '&6>kG|E~Q8iqM?hB`!!:[Z$u;5Z7:wcAlTA9AY$yJ}2YM2~{<v6aZ!$hX92V {i_');
define('LOGGED_IN_SALT',   'AyWD#E)sV.V4h.m~[qkE9Y.-?gKhtca50Cs[SDq!| %Vv9vu1^hL-].bW!x0=X</');
define('NONCE_SALT',       'LNz=u1Zi>JTB9Aa[E]{@Vk{Nm=>OOcvcv6&lC4& Ezv:b89Nt8,tkuwf5FE9#y6|');

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
