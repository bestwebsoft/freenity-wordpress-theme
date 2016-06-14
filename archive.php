<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 *
 * @subpackage Freenity
 * @since      Freenity 1.0
 */

get_header(); ?>
	<div class="freenity-width">
		<div id="content" class="content-width" role="main">
			<div class="freenity-content">
				<div class="freenity-post-area">
					<h1 class="freenity-archive"><?php the_archive_title(); ?></h1>
					<h2><?php the_archive_description(); ?></h2>
					<?php if ( have_posts() ) {
						while ( have_posts() ) {
							the_post(); ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<h2 class="title-article">
									<a href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute( array( 'before' => __( 'Permalink to ', 'freenity' ), 'after' => '' ) ); ?>"><?php the_title(); ?></a>
								</h2>
								<div class="freenity-entry">
									<span class="freenity-author"><?php the_author_posts_link(); ?></span>
									<span class="freenity-entry-date"><a href="<?php freenity_date_permalink( $post ); ?>"><?php echo '&nbsp;- ' . get_the_date(); ?></a></span>
									<span class="freenity-edit"><?php edit_post_link( ' | ' . __( 'Edit', 'freenity' ) ); ?> </span>
									<div class="freenity-post-image-archive"><?php the_post_thumbnail(); ?></div>
									<?php if ( has_post_thumbnail() ) {
										do_action( 'freenity_thumbnail_caption' );
									} ?>
									<div class="freenity-post-excerpt">
										<?php the_excerpt();
										wp_link_pages(
											array(
												'before'      => '<div class="page-links">',
												'after'       => '</div>',
												'link_before' => '<span class="page-links-number">&nbsp;',
												'link_after'  => '&nbsp;</span>',
											)
										); ?>
									</div>
									<div class="freenity-tags"><?php echo get_the_tag_list( '<i class="fa fa-tags"></i>', ', ', '' ); ?></div>
									<div class="freenity-category">
										<?php echo __( 'In', 'freenity' ) . ' ';
										the_category( ', ' ); ?>
									</div>
									<?php if ( has_post_format( array( 'link', 'video' ) ) ) { ?>
										<span class="freenity-info">
											<?php echo __( 'Posted by', 'freenity' ) . ' ';
											the_author_posts_link();
											echo ' ' . __( 'on', 'freenity' ) . ' ';
											the_date();
											echo ' ' . __( 'in', 'freenity' ) . ' ';
											the_category( ', ' ); ?>
											<span class="freenity-edit"><?php edit_post_link( ' | ' . __( 'Edit', 'freenity' ) ); ?> </span>
										</span>
									<?php } ?>
								</div><!-- .freenity-entry -->
							</div><!--.post-ID -->
							<hr />
						<?php }
					} else {
						get_template_part( 'content', 'none' );
					} ?>
				</div><!-- .freenity-post-area -->
				<?php freenity_paging_nav(); ?>
			</div><!-- .freenity-content -->
			<?php get_sidebar(); ?>
		</div>  <!-- .content-width -->
	</div> <!-- .freenity-width -->
<?php get_footer();
