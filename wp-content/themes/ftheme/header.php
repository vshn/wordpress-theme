<?php
/**
 * @package ftheme
 */
global $globalSite;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php if(has_site_icon()): ?>
    <link rel="icon" href="<?php echo get_site_icon_url(); ?>" type="image/x-icon" />
    <?php else: ?>
    <link rel="icon" href="<?php echo get_template_directory_uri() . '/src/images/vision_favicon.ico'; ?>"
        type="image/x-icon" />
    <?php endif; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.8.1/lottie.min.js" integrity="sha512-V1YyTKZJrzJNhcKthpNAaohFXBnu5K9j7Qiz6gv1knFuf13TW/3vpgVVhJu9fvbdW8lb5J6czIhD4fWK2iHKXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.8.1/lottie_worker.min.js" integrity="sha512-6vVWvwgWScukTOn45HlvUolNY6im/rlHZaR6JXEPrQTeXbgXmzy++yJ1CDDsz7WT9jbfATc3LH271E5k5Iv3Fw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>(function (w, d, s, l, i) { w[l] = w[l] || []; w[l].push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' }); var f = d.getElementsByTagName(s)[0], j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : ''; j.async = true; j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl + ''; f.parentNode.insertBefore(j, f); })(window, document, 'script', 'dataLayer', 'GTM-5FC2LLB');</script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div id="page" class="site">
        <div class="m-overlay"></div>