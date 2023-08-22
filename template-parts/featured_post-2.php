<div class="mb-3 d-flex align-items-center">
    <img height="80" style="height: 80px;" src="<?php echo the_post_thumbnail_url('full'); ?>">
    <div class="pl-3">
        <h2 class="mb-2 h6 font-weight-bold">
            <a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
        <div class="card-text text-muted small">
	        <?php the_author() . _e(' in category: ', 'gnulinux') . the_category(', '); ?>
        </div>
		<?php echo gnulinux_post_meta($post->ID) ?>
    </div>
</div>