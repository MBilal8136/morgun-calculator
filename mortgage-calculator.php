<?php
/**
 * Plugin Name: Mortgage Calculator Pro
 * Description: A professional, customizable mortgage calculator plugin for WordPress.
 * Version: 1.0
 * Author: MUHAMMAD BILAL
 * Text Domain: mortgage-calculator-pro
 */

// Display a welcome message after plugin activation
function mcp_plugin_activation() {
    update_option('mcp_show_welcome_message', true);
}
register_activation_hook(__FILE__, 'mcp_plugin_activation');

// Show admin notice
function mcp_admin_notice() {
    if (get_option('mcp_show_welcome_message')) {
        ?>
        <div class="notice notice-success is-dismissible">
            <p>Thank you for installing <strong>Mortgage Calculator Pro</strong>! This plugin was created by <strong>MUHAMMAD BILAL</strong>. Configure the plugin <a href="<?php echo admin_url('admin.php?page=mortgage-calculator-pro'); ?>">here</a>.</p>
        </div>
        <?php
        delete_option('mcp_show_welcome_message');
    }
}
add_action('admin_notices', 'mcp_admin_notice');

// Prevent direct access
if (!defined('ABSPATH')) exit;

// Define constants
define('MCP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MCP_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include helper functions
require_once MCP_PLUGIN_DIR . 'includes/helper-functions.php';

// Enqueue assets
function mcp_enqueue_assets() {
    wp_enqueue_style('mcp-style', MCP_PLUGIN_URL . 'public/css/style.css');
    wp_enqueue_script('mcp-script', MCP_PLUGIN_URL . 'public/js/calculator.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'mcp_enqueue_assets');

// Admin settings
if (is_admin()) {
    require_once MCP_PLUGIN_DIR . 'admin/settings-page.php';
}

// Register shortcode
function mcp_mortgage_calculator_shortcode() {
    ob_start();
    include MCP_PLUGIN_DIR . 'templates/calculator-template.php';
    return ob_get_clean();
}
add_shortcode('mortgage_calculator_pro', 'mcp_mortgage_calculator_shortcode');

// Enqueue admin styles and scripts
function mcp_enqueue_admin_assets($hook) {
    // Load only on the plugin settings page
    if ($hook === 'toplevel_page_mortgage-calculator-pro') {
        wp_enqueue_style('mcp-admin-style', plugin_dir_url(__FILE__) . 'admin/admin-style.css');
        wp_enqueue_script('mcp-admin-script', plugin_dir_url(__FILE__) . 'admin/admin-script.js', array('jquery'), null, true);
    }
}
add_action('admin_enqueue_scripts', 'mcp_enqueue_admin_assets');
require_once plugin_dir_path(__FILE__) . 'includes/helper-functions.php';

