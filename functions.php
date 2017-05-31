<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php' // Theme customizer
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);


define(SINGLE_PATH, TEMPLATEPATH . '/post');
add_filter('single_template', 'my_single_template');
function my_single_template($single) {
global $wp_query, $post;
foreach((array)get_the_category() as $cat) :
if(file_exists(SINGLE_PATH . '/single-' . $cat->slug . '.php'))
  return SINGLE_PATH . '/single-' . $cat->slug . '.php';
elseif(file_exists(SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php'))
  return SINGLE_PATH . '/single-cat-' . $cat->term_id . '.php';
endforeach;
}

function custom_field_excerpt($id) 
{
  global $post;
  $text = get_field('content', $id);

  if ( '' != $text ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $excerpt_length = 80; 
    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
  }
  return apply_filters('the_excerpt', $text);
}

function custom_field_excerpt3() 
{
  global $post;
  $text = get_field('content');
  if ( '' != $text ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $excerpt_length = 80; 
    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
  }
  return apply_filters('the_excerpt', $text);
}

function custom_field_excerpt2($text) {
  global $post;
  if ( '' != $text ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $text = str_replace('<br/>', 'hello', $text);
    $excerpt_length = 10; // 20 words
    // $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
  }
  return apply_filters('the_excerpt', $text);
}

function custom_field_excerpt4($text) {
  global $post;
  if ( '' != $text ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $text = str_replace('<br/>', 'hello', $text);
    $excerpt_length = 1; // 20 words
    // $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
  }
  return apply_filters('the_excerpt', $text);
}

function custom_field_excerpt5() 
{
  global $post;
  $text = get_field('bio');
  if ( '' != $text ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $excerpt_length = 40; 
    $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
  }
  return apply_filters('the_excerpt', $text);
}

function custom_field_excerpt6() 
{
  global $post;
  $text = get_field('content');
  if ( '' != $text ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $excerpt_length = 25; 
    // $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $text = wp_trim_words( $text, $excerpt_length, '...' );
  }
  return apply_filters('the_excerpt', $text);
}

function custom_field_excerpt7() 
{
  global $post;
  $text = get_field('content');
  if ( '' != $text ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $excerpt_length = 15; 
    // $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $text = wp_trim_words( $text, $excerpt_length, '');
  }
  return apply_filters('the_excerpt', $text);
}

function custom_field_excerpt8() 
{
  global $post;
  $text = get_field('bio');
  if ( '' != $text ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $excerpt_length = 39; 
    // $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $text = mb_strimwidth( $text, 600, 100000, '...');
  }
  return apply_filters('the_excerpt', $text);
}

function custom_field_excerpt9() 
{
  global $post;
  $text = get_field('bio');
  if ( '' != $text ) {
    $text = strip_shortcodes( $text );
    $text = apply_filters('the_content', $text);
    $text = str_replace(']]>', ']]>', $text);
    $excerpt_length = 40; 
    // $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
    $text = mb_strimwidth( $text, 0, 600,'');
  }
  return apply_filters('the_excerpt', $text);
}

function posts_by_year($catname) {
  // array to use for results
  $years = array();
  $today = date('Ymd');       

  // get posts from WP
  $posts = get_posts(array(
    'numberposts' => -1,
    'meta_query' => array(
    array(
          'key'   => 'eventdate',
          'compare' => '<',
          'value'   => $today,
      )
    ),    
    'meta_key'      => 'eventdate',
    'orderby'     => 'meta_value_num',
    'order'       => 'ASC',
    'post_type' => 'post',
    'post_status' => 'publish',
    'category_name' => $catname
  ));
  // loop through posts, populating $years arrays
  

  foreach($posts as $post) {
    // setup_postdata( $post )
    $post_id = $post->ID;
    $fields = get_field_objects($post_id);
    if( $fields )
    {
      foreach( $fields as $field_name => $field )
      {
        $startDate = 'Event Start Date';
        $label = $field['label'];
        // echo $label;
        if (strcmp ( $label , $startDate ) == 0)
        {
            $eventDate = $field['value'];
        }
      }
    }
    $years[date('Y', strtotime($eventDate))][] = $post;
  }
// wp_reset_postdata();
  // reverse sort by year
  krsort($years);

  return $years;
}

function posts_by_month($yearPosts) {
  // array to use for results
  $month = array();

  foreach($yearPosts as $post) {
    // setup_postdata( $post )
    $post_id = $post->ID;
    $fields = get_field_objects($post_id);

    if( $fields )
    {
      foreach( $fields as $field_name => $field )
      {

        $startDate = 'Event Start Date';
        $label = $field['label'];
        // echo $label;
        if (strcmp ( $label , $startDate ) == 0)
        {
            $eventDate = $field['value'];
        }
      }
    }

    // $fields = get_fields();

    // $years[date('Y', strtotime(the_field('eventdate')))][] = $post;
    $month[date('M', strtotime($eventDate))][] = $post;
  }
  return $month;
}

function excerpt($limit) {
      $excerpt = explode(' ', get_the_excerpt(), $limit);
      if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
      } else {
        $excerpt = implode(" ",$excerpt);
      } 
      $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
      return $excerpt;
}

function content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
        array_pop($content);
        $content = implode(" ",$content).'...';
      } else {
        $content = implode(" ",$content);
      } 
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('the_content', $content); 
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
}


// remove emoji function on head.php
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );