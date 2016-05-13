<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @subpackage Freenity
 * @since      Freenity 1.0
 */
?>
<footer class="freenity-footer">
	<div class="freenity-content-width">
		<div class="freenity-footer-content">
			<div class="freenity-footer-sidebar">
				<?php if ( is_active_sidebar( 'freenity-footer-sidebar' ) ) { ?>
					<div id="true-side" class="sidebar">
						<?php dynamic_sidebar( 'freenity-footer-sidebar' ); ?>
					</div>
				<?php } else {
					the_widget( 'Freenity_Description_Text' );
				} ?>
			</div>
			<div class="freenity-footer-down">
				<div class="freenity-copyright">
					<p><?php _e( 'Copyright', 'freenity' ); ?>
						<a href="<?php echo esc_url( wp_get_theme()->get( 'AuthorURI' ) ); ?>">BestWebLayout</a> <?php _e( 'and', 'freenity' ); ?>
						<a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>">WordPress</a></p>
					<p>&copy;<?php echo date( 'Y' ) . '&nbsp;';
						bloginfo( 'name' ); ?></p>
				</div>
				<?php do_action( 'freenity_contact_data' ); ?>
			</div>
		</div><!-- .freenity-footer-content -->
	</div><!-- .freenity-content-width -->
</footer>
</div><!-- .wrapper -->
<?php wp_footer(); ?>
</body>
</html>
