<?php

/**
 * Plugin Name: WP Custom Wocom Product
 * Description: Custom Wocom Product
 * Version: 1.0.0
 * Author: Gautam Dheer
 */

 if(!defined("WPINC")){
    exit;
 }
 
 // add plugin to menu
 add_action("admin_menu","wcp_add_plugin_menu");

 function wcp_add_plugin_menu(){
    add_menu_page("Woocommerce Product Creator","Woocommerce Product Creator","manage_options","wcp-product-creator","wcp_add_woocommerce_product_layout","dashicons-cloud-upload",8);
 }

 function wcp_add_woocommerce_product_layout(){
    echo "<h2>Woocommerce Product Creator</h2>";
   // include_once(WCP_PLUGIN_DIR."templates/wcp-product-layout.php");
 }


 

