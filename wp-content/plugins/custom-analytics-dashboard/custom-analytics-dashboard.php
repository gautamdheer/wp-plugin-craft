<?php
/*
Plugin Name: Custom Analytics Dashboard
Description: A plugin that integrates with Google Analytics or custom tracking APIs to display user-friendly analytics dashboards directly in the WordPress admin panel. It allows filtering by date, post type, and author, providing actionable insights for content creators.
Author: Gautam Dheer
Version: 1.0
Plugin URI: https://example.com/custom-analytics-dashboard
Author URI: https://gautamdheer.github.io/ 
*/
require_once(__DIR__ . '/vendor/autoload.php');

if(!defined('ABSPATH')) {
    exit;
}

// add admin menu
// add admin menu
// enqueue scripts
// google analytics api integration
    // - setup google api client
    // - add oAuth configuration
    // - add api key
    // - add api secret
// authentication and fetch data
// display data
// add filters option
// add export option

// add admin menu
add_action('admin_menu', 'cad_add_dashboard_menu');
function cad_add_dashboard_menu() {
    add_menu_page( 'Custom Analytics Dashboard', 'Custom Analytics Dashboard', 'manage_options', 'custom-analytics-dashboard', 'cad_page', 'dashicons-analytics', 100);
}

// enqueue scripts
function cad_enqueue_scripts() {
    wp_enqueue_style('cad-admin-style', plugin_dir_url(__FILE__) . 'assets/css/style.css', array(), '1.0.0');
    wp_enqueue_script('cad-admin-script', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('cad-chart-js', 'https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js', array('jquery'), '3.7.0', true);
}
add_action('admin_enqueue_scripts', 'cad_enqueue_scripts');


function cad_page() {
    echo '<div class="wrap">';
    echo '<h1>Custom Analytics Dashboard</h1>';
    echo '<div id="analytics-charts"></div>';
    echo '</div>';
}


function cad_get_google_analytics_data() {
    // logic to fetch data from Google Analytics API
    $client  = new Google_Client();
    $client->setAuthConfig(__DIR__ . '/client_secrets.json');
    $client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);
    $analytics = new Google_Service_Analytics($client);

    $profileId = 'YOUR_PROFILE_ID'; // Replace with your Google Analytics profile ID
    $results = $analytics->data_ga->get(
        'ga:' . $profileId,
        '30daysAgo',
        'today',
        'ga:sessions,ga:users'
    );
    return $results->getRows();
}

function cad_render_dashboard(){
    $data = cad_get_google_analytics_data()
    ?>
    <div class="wrap>
    <h1>Custom Analytics Dashboard</h1>
    <canvas id="traffic-chart"></canvas>
    <script>
        const chartData = <?php echo json_encode($data)
        ?>;
        const ctx = document.getElementById('traffic-chart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.map(row => row[0]),
                datasets: [{
                    label: 'Sessions',
                    data: chartData.map(row => row[1]),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    </div>
    <?php
}
?>