<?php

/**
 * Get Media Count
 */
function wpns_get_media_count()
{
    $mediaData = wp_count_attachments();
    $mediaCount = 0;

    if (is_object($mediaData)) :
        foreach ($mediaData as $count) :
            $mediaCount += $count;
        endforeach;
    endif;
    return $mediaCount;
}

/**
 * Ping Sitemap 
 */
function wpns_ping_sitemap_url($url)
{
    wp_remote_get($url);
}

/**
 * Get News Publisher
 */
function wpns_get_publish_name()
{
    $wpnsSettings = get_option('wpns-settings');
    return (isset($wpnsSettings['wpns_publish_name'])) ? $wpnsSettings['wpns_publish_name'] : get_option('blogname');
}

/**
 * Get News Language
 */
function wpns_get_publish_lang()
{
    $wpnsSettings = get_option('wpns-settings');
    return (isset($wpnsSettings['wpns_language'])) ? $wpnsSettings['wpns_language'] : 'en';
}

/**
 * Get Ping Post Sitemap Status
 */
function wpns_is_post_sitemap_ping()
{
    $wpnsSettings = get_option('wpns-settings');
    return (isset($wpnsSettings['wpns_enable_post_sitemap_ping'])) ? $wpnsSettings['wpns_enable_post_sitemap_ping'] : 0;
}
/**
 * Get Ping Post Sitemap Status
 */
function wpns_is_attach_sitemap_ping()
{
    $wpnsSettings = get_option('wpns-settings');
    return (isset($wpnsSettings['wpns_enable_attachment_sitemap_ping'])) ? $wpnsSettings['wpns_enable_attachment_sitemap_ping'] : 0;
}
