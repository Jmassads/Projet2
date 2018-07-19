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

    <section class="actualites">
        <h2 class="headline headline--medium underlined">Toutes les actualités par rubrique:</h2>

        <div class="row">
            <div class="col-xs-12">
                 <?php echo do_shortcode('[searchandfilter fields="rubrique" submit_label="Rechercher" all_items_labels="+ rubriques"]'); ?>
            </div>
        </div>

        <h2 class="headline headline--small-plus">Les dernières actualités: </h2>
        <div class="row center-xs start-sm">

            <?php
    
                $args = array( 
               'post_type'           => 'actualites',
               'post_parent__not_in' => array( 0 ),
               'posts_per_page' => 10
                );

                $the_query = new WP_Query( $args );
                // The Loop
                if ( $the_query->have_posts() ) :
                while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                <div class="actualite-post post col-sm-6 col-md-4">
                    <div class="imageholder">
                        <div class="featured-image">
                            <?php the_post_thumbnail('post');?>
                        </div>
                        <span class="theme"><?php the_terms( $post->ID, 'rubrique', ' ', ' / ' ); ?></span>
                    </div>
                    <a href="<?php the_permalink();?>">
                        <h2 class="headline headline--smaller">
                            <?php the_title(); ?> </h2>
                    </a>
                    <p>
                        <?php if (has_excerpt()){
                      echo get_the_excerpt();
                    } else {
                      echo wp_trim_words(get_the_content(), 10);
                    } ?>
                    </p>
                    <p><a class="read-more" href="<?php the_permalink();?>">En savoir plus <i class="ion-android-arrow-forward"></i></a></p>
                    <p class="t-italic">Posté par:
                        <?php the_author();?>
                    </p>
                    <div class="post-meta">
                    <p class="actualite_date"><span><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo get_the_date('l j F Y');?></span> à <span><?php echo the_time();?></span></p>
                    </div>
                </div>



                <?php endwhile;
                endif;
                // Reset Post Data
                wp_reset_postdata();

                ?>
        </div>
    </section>

</div>

<?php get_footer()?>
