<?php get_header(); ?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/city.jpg') ?>);"></div>
    <div class="page-banner__content container-fluid t-center c-white">
        <h2 class="page-banner__title">
            <?php single_term_title();?>
        </h2>
    </div>
</div>

<section>
    <div class="wrap container-fluid">
        
        <?php
    
    if (is_tax( 'visiter_a_strasbourg', 'quartiers-remarquables' )) { ?>
            <p class="p-top-large">Si de nombreuses communes d'Alsace possèdent un charme non-discutable, certains de leurs quartiers sont de véritables atouts. Centre historique ou particularité, ces quartiers remarquables à Strasbourg font partie de ces lieux à voir à tout prix pour bien commencer votre visite.</p>
            <?php } 
    else if (is_tax( 'visiter_a_strasbourg', 'sites-et-monuments-historiques' ))  { ?>


            <p class="p-top-large">Strasbourg compte 225 édifices protégés au titre de la loi de 1913, soit 26 % des monuments historiques du département du Bas-Rhin. Strasbourg est la 8e ville française comptant le plus de monuments historiques, après Paris, Bordeaux, La Rochelle, Nancy, Lyon, Rouen et Arras.</p>

            <?php }
    
    else if (is_tax( 'visiter_a_strasbourg', 'parcs-et-jardins' )) { ?>


            <p class="p-top-large">Les parcs et jardins sont des espaces de nature inestimables. Patrimoine fragile, ils permettent de préserver la biodiversité. Ils sont également propices au sport et à la détente.</p>

            <?php }
    
    else if (is_tax( 'visiter_a_strasbourg', 'musees' )) { ?>


            <p class="p-top-large">La richesse du patrimoine muséal de Strasbourg est unique : ses 10 musées, organisés en réseau et rassemblés sous une direction commune, livrent une vision panoramique et riche de l’art et de l’histoire. Plus d'infos: <a href="https://www.musees.strasbourg.eu/" target="_blank">https://www.musees.strasbourg.eu/</a></p>

            <?php }
    
    else if (is_tax( 'rubrique', array( 'climat-environnement', 'culture-loisirs', 'economie-social', 'education', 'faits-divers-justice', 'insolite', 'sante-sciences', 'societe', 'transports', 'football' ) ))  { ?>

            <div class="row center-xs">
                <div class="col-xs-12">
                    <h2 class="headline headline--small">Voici toutes les actualités dans la rubrique "
                        <?php echo single_term_title();?>"</h2>
                </div>
            </div>


            <?php }
    
    else { ?>



            <?php }
    
    ?>



    <section>
        <div class="row">

                    <?php
            
           
if ( have_posts() ) {
    while ( have_posts() ) {
        the_post();
       

        $args=array(
                'orderby' => 'menu_order',
                'order' => 'ASC',
                'posts_per_page' => -1,
                'post_type' => get_post_type( $post->ID ),
                'post_parent' => $post->ID
        );

        $childpages = new WP_Query($args);

        if($childpages->post_count > 0) { /* display the children content  */
          
            while ($childpages->have_posts()) {
                 $childpages->the_post(); ?>



                        <div class="col-sm-6 col-md-4">
                            <div class="post">

                            <div class="featured-image">
                                <?php the_post_thumbnail('post');?>
                            </div>

                            <h2 class="headline headline--small">
                                <a href="<?php the_permalink();?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            
                             <p>
                                <?php if (has_excerpt()){
                      echo get_the_excerpt();
                    } else {
                      echo wp_trim_words(get_the_content(), 20);
                    } ?>
                                <a class="read-more" href="<?php the_permalink();?>">En savoir plus</a>
                            </p>
                            
                            <?php
                            global $post;
                            if( get_post_type() == 'actualites' ){ ?>
                                <div class="post-meta">
                                    <span><?php echo get_the_date('l j F Y');?></span> à <span><?php echo the_time();?></span><br/>
                                </div>
                                <?php }
                             ?>
                                
                            <?php
                            global $post;
                            if( get_post_type() == 'gastronomie' ){ ?>
                                <div class="restaurant_buttons p-bottom-large">
                            <?php if( get_field('site_web') ) { ?>
                            <span><a href="<?php the_field('site_web'); ?>" target="_blank">Voir le Site <i class="fa fa-chevron-right"></i></a></span>
                            <?php } ?>

                            <?php if( get_field('reserver') ) { ?>
                            <span><a href="<?php the_field('reserver'); ?>" target="_blank">Réservez <i class="fa fa-chevron-right"></i></a></span>
                            
                            <?php } ?>
                            </div>
                                <?php }
                             ?>
                                
                                
            
      
                            



                        
                            </div> <!-- end post -->

                        </div>





                        <?php } 
        
        }
        wp_reset_query();

      
    }
}

            
            
        ;?>







                </div>
    </section>
    </div>
</section>

<?php get_footer(); ?>
