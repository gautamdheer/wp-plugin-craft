<?php
/**
 * Plugin Name: My Custom Widget
 * Description: This is the Custom Widget
 * Version:1.0
 * Author:Gautam Dheer
 * Plugin URI: https://example.com/my-custom-widget
 * Author URI: https://gautamdheer.github.io/ 
 */

if(!defined("ABSPATH")){
    exit;
}

add_action("widgets_init","mcw_register_widget");

function mcw_register_widget(){
    register_widget("My_Custom_Widget");
}
include_once(plugin_dir_path(__FILE__) ."My_Custom_Widget.php");

// add script.js 
add_action("admin_enqueue_scripts","mcw_add_admin_script");

function mcw_add_admin_script() {

    // CSS
    wp_enqueue_style("admin-css", plugin_dir_url(__FILE__) ."style.css");
    // JS
    wp_enqueue_script('admin-script', plugin_dir_url(__FILE__) .'script.js', array('jquery'));
}

