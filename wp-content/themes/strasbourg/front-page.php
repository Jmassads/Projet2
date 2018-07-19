<?php get_header()?>


<div id="slider" role="slider" aria-valuemin="0"
           aria-valuenow="100"
           aria-valuemax="255">
    <?php

        $args = array(
          'post_type' => 'homepage_slider',
          'posts_per_page' => -1,
          'order' => 'ASC'

        );

        $the_query = new WP_Query($args)
        ?>
        <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
        $the_query->the_post(); ?>
        <figure>
            <?php 

                $image = get_field('slide');

                if( !empty($image) ): ?>

                    <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

            <?php endif; ?>
        </figure>
        <?php endwhile;?>
        <?php endif; ?>
</div>


<div class="slider-pro sp-no-js" id="my-slider">
    <div class="sp-slides">

        <?php

                    $args = array(
                      'post_type' => 'homepage_slider',
                      'posts_per_page' => -1,
                      'order' => 'ASC'
                      
                    );

                    $the_query = new WP_Query($args)
                    ?>


            <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>
            <div class="sp-slide">

                <?php 

                $image = get_field('slide');

                if( !empty($image) ): ?>

                    <img class="sp-image" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

                <?php endif; ?>

                
                <?php if( get_field('first_slide_welcome_text') ) { ?>
                <h2 class="headline headline--medium sp-layer sp-padding <?php the_field('hide_small_screen'); ?> <?php the_field('texte_1_couleur') ;?>" data-position="<?php the_field('texte_1_position'); ?>" data-horizontal="<?php the_field('texte_1_position_horizontale'); ?>" data-vertical="-30%" data-show-transition="down" data-show-delay="900" data-hide-transition="up">
                    <?php the_field('first_slide_welcome_text'); ?>
                </h2>
                <?php } ?>

                <?php if( get_field('texte_1') ) { ?>
                <h2 class="headline headline--medium sp-layer sp-padding <?php the_field('hide_small_screen'); ?> <?php the_field('texte_1_couleur') ;?>" data-position="<?php the_field('texte_1_position'); ?>" data-horizontal="<?php the_field('texte_1_position_horizontale'); ?>" data-show-transition="down" data-show-delay="900" data-hide-transition="up">
                    <?php the_field('texte_1'); ?>
                </h2>
                <?php } ?>

                <?php if( get_field('texte_2') ) { ?>
                <h2 class="headline sp-layer sp-padding <?php the_field('hide_small_screen'); ?> <?php the_field('texte_2_couleur') ;?>" data-position="<?php the_field('texte_2_position'); ?>" data-horizontal="<?php the_field('texte_2_position_horizontale'); ?>" data-vertical="30%" data-show-transition="down" data-show-delay="1300" data-hide-transition="up">
                    <?php the_field('slide_texte_2'); ?>
                    <i class="fa fa-arrow-right"></i></h2>
                <?php } ?>

                <?php if( get_field('texte_3') ) { ?>
                <p class="sp-layer sp-padding <?php the_field('texte_3_couleur') ;?>" data-position='<?php the_field('texte_3_position'); ?>' data-show-transition="left" data-show-delay="1300">
                    <?php the_field('texte_3'); ?>
                </p>
                <?php } ?>


                <p class="sp-layer view-more" data-position="bottomCenter" data-vertical="10%" data-show-transition="down" data-hide-transition="up">
                    <a href="#news" aria-label="Cliquez sur l'icône pour descendre dans la page"><i class="fa fa-angle-down"></i></a>
                </p>
            </div>

            <?php endwhile;?>
            <?php endif; ?>

    </div>
</div>

<section id="news" class="news">
    <div class="wrap container-fluid">
        <div class="row between-xs middle-xs">
            <h2 class="headline headline--medium heading-move underlined">Les Actualités</h2>
            <p><a href="<?php echo site_url('/actualites/');?>" class="text-move t-italic">Toutes les actualités <i class="fa fa-arrow-right"></i></a></p>
        </div>




        <?php

        $args = array(
          'post_type' => 'actualites',
          'post_parent__not_in' => array( 0 ),
          'posts_per_page' => 2,
          'order_by' => 'publish_date',
          'order' => 'DESC'
        );

        $the_query = new WP_Query($args)
        ?>

            <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
            $the_query->the_post(); ?>
            <div class="row middle-md p-bottom-small ">
                <div class="col-sm-9">
                    <div class="front-page__single-post">
                        <div class="front-page__single-post__date">

                            <span class="single-post__date--month"><?php 
            the_time('F')
            ?></span>
                            <span class="single-post__date--day"><?php 
            the_time('j')
            ?></span>

                        </div>

                        <div class="front-page__single-post__text">

                            <h3 class="headline">
                                <a class="headline--small" href="<?php the_permalink();?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>

                            <p>
                                <?php if (has_excerpt()){
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 30);
                } ?>
                                <a class="read-more" href="<?php the_permalink();?>">En savoir plus</a>
                            </p>



                        </div>
                    </div>




                </div>
                <div class="col-sm-3">
                    <?php the_post_thumbnail('post');?>
                </div>
            </div>
            <?php endwhile;?>
            <?php endif; ?>
            <?php wp_reset_postdata();?>

    </div>


