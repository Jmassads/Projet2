<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package strasbourg
 */

get_header();
?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/city.jpg') ?>);"></div>
        <div class="page-banner__content container-fluid t-center c-white">
            <h2 class="page-banner__title">
                <?php the_title();?>
            </h2>
        </div>
    </div>

<section class="contact">
    <div class="wrap container-fluid">
        <div class="row middle-md">
            <div class="col-xs-12 col-md-6">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post();
        the_content();
        endwhile; else: ?>
        <p>Sorry, no posts matched your criteria.</p>
        <?php endif; ?>
            </div>
            <div class="col-xs-12 col-md-6 m-top-medium">
                <h2 class="headline headline--small"> Horaires d'ouverture :</h2>
                <h3 class="headline headline--smaller">Bureau d'accueil :</h3>
                <p>Tous les jours de 9H à 19H.</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2639.454133166308!2d7.747738815629707!3d48.5820028792614!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4796c85254c0f10d%3A0x4552eabd2c396c70!2s17+Place+de+la+Cath%C3%A9drale%2C+67000+Strasbourg!5e0!3m2!1sen!2sfr!4v1527789259759" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>        
    </div>
</section>


    <?php get_footer() ?>
