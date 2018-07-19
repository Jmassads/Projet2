<?php get_header(); ?>

<?php
if (has_post_thumbnail()) {
    $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
    $thumbnail_url = $thumbnail_data[0];
}
?>


    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/city.jpg') ?>);"></div>
        <div class="page-banner__content container-fluid t-center c-white">
            <h2 class="headline headline--medium">
                <?php the_title(); ?></h2>
         
        </div>
    </div>

<section>
       <div class="wrap container-fluid">
        <div class="row">
            <?php
		while ( have_posts() ) :
			the_post();?>

               
                <div class="activite-description col-sm-8">
                   
                    <h2 class="headline headline--small"><?php the_title();?></h2>
                    <p>
                        <?php the_content();?>
                    </p>


                </div>
                <div class="col-sm-4">
                    <h2 class="headline headline--small">Informations:</h2>
                    <p>
                        <?php echo get_field('adresse');?>
                    </p>
                    <p>
                        <?php echo get_field('telephone');?>
                    </p>
                    <p>
                        <?php echo get_field('website');?>
                    </p>
                     <p>
                        <?php echo get_field('email');?>
                    </p>
                     <div class="activite__imageholder">
                         <?php the_post_thumbnail('medium'); ?>
                    </div>
                </div>

                <?php endwhile; // End of the loop.
		?>
        </div>



    
</div>
</section>
 


    <?php

get_footer();
