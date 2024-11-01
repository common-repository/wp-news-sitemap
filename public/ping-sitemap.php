<?php

/**
 * Event Hook - For Submit Sitemap
 */
function wpns_ping_sitemaps_hook_callback()
{
    $homeUrl = home_url();

    //News Sitemap
    wpns_ping_sitemap_url("https://www.google.com/ping?sitemap=$homeUrl/sitemap-news.xml");
    wpns_ping_sitemap_url("https://www.google.com/webmasters/tools/ping?sitemap=$homeUrl/sitemap-news.xml");
    wpns_ping_sitemap_url("https://www.google.com/webmasters/sitemaps/ping?sitemap=$homeUrl/sitemap-news.xml");


    if (wpns_is_post_sitemap_ping()) :

        //Post Sitemap
        $posts_count = wp_count_posts();
        $sitemapCount = 1;
        if ($posts_count) {
            $published_posts = intval($posts_count->publish);
            $sitemapCount +=  ceil($published_posts / 1000);
        }
        for ($i = 1; $i < $sitemapCount; $i++) {
            wpns_ping_sitemap_url("https://www.google.com/ping?sitemap=$homeUrl/post-sitemap$i.xml");
            wpns_ping_sitemap_url("https://www.google.com/webmasters/tools/ping?sitemap=$homeUrl/post-sitemap$i.xml");
            wpns_ping_sitemap_url("https://www.google.com/webmasters/sitemaps/ping?sitemap=$homeUrl/post-sitemap$i.xml");
        }
    endif;

    if (wpns_is_attach_sitemap_ping()) :

        //Media Sitemap
        $mediaCount = wpns_get_media_count();
        $attSitemapCount = 1;
        if ($mediaCount) {
            $attachments = intval($mediaCount->publish);
            $attSitemapCount +=  ceil($attachments / 1000);
        }

        for ($i = 1; $i < $attSitemapCount; $i++) {
            wpns_ping_sitemap_url("https://www.google.com/ping?sitemap=$homeUrl/attachment-sitemap$i.xml");
            wpns_ping_sitemap_url("https://www.google.com/webmasters/tools/ping?sitemap=$homeUrl/attachment-sitemap$i.xml");
            wpns_ping_sitemap_url("https://www.google.com/webmasters/sitemaps/ping?sitemap=$homeUrl/attachment-sitemap$i.xml");
        }
    endif;
}
add_action('wpns_ping_sitemaps_hook', 'wpns_ping_sitemaps_hook_callback');

/**
 * Generate News Sitemap
 */
function wpns_generate_news_sitemap_callback_data()
{
    do_action('wpns_generate_news_sitemap');
}
add_action('publish_post', 'wpns_generate_news_sitemap_callback_data');
