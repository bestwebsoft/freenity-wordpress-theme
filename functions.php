<?php

/* Set content width value based on the theme's design */
if ( ! isset( $content_width ) ) {
	$content_width = 960;
}

/* Register Theme Settings */
function freenity_theme_setup() {

	/* Add theme support for Automatic Feed Links */
	add_theme_support( 'automatic-feed-links' );

	/* Add theme support for Post Formats */
	add_theme_support( 'post-formats', array(
		'status',
		'quote',
		'gallery',
		'image',
		'video',
		'audio',
		'link',
		'aside',
		'chat',
	) );

	/* Add theme support for Featured Images */
	add_theme_support( 'post-thumbnails' );

	/* This theme styles the visual editor with editor-style.css to match the theme style. */
	add_editor_style( 'editor_style.css' );

	/* Add theme support for Custom Background */
	$background_args = array(
		'default-color'      => 'fff',
		'default-image'      => '',
		'default-repeat'     => '',
		'default-position-x' => '',
	);
	add_theme_support( 'custom-background', $background_args );

	/* Add theme support for Custom Header */
	$args = array(
		'default-image'          => '',
		'height'                 => 150,
		'width'                  => 3000,
		'flex-width'             => false,
		'flex-height'            => false,
		'random-default'         => false,
		'uploads'                => true,
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $args );

	/* Add theme support for document Title tag */
	add_theme_support( 'title-tag' );

	/* Add theme support for Translation */
	load_theme_textdomain( 'freenity', get_template_directory() . '/languages' );

	/* Register navigation menu */
	register_nav_menus(
		array(
			'top-menu'  => __( 'Primary Menu', 'freenity' ),
			'head-menu' => __( 'Secondary Menu', 'freenity' ),
		)
	);

	/* Image Size */
	add_image_size( 'freenity_gallery_min', 230, 220, true );
	add_image_size( 'freenity_gallery_large', 370, 300, true );
	add_image_size( 'freenity_gallery_large2', 310, 300, true );
	add_image_size( 'freenity_widget_thumbnail', 60, 60, true );
	add_image_size( 'freenity_horizontal_thumbnail', 310, 167, true );
	add_image_size( 'freenity_vertical_thumbnail', 230, 230, true );

	add_theme_support( 'custom-logo', array(
		'height'      => 100,
		'width'       => 100,
		'flex-height' => true,
	) );
}

/* Caption text */
function freenity_thumbnail_caption() {
	echo get_post_field( 'post_excerpt', get_post_thumbnail_id() );
}

/* Breadcrumb navigation */
function freenity_breadcrumb() {
	if ( ! is_front_page() ) {
		echo '<span class = "home"><a href="' . esc_url( home_url() ) . '">' . __( 'Home', 'freenity' ) . ' ' . '</a></span>&#8226;' . ' ';
		if ( is_category() || is_single() ) {
			the_category( ', ' );
			if ( is_single() ) {
				echo ' &#8226; ';
				the_title();
			}
		} elseif ( is_page() ) {
			the_title();
		}
	} else {
		_e( 'Home', 'freenity' );
	}
}

/* Post navigation */
function freenity_post_nav() {
	global $post;
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous ) {
		return;
	} ?>
	<nav class="another-posts" role="navigation">
		<div class="previous-posts"><i class="fa fa-chevron-left"></i><?php previous_post_link( '%link', '%title' ); ?>
		</div>
		<div class="next-posts"><?php next_post_link( '%link', '%title' ); ?><i class="fa fa-chevron-right"></i></div>
	</nav><!-- .another-posts -->
<?php }

/* Paging navigashion. Display navigation to next/previous set of posts when applicable.*/
function freenity_paging_nav() {
	global $wp_query;
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	} ?>
	<nav class="navigation paging-navigation" role="navigation">
		<div class="nav-links">
			<?php if ( get_next_posts_link() ) { ?>
				<div class="nav-previous">
					<span class="meta-nav">&larr;</span><?php next_posts_link( __( 'Older posts', 'freenity' ) ); ?></div>
			<?php } ?>
			<?php if ( get_previous_posts_link() ) { ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'freenity' ) ); ?>
					<span class="meta-nav">&rarr;</span></div>
			<?php } ?>
		</div>
	</nav>
<?php }

