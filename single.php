<?php
if (have_posts()) : while (have_posts()) : the_post();

if( is_category( 'Sermon' ) ):
get_template_part( 'single','sermon' );
else( is_category( 'parameter' ) ):
get_template_part('templates/content', 'single');
endwhile;
?>
