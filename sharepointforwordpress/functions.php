<?php

if ( ! isset( $content_width ) )
	$content_width = 640;

register_sidebar( array(
        'name' => __( 'Primary Widget Area', 'portalfront' ),
        'id' => 'primary-widget-area',
        'description' => __( 'The primary widget area', 'portalfront' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
) );

register_sidebar( array(
        'name' => __( 'Left Sidebar', 'portalfront' ),
        'id' => 'left-sidebar',
        'description' => __( 'Sub menu stuff here', 'portalfront' ),
        'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
        'after_widget' => '</li>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
) );


define( 'HEADER_TEXTCOLOR', 'ffffff' );
define( 'HEADER_IMAGE', '%s/images/icons/users.png' ); // %s is the template dir uri
define( 'HEADER_IMAGE_WIDTH', 32 ); // use width and height appropriate for your theme
define( 'HEADER_IMAGE_HEIGHT', 32 );





function header_style() {
        ?><style type="text/css">

        div.mantle h1.users {
            background: url(<?php header_image(); ?>) no-repeat left center;
        }

        </style><?php
}
function admin_header_style() {
    ?><style type="text/css">
        #headimg {
            background: url(<?php header_image(); ?>) no-repeat left center;
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
            height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
            border: none;
        }
        .appearance_page_custom-header #headimg  {border:none;}
        #headimg h1 {display:none;}
        #headimg div {display:none;}
    </style><?php
}


add_custom_image_header( 'header_style', 'admin_header_style' );
add_custom_background();
add_editor_style();

function the_breadcrumb() {
        echo '<a class="breadcrumbs" href="';
        echo get_option('home');
        echo '">';
        bloginfo('name');
        echo "</a> > <span>";
        if (is_category() || is_single()) {
                the_category('title_li=');
                if (is_single()) {
                        echo " > ";
                        the_title();
                }
        } else {
            the_title();
        }
        echo "</span>";
}


if ( ! function_exists( 'portalfront_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since PortalFront 1.0
 */
function portalfront_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'portalfront' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'portalfront' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;


if ( ! function_exists( 'portalfront_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own portalfront_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since PortalFront 1.0
 */
function portalfront_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php printf( __( '%s <span class="says">says:</span>', 'portalfront' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php _e( 'Your comment is awaiting moderation.', 'portalfront' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( __( '%1$s at %2$s', 'portalfront' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)', 'portalfront' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'portalfront' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'portalfront'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Makes some changes to the <title> tag, by filtering the output of wp_title().
 *
 * If we have a site description and we're viewing the home page or a blog posts
 * page (when using a static front page), then we will add the site description.
 *
 * If we're viewing a search result, then we're going to recreate the title entirely.
 * We're going to add page numbers to all titles as well, to the middle of a search
 * result title and the end of all other titles.
 *
 * The site title also gets added to all titles.
 *
 * @since PortalFront 1.0
 *
 * @param string $title Title generated by wp_title()
 * @param string $separator The separator passed to wp_title(). Twenty Ten uses a
 * 	vertical bar, "|", as a separator in header.php.
 * @return string The new title, ready for the <title> tag.
 */
function portalfront_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'portalfront' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'portalfront' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'portalfront' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'portalfront_filter_wp_title', 10, 2 );

add_theme_support( 'menus' );
add_theme_support( 'automatic-feed-links' );

add_action( 'init', 'my_custom_menus' );


function my_custom_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Primary Menu' ),
			'secondary-menu' => __( 'Secondary Menu' )
		)
	);
}

/**
* Top Nav Menu Fallback
*/
function topnav_fallback() {
        wp_page_menu( "menu_class=topnav" );
}

function add_menuclass($ulclass) {
        $ulclass =  preg_replace('/<ul>/', '<ul class="topnav">', $ulclass, 1);
        return preg_replace('/<ul class="children">/', '<ul class="sub-menu">', $ulclass, 1);
}



add_filter( 'wp_page_menu', 'add_menuclass' );



if ( function_exists( 'wp_enqueue_script' ) ) {
        wp_enqueue_script( 'jquery-stuff-my', get_bloginfo('wpurl') .   '/wp-content/themes/portalfront/includes/my.js', array('jquery'), '0.1' );
        wp_enqueue_script( 'jquery-stuff-menu', get_bloginfo('wpurl') . '/wp-content/themes/portalfront/includes/menu.js', array('jquery'), '0.1' );
        wp_enqueue_script( 'jquery-stuff-menu_fallback', get_bloginfo('wpurl') . '/wp-content/themes/portalfront/includes/menu_fallback.js', array('jquery'), '0.1' );
}

