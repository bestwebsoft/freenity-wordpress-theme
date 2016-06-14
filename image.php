<?php
/**
 * The template for displaying image attachments
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
									<a href="<?php echo esc_url( get_the_permalink() ); ?>" rel="bookmark" title="<?php the_title_attribute( array( 'before' => __( 'Permalink to ', 'freenity' ), 'after' => '' ) ); ?>"><?php the_title(); ?></a></h2>
								<div class="freenity-entry">
									<span class="freenity-author"><?php the_author_posts_link(); ?></span>
									<span class="freenity-entry-date"><a href="<?php freenity_date_permalink( $post ); ?>"><?php echo '&nbsp;- ' . get_the_date(); ?></a></span>
									<span class="freenity-edit"><?php edit_post_link( ' | ' . __( 'Edit', 'freenity' ) ); ?> </span>
									<div class="freenity-post-image"> <?php the_post_thumbnail(); ?> </div>
									<?php if ( has_post_thumbnail() ) {
										do_action( 'freenity_thumbnail_caption' );
									} ?>
									<article class="freenity-content-article">
										<div class="entry-attachment">
											<div class="attachment">
												<?php $attachments = array_values( get_children( array(
													'post_parent'    => $post->post_parent,
													'post_status'    => 'inherit',
													'post_type'      => 'attachment',
													'post_mime_type' => 'image',
													'order'          => 'ASC',
													'orderby'        => 'menu_order ID',
												) ) );
												foreach ( $attachments as $k => $attachment ) {
													if ( $attachment->ID == $post->ID ) {
														break;
													}
												}
												$k ++;
												if ( count( $attachments ) > 1 ) {
													if ( isset( $attachments[ $k ] ) ) {
														// get the URL of the next image attachment
														$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
													} else {
														// or get the URL of the first image attachment
														$next_attachment_url = get_attachment_link( $attachments[0]->ID );
													}
												} else {
													// or, if there's only 1 image, get the URL of the image
													$next_attachment_url = wp_get_attachment_url();
												} ?>
												<a href="<?php echo esc_url( $next_attachment_url ); ?>" title="<?php the_title_attribute(); ?>" rel="attachment">
													<?php $attachment_size = apply_filters( 'freenity_attachment_size', array( 560, 460 ) );
													echo wp_get_attachment_image( $post->ID, $attachment_size ); ?>
												</a>
												<?php if ( ! empty( $post->post_excerpt ) ) { ?>
													<div class="wp-caption-text">
														<?php the_excerpt(); ?>
													</div>
												<?php } ?>
											</div><!-- .attachment -->
										</div><!-- .entry-attachment -->
										<nav id="image-nav" class="image-navigation" role="navigation">
											<div class="freenity-image-nav-prev alignleft"><?php previous_image_link( false, '&laquo;&nbsp;' . __( 'Previous', 'freenity' ) ); ?></div>
											<div class="freenity-image-nav-next alignright"><?php next_image_link( false, __( 'Next', 'freenity' ) . '&nbsp;&raquo;' ); ?></div>
											<div class="freenity-clear"></div>
										</nav>
										<?php the_content();
										wp_link_pages(
											array(
												'before'      => '<div class="page-links">',
												'after'       => '</div>',
												'link_before' => '<span class = "page-links-number">&nbsp;',
												'link_after'  => '&nbsp;</span>',
											)
										); ?>
									</article> <!-- .freenity-content-article -->
									<div class="freenity-tags"><?php echo get_the_tag_list( '<i class="fa fa-tags"></i>', ', ', '' ); ?></div>
								</div><!-- .freenity-entry -->
							</div><!-- post class -->
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
										<li class="freenity-follow-author"> <?php printf( __( 'Follow', 'freenity' ) . ' ' . esc_attr( '%s' ) . __( 'on ', 'freenity' ) . ' ', get_the_author() ); ?> </li>
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
							<?php do_action( 'freenity_post_nav' ); ?>
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
