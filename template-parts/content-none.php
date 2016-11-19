<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Micro
 */

?>

<div class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'micro' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'micro' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'micro' ); ?></p>
			<?php
				get_search_form();

		else : ?>

			<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'micro' ); ?></p>
			<?php
				get_search_form();

		endif; ?>

		<?php
		$args = array(
			'posts_per_page' => '10'
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
					</a>
				<?php endwhile; ?>
			</div>
			<!-- end of the loop -->

			<?php wp_reset_postdata(); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</div><!-- .no-results -->
