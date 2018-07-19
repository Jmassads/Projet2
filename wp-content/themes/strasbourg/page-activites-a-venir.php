<?php get_header()?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/mois.jpg') ?>);"></div>
    <div class="page-banner__content container-fluid t-center c-white">
        <h2 class="page-banner__title">
            <?php echo the_title();?>

        </h2>
    </div>
</div>

<section class="activites-a-venir">
    <div class="wrap container-fluid">

    <div class="row center-xs middle-md start-md">
        <div class="col-xs-12 col-md-5">
            <p>Concerts, animations litteraires, projections cinematographique, théâtre...faites le plein d'idée sorties pour
                 <?php
setlocale(LC_TIME, "fr_FR");
echo strftime("%B");?>
            </p>
        </div>
        <div class="col-xs-12 col-md-7">
            <?php echo do_shortcode('[searchandfilter fields="thematique" submit_label="Rechercher" all_items_labels="+ thematiques"]'); ?>
        </div>
    </div>

    <div class="activites_table">
        <div class="table_header">
            <div class="row">
                <div class="col-xs-12 col-md-2">
                    <p><i class="fa fa-calendar" aria-hidden="true"></i></p>
                </div>
                <div class="col-xs-12 col-md-3">
                    <p>Activité</p>
                </div>
                <div class="col-xs-12 col-md-2">
                    <p>Date</p>
                </div>
                <div class="col-xs-12 col-md-3">
                    <p>A Propos</p>
                </div>
                <div class="col-xs-12 col-md-2">
                    <p>Inscriptions:</p>
                </div>
            </div>
        </div>

        <div class="table_inner">


<?php 
                
                $lastdayofmonth = date('Ymd',strtotime('last day of this month'));
                ?>
                
               

                <?php $i = 0;?>
                <?php
                $today = date('Ymd');
                $the_query = new WP_Query(array(
                'posts_per_page' => 10,
                'post_type' => 'activites',
                'meta_key' => 'date_de_debut',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_query' => array(
                    array(
                        'key' => 'date_de_fin',
                        'compare' => '>=',
                        'value' => $today,
                        'type' => 'numeric'
                    ),
                    array(
                        'key' => 'date_de_debut',
                        'compare' => '>',
                        'value' => $lastdayofmonth,
                        'type' => 'numeric'
                    )
                    
                    
                )
                    
                
            ));


    
    // The Loop
    if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                    <?php $i++;?>
                <div id="table_row-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="row middle-md">


                        <div class="col-xs-12 col-md-2 theme activite_image">
                            <p>
                                <?php the_post_thumbnail('tiny-thumbnail'); ?>
                            </p>
                            <p>
                                <?php the_terms( $post->ID, 'thematique', ' ', '-' ); ?>
                            </p>
                        </div>
                        <div class="col-xs-12 col-md-3 titre">
                            <p>
                                <?php the_title(); ?>
                            </p>
                        </div>
                      <div class="col-xs-12 col-md-2 date">
                            <p><span class="event-summary__date"><?php 
                $date = get_field('date_de_debut');
$y = substr($date, 0, 4);
$m = substr($date, 4, 2);
$d = substr($date, 6, 2);
setlocale(LC_TIME, "fr_FR");
$date = strtotime($d.'-'.$m.'-'.$y);
echo strftime("%e %B" ,$date);
                ?>
            </span>
                                <?php
            $startdate = get_field('date_de_debut');
            $enddate = get_field('date_de_fin');
            if($enddate AND $enddate !== $startdate){ ?>
                                    <span>- </span>
                                    <span class="event-summary__date"><?php 
            $date = get_field('date_de_fin');
$y = substr($date, 0, 4);
$m = substr($date, 4, 2);
$d = substr($date, 6, 2);
setlocale(LC_TIME, "fr_FR");
$date = strtotime($d.'-'.$m.'-'.$y);
echo strftime("%e %B" ,$date);
            ?></span>
                                    <?php } 
            ?>
                            </p>
                        </div>
                        <div class="col-xs-12 col-md-3 description">
                            <p>
                                <?php if (has_excerpt()){
                      echo get_the_excerpt();
                    } else {
                      echo wp_trim_words(get_the_content(), 10);
                    } ?>
                                <a href="<?php the_permalink();?>" class="nu gray">En savoir plus</a></p>
                        </div>
                        <div class="col-xs-12 col-md-2 inscrire"><a class="inscription btn btn--purple" data-toggle="modal" data-target=".modal<?php echo $i;?>">S'inscrire </a></div>
                      
                    </div>
                  
                </div>
      
              <!-- Modal -->
                    <div id="myModal" class="modal modal<?php echo $i;?> fade" role="dialog">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title">
                                        <?php the_title();?>
                                    </h3>
                                    <p>
                                        <?php the_content();?>
                                    </p>
                                </div>
                                <div class="modal-body">
                                    <?php echo do_shortcode( '[contact-form-7 id="329" title="Contact form 1"]' );?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>

                        </div>
                    </div>



                    <?php endwhile;
                endif;
                // Reset Post Data
                wp_reset_postdata();

                ?>

               


        </div>

    </div>

     <div class="row center-xs">
            <div>
                <p class="t-center no-margin"><a href="<?php echo site_url('activites-passees/');?>" class="btn btn--borderedpurple">Activités Passées</a></p>
            </div>
            <div>
                <p class="t-center no-margin"><a href="<?php echo site_url('activites//');?>" class="btn btn--borderedpurple">Activités du mois</a></p>
            </div>
        </div>


    </div></section>




<?php get_footer()?>









<?php get_footer()?>


<?php get_footer()?>