/* Comment */
function freenity_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) {
		case 'pingback' : ?>
			<li class="post pingback">
			<span class="pings"><?php _e( 'Pingback:', 'freenity' ) ?> </span>
			<div class="comment-author-info">
				<?php printf( '<span class="comment-autor-link">%s</span>', get_comment_author_link() ); ?>
				<?php printf( '%1$s %2$s', '<span class="comment-date"><em>' . get_comment_date() . '</em></span>', '<span class="comment-time"><em>' . '<span>' . __( 'at', 'freenity' ) . ' ' . '</span>' . get_comment_time() . '</em></span>' ); ?>
				<?php edit_comment_link( ' ' . __( 'Edit', 'freenity' ), ' ' ); ?>
			</div>
			<hr />
			<?php break;
		case 'trackback' : ?>
			<li class="post pingback">
			<span class="pings"><?php _e( 'Trackback:', 'freenity' ) ?> </span>
			<div class="comment-author-info">
				<?php printf( '<span class="comment-autor-link">%s</span>', get_comment_author_link() ); ?>
				<?php printf( '%1$s %2$s', '<span class="comment-date"><em>' . get_comment_date() . '</em></span>', '<span class="comment-time"><em>' . '<span>' . __( 'at', 'freenity' ) . ' ' . '</span>' . get_comment_time() . '</em></span>' ); ?>
				<?php edit_comment_link( ' ' . __( 'Edit', 'freenity' ), ' ' ); ?>
			</div>
			<hr />
			<?php break;
		default : ?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
			<div id="comment-<?php comment_ID(); ?>">
				<div class="author-avatar"><?php echo get_avatar( $comment->comment_author_email, $args['avatar_size'] ); ?></div>
				<div class="comment-body">
					<div class="comment-author-info">
						<?php printf( '<span class="comment-autor-link">%s</span>', get_comment_author_link() ); ?>
						<?php printf( '%1$s %2$s', '<span class="comment-date"><em>' . get_comment_date() . '</em></span>', '<span class="comment-time"><em>' . '<span>' . __( 'at', 'freenity' ) . ' ' . '</span>' . get_comment_time() . '</em></span>' ); ?>
						<?php edit_comment_link( ' ' . __( 'Edit', 'freenity' ), ' ' ); ?>
						<span class="reply">
								<?php comment_reply_link( array_merge( $args, array(
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
								) ) ) ?>
							</span>
					</div>
					<div class="comment-text">
						<?php $comment_type = get_comment_type();
						if ( 'comment' == $comment_type ) {
							comment_text();
						} ?>
					</div>
				</div>
			</div>
			<div class="freenity-clear"></div>
			<hr />
			<?php if ( '0' == $comment->comment_approved ) { ?>
				<div class="comment-awaiting-verification"><?php _e( 'Your comment is awaiting moderation.', 'freenity' ) ?></div>
			<?php }
			break;
	}
}

/* Adds Freenity Recent Posts widget. */

class Freenity_Recent_Posts extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'freenity_recent_posts',
			'description' => __( 'Freenity Recent Posts widget which displays the featured image thumbnail', 'freenity' ),
		);
		parent::__construct( 'freenity_recent_posts', __( 'Freenity Recent Posts', 'freenity' ), $widget_ops );
		$this->alt_option_name = 'freenity_recent_posts';
	}

	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		$title  = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts', 'freenity' );
		$title  = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number ) {
			$number = 5;
		}
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$r         = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true,
		) ) );
		if ( $r->have_posts() ) {
			echo $args['before_widget'];
			if ( $title ) {
				echo $args['before_title'] . $title . $args['after_title'];
			} ?>
			<ul>
				<?php while ( $r->have_posts() ) {
					$r->the_post(); ?>
					<li>
						<div class="sidebar-recent-post">
							<a href="<?php echo esc_url( get_the_permalink() ); ?>">
								<span class="recent-title"><?php the_post_thumbnail( 'freenity_widget_thumbnail' ); ?></span>
							</a>
							<a href="<?php echo esc_url( get_the_permalink() ); ?>">
								<?php get_the_title() ? the_title() : the_ID(); ?>
							</a>
							<br />
							<?php if ( $show_date ) { ?>
								<span class="post-date"><?php echo get_the_date(); ?></span>
							<?php } ?>
						</div>
					</li>
				<?php } ?>
			</ul>
			<?php echo $args['after_widget'];
			wp_reset_postdata();
		}
	}

	public function update( $new_instance, $old_instance ) {
		$instance              = $old_instance;
		$instance['title']     = sanitize_text_field( $new_instance['title'] );
		$instance['number']    = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;

		return $instance;
	}

	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false; ?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'freenity' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:', 'freenity' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" />
		</p>
		<p>
			<input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display the post date?', 'freenity' ); ?></label>
		</p>
	<?php }
}

