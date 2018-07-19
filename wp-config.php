<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

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
define('DB_NAME', 'jmsibbay_wp530');

/** MySQL database username */
define('DB_USER', 'jmsibbay_wp530');

/** MySQL database password */
define('DB_PASSWORD', '9pS84@5x!1');

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
define('AUTH_KEY',         'zyk3ri7kze0gi0plqqqwhzroy4zoafclren75ahioqq8nazfxnwpkprwd0gdfhms');
define('SECURE_AUTH_KEY',  '51uxvvji7vjuoqpgt3cldmqnao8oj7wdobpssfsybqyf0v5vxt1futka293jgaol');
define('LOGGED_IN_KEY',    'h8brmd54oy3lplgw2ldikpillgtrkmzzchilmqfmucaipfxrsnvn9hlpw7q9ddu4');
define('NONCE_KEY',        'jnyfwxvqencsznzotuknhzymsm4bcvik7qasxi1lo93rewvdz8mxxkpxhr0qbhbo');
define('AUTH_SALT',        'w0cn7l5hjae27yggifwwctpxa6gdz8ns2rkg5mkvu55tadmq1weetyn2cv0nua1r');
define('SECURE_AUTH_SALT', 'li07vde5cyu3yxtop1hegu6ohmgf2hjvyvlafak0skjx5ovbq0jj7viyrh9py677');
define('LOGGED_IN_SALT',   '6kytbeaa0wlcd3wvlshyoo8lcspingysfjt3yzw2lnmqswlhxatmo681pzwyk4vp');
define('NONCE_SALT',       'va67ubloouvfod2zy75wcg6zhjoq9we7sirk8bmgvujvnjxwwt6p7ncnlo9txgap');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_51';

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
