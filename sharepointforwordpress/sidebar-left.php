<div class="sidebar">

    <?php wp_nav_menu( array( 'theme_location' => 'secondary-menu', 'menu_class' => 'secondary', 'fallback_cb' => 'sidnav_fallback') ); ?>






     <p>
        <?php echo get_bloginfo ( 'description' );?>
        <br /><br />Powered by <a href="http://wordpress.org">Wordpress</a>
        <br />Built by <a href="http://www.portalfronthosting.com">PortalFront Hosting</a>
     </p>



</div>