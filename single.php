<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Micro
 */

get_header(); ?>

	<section class="section-fullwidth section-main">
		<div class="row">
			<div class="columns small-12 medium-8">
				<div id="primary" class="content-area">
					<main id="main" class="site-main">

					<?php
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', get_post_format() );

						the_post_navigation();

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;

					endwhile; // End of the loop.
					?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- .columns small-12 medium-8 -->
			<div class="columns small-12 medium-4">
				<?php get_sidebar(); ?>
			</div><!-- .columns small-12 medium-4 -->
		</div><!-- .row -->
	</section><!-- .section-fullwidth section-main -->

<?php
get_footer();
