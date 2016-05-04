<?php
/**
 * The template for displaying Search Results pages
 *
 * @subpackage Twenty_Fifteen
 * @since      Twenty Fifteen 1.0
 */

get_header(); ?>
	<div class="freenity-width">
		<div id="content" class="content-width" role="main">
			<div class="freenity-content">
				<div class="freenity-post-area">
					<?php if ( have_posts() ) { ?>
						<h1 class="search"><?php printf( __( 'Search Results for:', 'freenity' ) . ' ' . '%s', get_search_query() ); ?></h1>
						<?php while ( have_posts() ) {
							the_post(); ?>
							<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<h2 class="title-article">
									<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php echo __( 'Permalink to', 'freenity' ) . '&nbsp;';
									the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<div class="freenity-entry">
									<span class="freenity-author freenity-author-search"><?php the_author_posts_link(); ?></span>
									<span class="freenity-entry-date"><?php echo '&nbsp;- ' . get_the_date(); ?></span>
									<span class="freenity-edit"><?php edit_post_link( ' | ' . __( 'Edit', 'freenity' ) ); ?></span>
									<div class='post-image-search'> <?php the_post_thumbnail(); ?> </div>
									<?php if ( has_post_thumbnail() ) {
										do_action( 'freenity_thumbnail_caption' );
									} ?>
									<div class="freenity-post-excerpt">
										<?php the_excerpt();
										wp_link_pages(
											array(
												'before'      => '<div class="page-links">',
												'after'       => '</div>',
												'link_before' => '<span class = "page-links-number">&nbsp;',
												'link_after'  => '&nbsp;</span>',
											)
										); ?>
									</div>
									<div class="freenity-clear"></div>
									<div class="freenity-tags"><?php echo get_the_tag_list( '<i class="fa fa-tags"></i>', ', ', '' ); ?></div>
									<div class="freenity-category"><?php echo __( 'In', 'freenity' ) . ' ';
										the_category( ', ' ); ?></div>
									<?php if ( has_post_format( array( 'link', 'video' ) ) ) { ?>
										<span class="freenity-info"><?php echo __( 'Posted by', 'freenity' ) . ' ';
											the_author_posts_link();
											echo ' ' . __( 'on', 'freenity' ) . ' ';
											the_date();
											echo ' ' . __( 'in', 'freenity' ) . ' ';
											the_category( ', ' ); ?>
											<span class="freenity-edit"><?php edit_post_link( ' | ' . __( 'Edit', 'freenity' ) ); ?> </span>	
									</span>
									<?php } ?>
								</div><!-- .freenity-entry -->
							</div><!-- post -->
							<hr />
						<?php }
					} else {
						get_template_part( 'content', 'none' );
					} ?>
				</div> <!-- .freenity-post-area -->
				<?php freenity_paging_nav(); ?>
			</div> <!-- .freenity-content -->
			<?php get_sidebar(); ?>
		</div>  <!-- .content-width -->
	</div> <!-- .freenity-width -->
<?php get_footer();
