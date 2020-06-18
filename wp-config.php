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
// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );
/** MySQL database username */
define( 'DB_USER', 'root' );
/** MySQL database password */
define( 'DB_PASSWORD', 'root' );
/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '9Jm2TD6d81RS+1X/dxztAVxqgBU3Trm5tGxvk2YQzw4nCURy4W05rn+Dbz84w+0PRjpZygyKPJfmWGQqqJvG2A==');
define('SECURE_AUTH_KEY',  'aep1kLo3iCk5pXGwc+muqRkm8Un/QSR6fpRXBt+GOMQ22+Pm0Fssr9UxnzaeDrfoYET6XerGS/POAVzSe8Ii2w==');
define('LOGGED_IN_KEY',    'H2IE1Zuhoi+F5RWa1nW6JT2hyQuhPje7MeU/hx1pW39ymENjRNS4JzieliNwOWH/y+cKOnii98MWMEV5l0mocw==');
define('NONCE_KEY',        'PoOAeGCTfrEBPJ78F3Dg2tcegIFenOAyT87xmr5TeQVBYzj4iLYeou0cuLNx4ioaIDXvOJTsQDH+dgF8/TrZcg==');
define('AUTH_SALT',        'ucasLgeWqtEi73Cb+Cm2EBVz8RjF6dGypvbgy6VMPRBetoijdrjWFBEUhU/TRFvZPpDm3STazX5TdhWyshNy7w==');
define('SECURE_AUTH_SALT', 'KPj3sPzNeQmGoZfOts6b0SzlsAPi9N9hXOZ2vev8y8MjVqRiFYVik2IRXTTIBHZX8LCtBK3VwVm53V4dBeaBYQ==');
define('LOGGED_IN_SALT',   'E7hJIpPVKbczqoFpDO9P/Sk1Wm7XIYQU/jL0Lsc666TsPqqDUTNmTwAXtR9eSBRNrJkaDPOKbK2ReQs08rBNHw==');
define('NONCE_SALT',       'rQ7TgPxCqijvyH2FOIg+3njnSRAZoBasDcNCn17zVRMvnaCg77qPzxIZ98UsFkk/jmBG48ST/Uvq2d+41tt9qw==');
/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'unp_';
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
