<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Micro
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer section-fullwidth" role="<?php _e( 'contentinfo', 'textdomain' ); ?>">
		<div class="row">
			<div class="columns small-12">
				<div class="site-info">
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'micro' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'micro' ), 'WordPress' ); ?></a>
					<span class="sep"> | </span>
					<?php printf( esc_html__( 'Theme: %1$s, developed by %2$s.', 'micro' ), 'micro', '<a href="http://devrix.com">DevriX</a>' ); ?>
				</div><!-- .site-info -->
			</div><!-- .small-12 -->
		</div><!-- .row -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
