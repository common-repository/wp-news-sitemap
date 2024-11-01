<?php
// ------------------------------------------------------------------
// Add all your sections, fields and settings during admin_init
// ------------------------------------------------------------------
//

function wpns_settings_api_init()
{
    register_setting('wpns', 'wpns-settings', 'wpns_sanitize');

    add_settings_section(
        'wpns-settings', // ID
        'WP News Sitemap Settings', // Title
        'wpns_print_section_info',
        'wpns-settings' // Page
    );

    add_settings_field(
        'wpns_publish_name', // ID
        'Publisher Name ', // Title 
        'wpns_publish_name_callback',
        'wpns-settings', // Page
        'wpns-settings' // Section           
    );
    add_settings_field(
        'wpns_language', // ID
        'Language', // Title 
        'wpns_language_callback',
        'wpns-settings', // Page
        'wpns-settings' // Section           
    );
    add_settings_field(
        'wpns_enable_post_sitemap_ping', // ID
        'Enable Auto Ping For Post Sitemap', // Title 
        'wpns_enable_post_sitemap_ping_callback',
        'wpns-settings', // Page
        'wpns-settings' // Section           
    );
    add_settings_field(
        'wpns_enable_attachment_sitemap_ping', // ID
        'Enable Auto Ping For Attachment Sitemap', // Title 
        'wpns_enable_attachment_sitemap_ping_callback',
        'wpns-settings', // Page
        'wpns-settings' // Section           
    );
}

add_action('admin_init', 'wpns_settings_api_init');


function wpns_print_section_info()
{
    echo 'Fill below settings and save so that plugin functionality works smoothly';
}

/**
 * Sanitize each setting field as needed
 *
 * @param array $input Contains all settings fields as array keys
 */
function wpns_sanitize($input)
{

    $new_input = array();

    $new_input['wpns_publish_name'] = (isset($input['wpns_publish_name'])) ?  sanitize_text_field($input['wpns_publish_name']) : '';
    $new_input['wpns_language'] = (isset($input['wpns_language'])) ?  sanitize_text_field($input['wpns_language']) : '';
    $new_input['wpns_enable_post_sitemap_ping'] = (isset($input['wpns_enable_post_sitemap_ping'])) ?  1 : 0;
    $new_input['wpns_enable_attachment_sitemap_ping'] = (isset($input['wpns_enable_attachment_sitemap_ping'])) ?  1 : 0;

    return $new_input;
}

function wpns_publish_name_callback()
{
    $wpnsSettings = get_option('wpns-settings');
    $publisherName = (isset($wpnsSettings['wpns_publish_name'])) ? $wpnsSettings['wpns_publish_name'] : '';
    echo wp_sprintf('<input name="wpns-settings[wpns_publish_name]" id="wpns_publish_name" type="text" value="%s" class="regular-text ltr"  />', $publisherName);
}

function wpns_language_callback()
{
    $wpnsSettings = get_option('wpns-settings');
    $publisherLang = (isset($wpnsSettings['wpns_language'])) ? $wpnsSettings['wpns_language'] : '';
    echo wp_sprintf('<input name="wpns-settings[wpns_language]" id="wpns_language" type="text" value="%s" class="regular-text ltr"  />', $publisherLang);
}
function wpns_enable_post_sitemap_ping_callback()
{
    $wpnsSettings = get_option('wpns-settings');
    $pingPostSitmap = (isset($wpnsSettings['wpns_enable_post_sitemap_ping'])) ? $wpnsSettings['wpns_enable_post_sitemap_ping'] : 0;
    echo '<input name="wpns-settings[wpns_enable_post_sitemap_ping]" id="wpns_enable_post_sitemap_ping" type="checkbox" value="1" class="code" ' . checked(1, $pingPostSitmap, false) . ' />';
}
function wpns_enable_attachment_sitemap_ping_callback()
{
    $wpnsSettings = get_option('wpns-settings');
    $pingAttachSitmap = (isset($wpnsSettings['wpns_enable_attachment_sitemap_ping'])) ? $wpnsSettings['wpns_enable_attachment_sitemap_ping'] : 0;
    echo '<input name="wpns-settings[wpns_enable_attachment_sitemap_ping]" id="wpns_enable_attachment_sitemap_ping" type="checkbox" value="1" class="code" ' . checked(1, $pingAttachSitmap, false) . ' />';
}
