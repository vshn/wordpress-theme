<?php
header('Content-Type: application/rss+xml; charset=UTF-8');
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:wfw="http://wellformedweb.org/CommentAPI/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:sy="http://purl.org/rss/1.0/modules/syndication/" xmlns:slash="http://purl.org/rss/1.0/modules/slash/">

    <!-- Feed metadata -->
    <title>Custom RSS Feed</title>
    <description>Custom RSS Feed for All Categories</description>
    <link><?php echo home_url(); ?></link>
    <generator>WordPress</generator>
    <lastBuildDate><?php echo date(DATE_RSS, strtotime('now')); ?></lastBuildDate>

    <?php
    // Loop through the feed items
    if (have_posts()) :
        while (have_posts()) : the_post();
            ?>
            <item>
                <title><?php the_title(); ?></title>
                <description><![CDATA[<?php the_excerpt(); ?>]]></description>
                <link><?php the_permalink(); ?></link>
                <guid isPermaLink="false"><?php the_permalink(); ?></guid>
                <category><?php single_cat_title(); ?></category>
                <pubDate><?php echo get_the_date(DATE_RSS); ?></pubDate>
                <content:encoded><![CDATA[<?php the_content(); ?>]]></content:encoded>
            </item>
            <?php
        endwhile;
    endif;
    ?>

</rss>
