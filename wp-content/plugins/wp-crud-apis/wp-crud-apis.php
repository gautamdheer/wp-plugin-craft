<?php
/**
 * Plugin Name: WP CRUD APIs
 * Description: A plugin to create CRUD APIs for WordPress.
 * Version: 1.0.0
 * Author: Gautam Dheer
 */

if(!defined('ABSPATH')){
    exit;
}

define('WPCRUDAPIS_PLUGIN_DIR', plugin_dir_path(__FILE__));


// activate plugin
register_activation_hook(__FILE__, 'wp_crud_apis_activate');
function wp_crud_apis_activate(){
    // create custom table  
    global $wpdb;
    $table_name = $wpdb->prefix . 'students';
    $wp_collate = $wpdb->get_charset_collate();
            
    $wpdb->query("CREATE TABLE IF NOT EXISTS $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        phone INT NOT NULL
    )" . $wp_collate);
 }


// Action hook for registration of apis
add_action('rest_api_init', function(){
     require_once WPCRUDAPIS_PLUGIN_DIR . 'includes/api-routes.php';
});

?>