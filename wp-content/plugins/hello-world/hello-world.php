<?php
/**
 * Plugin Name: Hello World Plugin
 * Description: This is our first plug-in which creat....min dashboard as well as admin notice
 * Author: Gautam Dheer
 * Author URI: https://gautamdheer.github.io/
 * Plugin URI: https://example.com
 */

 // Admin Notices

 add_action('admin_notices', 'hw_show_warning_message');

function hw_show_information_message(){
    echo '<div class="notice notice-info is-dimisssible"><p>Hello I am success message</p></div>';
}

function hw_show_warning_message(){
    echo '<div class="notice notice-warning is-dismissible"><p>
    Hi I am warning message
    </p></div>';
}

 // Admin Dashboard Widget

add_action('wp_dashboard_setup', 'hw_hello_world_dashboard_widget');

function hw_hello_world_dashboard_widget(){
    wp_add_dashboard_widget('hw_hello_world', 'HW - Hello World Widget','hw_custom_admin_widget');
}

function hw_custom_admin_widget(){
    echo "This is Hello World Custom Admin Widget";
}


?>