<?php // Template name: Homepage ?>
<?php get_header(); ?>

<section class="homepage-welcome">
	<div class="row">
		<div class="column">
			<h1 class="welcome-title"><?php the_title(); ?></h1>
			<div class="welcome-content">
				<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>
				<?php endwhile; ?>
			</div><!-- .welcome-content -->
		</div><!-- .column -->
	</div><!-- .row -->
</section><!-- .homepage-welcome -->

<section class="homepage-listing">
	<div class="row">
		<div class="column">
			<?php
			$args = array(
				'posts_per_page' => '50'
			);

			$the_query = new WP_Query( $args ); ?>

			<?php if ( $the_query->have_posts() ) : ?>

				<div class="posts-list">
					<h2 class="posts-list-header"><?php _e("Recently published:", "micro") ?></h2>
				<!-- the loop -->
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<a href="<?php the_permalink(); ?>" class="entry list-item">
							<span class="date"><?php echo get_the_date(); ?></span>
							<h3 class="title"><?php the_title(); ?></h3>
							<span class="comments"><?php comments_number() ?></span>
						</a>
					<?php endwhile; ?>
				</div>
				<!-- end of the loop -->

				<?php wp_reset_postdata(); ?>

			<?php endif; ?>
		</div><!-- .column -->
	</div><!-- .row -->
</section><!-- .homepage-listing -->

<?php get_footer(); ?>