</section>

<section class="events section">
    <div class="wrap container-fluid">
        <div class="row between-xs middle-xs">
            <p><a href="<?php echo site_url('/activites/');?>" class="t-italic heading-move">Toutes les activités du mois <i class="fa fa-arrow-right"></i></a></p>
            <h2 class="headline headline--medium text-move underlined"> Les Activités du mois</h2>
        </div>

        <?php
        $today = date('Ymd');
        $args = array(
           'post_type' => 'activites',
           'posts_per_page' => 2,

            'meta_key' => 'date_de_debut',
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
                array(
                    'key' => 'date_de_fin',
                    'compare' => '>=',
                    'value' => $today,
                    'type' => 'numeric'
                )
            )
        );

        $the_query = new WP_Query($args)
        ?>

            <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
            $the_query->the_post(); ?>
            <div class="row middle-md p-bottom-small">
                <div class="col-sm-3">
                    <p>
                        <?php the_terms( $post->ID, 'thematique', ' ', ' / ' ); ?> <i class="fa fa-caret-right"></i></p>
                </div>
                <div class="col-sm-9">

                    <div class="front-page__single-post">
                        <div class="front-page__single-post__date">


                            <span class="single-post__date--month"><?php 
                $dateformatstring = "F";
    $unixtimestamp = strtotime(get_field('date_de_debut'));
    echo date_i18n($dateformatstring, $unixtimestamp);
                ?></span>


                            <span class="single-post__date--day"><?php 
            $dateformatstring = "d";
$unixtimestamp = strtotime(get_field('date_de_debut'));
echo date_i18n($dateformatstring, $unixtimestamp);
            ?></span>

                            <?php
            $startdate = get_field('date_de_debut');
            $enddate = get_field('date_de_fin');
            if($enddate AND $enddate !== $startdate){ ?>
                                <i class="fa fa-arrow-down"></i>
                                <span class="single-post__date--month"><?php 
                $dateformatstring = "F";
    $unixtimestamp = strtotime(get_field('date_de_fin'));
    echo date_i18n($dateformatstring, $unixtimestamp);
                ?></span>
                                <span class="single-post__date--day"><?php 
            $dateformatstring = "d";
$unixtimestamp = strtotime(get_field('date_de_fin'));
echo date_i18n($dateformatstring, $unixtimestamp);
            ?></span>
                                <?php } 
            ?>





                        </div>
                        <div class="front-page__single-post__text">
                            <h3 class="headline">
                                <a class="headline--small" href="<?php the_permalink();?>">
                                    <?php the_title(); ?>
                                </a>
                            </h3>

                            <p>
                                <?php if (has_excerpt()){
                  echo get_the_excerpt();
                } else {
                  echo wp_trim_words(get_the_content(), 30);
                } ?>
                                <a class="read-more" href="<?php the_permalink();?>">En savoir plus</a>
                            </p>



                        </div>
                    </div>







                </div>
            </div>
            <?php endwhile;?>
            <?php endif; ?>
            <?php wp_reset_postdata();?>



    </div>


</section>

