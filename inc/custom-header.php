<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Micro
 */

function micro_customiser_settings( $wp_customize ) {

	// Remove the default color settings.
	$wp_customize->remove_section( 'colors' );
	// $wp_customize->remove_section( 'header_image' );

	$wp_customize->add_section( 'micro_color_settings' , array(
		'title'      => __( 'Micro colors', 'micro' ),
		'priority'   => 30,
	) );

	$wp_customize->add_setting( 'micro_text_color' , array(
		'default'     => '#b2df82',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'micro_text_color', array(
		'label'        => __( 'Primary color', 'micro' ),
		'section'    => 'micro_color_settings',
		'settings'   => 'micro_text_color',
	) ) );

	$wp_customize->add_setting( 'micro_background_color' , array(
		'default'     => '#0f110c',
		'transport'   => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color'
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'micro_background_color', array(
		'label'        => __( 'Secondary color', 'micro' ),
		'section'    => 'micro_color_settings',
		'settings'   => 'micro_background_color',
	) ) );

}
add_action( 'customize_register', 'micro_customiser_settings' );

function micro_customize_css() {
	?>
	<style type="text/css">
		/* Normal background color and text */
		body, code, kbd, tt, var, pre, input, textarea, select,
		.wp-block-button.is-style-outline .wp-block-button__link {
			color: <?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>;
			background-color: <?php echo esc_attr ( get_theme_mod( 'micro_background_color', '#060c08' ) ); ?>;
		}

		hr {
			background-color: <?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>;
		}

		::-webkit-input-placeholder {
			color: <?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>;
		}

		::-moz-placeholder {
			color: <?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>;
		}

		:-ms-input-placeholder {
			color: <?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>;
		}

		:-moz-placeholder {
			color: <?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>;
		}

		/* Inverted background color and text */
		a:hover,
		.entry .entry-title,
		.comment-form-comment label,
		.form-submit input[type="submit"],
		.widget_calendar caption,
		.comments-area .comments-title,
		.main-navigation.is-extended .sub-menu a:hover,
		.menu-toggle,
		.wp-block-table.is-style-stripes tbody tr:nth-child(odd),
		.wp-block-file .wp-block-file__button,
		.wp-block-button__link {
			color: <?php echo esc_attr ( get_theme_mod( 'micro_background_color', '#060c08' ) ); ?>;
			background-color: <?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>;
		}

		/* Overwrite for links */
		a,
		.main-navigation .menu-item a,
		.main-navigation .sub-menu a:hover,
		.main-navigation .children a:hover,
		.wp-block-latest-posts__post-date,
		.wp-block-latest-comments__comment-date,
		button, input  {
			color: <?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>;
		}

		/* Borders */
		input, button, textarea, select
		.site-footer,
		.homepage-welcome,
		.wp-block-table.is-style-stripes,
		.wp-block-file .wp-block-file__button,
		.wp-block-button.is-style-outline .wp-block-button__link  {
			border-color: <?php echo esc_attr ( get_theme_mod( 'micro_text_color', '#b2df82' ) ); ?>;
		}

		.entry .entry-title a,
		.entry .entry-title a:hover {
			color: <?php echo esc_attr ( get_theme_mod( 'micro_background_color', '#060c08' ) ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'micro_customize_css');
