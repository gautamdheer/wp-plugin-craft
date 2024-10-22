<?php
/**
 * Plugin Name: WP Employee CRUD
 * Description: This plugin provides complete CRUD (Create, Read, Update,   Delete) functionality for managing employee data within WordPress. It allows administrators to add, view, modify, and delete employee records directly from the WordPress admin interface. The plugin is ideal for handling small-scale data management tasks, such as employee directories or other data-driven applications.
 * Version: 1.0
 * Plugin URI: https://example.com/wp-crud-plugin
 * Author URI: https://gautamdheer.github.io/ 
 */

if(!defined('ABSPATH')){
exit;
}

define("WCE_DIR_PATH",plugin_dir_path(__FILE__));
define("WCE_DIR_URL",plugin_dir_url(__FILE__));

include_once WCE_DIR_PATH. "MyEmployees.php";

// create class object
$employeeObject = new MyEmployees;

// create DB Table + Wordpress ppage
register_activation_hook(__FILE__,[$employeeObject,"callPluginActivationFunctions"]);

// deactive the table
register_deactivation_hook(__FILE__,[$employeeObject,"dropTheTable"]);


// Render employee form layout
add_shortcode("wp-employee-form",[$employeeObject,"createEmployeeForm"]);



?>