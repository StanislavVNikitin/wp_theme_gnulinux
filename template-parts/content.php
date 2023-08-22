<div class="mb-3 d-flex justify-content-between">
    <div class="pr-3">
        <h2 class="mb-1 h4 font-weight-bold">
            <a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title() ?></a>
        </h2>
        <?php the_content('');?>
        <div class="card-text text-muted small">
	        <?php the_author() . _e(' in category: ', 'gnulinux') . the_category(', '); ?>
        </div>
	    <?php echo gnulinux_post_meta($post->ID) ?>
    </div>
    <img height="120" style="height: 120px;" src="<?php echo the_post_thumbnail_url('full') ?>">
</div>
