<?php
/**
 * secure-care-pathway-standards-scotland Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package secure-care-pathway-standards-scotland
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_SECURE_CARE_PATHWAY_STANDARDS_SCOTLAND_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'secure-care-pathway-standards-scotland-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_SECURE_CARE_PATHWAY_STANDARDS_SCOTLAND_VERSION, 'all' );
	wp_enqueue_script('secure-care-pathway-standards-scotland-theme-js', get_stylesheet_directory_uri() . '/script.js', array('astra-theme-js'), CHILD_THEME_SECURE_CARE_PATHWAY_STANDARDS_SCOTLAND_VERSION, 'all');

}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );


//add custom image size
add_image_size( 'standards-listing', 320, 220, true );
add_filter( 'image_size_names_choose','sec_care_custom_image_sizes' );

function sec_care_custom_image_sizes( $sizes ) {
  return array_merge( $sizes, array(
  //Add your custom sizes here
  'standards-listing' => __( 'Standards thumb' ),
  ) );
}


//Add the category type to the body tag style
add_filter('body_class','add_category_to_single');
  function add_category_to_single($classes) {
    if (is_single() ) {
      global $post;
      foreach((get_the_category($post->ID)) as $category) {
        // add category slug to the $classes array
        $classes[] = 'cat-' . $category->category_nicename;
      }
    }
    // return the $classes array
    return $classes;
  }


  // function that runs when shortcode is called
function scs_render_navbuttons( $atts = [], $content = null ) {
  ob_start();
  if ( $atts['dir'] == 'true'){
    $content = next_post_link('%link','<img width="50px" style="opacity:0.4;" class="stnbtn nextbtn" src="' . get_stylesheet_directory_uri() . '/nav-arrow.svg" />');
  }elseif ( $atts['dir'] == 'false'){
    $content = previous_post_link('%link','<img width="50px" style="opacity:0.4;transform: scaleX(-1);" class="stnbtn prvbtn" src="' . get_stylesheet_directory_uri() . '/nav-arrow.svg" />');
  }

  if (!is_null($content)) {
      // secure output by executing the_content filter hook on $content
      $content = apply_filters('the_content', $content);
  }

  echo $content;
  return ob_get_clean();
} 


function scs_shortcodes_init(){
  add_shortcode('standardsnav', 'scs_render_navbuttons');
}
 
add_action('init', 'scs_shortcodes_init', 20);


// Shortcode to render edit button where we want it
add_shortcode('standardsnext', function () {
  ob_start();
  $gfxpath = get_stylesheet_directory_uri() . '/nav-arrow.svg';
  $gfxtag = '<img width="50px" style="opacity:0.4;" class="stnbtn nextbtn" src="' . $gfxpath . '" />';
  $content = next_post_link('%link',$gfxtag);
  echo $content;
  return ob_get_clean();
});

// Add feature to toolset to allow counting fields
add_shortcode('count_rf_entries', 'func_count_rf_entries');
function func_count_rf_entries($atts, $content){
    $atts = shortcode_atts( array(
        'field' => '',
        'post_id' => get_the_ID(),
    ), $atts );
       
    $field = get_post_meta($atts['post_id'], "wpcf-".$atts['field'], false);
    $res = 0;
    if(is_array($field)){
        $res = count($field);
    }
    return $res;
}
