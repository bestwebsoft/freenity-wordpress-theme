<?php
/**
 * The Header for our theme
 *
 * @subpackage Freenity
 * @since      Freenity 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif;
	wp_head(); ?>
</head>
<body <?php body_class(); ?> >
<div class="wrapper">
	<div class="freenity-content-width">
		<div class="freenity-header">
			<header>
				<div class="freenity-site-logo">
					<h1 class="freenity-site-title">
						<?php if ( function_exists( 'the_custom_logo' ) ) {
							if ( has_custom_logo() ) {
								the_custom_logo();
							}
						} elseif ( get_theme_mod( 'freenity_logo_header' ) ) { ?>
							<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
								<img src='<?php echo get_theme_mod( 'freenity_logo_header' ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' />
							</a>
						<?php } ?>
						<a href='<?php echo esc_url( home_url( '/' ) ); ?>' title='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' rel='home'>
							<?php bloginfo( 'name' ); ?>
						</a>
					</h1>
				</div>
			</header>
			<div class="freenity-nav">
				<div class="freenity-icon-menu">
					<i class="fa fa-align-justify"></i>
				</div>
				<div class="freenity-top-menu">
					<?php wp_nav_menu( array( 'theme_location' => 'top-menu' ) ); ?>
				</div>
			</div>
		</div> <!-- .freenity-header -->
	</div> <!-- .freenity-content-width -->
	<div class="freenity-head-menu">
		<?php if ( get_header_image() ) { ?>
			<img src="<?php header_image(); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" />
		<?php }
		wp_nav_menu( array(
				'theme_location' => 'head-menu',
				'depth'          => 1,
			)
		); ?>
	</div><!-- .freenity-headmenu -->
