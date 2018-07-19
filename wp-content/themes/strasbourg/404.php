<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package strasbourg
 */

get_header();
?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/city.jpg') ?>);"></div>
    <div class="page-banner__content container-fluid t-center c-white">
        <h1 class="page-banner__title"><?php echo the_title();?></h1>
        <div class="page-banner__intro">

        </div>
    </div>
</div>

 <div class="wrap container-fluid">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<div class="page-header">
					<h2 class="headline headline--small"><?php esc_html_e("Toutes nos excuses, mais la page que vous avez demandé n'a pas été trouvée.", 'strasbourg' ); ?></h2>
				</div><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'Que recherchez vous?', 'strasbourg' ); ?></p>

					<?php
					get_search_form();

					the_widget( 'WP_Widget_Recent_Posts' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->
 </div>

<?php
get_footer();
