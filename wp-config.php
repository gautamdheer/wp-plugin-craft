<?php
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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-plugin-craft' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

define('WP_MEMORY_LIMIT', '256M'); // Adjust "256M" to your desired memory limit


if ( !defined('WP_CLI') ) {
    define( 'WP_SITEURL', $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
    define( 'WP_HOME',    $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] );
}



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
define( 'AUTH_KEY',         'EsLDTGGDqA9Uso0nwjIFajSGJsJhaESCt3t5cUT3StPTx2hPOhowOYJRbZ1R1xoV' );
define( 'SECURE_AUTH_KEY',  '35OUSRKh8P07qQtVFWQ4EyI1XE8WdLNDaJTT6PM1GKfYtbhu0r4LB1E9p75pcQiS' );
define( 'LOGGED_IN_KEY',    'TA4162tmTVtbizORaFz0EVyNmweKzqmkP0RVfMnVrWNmklp8z0GWTRSotSBxKQCa' );
define( 'NONCE_KEY',        'qVTzJqKJtOChwVQDu4xGelsGYcAXveOTT5fVVVsiT7CYBmeVH0XHK0PNvpKxq8Zt' );
define( 'AUTH_SALT',        'Rz1V05Ax4JilRBiFMa3LCieqK1Gj4uPtRnXkO2fQ2seKibh41RhdaXAMojJ2bGJu' );
define( 'SECURE_AUTH_SALT', 'HmLrtZqScanWg8lUEwCaRJa9EtYBXVrQxoKSS02nWaA8owAeu6MjTEclUkiVYepl' );
define( 'LOGGED_IN_SALT',   'RIluqlzNdPc3t3v45kAN1OJS46SJm731ydgBEzJmOm2tKNvThtEruKkuhfQflBY2' );
define( 'NONCE_SALT',       'LCRTMR9OLzuMLZyzrtz7Q2ZTXsLEFsDDQFXFRwIgFlLHlcytDdGhSzhrriPrxt43' );

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
