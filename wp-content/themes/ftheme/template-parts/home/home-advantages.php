<?php
if( have_rows('advantages') ):
    while( have_rows('advantages') ): the_row();

    $title = get_sub_field('title');

?>

<section class="wrapper advantages">
    <div class="container">
        <h2 class="title heading wrapper_size_xl"><?= $title; ?></h2>
        <?php
        if( have_rows('items') ):
        ?>
        <ul class="items-wrapper">
            <?php
            $counter = 1;
            while( have_rows('items') ): the_row(); 
                $link = get_sub_field('link');
                $card_title = get_sub_field('title');
                $image_name = get_sub_field('image_name');
            ?>
            <li class="wrapper advantages-card">
                <?php
            if( $link ):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
                <a href="<?php echo esc_url( $link_url ) ?>" target="<?php echo esc_attr( $link_target ); ?>"
                    class="inner">
                    <span class="number heading wrapper wrapper_size_lg"><?= $counter; ?></span>

                    <?php
                    if( $image_name == 'Get Back Time' ): ?>
                    <svg class="image" width="120" height="120" viewBox="0 0 120 120" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M12 60C12 86.5097 33.4903 108 60 108C86.5097 108 108 86.5097 108 60C108 33.4903 86.5097 12 60 12C46.7152 12 34.6909 17.3969 26 26.1179"
                            stroke="#D1D5E0" stroke-width="4" />
                        <path d="M35.9706 27.3136H24.6569V15.9999" stroke="#D1D5E0" stroke-width="4"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M10 60C10 87.6142 32.3858 110 60 110V60H10Z"
                            fill="#D1D5E0" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 60H10V62C10 60.8954 10.8954 60 12 60Z"
                            fill="white" />
                        <circle cx="60" cy="60" r="35" fill="#4CC3FF" />
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M25 60H60V95C40.67 95 25 79.33 25 60Z"
                            fill="#08112B" />
                        <circle cx="60" cy="60" r="9" fill="white" />
                        <path d="M60 35L60 60.0001H85" stroke="white" stroke-width="4" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <circle cx="60" cy="60" r="5" fill="#4CC2FF" />
                    </svg>
                    <?php
                    elseif( $image_name == 'Increase Security' ): ?>
                    <svg class="image" width="120" height="120" fill="none" xmlns="http://www.w3.org/2000/svg" class="item-module--image--2iYdA" aria-hidden="true"><path d="M93.158 26.414c-9.948 0-23.948-2.62-31.684-10.853-.737-.748-1.842-.748-2.58 0-8.105 8.233-22.105 10.853-32.052 10.853-1.105 0-1.842.748-1.842 1.87v37.423c0 14.22 19.895 34.428 34.263 39.293h1.474C75.474 100.135 95 79.927 95 65.707V28.285c0-1.123-.737-1.871-1.842-1.871z" fill="#4CC3FF"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M95 49H25v16.707c0 2.304.522 4.765 1.459 7.293h67.107C94.487 70.472 95 68.01 95 65.707V49z" fill="#08112B"></path><path d="M53.04 50S52.045 38 60 38c7.954 0 6.96 12 6.96 12" stroke="#fff" stroke-width="4"></path><path d="M45 52a3 3 0 013-3h24a3 3 0 013 3v18a3 3 0 01-3 3H48a3 3 0 01-3-3V52z" fill="#fff"></path><path fill-rule="evenodd" clip-rule="evenodd" d="M62.061 61.429a4 4 0 10-4.122 0l-.776 5.43a1 1 0 00.99 1.141h3.694a1 1 0 00.99-1.141l-.776-5.43z" fill="#4CC2FF"></path><path d="M5.577 43.385A1 1 0 016.5 42H25v24H6.5a1 1 0 01-.923-1.385l3.942-9.461a3 3 0 000-2.308l-3.942-9.461zM114.423 43.385A1 1 0 00113.5 42H95v24h18.5a1 1 0 00.923-1.385l-3.942-9.461a2.997 2.997 0 010-2.308l3.942-9.461z" fill="#D1D5E0"></path>
                    </svg>
                    <?php
                    else: ?>
                    <svg class="image" width="120" height="120" fill="none" xmlns="http://www.w3.org/2000/svg" class="item-module--image--2iYdA" aria-hidden="true"><rect x="25" y="25" width="90" height="50" rx="2" fill="#08112B"></rect><rect x="15" y="35" width="90" height="50" rx="2" fill="#D1D5E0"></rect><rect x="5" y="45" width="90" height="50" rx="2" fill="#4CC3FF"></rect><circle cx="19" cy="70" r="4" fill="#fff"></circle><circle cx="81" cy="70" r="4" fill="#fff"></circle><circle cx="50" cy="70" r="17" fill="#fff"></circle><path d="M46.806 61.405C45.86 60.477 44.736 60 43.38 60c-1.354 0-2.504.477-3.45 1.405-.945.929-1.431 2.033-1.431 3.363s.486 2.46 1.431 3.388c.946.928 2.096 1.38 3.45 1.38 1.355 0 2.479-.452 3.425-1.38.945-.929 1.43-2.058 1.43-3.388s-.485-2.434-1.43-3.363zm7.717-1.204l-13.11 19.648h4.064l13.11-19.648h-4.064zm-11.142 6.022c-1.865.1-1.865-3.011 0-2.91.843 0 1.431.652 1.431 1.455s-.613 1.455-1.43 1.455zm8.382 9.01c0 1.33.486 2.458 1.431 3.387.946.928 2.096 1.38 3.45 1.38 1.355 0 2.48-.452 3.425-1.38.945-.929 1.431-2.058 1.431-3.388s-.486-2.46-1.431-3.388c-.946-.928-2.07-1.405-3.425-1.405-1.354 0-2.53.477-3.475 1.405-.946.929-1.406 2.058-1.406 3.388zm4.881-1.481c.818 0 1.432.677 1.432 1.48 0 .803-.614 1.456-1.432 1.456-1.865.1-1.865-3.012 0-2.936z" fill="#4CC2FF"></path></svg>
                    <?php
                    endif; ?>


                    <div class="content">
                        <h3 class="title heading wrapper_size_lg"><?= $card_title; ?></h3>
                        <span class="footer-text"><?php echo esc_html( $image_name); ?></span>
                    </div>
                </a>
                <?php 
            endif; ?>
            </li>
            <?php
                $counter++;
            endwhile; ?>
        </ul>
        <?php
        endif; ?>
    </div>
</section>
<?php
    endwhile;
endif;