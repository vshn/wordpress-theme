<?php $shape = get_template_directory_uri() . "/src/images/shape.svg";?>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'posts_per_page' => 20,
    'post_type' => 'post',
    'paged' => $paged
);


$posts_query = new WP_Query($args);
?>
<div class="wrapper blog-post-list">
    <div class="container">
    <?php
    if( $posts_query->have_posts() ): ?>
        <div class="items-wrapper has-banner">
        <?php
        while( $posts_query->have_posts() ): $posts_query->the_post();

            include('blog-post-list-single.php');
        
        endwhile; 
        
        ?>
        </div>
        <?php
        endif; 

        wp_reset_postdata(); 
        
        $banner = get_field('banner');
        ?>
        <div class="illustration">
            <a href="<?php echo esc_url($banner['banner_link']) ?>" class="banner">
                <div class="image gatsby-image">
                    <img class="banner-image" src="<?php echo esc_url($banner['banner_cover']['url']); ?>" alt="">
                </div>
                <div class="banner-overlay"></div>
                <h4 class="banner-title" class="heading wrapper wrapper_size_lg" color="tertiary"><?php echo $banner['banner_title']; ?></h4>
            </a>
        </div>
    </div>
    <img class="shape" src="<?php echo $shape; ?>" />
</div>


<div class="wrapper pagination">
    <div class="container">
        <ul class="items-wrapper">
            <li class="item previous">
                <a tabindex="0" role="button" aria-disabled="true" aria-label="Previous page" rel="prev" id="previous-posts-link">
                    <span>
                        <svg width="22" height="12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 6h20m0 0l-5.667-5M21 6l-5.667 5" stroke="#08112B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                        <span>Newer posts</span>
                    </span>
                </a>
            </li>
            <li class="item active" id="page-element"><a role="button" tabindex="0" aria-label="Page 1 is your current page" aria-current="page">1</a></li>
            <li class="item">
                <a role="button" tabindex="0">...</a>
            </li>
            <li class="item next">
                <a tabindex="0" role="button" aria-disabled="false" aria-label="Next page" rel="next" id="next-posts-link">
                    <span>
                        <span>Older Posts</span>
                        <svg width="22" height="12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 6h20m0 0l-5.667-5M21 6l-5.667 5" stroke="#08112B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>