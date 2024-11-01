<?php
/**
 * Register Settings
 */
require_once WPNS_PATH . "admin/wp-plugin-settings.php";


/**
 * Register plugin setting menu page.
 */
function wpns_register_plugin_settings_menu()
{
    add_options_page(
        __('WPNS Settings', 'wp-news-sitemap'),
        'WPNS Settings',
        'manage_options',
        'wpns-settings',
        'wpns_render_news_sitemap_settings'
    );
}
add_action('admin_menu', 'wpns_register_plugin_settings_menu');

function wpns_render_news_sitemap_settings()
{
    require_once WPNS_PATH . "admin/wp-plugin-settings-view.php";
}
