<?php
/**
 * Template Name: Sermons Template
 */
?>

<div class="container">
    <div class="row">
        <?php $posts = query_posts('category_name=Sermon&post_type=post&post_status=publish&posts_per_page=-1'); ?>
        <?php if( have_posts() ): ?>
            <?php while( have_posts() ): the_post(); ?>
                <div class="sub col-sm-6 col-md-3">
                    <a href="<?php echo get_permalink(); ?>">
                        <h4><?php the_title(); ?></h4>
                        <div class="sub thumbnail">
                            <img src="<?php the_field('main_image');?>" alt="...">
                        </div>
                    </a>
                </div>
            <?php endwhile; ?>
        <?php endif; wp_reset_query(); ?>
    </div>
</div>