/* Registration widget */
function freenity_register_widget() {
	register_widget( 'Freenity_Recent_Posts' );
}

/* Сonclusion sidebar */
function freenity_register_sidebars() {

	/* Right Sidebar*/
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'freenity' ),
		'id'            => 'freenity-sidebar',
		'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'freenity' ),
		'before_widget' => '<div id="%1$s" class="side-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	/* Footer Sidebar*/
	register_sidebar( array(
		'name'          => __( 'Footer Sidebar', 'freenity' ),
		'id'            => 'freenity-footer-sidebar',
		'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'freenity' ),
		'before_widget' => '<div id="%1$s" class="foot-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

/* Add script and stile */
function freenity_scripts() {
	wp_enqueue_script( 'freenity-script', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ) );
	// Load the html5 shiv.
	wp_enqueue_script( 'freenity-html5', get_template_directory_uri() . '/js/html5.js' );
	wp_script_add_data( 'freenity-html5', 'conditional', 'lt IE 9' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'doubletaptogo', get_template_directory_uri() . '/js/doubletaptogo.js' );
	wp_enqueue_style( 'freenity-style', get_stylesheet_uri() );
	wp_enqueue_style( 'freenity-font-awesome', get_stylesheet_directory_uri() . '/fonts/fontawesome/css/font-awesome.css' );
}

/* Add excerpt */
function freenity_excerpt_more( $more ) {
	global $post;
	return '<br /><a href="' . esc_url( get_permalink( $post->ID ) ) . '">' . __( 'Read More...', 'freenity' ) . '</a>';
}

/* Excerpt lenght */
function freenity_excerpt_length( $length ) {
	return 20;
}

/**
 * Sets up the theme customizer sections, controls, and settings.
 *
 * @since Freenity 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function freenity_customize_register( $wp_customize ) {
	/* Logo header */
	if ( ! function_exists( 'the_custom_logo' ) ) {
		$wp_customize->add_setting( 'freenity_logo_header', array(
			'default'           => get_template_directory_uri() . '/images/logo_header.png',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'freenity_logo_header', array(
			'label'     => __( 'Logo Header', 'freenity' ),
			'section'   => 'title_tagline',
		) ) );
	}

	/* Logo footer */
	$wp_customize->add_setting( 'freenity_logo_footer', array(
		'default'           => get_template_directory_uri() . '/images/logo_footer.png',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'freenity_logo_footer', array(
		'label'     => __( 'Logo Footer', 'freenity' ),
		'section'   => 'title_tagline',
	) ) );

	/* Adds social profiles links */
	$wp_customize->add_panel( 'freenity_social_links', array(
		'title'       => __( 'Social Links', 'freenity' ),
		'priority'    => 160,
		'description' => __( "Here you can change the links to your social accounts and e-mail for feedback. It's possible to save forms empty.", 'freenity' ),
	) );

	$wp_customize->add_section( 'freenity_facebook_link', array(
		'title'       => __( 'Facebook Link', 'freenity' ),
		'priority'    => 10,
		'description' => __( 'Enter you Facebook Link. E.g.', 'freenity' ) . ' "http://www.example.com"',
		'panel'       => 'freenity_social_links',
	) );

	$wp_customize->add_setting( 'freenity_facebook_link', array(
		'type'              => 'option',
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'freenity_facebook_link', array(
		'label'    => __( 'Facebook Link', 'freenity' ),
		'section'  => 'freenity_facebook_link',
		'type'     => 'url',
	) ) );

	$wp_customize->add_section( 'freenity_twitter_link', array(
		'title'       => __( 'Twitter Link', 'freenity' ),
		'priority'    => 20,
		'description' => __( 'Enter you Twitter link. E.g.', 'freenity' ) . ' "http://www.example.com"',
		'panel'       => 'freenity_social_links',
	) );

	$wp_customize->add_setting( 'freenity_twitter_link', array(
		'type'              => 'option',
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'freenity_twitter_link', array(
		'label'    => __( 'Twitter Link', 'freenity' ),
		'section'  => 'freenity_twitter_link',
		'type'     => 'url',
	) ) );

	$wp_customize->add_section( 'freenity_googleplus_link', array(
		'title'       => __( 'Google+ Link', 'freenity' ),
		'priority'    => 30,
		'description' => __( 'Enter your Google+ link. E.g.', 'freenity' ) . ' "http://www.example.com"',
		'panel'       => 'freenity_social_links',
	) );

	$wp_customize->add_setting( 'freenity_googleplus_link', array(
		'type'              => 'option',
		'sanitize_callback' => 'esc_url_raw',
		'default'           => '',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'freenity_googleplus_link', array(
		'label'    => __( 'Google+ Link', 'freenity' ),
		'section'  => 'freenity_googleplus_link',
		'type'     => 'url',
	) ) );

	$wp_customize->add_section( 'freenity_email', array(
		'title'       => __( 'E-mail', 'freenity' ),
		'priority'    => 40,
		'description' => __( 'Enter the e-mail for feedback. E.g.', 'freenity' ) . ' "example.mail@gmail.com"',
		'panel'       => 'freenity_social_links',
	) );

	$wp_customize->add_setting( 'freenity_email', array(
		'type'              => 'option',
		'sanitize_callback' => 'sanitize_email',
		'default'           => '',
	) );

	$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'freenity_email', array(
		'label'    => __( 'E-mail for feedback', 'freenity' ),
		'section'  => 'freenity_email',
		'type'     => 'email',
	) ) );
}

