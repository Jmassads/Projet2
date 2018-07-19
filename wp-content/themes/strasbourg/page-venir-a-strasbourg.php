<?php get_header()?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/city.jpg') ?>);"></div>
    <div class="page-banner__content container-fluid t-center c-white">
        <h2 class="page-banner__title"><?php echo the_title();?></h2>
        <div class="page-banner__intro">

        </div>
    </div>
</div>

<div class="wrap container-fluid">
    
    <section>
     <div class="row center-xs start-sm">
            <?php

                    $args = array(
                      'post_type' => 'venir_a_strasbourg',
                      'posts_per_page' => -1,
                      'post_parent' => 0
                      
                    
                    );
                 
                    global $post;
                    $the_query = new WP_Query($args)
                    ?>


                <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>

                <div class="post visit-post col-sm-6 col-md-4">

                    <div class="imageholder moyen_de_transport">
                        <div class="featured-image">
                            <?php the_post_thumbnail('post');?>
                        </div>
                        <span class="theme"><?php the_terms( $post->ID, 'moyen_de_transport', ' ', ' / ' ); ?></span>
                        
                        
                    
                        
                    <?php 
                    $terms = wp_get_post_terms( $post->ID, 'moyen_de_transport');
                    echo '<span class="plus">';
                    foreach ($terms as $term) {
                        echo '<a href="'.get_term_link($term->slug, 'moyen_de_transport').'"><i class="fa fa-plus"></i></a>';
                    }
                    echo '</span>';
                    ;?>
                        
                    </div>





                    <p>
                        <?php if (has_excerpt()){
                      echo get_the_excerpt();
                    } else {
                      echo wp_trim_words(get_the_content());
                    } ?>

                    </p>







                </div>



                <?php endwhile;?>
                <?php endif; ?>
        
        
        </div>
    </section>

   

</div>

<?php get_footer()?>
