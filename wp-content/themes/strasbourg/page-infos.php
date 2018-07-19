<?php get_header()?>


<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url('https://i.pinimg.com/originals/41/ca/b5/41cab548870d1046972e0d13b1be0a54.jpg')"></div>
    <div class="page-banner__content container-fluid t-center c-white">
        <h2 class="page-banner__title">
            <?php echo the_title();?>
        </h2>
    </div>
</div>

<div class="wrap container-fluid">
    
    <section class="patrimoine_culture">
        <h2 class="headline headline--medium t-uppercase t-center">Patrimoine et Culture</h2>
        <div class="row center-xs middle-md start-md p-bottom-large">
            <div class="col-xs-12 col-md-5">
                 <p>Strasbourg possède un patrimoine exceptionnel et reconnu mondialement. De nombreux monuments et lieux de cultures en font sa renommée.</p>
            </div>
            <div class="col-xs-12 col-md-7">
                <?php echo do_shortcode('[searchandfilter fields="visiter_a_strasbourg" submit_label="Rechercher" all_items_labels="+ de visites"]'); ?>
            </div>
        </div>
        <div class="row center-xs start-sm">
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

                <div class="col-sm-6 col-md-4">
                    <div class="post visit-post ">

                    <div class="imageholder">
                        <div class="featured-image">
                            <?php the_post_thumbnail('post');?>
                        </div>
                        <span class="theme"><?php the_terms( $post->ID, 'visiter_a_strasbourg', ' ', ' / ' ); ?></span>

                    </div>





                    <p>
                        <?php if (has_excerpt()){
                      echo get_the_excerpt();
                    } else {
                      echo wp_trim_words(get_the_content());
                    } ?>

                    </p>






                  </div>
                </div>



                <?php endwhile;?>
                <?php endif; ?>
        
        
        </div>
        <div class="row">
            <div class="col-md-8 no-padding">
                <h3 class="headline headline--small-plus t-uppercase t-center">Les incontournables</h3>
                <div class="row center-xs start-sm">

                    <?php

                    $args = array(
                      'post_type' => 'patrimoine_culture',
                      'tag' => 'incontournable',
                      'posts_per_page' => 3
                     
                    );

                    $the_query = new WP_Query($args)
                    ?>


                        <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>


                        <div class="col-sm-6">
                            <div class="post">
                            <div class="featured-image">
                                <a href="<?php the_permalink();?>">
                                    <?php the_post_thumbnail('post');?>
                                </a>
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
                      echo wp_trim_words(get_the_content(), 15);
                    } ?>
                                <a class="read-more" href="<?php the_permalink();?>">Plus d'infos</a>
                            </p>






                           </div>
                        </div>



                        <?php endwhile;?>
                        <?php endif; ?>
                </div>

        

        </div>
        <!--end row--></div>
    </section>
    
    <section class="passes section">
        <div class="row middle-xs">
            <div class="col-sm-6">
                <h2 class="headline headline--medium t-uppercase t-center">Strasbourg Pass</h2>

                <p>Si vous avez envie de sortir à Strasbourg, de multiples possibilités s'offrent à vous.</p>
                <p>Pour 21,50 € par adulte et de 10 € à 15 € seulement pour les juniors, le Strasbourg Pass vous ouvre les portes de la ville pendant 3 jours consécutifs.</p>

                <p>Des prestations gratuites et de nombreuses réductions vous permettront de découvrir les monuments et sites incontournables, à votre rythme et en toute liberté. Seul, en amoureux ou en famille !</p>
                <p>Vente et information dans les bureaux d'accueil de l'Office de Tourisme de Strasbourg.</p>


            </div>
            <div class="col-sm-6 pass-container">
                <div class="strasbourg-passes">

                    <div class="strasbourg-passes__slide-pass">
                        <img src="<?php echo get_theme_file_uri('images/Vignette_Flyer-adulte.jpg');?>" alt="strasbourg pass adulte">
                        <div class="pass-overlay">Strasbourg Pass Adulte</div>
                    </div>
                    <div class="strasbourg-passes__slide-pass">
                        <img src="<?php echo get_theme_file_uri('images/Vignette_Flyer-junior.jpg');?>" alt="strasbourg pass junior">
                        <div class="pass-overlay">Strasbourg Pass Junior</div>
                    </div>


                </div>
            </div>

        </div>
    </section>

    <section class="sortir section">



        <h2 class="headline headline--medium t-uppercase t-center p-top-large">Sortir</h2>

        <div class="row p-bottom-large">
            <div class="col-sm-8">
                <div class="row center-xs start-sm">
                    <div class="col-sm-6">
                        <img src="<?php echo get_theme_file_uri('images/mois.jpg'); ?>" alt="activites du mois">
                    </div>
                    <div class="col-sm-6">
                        <a href="<?php echo site_url('/activites/');?>">
                            <h3 class="headline headline--small">Strasbourg, les activités du mois</h3>
                        </a>
                        <p>Concerts, animations litteraires, projections cinematographique, théâtre...faites le plein d'idée sorties pour <?php
