<section class="s-products-content wrapper">
    <div class="container inner">
        <div class="content">
        <?php the_content(); ?>

       
        <?php
        $form_id = get_field('content_page_form_id');

        if( $form_id ): ?>

            <div class="form">
                <script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
                <div id="form-container">
                    <!--[if lte IE 8]>
                    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
                    <![endif]-->
                    <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
                    <script>
                    hbspt.forms.create({
                        portalId: "7105834",
                        formId: "<?php echo $form_id ?>",
                        onFormReady: function($form){
                            $form.find('textarea[name="message"]').val("").change();
                        }
                    });
                    </script>
                </div>
            </div> <!-- end form -->
            <?php
            endif; ?>
        </div>
        <?php
            if( have_rows('related_items') ):
                while( have_rows('related_items') ): the_row();

                $title = get_sub_field('title');
            ?>
            <section class="wrapper related-items">
                <div class="container">
                    <h2 class="title" ><?= $title; ?></h2>
                    <?php
                    if( have_rows('items') ): ?>
                    <div class="items-wrapper">
                    <?php
                        while( have_rows('items') ): the_row(); 
                        $link = get_sub_field('link');

                        if( $link ) {
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a href="<?php echo esc_url($link_url); ?>" target="<?php echo esc_attr( $link_target ) ?>" class="item"><?php echo esc_html($link_title); ?></a>
                    <?php
                        }
                        endwhile; ?>
                    </div>
                    <?php
                    endif; ?>
                </div>
            </section>
            <?php
                endwhile;
            endif; ?> 
    </div>
</section>
