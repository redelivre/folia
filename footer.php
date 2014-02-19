<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Folia
 */
?>

		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div id="tertiary" class="widget-area widget-area--footer clear" role="complementary">
	            <aside class="widget">
	            	<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
		                <img class="site-logo" src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" alt="Logo <?php bloginfo ( 'name' ); ?>" />
		                <?php folia_social_networks(); ?>
		            </a>
	            </aside>
	            <aside class="widget">
	            	<p><span class="icon-twitter">Rua da Assembleia, 10</span></p>
	            	<p><span class="icon-twitter"><?php echo antispambot( get_bloginfo( 'admin_email' ) ); ?></span></p>
	            	<p><span class="icon-twitter tel">0800-655-303</span></p>
	            </aside>
	            <aside class="widget">
	            	<h3 class="widget-title">Parceiros</h3>
	            	<img src="http://placehold.it/100" />
	            	<img src="http://placehold.it/100" />
	            	<img src="http://placehold.it/100" />
	            	<img src="http://placehold.it/100" />
	            </aside>
	        </div><!-- .widget-area--footer -->
			<div class="site-info">
				<a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'folia' ), 'WordPress' ); ?></a>
				<span class="sep"> | </span>
				<?php printf( __( 'Theme: %1$s by %2$s.', 'folia' ), 'Folia', '<a href="http://ethymos.com.br" rel="designer">Ethymos</a>' ); ?>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>