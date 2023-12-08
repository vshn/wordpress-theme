<?php
/**
 * Header for pages
 * Custom header image functionality
 * @package WordPress
 */

/**
 * @return mixed|string in case there is a image array in field, returns random image from it, otherwise returns random.jpg from images
 *
 */
function randomHeaderImage() {

    $images = array();

    if( have_rows('imgs', 'options') ):
        while( have_rows('imgs', 'options')): the_row();
            $image = get_sub_field('img');

            array_push($images, $image);
        endwhile;
        $random_counter = rand(0, count($images)-1);

    endif;
    if( !empty($images) ) return $images[$random_counter];
    else return get_template_directory_uri() . '/src/images/random.jpg';
}

/**
 * Custom header for home page
 * Change name of images that show up by default if nothing is selected (from random.jpg)
 */
function headerHomePage() { ?>
<header class="wrapper" id="js-header">
    <div class="container">
        <div class="section top-section">
            <ul class="list">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'top-menu', // Replace 'top-menu' with your actual menu location
                'container' => false, // No container element
                'items_wrap' => '<ul class="list">%3$s</ul>', // Custom HTML structure for the menu
                'walker' => new Top_Menu_Walker_Nav_Menu()
            ));
            ?>
            </ul>
            <ul class="list">
                <?php
                $languages = pll_the_languages( array( 'raw' => 1 ) );

                foreach( $languages as $language ) { ?>

                <li class="list-item">
                    <a href="<?php echo $language['url'] ?>"
                        class="list-link <?php echo ($language['current_lang'] == true) ? "active" : ""; ?>">
                        <?php
                    if( $language['name'] == 'English' ) { ?>
                        <svg class="icon" width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11 22C17.0751 22 22 17.0751 22 11C22 4.92487 17.0751 0 11 0C4.92487 0 0 4.92487 0 11C0 17.0751 4.92487 22 11 22Z"
                                fill="#F0F0F0" />
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M13.869 0.378906C15.2767 0.75832 16.5723 1.40986 17.6965 2.27391L13.869 6.10136V0.378906ZM19.7257 4.30249C20.5897 5.42668 21.2413 6.72241 21.6206 8.12998H15.8982L19.7257 4.30249ZM0.37793 8.13055C0.757301 6.72294 1.40884 5.42722 2.27289 4.30303L6.10042 8.13055H0.37793ZM0.37793 13.8695C0.757344 15.2771 1.40888 16.5728 2.27289 17.6969L6.10029 13.8695H0.37793ZM4.30205 19.7261C5.42624 20.5901 6.72197 21.2417 8.12954 21.6211V15.8987L4.30205 19.7261ZM4.30205 2.27387C5.4262 1.40986 6.72192 0.75832 8.12949 0.378906V6.10131L4.30205 2.27387ZM13.869 21.6211C15.2766 21.2417 16.5723 20.5901 17.6965 19.7261L13.869 15.8987V21.6211ZM19.7257 17.697L15.8982 13.8695H21.6206C21.2413 15.2771 20.5897 16.5728 19.7257 17.697Z"
                                fill="#16389C" />
                            <path
                                d="M21.9069 9.56523H12.4349H12.4348V0.0931133C11.9651 0.0319688 11.4863 0 11 0C10.5136 0 10.0349 0.0319688 9.56523 0.0931133V9.56514V9.56519H0.0931133C0.0319688 10.0349 0 10.5137 0 11C0 11.4864 0.0319688 11.9651 0.0931133 12.4348H9.56514H9.56519V21.9069C10.0349 21.968 10.5136 22 11 22C11.4863 22 11.9651 21.9681 12.4348 21.9069V12.4349V12.4348H21.9069C21.968 11.9651 22 11.4864 22 11C22 10.5137 21.968 10.0349 21.9069 9.56523Z"
                                fill="#FF1940" />
                            <path
                                d="M13.8691 13.8697L18.7777 18.7783C19.0035 18.5526 19.2188 18.3166 19.4243 18.0721L15.2219 13.8696H13.8691V13.8697Z"
                                fill="#FF1940" />
                            <path
                                d="M8.13029 13.8696H8.13021L3.22168 18.7782C3.44735 19.0039 3.68329 19.2193 3.92787 19.4248L8.13029 15.2222V13.8696Z"
                                fill="#FF1940" />
                            <path
                                d="M8.13037 8.13088V8.13079L3.22179 3.22217C2.99603 3.44784 2.78067 3.68378 2.5752 3.92836L6.77767 8.13084H8.13037V8.13088Z"
                                fill="#FF1940" />
                            <path
                                d="M13.8691 8.13041L18.7778 3.22175C18.5521 2.99599 18.3161 2.78063 18.0716 2.5752L13.8691 6.77767V8.13041Z"
                                fill="#FF1940" />
                        </svg>
                        <?php
                    } else { ?>
                        <svg class="icon" width="22" height="22" viewBox="0 0 22 22" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="0" width="22"
                                height="22">
                                <circle cx="11" cy="11" r="11" fill="#C4C4C4" />
                            </mask>
                            <g mask="url(#mask0)">
                                <rect y="14.666" width="22" height="7.33333" fill="#FFBF00" />
                                <rect width="22" height="7.33333" fill="#000D1A" />
                                <rect y="7.33398" width="22" height="7.33333" fill="#FF1A40" />
                            </g>
                        </svg>
                        <?php } ?>
                        <?php echo $language['name']; ?>
                    </a>
                </li>
                <?php
                }
            ?>
            </ul>
        </div>
        <div class="section">
            <a href="<?php echo get_the_permalink(pll_get_post(get_page_by_path( 'home' )->ID));?>">
                <img class="logo" src="<?php echo get_template_directory_uri() ?>/src/images/icons/logo.svg"
                    alt="Logo" />
            </a>

            <!-- <nav class="nav">
                <ul class="menu">
                    <li class="menu-item with-sub-menu">
                        <div class="link">
                            <a href="/products" class="link">
                                Products
                            </a>
                            <div class="sub-menu wrapper">
                                <div class="container inner">
                                    <a href="#" class="banner">
                                        <h2 class="banner-title heading wrapper wrapper_size_md wrapper_color_tertiary">
                                            Watch the APPUiO video</h2>
                                        <span class="banner-link-text">Read more </span>
                                    </a>
                                    <ul class="items">
                                        <li class="item">
                                            <a href="/">VSHN AppFlow</a>

                                            <ul class="sub-sub-menu container">
                                                <li><a
                                                        href="/en/products/appflow/continuous-integration-pipeline-ci-engineering/">Continuous
                                                        Integration Pipeline (CI) Engineering</a></li>
                                                <li><a href="/en/products/appflow/continuous-delivery-cd-engineering/">Continuous
                                                        Delivery (CD) Engineering</a></li>
                                                <li><a href="/en/products/appflow/containerizing-and-packaging/">Containerizing
                                                        and Packaging</a></li>
                                                <li><a href="/en/products/appflow/devsecops/">DevSecOps</a></li>
                                            </ul>
                                        </li>
                                        <li class="item with-sub-item"><a href="/en/products/appops/">VSHN AppOps</a>
                                            <ul class="sub-sub-menu container">
                                                <li><a href="/en/products/appops/application-operations/">Application
                                                        Operations</a></li>
                                                <li><a href="/en/products/appops/application-hosting-platform/">Application
                                                        Hosting Platform</a></li>
                                                <li><a
                                                        href="/en/products/appops/cloud-hosting-architecture-engineering/">Cloud
                                                        Hosting Architecture Engineering</a></li>
                                                <li><a href="/en/products/appops/security-operations/">Security
                                                        Operations</a></li>
                                            </ul>
                                        </li>
                                        <li class="item with-sub-menu"><a href="/en/products/appcat/">VSHN AppCat</a>
                                            <ul class="sub-sub-menu container">
                                                <li><a href="/en/products/appcat/object-storage/">Object Storage</a>
                                                </li>
                                                <li><a href="/en/products/appcat/postgresql-by-vshn/">PostgreSQL by
                                                        VSHN</a></li>
                                                <li><a href="/en/products/appcat/exoscale-dbaas/">Exoscale DBaaS</a>
                                                </li>
                                                <li><a href="/en/products/appcat/redis-by-vshn/">Redis by VSHN</a></li>
                                            </ul>
                                        </li>
                                        <li class="item with-sub-menu"><a
                                                href="/en/products/appuio-swiss-container-platform/">APPUiO – Swiss
                                                Container Platform</a>
                                            <ul class="sub-sub-menu container">
                                                <li><a href="/en/products/appuio-swiss-container-platform/appuio-faq/">APPUiO
                                                        Managed Kubernetes Services FAQ</a></li>
                                                <li><a href="/en/appuio-cloud/for-agencies/">APPUiO Cloud for
                                                        Agencies</a></li>
                                                <li><a href="/en/appuio-cloud/for-fintech-insurtech-medtech/">APPUiO
                                                        Cloud for Fintech, Insurtech &amp; Medtech</a></li>
                                                <li><a href="/en/appuio-cloud/for-isvs/">APPUiO Cloud for ISVs</a></li>
                                                <li><a href="/en/appuio-cloud/for-saas-e-commerce/">APPUiO Cloud for
                                                        SaaS &amp; E-commerce</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item with-sub-menu">
                        <div class="link">
                            <a class="link" href="/solutions">
                                Solutions
                            </a>
                            <div class="sub-menu wrapper">
                                <div class="container inner">
                                    <a href="#" class="banner">
                                        <h2 class="banner-title heading wrapper wrapper_size_md wrapper_color_tertiary">
                                            Watch the APPUiO video</h2>
                                        <span class="banner-link-text">Read more </span>
                                    </a>
                                    <ul class="items">
                                        <li class="item">
                                            <a href="/">VSHN AppFlow</a>

                                            <ul class="sub-sub-menu container">
                                                <li><a
                                                        href="/en/products/appflow/continuous-integration-pipeline-ci-engineering/">Continuous
                                                        Integration Pipeline (CI) Engineering</a></li>
                                                <li><a href="/en/products/appflow/continuous-delivery-cd-engineering/">Continuous
                                                        Delivery (CD) Engineering</a></li>
                                                <li><a href="/en/products/appflow/containerizing-and-packaging/">Containerizing
                                                        and Packaging</a></li>
                                                <li><a href="/en/products/appflow/devsecops/">DevSecOps</a></li>
                                            </ul>
                                        </li>
                                        <li class="item with-sub-item"><a href="/en/products/appops/">VSHN AppOps</a>
                                            <ul class="sub-sub-menu container">
                                                <li><a href="/en/products/appops/application-operations/">Application
                                                        Operations</a></li>
                                                <li><a href="/en/products/appops/application-hosting-platform/">Application
                                                        Hosting Platform</a></li>
                                                <li><a
                                                        href="/en/products/appops/cloud-hosting-architecture-engineering/">Cloud
                                                        Hosting Architecture Engineering</a></li>
                                                <li><a href="/en/products/appops/security-operations/">Security
                                                        Operations</a></li>
                                            </ul>
                                        </li>
                                        <li class="item with-sub-menu"><a href="/en/products/appcat/">VSHN AppCat</a>
                                            <ul class="sub-sub-menu container">
                                                <li><a href="/en/products/appcat/object-storage/">Object Storage</a>
                                                </li>
                                                <li><a href="/en/products/appcat/postgresql-by-vshn/">PostgreSQL by
                                                        VSHN</a></li>
                                                <li><a href="/en/products/appcat/exoscale-dbaas/">Exoscale DBaaS</a>
                                                </li>
                                                <li><a href="/en/products/appcat/redis-by-vshn/">Redis by VSHN</a></li>
                                            </ul>
                                        </li>
                                        <li class="item with-sub-menu"><a
                                                href="/en/products/appuio-swiss-container-platform/">APPUiO – Swiss
                                                Container Platform</a>
                                            <ul class="sub-sub-menu container">
                                                <li><a href="/en/products/appuio-swiss-container-platform/appuio-faq/">APPUiO
                                                        Managed Kubernetes Services FAQ</a></li>
                                                <li><a href="/en/appuio-cloud/for-agencies/">APPUiO Cloud for
                                                        Agencies</a></li>
                                                <li><a href="/en/appuio-cloud/for-fintech-insurtech-medtech/">APPUiO
                                                        Cloud for Fintech, Insurtech &amp; Medtech</a></li>
                                                <li><a href="/en/appuio-cloud/for-isvs/">APPUiO Cloud for ISVs</a></li>
                                                <li><a href="/en/appuio-cloud/for-saas-e-commerce/">APPUiO Cloud for
                                                        SaaS &amp; E-commerce</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="menu-item with-sub-menu">
                        <a class="link" href="/learn">
                            Learn
                        </a>
                    </li>
                    <li class="menu-item with-sub-menu">
                        <a class="link" href="/partners">
                            Partners
                        </a>
                    </li>
                    <li class="menu-item with-sub-menu">
                        <a class="link" href="/blog">
                            Blog
                        </a>
                    </li>
                    <li class="menu-item with-sub-menu">
                        <a class="link" href="/about">
                            About
                        </a>
                    </li>
                    <li class="menu-item with-sub-menu">
                        <a class="link" href="/contact">
                            Contact
                        </a>
                    </li>
                    <li class="menu-item with-sub-menu">
                        <a class="link" href="/login">
                            Login
                        </a>
                    </li>
                </ul>
            </nav> -->

            <?php
            wp_nav_menu(array(
                'theme_location' => 'main-menu', // Replace with your menu location,
                'container' => 'nav',
                'container_class' => 'nav',
                'walker' => new Main_Menu_Walker(),
            ));
            ?>
            <button class="burger" type="button" aria-label="Open Mobile Menu">
                <span class="burger-line"></span>
                <span class="burger-line"></span>
                <span class="burger-line"></span>
            </button>

        </div>
    </div>
