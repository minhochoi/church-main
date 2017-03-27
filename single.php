<?php get_template_part('templates/content-single', get_post_type()); ?>

<!-- <?php
if (have_posts()) : while (have_posts()) : the_post();

if( is_category( 'Portfolio' ) ):
get_template_part( 'single','portfolio' );
else if ( is_category( 'News' ) ):
get_template_part( 'single','news' );
else( is_category( 'parameter' ) ):
get_template_part('templates/content', 'single');
endwhile;
?>

 -->