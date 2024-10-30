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

// Add Menu Page
add_action('admin_menu', 'wocom_product_init');
function wocom_product_init() {
    add_menu_page('Wocom Custom Product', 'Wocom Custom Product', 'manage_options', 'wocom-custom-product', 'wocom_product_page');
}

// Add Product Page Function
function wocom_product_page() {
    include_once plugin_dir_path(__FILE__) .'templates/wcp-product-layout.php';
}   

// Enqueue styles
add_action("admin_enqueue_scripts", "wcp_enqueue_scripts");
function wcp_enqueue_scripts() {

    wp_enqueue_media();

    wp_enqueue_style("wcp-css", plugins_url("assets/style.css", __FILE__), array(), "1.0.0", "all");

    wp_enqueue_script("wcp-js", plugins_url("assets/script.js", __FILE__), array("jquery"), "1.0.0", true);
}

// Admin init
add_action('admin_init', 'wcp_handle_form_submission');

function wcp_handle_form_submission() {
    if(isset($_POST['wcp_add_product'])) {

     // Verify nonce
      if(!wp_verify_nonce($_POST['wcp_add_product_nonce'], 'wcp_handle_form_submission')) {
        exit;
      }
 
      // Check if class exists
      if(class_exists('WC_Product_Simple')) {
        $product = new WC_Product_Simple();
        $product->set_name($_POST['wcp_name']);
        $product->set_regular_price($_POST['wcp_regular_price']);
        $product->set_sale_price($_POST['wcp_sale_price']);
        $product->set_description($_POST['wcp_description']);
        $product->set_short_description($_POST['wcp_short_description']);
        $product->set_sku($_POST['wcp_sku']);
        $product->set_status('publish');
        $product->set_image_id($_POST['product_media_id']);
        $product_id = $product->save();
        
        if($product_id > 0) {
            add_action('admin_notices', function(){
                echo "<div class='notice notice-success'>
                <p>Product Added Successfully</p>
              </div>";
            });
        }



      } 
        
    }
}   