<section class="plus-infos section">
    <div class="wrap container-fluid">
        <div class="t-center p-bottom-large">
            <h2 class="headline headline--medium underlined">Plus D'Infos</h2>
        </div>
        <div>
            <div class="intro">
                <div class="lead">
                    <div class="lead--text">
                        <h3 class="separateur"><span class="inner">Patrimoine et Culture</span></h3>
                        <p class="p-top-medium">Strasbourg, une ville au patrimoine exceptionnel, culturel, muséographique et architectural.
                        </p>
                        <p>Son centre ville fait partie du patrimoine mondial de L’UNESCO.</p>
                        <p class="t-italic">
                            <a href="<?php echo site_url('/infos/');?>">
                                En Savoir Plus <i class="fa fa-arrow-right"></i>
                            </a>
                        </p>
                    </div>

                </div>
                <div class="fp-slider">
                    <div class="box-slider">
                        <?php

                    $args = array(
                      'post_type' => 'patrimoine_culture',
                      'posts_per_page' => -1,
                      'post_parent' => 0
                      
                    
                    );

                    $the_query = new WP_Query($args)
                    ?>


                            <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>
                            <div>
                                <div>
                                    <?php the_post_thumbnail('post');?>
                                </div>
                            </div>

                            <?php endwhile;?>
                            <?php endif; ?>
                    </div>
                </div>
                <div id="slider2">
    <?php

        $args = array(
          'post_type' => 'patrimoine_culture',
          'posts_per_page' => -1,
          'post_parent' => 0

        );

        $the_query = new WP_Query($args)
        ?>
        <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
        $the_query->the_post(); ?>
        <figure>
            <?php the_post_thumbnail('post');?>
        </figure>
        <?php endwhile;?>
        <?php endif; ?>
</div>
            </div>

        </div>
        <div>
            <div class="row">
                <div class="hide-small col-md-offset-0 col-md-3">
                    <div class="sidebar">
                        <?php echo do_shortcode( '[jr_instagram id="2"]' ); ?>
                    </div>
                </div>

                <div class="col-xs-12 col-md-9">
                    <div class="row">
                        <div class="col-xs">
                            <h3 class="separateur"><span class="inner">Sortir à Strasbourg</span></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs">

                            <?php echo do_shortcode('[searchandfilter fields="evenements" submit_label="Rechercher" all_items_labels="+ évènements"]'); ?>

                        </div>
                    </div>
                    <div class="row">
                        <?php

                    $args = array(
                      'post_type' => 'sortir',
                      'tag' => 'front-page-post',
                      'posts_per_page' => 4
                     
                    );

                    $the_query = new WP_Query($args)
                    ?>


                            <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>

                            <div class="col-xs-12 col-sm-6 col-md-4">

                                <div class="imageholder">
                                    <div class="featured-image">
                                        <?php the_post_thumbnail('post');?>
                                    </div>
                                    <span class="theme"><?php the_terms( $post->ID, 'evenements', ' ', ' / ' ); ?></span>

                                </div>


                                <h2 class="headline">
                                    <a class="headline--small" href="<?php the_permalink();?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h2>
                                <p>
                                    <?php if (has_excerpt()){
                      echo get_the_excerpt();
                    } else {
                      echo wp_trim_words(get_the_content(), 10);
                    } ?>

                                </p>


                            </div>

                            <?php endwhile;?>
                            <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
        <div>
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs">
                            <h3 class="separateur"><span class="inner">Ou Manger à Strasbourg</span></h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs">

                            <?php echo do_shortcode('[searchandfilter fields="cuisine" submit_label="Rechercher" all_items_labels="+ de restaurants"]'); ?>

                        </div>
                    </div>
                    <div class="row">
                        <?php

                    $args = array(
                      'post_type' => 'gastronomie',
                      'tag' => 'front-page-post',
                      'posts_per_page' => 4
                     
                    );

                    $the_query = new WP_Query($args)
                    ?>


                            <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>

                            <div class="col-xs-12 col-sm-6 col-md-4">

                                <div class="imageholder">
                                    <div class="featured-image">
                                        <?php the_post_thumbnail('post');?>
                                    </div>
                                    <span class="theme"><?php the_terms( $post->ID, 'cuisine', ' ', ' / ' ); ?></span>

                                </div>


                                <h2 class="headline headline--smal">
                                
                                        <?php the_title(); ?>
                                   
                                </h2>
                                <p>
                                    <?php if (has_excerpt()){
                      echo get_the_excerpt();
                    } else {
                      echo wp_trim_words(get_the_content(), 10);
                    } ?>

                                </p>

                                <div class="restaurant_buttons p-bottom-large">
                                    <?php if( get_field('site_web') ) { ?>
                                    <span><a href="<?php the_field('site_web'); ?>" target="_blank">Voir le Site <i class="fa fa-chevron-right"></i></a></span>
                                    <?php } ?>

                                    <?php if( get_field('reserver') ) { ?>
                                    <span><a href="<?php the_field('reserver'); ?>" target="_blank">Réservez <i class="fa fa-chevron-right"></i></a></span>

                                    <?php } ?>
                                </div>


                            </div>

                            <?php endwhile;?>
                            <?php endif; ?>
                    </div>
                </div>

            </div>



        </div>
    </div>
</section>

<?php get_footer()?>
