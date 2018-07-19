<?php get_header()?>


<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/mois.jpg') ?>);"></div>
    <div class="page-banner__content container-fluid t-center c-white">
        <h2 class="page-banner__title">
            <?php echo the_title();?>
        </h2>
    </div>
</div>

<?php echo do_shortcode( '[contact-form-7 id="329" title="Contact form Modal"]' ); ?>

<?php get_footer()?>