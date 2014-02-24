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
	            <aside class="widget clear">
	            	<div class="site-branding--footer">
		            	<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			                <img class="site-logo" src="<?php echo get_template_directory_uri() . '/images/logo-picnic.png'; ?>" alt="Logo <?php bloginfo ( 'name' ); ?>" />
			            </a>
			            <?php folia_social_networks(); ?>
		        	</div>
	            </aside>
	            <aside class="widget widget-apoios clear">
	            	<h3 class="widget-title">Apoio</h3>
	            	<img src="<?php echo get_template_directory_uri() . '/images/logo-apoios.png'; ?>" alt="Logo <?php bloginfo ( 'name' ); ?>" />
	            </aside>
	            <aside class="widget widget-patrocinios clear">
	            	<h3 class="widget-title">Patrocínio</h3>
	            	<img src="<?php echo get_template_directory_uri() . '/images/logo-patrocinios.png'; ?>" alt="Logo <?php bloginfo ( 'name' ); ?>" />
	            </aside>
	        </div><!-- .widget-area--footer -->

	        <div class="site-location clear">
		        <span class="icon-location">Rua Antônio Torres, 103 | Sagrada Família | CEP 31030-130</span>
	        	<span class="icon-phone tel">+55 31 3309-6558</span>
	        	<span class="icon-mail"><a href="mailto:<?php echo antispambot( 'contato@picnicdigital.com.br' ); ?>"><?php echo antispambot( 'contato@picnicdigital.com.br' ); ?></a></span>
        	</div>

			<div class="site-info">
				<a href="<?php echo home_url( '/' ); ?>">Mapa da Folia &bull; 2014</a>
			</div><!-- .site-info -->
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
