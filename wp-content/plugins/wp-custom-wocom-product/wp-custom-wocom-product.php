<?php

/**
 * Plugin Name: WP Custom Wocom Product
 * Description: Custom Wocom Product
 * Version: 1.0.0
 * Author: Gautam Dheer
 */
if(!defined("WPINC")) {
    die;
}

function wcp_show_woocommerce_error() {
    $class = 'notice notice-error';
    $message = __('Wocom Product requires WooCommerce to be installed and active.', 'wcp');
    printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
}

if(!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    add_action('admin_notices', 'wcp_show_woocommerce_error');
}

function wocom_product_init() {
    add_menu_page('Wocom Custom Product', 'Wocom Custom Product', 'manage_options', 'wocom-custom-product', 'wocom_product_page');
}

function wocom_product_page() {
    include_once plugin_dir_path(__FILE__) .'templates/wcp-product-layout.php';
}   

add_action('admin_menu', 'wocom_product_init');


// Enqueue styles
add_action("admin_enqueue_scripts", "wcp_enqueue_scripts");

function wcp_enqueue_scripts() {
    wp_enqueue_style("wcp-css", plugins_url("assets/style.css", __FILE__), array(), "1.0.0", "all");
}
