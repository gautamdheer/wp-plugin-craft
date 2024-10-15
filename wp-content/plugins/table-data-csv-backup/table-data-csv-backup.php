<?php

/**
 * Plugin Name: CSV Data Backup
 * Description: This is the plugin to export the table data
 * Author:Gautam Dheer
 * Version: 1.0
 * Author:Gautam Dheer
 * Plugin URI:https://example.com/shortcode-plugin
 * Author URI: https://gautamdheer.github.io/
 */

// Add admin menu for the plugin
// Create a page for the Export - A button Export
// Export the data into csv format file

add_action("admin_menu","tdcb_create_admin_menu");

// Admin menu
function tdcb_create_admin_menu() {
    add_menu_page("CSV Data Backup Plugin","CSV Data Backup","manage_options","csv-data-backup",
    "tbcb_export_form","dashicons-database-export",8);
}

// Form layout
function tbcb_export_form() {

    ob_start();

    include_once plugin_dir_path( __FILE__ ) ."/template/table_data_backup.php";

    $template = ob_get_contents();

    ob_end_clean();

    echo $template; 
}

add_action("admin_init","tdcb_handle_form_export");

function tdcb_handle_form_export() {
    if(isset($_POST['tdcb_export_button'])){
        global $wpdb;
        $table_name = $wpdb->prefix .'students_data';
        $students = $wpdb->get_results("SELECT * from {$table_name}", ARRAY_A);

        if(empty($students)){

        }
        $filename = "students_data_".time().".csv";
        header("Content-Type:text/csv; charset=utf-8");
        header("Content-Disposition:attachment; filename=".$filename);

         $output = fopen("php://output","w");
         fputcsv($output, array_keys($students[0]));

         foreach($students as $student){
            fputcsv($output, $student);
         }
         fclose($output);

         exit;
         
    }   
}