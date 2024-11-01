<?php

/**
 * Generate News Sitemap
 */
function wpns_generate_news_sitemap_callback()
{
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => 200,
    );

    $query = new WP_Query($args);

    ob_start();

echo '<?xml version="1.0" encoding="UTF-8"?>'.PHP_EOL;
?>
<!-- * Sitemap Update on <?php echo date("l jS \of F Y h:i:s A"); ?> -->
<!-- * Plugin Name:     WP News Sitemap -->
<!-- * Plugin URI:      https://profiles.wordpress.org/thebetterindia/ -->
<!-- * Description:     This plugin is used to create and auto submit news sitemap -->
<!-- * Author:          Sunil Kumar Sharma -->
<!-- * Author URI:      https://www.xpertzmate.com -->
<!-- * Text Domain:     wp-news-sitemap -->
<!-- * Domain Path:     /languages -->
<!-- * Version:         1.0.0 -->

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml" xmlns:news="http://www.google.com/schemas/sitemap-news/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">
    <?php
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();


            $publishDate = str_replace(" ", "T", $query->post->post_date_gmt) . "Z";
            $modifieDate = str_replace(" ", "T", $query->post->post_modified_gmt) . "Z";

            $keywordData = array();

            $categories = get_the_category();
            if (!empty($categories)) :
                foreach ($categories as $category) :
                    array_push($keywordData, esc_html($category->name));
                endforeach;
            endif;


            $post_tags = get_the_tags();
            if (!empty($post_tags)) :
                foreach ($post_tags as $tag) :
                    array_push($keywordData, esc_html($tag->name));
                endforeach;
            endif;
    ?>

            <url>
                <loc><?php echo get_permalink(get_the_ID()); ?></loc>
                <xhtml:link rel="amphtml" href="<?php echo get_permalink(get_the_ID()); ?>" />
                <news:news>
                    <news:publication>
                        <news:name><?php echo wpns_get_publish_name(); ?></news:name>
                        <news:language><?php echo wpns_get_publish_lang(); ?></news:language>
                    </news:publication>
                    <news:publication_date><?php echo $publishDate; ?></news:publication_date>
                    <news:title>
                        <![CDATA[<?php echo esc_html(get_the_title()); ?>]]>
                    </news:title>
                    <news:keywords>
                        <![CDATA[<?php echo  implode(", ", $keywordData); ?>]]>
                    </news:keywords>
                </news:news>
                <lastmod><?php echo $modifieDate; ?></lastmod>
                <image:image>
                    <image:loc><?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?></image:loc>
                </image:image>
            </url>
    <?php
        endwhile;
    endif; //if($query->have_posts()):
    ?>
</urlset>
<?php
    $newsSitemap = ob_get_clean();

    $fp = fopen(ABSPATH . '/' . "sitemap-news.xml", 'w');
    fwrite($fp, $newsSitemap);
    fclose($fp);
}
add_action('wpns_generate_news_sitemap', 'wpns_generate_news_sitemap_callback');