/* Display social contacts at the theme footer */
function freenity_contact_data() {
	$freenity_theme_option = array(
		'facebook'   => get_option( 'freenity_facebook_link' ),
		'twitter'    => get_option( 'freenity_twitter_link' ),
		'googleplus' => get_option( 'freenity_googleplus_link' ),
		'email'      => get_option( 'freenity_email' ),
	); ?>
	<ul class="freenity-social-button">
		<?php if ( ! empty( $freenity_theme_option['facebook'] ) ) { ?>
			<li class="freenity-facebook">
				<a href="<?php echo esc_url( $freenity_theme_option['facebook'] ); ?>"><i class="fa fa-facebook-square"></i></a>
			</li>
		<?php }
		if ( ! empty( $freenity_theme_option['twitter'] ) ) { ?>
			<li class="freenity-twitter">
				<a href="<?php echo esc_url( $freenity_theme_option['twitter'] ); ?>"><i class="fa fa-twitter"></i></a>
			</li>
		<?php }
		if ( ! empty( $freenity_theme_option['googleplus'] ) ) { ?>
			<li class="freenity-google-plus">
				<a href="<?php echo esc_url( $freenity_theme_option['googleplus'] ); ?>"><i class="fa fa-google-plus"></i></a>
			</li>
		<?php }
		if ( ! empty( $freenity_theme_option['email'] ) ) { ?>
			<li class="freenity-e-mail">
				<a href="<?php echo esc_url( 'mailto:' . $freenity_theme_option['email'] ); ?>"><i class="fa fa-envelope"></i></a>
			</li>
		<?php } ?>
	</ul>
	<div class="clear"></div>
<?php }

/* Add custom password form */
function freenity_password_form() {
	global $post;
	$label = 'pwbox-' . ( empty( $post->ID ) ? rand() : $post->ID );
	$o     = '<form action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
		' . __( 'This post is password protected. To view it please enter your password below:', 'freenity' ) . '
		<label for="' . $label . '">' . __( 'Password:', 'freenity' ) . ' </label><input name="post_password" id="' . $label . '" type="password"  maxlength="20" /><br/>
		<input type="submit" name="Submit" value="' . esc_attr__( 'Submit', 'freenity' ) . '" />
	</form>';

	return $o;
}

add_filter( 'the_password_form', 'freenity_password_form' );
add_action( 'customize_register', 'freenity_customize_register', 11 );
add_action( 'freenity_contact_data', 'freenity_contact_data' );
add_action( 'wp_enqueue_scripts', 'freenity_scripts' );
add_action( 'after_setup_theme', 'freenity_theme_setup' );
add_action( 'widgets_init', 'freenity_register_sidebars' );
add_filter( 'excerpt_more', 'freenity_excerpt_more' );
add_filter( 'excerpt_length', 'freenity_excerpt_length' );
add_action( 'freenity_thumbnail_caption', 'freenity_thumbnail_caption' );
add_action( 'freenity_post_nav', 'freenity_post_nav' );
add_action( 'widgets_init', 'freenity_register_widget' );
