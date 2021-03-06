<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @subpackage Freenity
 * @since      Freenity 1.0
 */

get_header(); ?>
	<div class="freenity-width">
		<div id="content" class="content-width" role="main">
			<div class="freenity-content">
				<div class="freenity-breadcrumb"> <?php freenity_breadcrumb(); ?> </div>
				<div class="freenity-single-post">
					<?php if ( have_posts() ) {
						while ( have_posts() ) {
							the_post(); ?>
							<div <?php post_class(); ?>>
								<h2 class="title-article">
									<?php the_title(); ?>
								</h2>
								<div class="freenity-entry">
									<span class="freenity-edit"><?php edit_post_link( __( 'Edit', 'freenity' ) ); ?> </span>
									<div class="freenity-post-image"> <?php the_post_thumbnail(); ?> </div>
									<?php if ( has_post_thumbnail() ) {
										do_action( 'freenity_thumbnail_caption' );
									} ?>
									<article class="freenity-content-article">
										<?php the_content();
										wp_link_pages(
											array(
												'before'      => '<div class="page-links">',
												'after'       => '</div>',
												'link_before' => '<span class = "page-links-number">&nbsp;',
												'link_after'  => '&nbsp;</span>',
											)
										); ?>
									</article>
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
							<div class="freenity-clear"></div>
							<div class="freenity-media-profile">
								<div class="freenity-avatar">
									<?php echo get_avatar( get_the_author_meta( 'ID' ), '90' ); ?>
								</div>
								<div class="freenity-author-description">
									<h4>
										<span class="freenity-author"><?php _e( 'Author:', 'freenity' ) ?></span><?php printf( esc_attr( '%s' ), get_the_author() ); ?>
									</h4>
									<div class="freenity-author-meta">
										<?php echo wp_kses( get_the_author_meta( 'description' ), null ); ?>
									</div>
								</div>
								<div class="freenity-profile-links">
									<ul class="freenity-social-links">
										<li class="freenity-follow-author"> <?php printf( __( 'Follow', 'freenity' ) . '' . esc_attr( '%s' ) . __( 'on ', 'freenity' ) . ' ', get_the_author() ); ?> </li>
										<?php if ( get_the_author_meta( 'facebook' ) != '' ) { ?>
											<li>
												<a class="freenity-facebook-link" href="<?php echo esc_url( get_the_author_meta( 'facebook' ) ); ?>">
													<i class="fa fa-facebook-square"></i>
												</a></li>
										<?php } ?>
										<?php if ( get_the_author_meta( 'twitter' ) != '' ) { ?>
											<li>
												<a class="freenity-twitter-link" href="https://twitter.com/<?php echo wp_kses( get_the_author_meta( 'twitter' ), null ); ?>">
													<i class="fa fa-twitter"></i>
												</a></li>
										<?php } ?>
										<?php if ( get_the_author_meta( 'googleplus' ) != '' ) { ?>
											<li>
												<a class="freenity-google-link" href="<?php echo esc_url( get_the_author_meta( 'googleplus' ) ); ?>">
													<i class="fa fa-google-plus"></i>
												</a></li>
										<?php } ?>
										<?php if ( get_the_author_meta( 'instagram' ) != '' ) { ?>
											<li>
												<a class="freenity-instagram-link" href="<?php echo esc_url( get_the_author_meta( 'instagram' ) ); ?>">
													<i class="fa fa-instagram"></i>
												</a></li>
										<?php } ?>
										<?php if ( get_the_author_meta( 'RSS' ) != '' ) { ?>
											<li><a class="freenity-rss-link" href="<?php echo esc_url( get_the_author_meta( 'RSS' ) ); ?>">
													<i class="fa fa-rss"></i>
												</a></li>
										<?php } ?>
									</ul>
								</div> <!--.freenity-profile-links-->
							</div> <!--.freenity-media-profile-->
							<div class="freenity-clear"></div>
							<div class="comments"><?php comments_template(); ?></div>
						<?php }
					} else {
						get_template_part( 'content', 'none' );
					} ?>
				</div><!-- .freenity-single-post -->
			</div><!-- .freenity-content -->
			<?php get_sidebar(); ?>
		</div>  <!-- .content-width -->
	</div> <!-- .freenity-width -->
<?php get_footer();
