<?php
/**
 * The sidebar
 *
 * @subpackage Freenity
 * @since      Freenity 1.0
 */
?>
<div id="tertiary" class="sidebar-container" role="complementary">
	<div class="right-sidebar">
		<div id="true-side" class="sidebar-right">
			<?php if ( is_active_sidebar( 'freenity-sidebar' ) ) {
				dynamic_sidebar( 'freenity-sidebar' );
			} else {
				the_widget( 'WP_Widget_Search' );
				the_widget( 'WP_Widget_Recent_Posts' );
				the_widget( 'WP_Widget_Recent_Comments' );
				the_widget( 'WP_Widget_Archives' );
				the_widget( 'WP_Widget_Categories' );
				the_widget( 'WP_Widget_Tag_Cloud' );
			} ?>
		</div>
	</div>
</div>
<div class="freenity-clear"></div>
