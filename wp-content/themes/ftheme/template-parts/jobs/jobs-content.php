<section class="wrapper jobs-content ">
    <div class="container inner">
        <h2 class="title heading wrapper wrapper_size_xl">Open positions</h2>
        <div class="recruitee" id="recruitee-careers">
        </div>
        <div class="content">
            <?php the_content() ?>
        </div>

        <?php
        if( have_rows('rating_cards') ):
            while( have_rows('rating_cards') ): the_row(); 
            $title = get_sub_field('title');
            $description = get_sub_field('description');
            
            ?>
            <section class="wrapper rating-card">
                <div class="container inner">
                    <h3 class="title" tag="h3"><?= $title ?></h3>
                    <div class="description"><?= $description; ?></div>
                    <?php
                    if( have_rows('items') ): ?>
                    <div class="rating-cards">
                    <?php
                        while( have_rows('items') ): the_row(); 
                        $card_description = get_sub_field('description');
                        $card_image = get_sub_field('image');
                        $card_link = get_sub_field('link');
                        ?>
                        <div class="item" key={index}>
                            <div class="text"><?= $card_description; ?></div>
                            <a href="<?php echo esc_url($card_link['url']); ?>" class="image-wrapper">
                                <img src="<?php echo esc_url($card_image['url']); ?>" alt="" />
                            </a>
                        </div>
                    <?php
                        endwhile; ?>
                    </div>
                    <?php
                    endif; ?>
                </div>
            </section>
        <?php
            endwhile;
        endif; 
        
        
        if( have_rows('rating_cards_2') ):
            while( have_rows('rating_cards_2') ): the_row();

            $title = get_sub_field('title');
            $description = get_sub_field('description');
        ?>
        
            <section class="wrapper rating-card">
                <div class="container inner">
                    <h3 class="title" tag="h3"><?= $title; ?></h3>
                    <div class="description"><?= $description; ?></div>
                    <?php
                    if( have_rows('items') ): ?>
                    <div class="rating-cards">
                    <?php
                        while( have_rows('items') ): the_row(); 
                        $card_description = get_sub_field('description');
                        $card_image = get_sub_field('image');
                        $card_link = get_sub_field('link');
                        ?>
                        <div class="item" key={index}>
                            <div class="text"><?= $card_description; ?></div>
                            <a href="<?php echo esc_url($card_link['url']); ?>" class="image-wrapper">
                                <img src="<?php echo esc_url($card_image['url']); ?>" alt="" />
                            </a>
                        </div>
                    <?php
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

<script>
const rtscript = document.createElement('script');
rtscript.type = 'text/javascript';
rtscript.onload = () => {
    if (window.RTWidget) {
        const {
            RTWidget
        } = window;
        window.widget = new RTWidget({
            companies: [74931],
            detailsMode: 'recruitee',
            language: 'en',
            departmentsFilter: [],
            themeVars: {
                primary: '#1999e3',
                secondary: '#000',
                text: '#5c6f78',
                textDark: '#37474f',
                fontFamily: '"Montserrat", sans-serif',
                baseFontSize: '16px',
            },
            flags: {
                showLocation: true,
                showCountry: true,
                showCity: true,
                groupByLocation: false,
                groupByDepartment: true,
                groupByCompany: false,
            },
        });
    }
};
rtscript.src = 'https://d10zminp1cyta8.cloudfront.net/widget.js';
document.body.appendChild(rtscript);
</script>