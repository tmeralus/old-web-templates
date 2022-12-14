<?php get_header(); ?>

              <div class="content">
                  <?php get_sidebar(); ?>
                  <div class="main">
                     <div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( is_front_page() ) { ?>
						<h2 class="entry-title"><?php the_title(); ?></h2>
					<?php } else { ?>	
						<h1 class="entry-title"><?php the_title(); ?></h1>
					<?php } ?>				

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __( 'Pages:', 'portalfront' ), 'after' => '</div>' ) ); ?>
						<?php edit_post_link( __( 'Edit', 'portalfront' ), '<span class="edit-link">', '</span>' ); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-## -->

				<?php comments_template( '', true ); ?>

<?php endwhile; ?>
                     </div>
			</div><!-- #content -->
		</div><!-- #container -->


<?php get_footer(); ?>
