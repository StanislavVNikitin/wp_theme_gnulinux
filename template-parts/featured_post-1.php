<div class="card border-0 mb-4 box-shadow h-xl-300">
	<div style="background-image: url(<?php echo the_post_thumbnail_url('full'); ?>); height: 150px;    background-size: cover;    background-repeat: no-repeat;"></div>
	<div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
		<h2 class="h4 font-weight-bold">
			<a class="text-dark" href="<?php the_permalink(); ?>"><?php the_title() ?></a>
		</h2>
		<?php the_content();?>
		<div>
			<small class="d-block card-text text-muted small">
				<?php the_author() . _e(' in category: ', 'gnulinux') . the_category(', '); ?>
			</small>
			<?php echo gnulinux_post_meta($post->ID) ?>
		</div>
	</div>
</div>