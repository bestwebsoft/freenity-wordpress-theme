<?php
/**
 * The template part for displaying a message that posts cannot be found
 *
 * Learn more: {@link https://codex.wordpress.org/Template_Hierarchy}
 *
 * @subpackage Freenity
 * @since      Freenity 1.0
 */
?>

<h1 class="page-title"><?php _e( 'Nothing Found', 'freenity' ); ?></h1>
<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
		<p><?php printf( __( 'Ready to publish your first post?', 'freenity' ) . '<a href="%1$s">' . __( 'Get started here.', 'freenity' ) . '</a>', admin_url( 'post-new.php' ) ); ?></p>
	<?php } elseif ( is_search() ) { ?>
		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'freenity' ); ?></p>
		<?php get_search_form(); ?>
	<?php } else { ?>
		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'freenity' ); ?></p>
		<?php get_search_form(); ?>
	<?php } ?>
</div><!-- .page-content -->
