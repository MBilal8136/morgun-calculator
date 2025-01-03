<?php
function mcp_register_settings() {
    register_setting('mcp_settings_group', 'mcp_currency_symbol');
    register_setting('mcp_settings_group', 'mcp_default_interest_rate');
    register_setting('mcp_settings_group', 'mcp_default_loan_term');
}

function mcp_settings_menu() {
    add_menu_page(
        'Mortgage Calculator Pro Settings',
        'Mortgage Calculator',
        'manage_options',
        'mortgage-calculator-pro',
        'mcp_settings_page',
        'dashicons-calculator',
        20
    );
}

function mcp_settings_page() { ?>
    <div class="wrap">
        <h1>Mortgage Calculator Pro by MUHAMMAD BILAL</h1>
        <p>Welcome to the Mortgage Calculator Pro settings page. This plugin allows you to create professional and customizable mortgage calculators for your WordPress site.</p>
        <form method="post" action="options.php">
            <?php settings_fields('mcp_settings_group'); ?>
            <?php do_settings_sections('mcp_settings_group'); ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Currency Symbol</th>
                    <td><input type="text" name="mcp_currency_symbol" value="<?php echo esc_attr(get_option('mcp_currency_symbol', '$')); ?>"></td>
                </tr>
                <tr>
                    <th scope="row">Default Interest Rate (%)</th>
                    <td><input type="number" name="mcp_default_interest_rate" value="<?php echo esc_attr(get_option('mcp_default_interest_rate', '3.5')); ?>" step="0.01"></td>
                </tr>
                <tr>
                    <th scope="row">Default Loan Term (years)</th>
                    <td><input type="number" name="mcp_default_loan_term" value="<?php echo esc_attr(get_option('mcp_default_loan_term', '30')); ?>"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
<?php }
add_action('admin_menu', 'mcp_settings_menu');
add_action('admin_init', 'mcp_register_settings');


