<?php
	$category = get_queried_object();
	$cat_id = $category->term_id;
	$cat_name = $category->name;

$featured_posts = get_posts( array(
	'meta_key'       => 'is_featured',
	'posts_per_page' => 1,
	'category'      => $cat_id,
) );

if (!empty($featured_posts)):
	$post =$featured_posts[0];
	setup_postdata($post);
?>

	<h5 class="font-weight-bold spanborder"><span><?php echo __('Featured in category: ','gnulinux') . $cat_name;?></span></h5>
	<div class="card border-0 mb-5 box-shadow">
		<div style="background-image: url(<?php the_post_thumbnail_url('full');?>); height: 350px; background-size: cover; background-repeat: no-repeat;">
		</div>
		<div class="card-body px-0 pb-0 d-flex flex-column align-items-start">
			<h2 class="h2 font-weight-bold">
				<a class="text-dark" href="<?php the_permalink();?>"><?php the_title();?></a>
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

	<?php wp_reset_postdata(); endif;?>