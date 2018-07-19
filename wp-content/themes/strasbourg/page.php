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

    <div class="wrap container-fluid">
        <div>


            <?php
		while ( have_posts() ) :
			the_post();

            get_template_part( 'template-parts/content', 'page' );
            

		endwhile; // End of the loop.
		?>

        </div>
        <!-- #gastronomie -->
    </div>


    <?php get_footer() ?>
