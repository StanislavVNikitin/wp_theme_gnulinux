<?php get_header(); ?>

<?php the_post();?>
    <div class="container">
        <div class="jumbotron jumbotron-fluid mb-3 pl-0 pt-0 pb-0 bg-white position-relative">
            <div class="h-100 tofront">
                <div class="row justify-content-between">
                    <div class="col-md-6 pb-6 pr-6 align-self-center">
                        <h1 class="display-4 secondfont mb-3 font-weight-bold"><?php the_title();?></h1>
                    </div>
                    <div class="col-md-6 pr-0">
						<?php the_post_thumbnail('full');?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->

    <!--------------------------------------
	MAIN
	--------------------------------------->


    <div class="container pt-4 pb-4">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-10<?php echo $content_class ?>">
                <article class="article-post">
					<?php the_content();?>
                </article>
            </div>
        </div>
    </div>

<?php get_template_part('template-parts/featured_posts');?>

<?php get_footer(); ?>