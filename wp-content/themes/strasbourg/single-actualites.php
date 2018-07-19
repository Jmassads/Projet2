<?php

get_header();
?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/city.jpg') ?>);"></div>
    <div class="page-banner__content container-fluid t-center c-white">
        <h2 class="page-banner__title">Actualités</h2>
    </div>
</div>


<section>
<div class=" wrap container-fluid">
    
    <div class="row">

        <div class="col-sm-8">
            <?php
		while ( have_posts() ) :
			the_post();?>

                <p>
                    <?php the_terms( $post->ID, 'rubrique', ' ', ' / ' ); ?>
                </p>
                <h2 class="headline headline--small-plus">
                    <?php the_title();?>
                </h2>
                <?php the_content();?>




                <?php endwhile; // End of the loop.
		?>

        
        </div>
        <div class="col-sm-4">
            <!-- begin custom related loop, isa -->

            <?php 
 
// get the custom post type's taxonomy terms
 
$custom_taxterms = wp_get_object_terms( $post->ID, 'rubrique', array('fields' => 'ids') );
// arguments
$args = array(
'post_type' => 'actualites',
'post_status' => 'publish',
'posts_per_page' => 3, // you may edit this number
'orderby' => 'rand',
'tax_query' => array(
    array(
        'taxonomy' => 'rubrique',
        'field' => 'id',
        'terms' => $custom_taxterms
    )
),
'post__not_in' => array ($post->ID),
'post_parent__not_in' => array( 0 )
);
$related_items = new WP_Query( $args );
// loop over query
if ($related_items->have_posts()) :
echo '<h2 class="headline headline--small-plus"> A lire aussi </h2>';
while ( $related_items->have_posts() ) : $related_items->the_post();
?>
            <div class="actualite-post-sidebar">
                <div class="post">
                    <div class="imageholder">
                        <div class="featured-image">
                            <?php the_post_thumbnail('post');?>
                        </div>
                        <span class="theme"><?php the_terms( $post->ID, 'rubrique', ' ', ' / ' ); ?></span>
                    </div>
                    

                    
                    <p>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </p>
                    <span>
                        <?php echo get_the_date();?>
                    </span>

                </div>
            </div>




            <?php
endwhile;

endif;
// Reset Post Data
wp_reset_postdata();
?>


                <!-- end custom related loop, isa -->


        
        </div>
    </div>


</div>
</section>


<?php

get_footer();
