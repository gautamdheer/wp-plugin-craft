<?php
/**
 * Plugin Name: My Metabox Plugin
 * Description: This will e the metabox for wordpress pages
 * Version: 1.0
 * Plugin URI: https://example.com/my-custom-widget
 * Author URI: https://gautamdheer.github.io/ 
 */

if(!defined("ABSPATH")){
    exit;
}
// Register page metabox
add_action("add_meta_boxes","mmp_register_page_metabox");


function mmp_register_page_metabox() {
    add_meta_box("mmp_metabox_id","My Custom Metabox - SEO","mmp_create_page_metabox");
}


// create layout for metabox
function mmp_create_page_metabox($post) {
    
    // include template file
    ob_start();

    include_once plugin_dir_path( __FILE__ ) ."template/page_metabox.php";
    $template = ob_get_contents();

    ob_end_clean();

    echo $template;

}

// save meta data
add_action("save_post","mmp_save_meta_data");

function mmp_save_meta_data($post_id) {
    // check and verify nonce value
    if(!wp_verify_nonce($_POST['mmp_save_nonce_data'], "mmp_save_meta_data")){
        return;
    }
    // check and verify auto save of wordpress
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE){
        return;
    }
    if(isset($_POST['pmeta_title'])){
        update_post_meta($post_id ,"pmeta_title",$_POST['pmeta_title']);
    }
    if(isset($_POST['pmeta_description'])){
        update_post_meta($post_id ,"pmeta_description",$_POST['pmeta_description']);
    }

}

// Add meta tag in the head 
add_action("wp_head","mmp_add_head_tags");
function mmp_add_head_tags(){
    if(is_page()){ 
        global $post;
        $post_id = $post->ID;
        
        $title = get_post_meta($post_id, "pmeta_title", true);
        $description = get_post_meta($post_id,"pmeta_description", true);

        if(!empty($title)){
            echo '<meta name="title" content="'.$title.'" />'."<br>";
        }
        if(!empty($description)){
            echo '<meta name="description" content="'.$description.'" />';
        }
    }
}