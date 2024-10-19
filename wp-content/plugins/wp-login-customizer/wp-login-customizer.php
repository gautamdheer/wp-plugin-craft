<?php
/**
 * Plugin Name: Wp Login Customizer
 * Description : This plugin customize the wordpress login page
 * Version:1.0
 * Author: Gautam Dheer
 * Plugin URI:https://example.com/wp-login-customizer
 * Author URI: https://gautamdheer.github.io/
 * 
 */

 if(!defined("ABSPATH")){
    exit;
 } 

 add_action("admin_menu","wpc_add_submenu");

 function wpc_add_submenu(){
  }