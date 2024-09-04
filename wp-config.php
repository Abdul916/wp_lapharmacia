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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_lapharmacia' );

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
define( 'AUTH_KEY',         'vhMDu!JS@`wsQ?3Z%0{`<1iekPW512bM *d873<?SY%wf;;Y5QQe4M[*<$RFmZ=v' );
define( 'SECURE_AUTH_KEY',  'C0gW)f0UQT?sff,hfG!w-b/IcD790$}oi/b~`l_wq+(Va+@GpzC *=QbZ8 h)!9-' );
define( 'LOGGED_IN_KEY',    'AZE^DEB0/1BHL<e+#(=v6UX_s1KxRS+y[ZXt^>4;ee%gE~jbE8,Bi#>`v&/qKDp~' );
define( 'NONCE_KEY',        '`yjq8CNov/OBi`!`|Krb?{Ehr9b1n#KugzT73w]iE-sH;k1~@ ~B2%d,tB/ k>Ea' );
define( 'AUTH_SALT',        'cLuz>8BWnYc-)&4x`Ak,-hF0<NG@>+F^loh>8[#u#6:}yZ()W5XEMq~,8c3F1/W!' );
define( 'SECURE_AUTH_SALT', 'I(N_+aJ`mSY^2jLb|#uReqQ],w!`R~VEn{GaeM3NvDb_J(1 +cY#VO+owUb*_^L2' );
define( 'LOGGED_IN_SALT',   'oM}AkjO^9M8E{4=kO)=KB:_F$;P[=o*Y$(^V:zTDt&BmetT4HwFGUi:t D{Qm[_e' );
define( 'NONCE_SALT',       '.;U<]TY-zvs|ZJ>r$-?||ULtYl`9s ?_5@BCy%(Gaty%G$&s29tg5m6O!h(GC ZL' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
