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
define('DB_NAME', 'wpexpdbAndy1');

/** MySQL database username */
define('DB_USER', 'wpexpdbAndy1');

/** MySQL database password */
define('DB_PASSWORD', 'wpexpdbAndy1Pwd');

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
define('AUTH_KEY',         'XNL4z/c> 1[:~-`0i(mZ*^FeZq0s6,?,#B2]%Gg&l{UdD@L-qz9dFwE!-69F~cvM');
define('SECURE_AUTH_KEY',  'o,nhxLk/wJ=}b`/N}}L#jNeRw;l#/Y,>8akv:V>B>ja~S;U(5$cF`qJ,fMuZWht@');
define('LOGGED_IN_KEY',    ']5:h_%uc3z_#4KcszR*LzxOw-lT/dqIV`mpl)]Uua[p)N7K|utgg?p`6#!GfL|cx');
define('NONCE_KEY',        'jDP`*9XJnqkW3R6hpxn>vgIiZ s4Q&f3_N>^e#!=fM`K_mw3({wI[NH$k>g.X{M,');
define('AUTH_SALT',        'I[ GF&,:0/McOnasB^|~G>3$TR*wole~rpES<U jGZ(}kf,?uHrIsC_/qn]]80Q5');
define('SECURE_AUTH_SALT', '~zm8hcX0@/`9t.[=Smwn{NTLcd4lF5c*Fa~D^;p8vJU8F/s^xN&U(LAI#V73K-~t');
define('LOGGED_IN_SALT',   'QtSI7:2TYQ3pO_N-WuX{}(>p7;OGAo 8Ix{.$;{)&GLwp+_:Z+~vj6Ap.qN3`g@+');
define('NONCE_SALT',       'u9nC<+r2I#*?_0jy;sk+%H?U!dG[eF:o<m%+oG-jr=)Dw/U:{B&)1%_C3pVndBrI');

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
