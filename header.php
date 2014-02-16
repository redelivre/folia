<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Folia
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		<div class="container">
			<?php get_search_form(); ?>
			<div class="site-branding">
				<?php
				/*
				// Check if there's a custom logo
	            $logo = get_theme_mod( 'folia_logo' );
	            if ( isset( $logo ) && ! empty( $logo ) ) :
	            ?>
	                <a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
	                    <img class="site-logo" src="<?php echo $logo; ?>" alt="Logo <?php bloginfo ( 'name' ); ?>" />
	                </a>
	        	<?php endif; */
	        	?>
	        
	        	<a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
	                <img class="site-logo" src="http://placehold.it/100&text=Logo" alt="Logo <?php bloginfo ( 'name' ); ?>" />
	            </a>
	        	
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
			</div><!-- .site-branding -->

			<div class="social">
				<a class="social-link icon icon-facebook" href="#"><span class="screen-reader-text">T</span></a>
				<a class="social-link icon icon-pinterest" href="#"><span class="screen-reader-text">T</span></a>
				<a class="social-link icon icon-rss" href="#"><span class="screen-reader-text">T</span></a>
				<a class="social-link icon icon-instagram" href="#"><span class="screen-reader-text">T</span></a>
				<a class="social-link icon icon-twitter" href="#"><span class="screen-reader-text">T</span></a>
			</div>

			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h1 class="menu-toggle"><?php _e( 'Menu', 'folia' ); ?></h1>
				<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'folia' ); ?></a>

				<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
			</nav><!-- #site-navigation -->
		</div><!-- .container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="container">