</header>
<div class="overlay-module wrapper"></div>
<nav class="wrapper mobile-menu open">
    <div class="inner">
        <ul class="lang-menu">
            <li class="lang-menu-item">
                <a href="/" class="lang-menu-link active">
                    English</a>
            </li>
            <li class="lang-menu-item">
                <a href="#" class="lang-menu-link">
                    Deutsch</a>
            </li>
        </ul>
        <div class="menu-wrapper">
            <ul class="menu">
                <li class="menu-item"><a class="menu-link" href="/en/products/">Products</a></li>
                <li class="menu-item"><a class="menu-link" href="/en/products/appflow/">VSHN AppFlow</a></li>
                <li class="menu-item"><a class="menu-link" href="/en/products/appops/">VSHN AppOps</a></li>
                <li class="menu-item"><a class="menu-link" href="/en/products/appcat/">VSHN AppCat</a></li>
                <li class="menu-item"><a class="menu-link" href="/en/solutions/">Solutions</a></li>
                <li class="menu-item"><a class="menu-link" href="/en/learn/">Learn</a></li>
                <li class="menu-item"><a class="menu-link" href="/en/partners/">Partners</a></li>
                <li class="menu-item"><a class="menu-link" href="/en/blog/">Blog</a></li>
                <li class="menu-item"><a class="menu-link" href="/en/about/">About</a></li>
                <li class="menu-item"><a class="menu-link" href="/jobs/">Jobs</a></li>
                <li class="menu-item"><a class="menu-link" href="/en/contact/">Contact</a></li>
                <li class="menu-item"><a href="https://status.vshn.net/" class="menu-link">Status</a></li>
            </ul>
        </div>

        <button class="button wrapper wrapper_size_md">Login</button>

        <button class="close-button" type="button" aria-label="Close Mobile Menu"></button>
    </div>
</nav>
<?php
}

/**
 * Custom header for all other pages
 * Change name of images that show up by default if nothing is selected (from random.jpg)
 */
function headerPage() {
    $header_image = get_field('header_image');
    $header_title = get_field('header_title');
    $image = get_ftheme_first([$header_image, get_the_post_thumbnail_url(), randomHeaderImage()]);
    $title = get_ftheme_first([$header_title, get_the_title(), get_the_archive_title()]); ?>

<!-- <section class="section header-section header-overlay" style="background-image: url(<?php echo $image; ?>);">
    <div class="wrapper">
        <div class="header-title">
            <h1 class="title">
                <?php
                    echo $title; ?>
            </h1>
        </div>
    </div>
</section> -->
<?php
}?>