<?php get_header(); ?>

<?php
if (has_post_thumbnail()) {
    $thumbnail_data = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
    $thumbnail_url = $thumbnail_data[0];
}
?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url('<?php echo $thumbnail_url ?>');"></div>
        <div class="page-banner__content container-fluid t-center c-white">
            <h2 class="headline headline--medium">
                <?php the_title(); ?>
            </h2>
        </div>
    </div>

    <section>
        <div class="wrap container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <?php
        while ( have_posts() ) :
            the_post();?>

                        <p>
                            <?php the_terms( $post->ID, 'visiter_a_strasbourg', ' ', ' / ' ); ?>
                        </p>
                        <h2 class="headline headline--small-plus">
                            <?php the_title();?>
                        </h2>
                    
                        <p><?php the_content();?></p>
                    
                        <div class="restaurant_buttons p-bottom-large">
                             <?php if( get_field('site_web') ) { ?>
                            <span><a href="<?php the_field('site_web'); ?>" target="_blank">Voir le Site <i class="fa fa-chevron-right"></i></a></span>
                            <?php } ?>

                            <?php if( get_field('reserver') ) { ?>
                            <span><a href="<?php the_field('reserver'); ?>" target="_blank">Réservez <i class="fa fa-chevron-right"></i></a></span>
                       
                            <?php } ?>
                            </div>

                       

                        




                        <?php endwhile; // End of the loop.
        ?>


                </div>
                <div class="col-sm-4">
                    <!-- begin custom related loop, isa -->

                    <?php 
 
// get the custom post type's taxonomy terms
 
$custom_taxterms = wp_get_object_terms( $post->ID, 'cuisine', array('fields' => 'ids') );
// arguments
$args = array(
'post_type' => 'gastronomie',
'post_status' => 'publish',
'posts_per_page' => 3, // you may edit this number
'orderby' => 'rand',
'tax_query' => array(
    array(
        'taxonomy' => 'cuisine',
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
echo '<h2 class="headline headline--small-plus"> + de restaurants </h2>';
while ( $related_items->have_posts() ) : $related_items->the_post();
?>
                    <div class="actualite-post-sidebar">
                        <div class="post">
                            <div class="imageholder">
                                <div class="featured-image">
                                    <?php the_post_thumbnail('post');?>
                                </div>
                                <span class="theme"><?php the_terms( $post->ID, 'cuisine', ' ', ' / ' ); ?></span>
                            </div>



                            <p>
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </p>


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
