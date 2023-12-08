<?php
$form_id = get_field('contact_form_id');

?>

<section class="wrapper contact-section">
    <div class="form-wrapper">
    <?php
    if( $form_id ): ?>

        <form class="form">
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
        </form>
    <?php
    endif; ?>
    </div>

    <?php
    if( have_rows('contact_info') ): 
        while( have_rows('contact_info') ): the_row();  ?>

        <?php
        if( have_rows('items') ): ?>
        <div class="container">
            <div class="item wrapper">
            <?php
            while( have_rows('items') ): the_row(); 
                $icon = get_sub_field('icon');
                $title = get_sub_field('title');
                $description = get_sub_field('description');
                $link = get_sub_field('link');
                ?>
                <div class="wrapper">
                    <div class="wrapper">
                        <span class="icon-wrapper">
                            <img src="<?php echo esc_url($icon['url']); ?>" alt="icon">
                        </span>
                        <h4 class="heading wrapper wrapper_size_lg"><?= $title; ?></h4>
                        <p class="description"><?= $description; ?></p>
                        <?php
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>" class="link"><?php echo esc_html( $link_title ); ?></a>
                        <?php
                        endif; ?>
                    </div>
                </div>

            <?php
            endwhile; ?>
            </div>
        </div>
        <?php
        endif; ?>

    <?php
        endwhile;
    endif; ?>
</section>