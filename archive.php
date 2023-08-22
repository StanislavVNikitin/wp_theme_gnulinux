<?php get_header();?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-8">

	        <?php if (!is_paged()): ?>
                <?php get_template_part('template-parts/featured_category_post');?>
	        <?php endif;?>

            <h5 class="font-weight-bold spanborder"><span><?php _e('Latest','gnulinux');?></span></h5>

	        <?php if (have_posts()) : while (have_posts() ): the_post();?>

		        <?php get_template_part('template-parts/content') ?>

	        <?php endwhile; ?>
                <?php the_posts_pagination(array(
                        'type' => 'list',
                ));?>
            <?php else: ?>

                <p><?php _e('No entries','gnulinux'); ?> </p>

	        <?php endif;?>

        </div>

        <?php get_sidebar();?>

    </div>
</div>



<?php get_footer(); ?>
