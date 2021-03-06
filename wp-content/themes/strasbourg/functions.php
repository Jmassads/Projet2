<?php
/**
 * strasbourg functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package strasbourg
 */

if ( ! function_exists( 'strasbourg_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function strasbourg_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on strasbourg, use a find and replace
		 * to change 'strasbourg' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'strasbourg', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		function register_my_menus() {
          register_nav_menus(
            array(
              'header-menu' => __( 'Header Menu' ),
              'header-menu-bottom' => __( 'Header Menu Bottom' ),
              'footer-1-menu' => __( 'Footer One' ),
              'footer-2-menu' => __( 'Footer Two' )
            )
          );
        }
        add_action( 'init', 'register_my_menus' );
        
        

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'strasbourg_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'strasbourg_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function strasbourg_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'strasbourg_content_width', 640 );
}
add_action( 'after_setup_theme', 'strasbourg_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function strasbourg_widgets_init() {
    
    register_sidebar( array(
		'name'          => esc_html__( "Widget Météo" , 'strasbourg' ),
		'id'            => "meteo",
		'description'   => esc_html__( 'Les prévisions météo', 'strasbourg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( "Widget Multilingue" , 'strasbourg' ),
		'id'            => "langues",
		'description'   => esc_html__( 'Widget qui permet de choisir la langue de votre choix.', 'strasbourg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
    
    register_sidebar( array(
		'name'          => esc_html__( "Barre de recherche" , 'strasbourg' ),
		'id'            => "search",
		'description'   => esc_html__( 'Barre de recherche ajax', 'strasbourg' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	) );
    
    
    
    
}
add_action( 'widgets_init', 'strasbourg_widgets_init' );

function strasbourg_scripts(){
    //adding css stylesheets
    wp_register_style( 'Font_Awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );    
    wp_register_style( 'Iconicons', 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' );
    wp_register_style( 'slick', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css');
    wp_register_style('slick_theme','https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css');
    wp_register_style('bxslider_css', 'https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.min.css');
    wp_register_style('slider_pro', get_template_directory_uri() . '/css/slider-pro.min.css');
    wp_register_style('style', get_template_directory_uri() . '/style.css');
    wp_register_style('custom-style', get_template_directory_uri() . '/css/style.css');
    
    //Enqueue the styles
    wp_enqueue_style('Font_Awesome');
    wp_enqueue_style('slider_pro');
    wp_enqueue_style('Iconicons');
    wp_enqueue_style('slick');
    wp_enqueue_style('slick_theme');
    wp_enqueue_style('bxslider_css');
    wp_enqueue_style('custom-style');

    // add Javascript files
    wp_register_script( 'jQuery', 'https://code.jquery.com/jquery-2.2.4.min.js', null, null, true);
    wp_register_script('ScrollMagic', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.5/ScrollMagic.min.js', null, null, true);
    wp_register_script('bxslider_js', 'https://cdn.jsdelivr.net/bxslider/4.2.12/jquery.bxslider.min.js', null, null, true);
    wp_register_script('sticky', get_template_directory_uri() . '/js/jquery.sticky.min.js', array(), '20151215', true );
    wp_register_script( 'strasbourg-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
    wp_register_script( 'strasbourg-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    wp_register_script( 'slick-js', get_template_directory_uri() . '/js/slick.min.js', array(), '20151215', true );
    wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '20151215', true );
    wp_register_script( 'slider_pro', get_template_directory_uri() . '/js/jquery.sliderPro.min.js', array(), '20151215', true );
    wp_register_script( 'custom-js', get_template_directory_uri() . '/js/styles.js', array(), '20151215', true );
    
    //Enqueue the javascript scripts
    wp_enqueue_script('jQuery');
    wp_enqueue_script('slider_pro');
    wp_enqueue_script('ScrollMagic');
    wp_enqueue_script('bxslider_js');
    wp_enqueue_script('sticky');
    wp_enqueue_script('strasbourg-navigation');
    wp_enqueue_script('strasbourg-skip-link-focus-fix');
    wp_enqueue_script('slick-js');
    wp_enqueue_script('bootstrap-js');
    wp_enqueue_script('custom-js');
    
    if( is_front_page() )
    {
      
    }
 
}
add_action( 'wp_enqueue_scripts', 'strasbourg_scripts' );

/* Custom Image Sizes */
add_image_size('tiny-thumbnail', 100, 100, true);
add_image_size('post', 464, 261, true);
add_image_size('map', 450, 450, false);

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

function tag_filter($query) {
  if ( !is_admin() && $query->is_main_query() ) {
    if ($query->is_tag) {
      $query->set('post_type', array( 'custom_post_type', ));
    }
  }
}
add_action('pre_get_posts','tag_filter');

function my_acf_google_map_api( $api ){
	
	$api['key'] = 'AIzaSyD0sjX3pkkFEccn5cfoSbFqroiEY5HM7s0';
	
	return $api;
	
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');

function wpcf7_sourceurl_shortcode_handler($tag) {
    if (!is_object($tag)) return '';

    $name = $tag['name'];
    if (empty($name)) return '';

    $html = '<input type="hidden" name="' . $name . '" value="' . get_the_title() . '" />';
   return $html;
}
remove_filter ('acf_the_content', 'wpautop');

/*  Script for no-js / js class
/* ------------------------------------ */
function alx_html_js_class () {
    echo '<script>document.documentElement.className = document.documentElement.className.replace("no-js","js");</script>'. "\n";
}
add_action( 'wp_head', 'alx_html_js_class', 1 );

wpcf7_add_form_tag('hidden', 'wpcf7_sourceurl_shortcode_handler', true);


function wpb_add_google_fonts() {
 
wp_enqueue_style( 'wpb-google-fonts', 'http://fonts.googleapis.com/css?family=Roboto+Condensed:300,400', false ); 
}
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );


function isa_add_img_title( $attr, $attachment = null ) {

    $img_title = trim( strip_tags( $attachment->post_title ) );

    $attr['title'] = $img_title;
    $attr['alt'] = $img_title;

    return $attr;
}
add_filter( 'wp_get_attachment_image_attributes','isa_add_img_title', 10, 2 );
 



add_filter('script_loader_tag', 'clean_script_tag');

function clean_script_tag($input) {

$input = str_replace("type='text/javascript' ", '', $input);

return str_replace("'", '"', $input);

}

