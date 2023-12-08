<div class="wrapper categories">
    <div class="container inner">
        <div class="items-wrapper">
            <a class="item active post-filter" href="">
                All posts
            </a>
            <?php
            $categories = get_categories(array(
                'orderby' => 'name',
                'order' => 'ASC',
                'exclude' => array(1, 49)
            ));

            foreach ($categories as $category) {
                $category_link = get_category_link($category->term_id);
                $category_count = $category->count;

                if ($category_count > 0) {
                    echo '<a class="item post-filter" href="' . esc_url($category_link) . '" data-category="' . $category->slug . '">';
                    echo esc_html($category->name);
                    echo '</a>';
                }
            }
            ?>
        </div>
    </div>
</div>