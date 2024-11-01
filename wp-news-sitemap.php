<?php

/**
 * Plugin Name:     WP News Sitemap
 * Plugin URI:      https://profiles.wordpress.org/thebetterindia/
 * Description:     This plugin is used to create and auto submit news sitemap
 * Author:          Sunil Kumar Sharma
 * Author URI:      https://www.xpertzmate.com
 * Text Domain:     wp-news-sitemap
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         Wp_News_Sitemap
 */

// Your code starts here.


if (!defined('WPNS_PATH')) :
    define('WPNS_PATH', plugin_dir_path(__FILE__));
endif;

if (!defined('WPNS_URL')) :
    define('WPNS_URL', plugin_dir_url(__FILE__));
endif;



/**
 * Includes
 */
require_once WPNS_PATH . 'includes/index.php';

/**
 * Admin
 */
require_once WPNS_PATH . 'admin/index.php';

/**
 * Public
 */
require_once WPNS_PATH . 'public/index.php';

/**
 * Schedule Event for Sitemap Submission and Generate
 */
function wpns_schedule_events_callback()
{
    if (!wp_next_scheduled('wpns_ping_sitemaps_hook')) {
        wp_schedule_event(time(), 'twicedaily', 'wpns_ping_sitemaps_hook');
    }

    if (!wp_next_scheduled('wpns_generate_news_sitemap')) {
        wp_schedule_event(time(), 'twicedaily', 'wpns_generate_news_sitemap');
    }
}
register_activation_hook(__FILE__, 'wpns_schedule_events_callback');



  
function wpns_schedule_events_clear_callback() {
    wp_clear_scheduled_hook( 'wpns_ping_sitemaps_hook' );
    wp_clear_scheduled_hook( 'wpns_generate_news_sitemap' );
}
register_deactivation_hook( __FILE__, 'wpns_schedule_events_clear_callback' );
