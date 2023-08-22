<?php
$main_post_cnt = get_option( 'main_post_cnt' );
if ( $main_post_cnt ) {
    $exclude = '';
    if (is_singular()) {
        $exclude = $post->ID;
    }
	$featured_posts = get_posts( array(
		'meta_key'       => 'is_featured',
		'posts_per_page' => $main_post_cnt,
        'exclude'       => $exclude
	) );
	if ( count( $featured_posts ) > 1 ) {
		$main_featured_post = array_shift( $featured_posts );
	}
}
?>
<?php if ( ! empty( $featured_posts ) ): ?>

    <div class="container pt-4 pb-4">

        <h5 class="font-weight-bold spanborder"><span><?php _e( 'Featured posts', 'gnulinux' ) ?></span></h5>
        <div class="row">
			<?php if ( ! isset( $main_featured_post ) ): // всего 1 пост в избранном ?>
                <div class="col-lg-12">
					<?php
					$post = $featured_posts[0];
					setup_postdata( $post );
					get_template_part( 'template-parts/featured_post-1' );
					wp_reset_postdata();
					?>
                </div>

			<?php else: // более 1 поста в избранном ?>
                <div class="col-lg-6">
					<?php
					$post = $main_featured_post;
					setup_postdata( $post );
					get_template_part( 'template-parts/featured_post-1' );
					wp_reset_postdata();
					?>
                </div>
                <div class="col-lg-6">
                    <div class="flex-md-row mb-4 box-shadow h-xl-300">
						<?php
						foreach ( $featured_posts as $post ) {
							setup_postdata( $post );
							get_template_part( 'template-parts/featured_post-2' );
						}
						wp_reset_postdata();
						?>
                    </div>
                </div>
			<?php endif; ?>
        </div>
    </div>

<?php endif; ?>
