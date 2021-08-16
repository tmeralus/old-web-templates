<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>;
           charset=<?php bloginfo('charset'); ?>" />


<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href="<?php bloginfo( 'template_url' ); ?>/includes/style.css" type="text/css" rel="stylesheet" />
<link href="<?php bloginfo( 'template_url' ); ?>/includes/menu.css" type="text/css" rel="stylesheet" />
<link href="<?php bloginfo( 'template_url' ); ?>/includes/menu_fallback.css" type="text/css" rel="stylesheet" />


  

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>

     <div class="wrapper">
          <div class="header">
              <ul>
                  <li class="site-actions"><a onclick="siteActions();return false" href="#">Site Actions</a>
                     <div class="site-actions">
                         
                          <ul>
                              <?php echo wp_register(); ?>
                              <li><?php wp_loginout(); ?></li>
                             <?php echo wp_meta(); ?>
                              <li> <?php get_calendar( true  ); ?> </li>
                          </ul>
                      </div>
                  </li>
                  <li class="directory"><a href="#" onclick="breadCrumbs();return false;"><span>breadcrumbs</span></a>
                      <div class="breadcrumbs">
                          <div>This page location is:</div>
                          <?php the_breadcrumb(); ?>
                      </div>
                  </li>
                  <li class="tab"><a  id="default" class="active" href="#">Browse</a></li>
                   <li class="tab"><a id="jpage" href="#">Share</a></li>
              </ul>

              <div class="support">
                  <?php wp_loginout(); ?>
              </div>


          </div>

          <div class="ribbon">
              <div class="jpage">
                  <ul>
                      <li>
                            <a href="http://twitter.com/home?status=Currently%20reading%20<?php the_permalink(); ?>" title="Tweet This"><img alt="Twitter" src="<?php bloginfo( 'template_url' ); ?>/images/icons/Twitter.png" /></a>
                      </li>
                      <li>
                            <a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" title="Share On Facebook"><img alt="Facebook" src="<?php bloginfo( 'template_url' ); ?>/images/icons/FaceBook.png" /></a>
                      </li>
                      <li>
                          <a href="http://del.icio.us/post?url=<?php the_permalink() ?>&amp;title=<?php echo urlencode(the_title('','', false)); ?>" title="Save To Delicious" ><img alt="Delicous" src="<?php bloginfo( 'template_url' ); ?>/images/icons/delicious.png" /></a>
                      </li>
                      <li>
                          <a href="http://digg.com/submit?phase=2&amp;url=<?php the_permalink() ?>" title="Digg It"><img src="<?php bloginfo( 'template_url' ); ?>/images/icons/Digg.png" alt="Digg" /></a>
                      </li>
                      <li>
                          <a href="http://technorati.com/faves?add=<?php the_permalink() ?>" title="Fav It On Technorati"><img alt="Technorati" src="<?php bloginfo( 'template_url' ); ?>/images/icons/Technorati.png" /></a>
                      </li>
                      <li>
                          <a href="<?php bloginfo('rss_url'); ?>" title="Subscribe To RSS"><img src="<?php bloginfo( 'template_url' ); ?>/images/icons/Feed.png" /></a>
                      </li>
                  </ul>
                  
              </div>
              <div class="default">
                  <div class="mantle">
                      <h1 class="users"><a href="<?php echo get_bloginfo('url') ?>"><?php echo get_bloginfo('title'); ?></a></h1>

                  </div>


                  <div class="menu">
                       <?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'topnav', 'fallback_cb' => 'topnav_fallback') ); ?>
                    

                      <div class="search"><?php get_search_form(); ?></div>
                      <div class="clear"></div>
                  </div>
              </div>

          </div>
          <div class="lower">
            <div class="sidebar">
            <?php get_sidebar( "left" ); ?>
            </div>