setlocale(LC_TIME, "fr_FR");
echo strftime("%B");?></p>
                    </div>
                </div>
            </div>

        </div>


        <div class="row center-xs middle-md start-md p-bottom-large">
            <div class="col-xs-12 col-md-7">
                <?php echo do_shortcode('[searchandfilter fields="evenements" submit_label="Rechercher" all_items_labels="+ Évènements"]'); ?>
            </div>
            <div class="col-xs-12 col-md-5">
                 <p>Toutes les idées pour sortir à Strasbourg : Sorties pour les enfants, Sports et Jeux, Où sortir le soir à Strasbourg...</p>
            </div>
        </div>



        <div class="row center-xs start-sm">





            <?php

                    $args = array(
                      'post_type' => 'sortir',
                      'posts_per_page' => -1,
                      'post_parent' => 0
                      
                    
                    );

                    $the_query = new WP_Query($args)
                    ?>


                <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>


                <div class="col-sm-6 col-md-4">

                 <div class="post single-post ">
                    <div class="imageholder">
                        <div class="featured-image">
                            <?php the_post_thumbnail('post');?>
                        </div>
                        <span class="theme"><?php the_terms( $post->ID, 'evenements', ' ', ' / ' ); ?></span>

                    </div>



                    <p>
                        <?php if (has_excerpt()){
                      echo get_the_excerpt();
                    } else {
                      echo wp_trim_words(get_the_content(), 15);
                    } ?>

                    </p>





                 </div>

                </div>



                <?php endwhile;?>
                <?php endif; ?>










        </div>


        <div class="row">
            <div class="col-sm-offset-4 col-md-8 no-padding">
                <h3 class="headline headline--small-plus t-uppercase t-center">Les incontournables</h3>
                <div class="row center-xs start-sm">

                    <?php

                    $args = array(
                      'post_type' => 'sortir',
                      'tag' => 'incontournable',
                      'posts_per_page' => 3
                     
                    );

                    $the_query = new WP_Query($args)
                    ?>


                        <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>


                        <div class="col-sm-6">
                            <div class="post">


                            <div class="featured-image">
                                <a href="<?php the_permalink();?>">
                                    <?php the_post_thumbnail('post');?>
                                </a>
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
                      echo wp_trim_words(get_the_content(), 15);
                    } ?>
                                <a class="read-more" href="<?php the_permalink();?>">Plus d'infos</a>
                            </p>






                          </div>
                        </div>



                        <?php endwhile;?>
                        <?php endif; ?>
                </div>

            </div>


        </div>
        <!--end row-->
    </section>

    <section class="restaurants section">

        <h2 class="headline headline--medium t-uppercase t-center p-top-large">Ou Manger?</h2>

        <div class="row center-xs middle-md start-md">
            <div class="col-xs-12 p-bottom-large">
                <?php echo do_shortcode('[searchandfilter fields="cuisine" submit_label="Rechercher" all_items_labels="+ de restaurants"]'); ?>
            </div>
        </div>


        <div class="row center-xs start-sm">

            <?php

                   $args = array(
                      'post_type' => 'gastronomie',
                      'posts_per_page' => -1,
                      'post_parent' => 0
                      
                    
                    );

                    $the_query = new WP_Query($args)
                    ?>


                <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>


                <div class="col-sm-6 col-md-4">
                    <div class="post gastronomie-post">
                    <div class="imageholder">
                        <div class="featured-image">
                            <?php the_post_thumbnail('post');?>
                        </div>
                        <span class="theme"><?php the_terms( $post->ID, 'cuisine', ' ', ' / ' ); ?></span>

                    </div>
                    
                    </div>
                </div>

                <?php endwhile;?>
                <?php endif; ?>

        </div>

        <div class="row">
            <div class="col-md-8">
                <h3 class="headline headline--small-plus t-uppercase t-center">Les incontournables</h3>
                <div class="row center-xs start-sm">

                    <?php

                    $args = array(
                      'post_type' => 'gastronomie',
                      'tag' => 'incontournable'
                    );

                    $the_query = new WP_Query($args)
                    ?>


                        <?php if($the_query->have_posts()) : while ( $the_query->have_posts() ) :
                    $the_query->the_post(); ?>


                        <div class="col-sm-6">
                            <div class="post gastronomie-post">
                            <div class="featured-image">
                                <a href="<?php the_permalink();?>">
                                    <?php the_post_thumbnail('post');?>
                                </a>
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
                                  echo wp_trim_words(get_the_content(), 15);
                                } ?>
                                <a class="read-more" href="<?php the_permalink();?>">Plus d'infos</a>
                            </p>
                            
                            <?php if( get_field('site_web') ) { ?>
                            <div class="restaurant_buttons">
                            <span><a href="<?php the_field('site_web'); ?>" target="_blank">Voir le Site <i class="fa fa-chevron-right"></i></a></span>
                            <?php } ?>

                            <?php if( get_field('reserver') ) { ?>
                            <span><a href="<?php the_field('reserver'); ?>" target="_blank">Réservez <i class="fa fa-chevron-right"></i></a></span>
                            </div>
                            <?php } ?>
                            </div>
                        </div>

                        <?php endwhile;?>
                        <?php endif; ?>
                </div>


            </div>



        </div>
        <!--end row-->

    
    </section>

</div>

<?php get_footer()?>
