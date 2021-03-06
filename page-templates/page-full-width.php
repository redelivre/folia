<?php
/**
 * Template Name: Full Width Page
 *
 * @since Folia 1.0
 */
__( 'Full Width Page', 'folia' );

get_header(); ?>

		<div id="primary" class="content-area content-area--full">
			<div id="content" class="site-content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>