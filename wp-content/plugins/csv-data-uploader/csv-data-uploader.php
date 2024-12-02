<?php

/**
 * Plugin Name: CSV Data Uploader
 * Description: This plugin upload CSV file data to the database table
 * Author: Gautam Dheer
 * Version: 1.0
 * Plugin URI: https://example.com/csv-data-uploader
 * Author URI: https://gautamdheer.github.io/ 
 */

define("CDU_PLUGIN_DIR_PATH", plugin_dir_path( __FILE__ ));
define("CDU_TABLE_NAME","students_data");

add_shortcode('csv-data-uploader', 'cdu_handle_uploader_form');

//form template
function cdu_handle_uploader_form(){
    // start buffer
    ob_start();

    include_once CDU_PLUGIN_DIR_PATH."/template/cdu-form.php";

    // read buffer
    $template = ob_get_contents();

    // clear buffer
    ob_end_clean();
    
    return $template;
}


// DB Table on plugin activation
register_activation_hook( __FILE__, "cdu_create_table");

function cdu_create_table(){
    global $wpdb;
    $table_name = $wpdb->prefix.CDU_TABLE_NAME;

    $table_collate = $wpdb->get_charset_collate();

    $sql = "
    CREATE TABLE `".$table_name."` (
        `id` int NOT NULL AUTO_INCREMENT,
        `name` varchar(50) DEFAULT NULL,
        `email` varchar(50) DEFAULT NULL,
        `age` int DEFAULT NULL,
        `phone` varchar(50) DEFAULT NULL,
        `photo` varchar(244) DEFAULT NULL,
        PRIMARY KEY (`id`)
      ) ".$table_collate."
      
    ";
    require_once(ABSPATH."/wp-admin/includes/upgrade.php");
    dbDelta($sql);

}

// hook the script file 
add_action('wp_enqueue_scripts', function(){
    wp_enqueue_script("cdu-script-js", plugin_dir_url(__FILE__)."assets/script.js", array("jquery"));
    wp_localize_script("cdu-script-js","cdu_object", array(
        "ajax_url" => admin_url("admin-ajax.php")
    ));
});

// capture ajax request
add_action("wp_ajax_cdu_submit_form_data","cdu_ajax_handler");  // when user is logged in
add_action("wp_ajax_nopriv_cdu_submit_form_data","cdu_ajax_handler"); // not logged in


function cdu_ajax_handler(){

    if($_FILES["csv_data_file"]){

        $csvFile = $_FILES["csv_data_file"]["tmp_name"];
        $handle = fopen($csvFile,"r");
        
        global $wpdb;
        $table_name = $wpdb->prefix."students_data";

        $row=0;
        if($handle){
            while (($data = fgetcsv($handle,1000,",")) !== false) {
                if($row == 0){    
                   $row++;
                   continue;
                }

                //insert the data into table
                $wpdb->insert($table_name, array(
                    "name"=> $data[1],
                    "email"=> $data[2],
                    "age"=> $data[3],
                    "phone"=> $data[4],
                    "photo"=> $data[5],
                ));
            }
            fclose($handle);

            echo json_encode(array(
                "status"=>1,
                "message"=>"CSV file successfully inserted",
            )); 
        }
    }
    else{
    echo json_encode(array(
        "status"=>0,
        "message"=>"No file found"
    )); 
    }
    exit;
}