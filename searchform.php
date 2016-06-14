<?php /**
 * The template for displaying search forms in freenity
 *
 * @subpackage Freenity
 * @since      Freenity 1.0
 */ ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="text" class="search" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'freenity' ); ?>" value="<?php the_search_query(); ?>" />
	<button type="submit" value="" class="genericon genericon-search"><i class='fa fa-search'></i></button>
	<div class="freenity-clear"></div>
</form>
