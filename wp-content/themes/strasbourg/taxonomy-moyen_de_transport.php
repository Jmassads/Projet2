<?php get_header(); ?>

<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/city.jpg') ?>);"></div>
    <div class="page-banner__content container-fluid t-center c-white">
        <h2 class="page-banner__title">
          <?php the_title();?>
        </h2>
    </div>
</div>

<section>
<div class="wrap container-fluid">
       

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
            
            <?php if ( has_post_thumbnail() ) { ?>
         <div class="single-post col-xs-12 col-sm-7">
            
            
            <h2 class="headline headline--medium t-center">
                <a href="<?php the_permalink();?>">
                    <?php the_title(); ?>
                </a>
            </h2>
            <p><?php the_content();?></p>
        </div>
                 <div class="col-xs-12 col-sm-5">
                     <div class="featured-image t-center">
                <?php the_post_thumbnail('map');?>
                    </div>
                </div>
  <?php 
      }else{ 
  ?>
      <div class="single-post col-xs-12">
            
            
            <h2 class="headline headline--medium t-center">
                <a href="<?php the_permalink();?>">
                    <?php the_title(); ?>
                </a>
            </h2>
            <p><?php the_content();?></p>
        </div>
      <?php
  } 
  ?> 
      
                 
                 
            
                 
            
            
            
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
