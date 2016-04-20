( function( $ ){
	$( document ).ready( function() {

		/*Add 'plus' in menu */
		$( '.freenity-top-menu>div>ul>li.menu-item-has-children a' ).after( '<i class="fa fa-plus"></i>' );
		$( '.freenity-top-menu>div>ul>li.page_item_has_children a' ).after( '<i class="fa fa-plus"></i>' );

		/* Follow author */
		$( '.freenity-social-links li' ).addClass( 'freenity-follow' );
		$( '.freenity-post-area>hr:last-child' ).css( { display: 'none' } );

		/* Post Portfolio */
		if ( $( '#content' ).is( '.hentry' )) {
			$( '.content-area, .sidebar-container' ).wrapAll( '<div class="content-width">' );
		}

		/* Woocommerce */
		if ( $( '.woocommerce-breadcrumb' ) ) {
			$( '.woocommerce-breadcrumb, .type-product' ).wrapAll( '<div class="freenity-content">' );
		}

		/* Prev post link  */
		$( '.format-link' ).prev().css( { display: 'none' } )

		/* Pages category */
		if ( $( '.type-page' ) ) {
			$( '.type-page>.freenity-entry>.freenity-category' ).css( { display: 'none' } )
		}

		/*Freenity Tabber Widget */
		$(function() {
			$('ul.freenity-tabs').each(function() {
			$(this).find('li').each(function(i) {
				$(this).click(function(){
				$(this).addClass('active').siblings().removeClass('active')
					.closest('div.freenity-tabs-widget').find('div.freenity-tab-content').removeClass('active').eq(i).addClass('active');
				});
			});
			});
		})

		/* Wrap Freenity Tabber Widget */
		$( '.freenity-footer-sidebar>.sidebar>.freenity-tabs-widget' ).wrap( '<div class="foot-widget">' );
		$( '.right-sidebar>.sidebar-right>.freenity-tabs-widget' ).wrap( '<div class="side-widget">' );

		/* Show "follow author" if there are links  */
		$( 'li.freenity-follow-author' ).removeClass( 'freenity-follow' )
		if ( $( '.freenity-social-links>li' ).hasClass( 'freenity-follow' ) ) {
			$( '.freenity-social-links' ).css( { display: 'inline-block' } )
		}

		/* Do not show links to next and previous posts if they are empty */
		$( '.previous-posts:not( :has( a ) )' ).css( { display: 'none' } )
		$( '.next-posts:not( :has( a ) )' ).css( { display: 'none' } )

		/* Top-menu touch-friendly drop-down navigation */
		$( '.freenity-top-menu li:has(ul)' ).doubleTapToGo();

		/* Top-menu drop down */
		var menuItem = $( 'div.freenity-top-menu li' );
		var totalTopMenuItems = $( '.freenity-top-menu>div>ul' ).children().length;
		$( '.freenity-icon-menu' ).click(function(e) { 

		/* Menu button action */
		$( '.freenity-top-menu' ).fadeToggle();
			$( menuItem ).click( function( e ) {
				e.stopPropagation(); 
				if ( $( this ).hasClass( 'menu-item-has-children' ) || $( this ).hasClass( 'page_item_has_children' ) ) {
					$( this ).children( 'ul' ).fadeToggle(); 
					var openedItemId = $( this ).attr( 'id' ); 
					if ( $( this ).parent( '.freenity-top-menu>div>ul' ).length > 0 ) { 
						$( '.freenity-top-menu>div>ul' ).children().each( function() { 
							if ( $( this ).attr( 'id' ) != openedItemId && $( this ).is( ':visible' ) ) {
								$( this ).children( 'ul' ).fadeOut(); 
							}
						} );
					}
				}
			} );
		} );
	} );
} ) ( jQuery );