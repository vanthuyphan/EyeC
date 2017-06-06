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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', '04e2d30c32d5b2dc85b93296c6e76970f065e28d1051e570');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'HGM/8~Ef|[qY/qF[g0`2TQQumn7m9@5C`Le-TmyD7eu0YW8W&~evh66WM3a<FQ.6');
define('SECURE_AUTH_KEY',  't`5t.XNn<R2?pGoB=q0,w&*`[yI6#LK]Hc;K41LaAV0M,zhwQTXt<|qpvzm]<_O`');
define('LOGGED_IN_KEY',    'e|ybyfGxSw`nth!1mvC5<TL(+Gt(8UP_Ei9rwJt=(B*|d=z3I7EjK|y[|D#Hj1,:');
define('NONCE_KEY',        'AK_G`,wo.kWw.R{?T]$bS80tgZ5ZobKg[*K/3}WNGMycJr/%U{!G|#Hj;jB9BP;e');
define('AUTH_SALT',        ';m/Yeae2P[kNWv^+yu1Qul5RjzAzRcy%yxy0|%LgEQ4n%-I$Z$jtWRJIe(8+#9Eu');
define('SECURE_AUTH_SALT', '!wyM;qg63[Td>=jL=]s^:!dl9G6Y<twn(Yf>OTu_Kt@i^u V Te!rZaz5Msqq)yG');
define('LOGGED_IN_SALT',   'A?ZK-,mi6T{n7oqcL`yH2aL/*lOT=Hssr{ebtH8JdxOp5a50Fn$RdG:jDKd>?-[:');
define('NONCE_SALT',       '^&hLd5og-6wg3?CRIN6WdI<0mnc arfERtO%,=Sz(`KY]=~C106_bY8x~WxMF5k,');

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
