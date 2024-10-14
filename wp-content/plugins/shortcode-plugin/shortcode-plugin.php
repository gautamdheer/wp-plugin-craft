<?php

/**
 * Plugin Name: Shortcode Plugin
 * Description: This plugin give idea about shortcode plugin
 * Version: 1.0
 * Author:Gautam Dheer
 * Plugin URI:https://example.com/shortcode-plugin
 * Author URI: https://gautamdheer.github.io/
 * 
 */


// Basic Shortcode
add_shortcode("message","sc_message");

function sc_message(){
    return "<p style='font-weight:bold;font-size:36px;color:red'>I am calling from shortcode plugin</p>";
}



// adding shortcode with using parameters 
// [student name="Gautam" email="gautamdheer.gh@gmail.com"]

add_shortcode("student","sc_message_parameter");

function sc_message_parameter($attributes){
    $attributes = shortcode_atts(array("name"=>"Default Student","email"=>"Default Email"),$attributes,"student");
    return "<h3 style='color:blue';>Student Name: {$attributes["name"]}, Student Email: {$attributes["email"]}";

}   


// Shortcode with DB Operation
add_shortcode("listposts","sc_handle_list_posts");

function sc_list_posts(){

    global $wpdb;
    $table_name = $wpdb->prefix."posts";

   // Get the post where post_type=posts and post_status=publish
   $posts =  $wpdb->get_results("SELECT post_title from ".$table_name." where post_type='post' AND post_status='publish'");
    
   if(count($posts)> 0){
    $output = "<ul style='list-style-type:none;'>";
    foreach($posts as $post){
        $output .= "<li>".$post->post_title."</li>";
     }
    $output.="</ul>";

   }
   return $output;


}

function sc_handle_list_posts($attributes){
    
    shortcode_atts(array(
        "number"=>5,
    ), $attributes, 'listposts');

    $query = new WP_Query(array(
        "posts_per_page"=>$attributes['number'],
        "post_status"=>"publish"
    ));

    if($query->have_posts()){
        
        $outputHtml = "<ul>";
        while( $query->have_posts() ){
            $query->the_post();
            $outputHtml .= '<li><a target="_blank" href="'.get_the_permalink().'">"'.get_the_title().'"</a></li>';
        }
        $outputHtml.="</ul>";
        return $outputHtml;
    }
    
    return "No Post Foound";
}



?>