<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @subpackage Freenity
 * @since      Freenity 1.0
 */

get_header(); ?>
	<div class="freenity-width content-area">
		<div id="content" class="content-width site-content" role="main">
			<div class="freenity-content entry-content">
				<article class="freenity-not-found post">
					<h1 class="freenity-page-404"><?php _e( 'Error 404', 'freenity' ); ?></h1>
					<p><?php _e( 'The page you are looking for is not found. Maybe try a search?', 'freenity' ); ?></p>
					<?php get_search_form(); ?>
				</article>
			</div><!-- .freenity-content -->
			<?php get_sidebar(); ?>
		</div>  <!-- .content-width -->
	</div> <!-- .freenity-width -->
<?php get_footer();
