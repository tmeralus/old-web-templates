<?php get_header(); ?>

              <div class="content">
                  <?php get_sidebar(); ?>
			<div id="content" role="main">

				<h1 class="page-title"><?php
					printf( __( 'Tag Archives: %s', 'portalfront' ), '<span>' . single_tag_title( '', false ) . '</span>' );
				?></h1>

<?php
 get_template_part( 'loop', 'tag' );
?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_footer(); ?>
