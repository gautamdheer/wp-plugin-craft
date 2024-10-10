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
add_shortcode(" ","");