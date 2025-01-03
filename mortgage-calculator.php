<?php
/**
 * Plugin Name: Mortgage Calculator
 * Description: A simple mortgage calculator plugin for WordPress.
 * Version: 1.0
 * Author: Your Name
 * Text Domain: mortgage-calculator
 */

// Prevent direct access
if (!defined('ABSPATH')) exit;

// Define constants
define('MC_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MC_PLUGIN_URL', plugin_dir_url(__FILE__));

// Enqueue assets
function mc_enqueue_assets() {
    wp_enqueue_style('mc-style', MC_PLUGIN_URL . 'public/css/style.css');
    wp_enqueue_script('mc-script', MC_PLUGIN_URL . 'public/js/calculator.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'mc_enqueue_assets');

// Register shortcode
function mc_mortgage_calculator_shortcode() {
    ob_start();
    include MC_PLUGIN_DIR . 'templates/calculator-template.php';
    return ob_get_clean();
}
add_shortcode('mortgage_calculator', 'mc_mortgage_calculator_shortcode');
