<?php get_header()?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/city.jpg') ?>);"></div>
    <div class="page-banner__content container-fluid t-center c-white">
        <h2 class="page-banner__title"><?php echo single_cat_title();?></h2>
        <div class="page-banner__intro">

        </div>
    </div>
</div>

<div class="wrap container-fluid">

    <section class="section activites">
   
        
        <h2 class="headline headline--small-plus">Voici toutes les activités de la thématique : <?php echo single_cat_title();?> </h2>
          <div class="row">
    
                <?php



    

    if( have_posts() ) :

    
        while ( have_posts() ) : the_post();?>
              
          <?php
              $today = date('Ymd');
              $enddate = get_field('date_de_fin');
              
              
              if($today < $enddate){ ;?>
                  
                    <div class="col-sm-6 col-md-4">
                <div class="featured-image">
                            <?php the_post_thumbnail('post');?>
                        </div>
                <h2 class="headline headline--smaller"><?php the_title(); ?></h2>
                <p>
                <?php if (has_excerpt()){
                      echo get_the_excerpt();
                    } else {
                      echo wp_trim_words(get_the_content(), 20);
                    } ?>
                </p>
                <p>
                    
                    <span class="event-summary__month"><?php 
                $eventdate = new DateTime(get_field('date_de_debut'));
                echo $eventdate -> format('M');
                ?></span>
                            <span class="event-summary__day"><?php 
                $eventdate = new DateTime(get_field('date_de_debut'));
                echo $eventdate -> format('d');
                ?></span>

                            <?php
                  $startdate = get_field('date_de_debut');
                  $enddate = get_field('date_de_fin');
                  if($enddate AND $enddate !== $startdate){ ?>
                                <span>- </span>
                                <span class="event-summary__month"><?php 
                $eventdate = new DateTime(get_field('date_de_fin'));
                echo $eventdate -> format('M');
                ?></span>
                                <span class="event-summary__day"><?php 
                $eventdate = new DateTime(get_field('date_de_fin'));
                echo $eventdate -> format('d');
                ?></span>
                                <?php } 
                ?></p>
                <p><a class="read-more" href="<?php the_permalink();?>">En savoir plus</a></p>
        
                
             
              </div>
              
              <?php } else {
                  echo ' ';
              }
          
        
        endwhile;

    endif;
    wp_reset_postdata();


?>
      </div>
    </section>

</div>

<?php get_footer()?>
