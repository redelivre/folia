<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Folia
 */

if ( ! function_exists( 'folia_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */
function folia_paging_nav() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
	<nav class="navigation paging-navigation clear" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'folia' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'folia' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'folia' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'folia_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @return void
 */
function folia_post_nav() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'folia' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'folia' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link',     'folia' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'folia_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function folia_posted_on( $plain = false ) {
	$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	if ( $plain === true ) {
		printf( __( '<span class="posted-on">Publicado em %1$s</span><span class="byline"> por %2$s</span>', 'folia' ),
			$time_string,
			sprintf( '<span class="author vcard">%s</span>',
				esc_html( get_the_author() )
			)
		);

	}
	else {
		printf( __( '<span class="posted-on">Publicado em %1$s</span><span class="byline"> por %2$s</span>', 'folia' ),
			sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
				esc_url( get_permalink() ),
				$time_string
			),
			sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s">%2$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_html( get_the_author() )
			)
		);
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 */
function folia_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so folia_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so folia_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in folia_categorized_blog.
 */
function folia_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'folia_category_transient_flusher' );
add_action( 'save_post',     'folia_category_transient_flusher' );

/**
 * Display the registered social networks
 *
 * @since  Folia 1.0
 */
function folia_social_networks() {

    // Social networks & RSS feed
	$social = get_option( 'campanha_social_networks' );
	if ( isset( $social ) && !empty( $social ) ) : ?>
		<div class="social">
			<?php
			foreach ( $social as $key => $value ) :
				if ( ! empty( $value) ) : ?>
					<a class="social-link social-link-<?php echo $key; ?> icon-<?php echo $key; ?>" href="<?php echo esc_url( $value ); ?>"><span class="screen-reader-text"><?php echo $value; ?></span></a>
				<?php
				endif;
			endforeach;
			?>
			<a class="social-link icon-rss social-link-rss" href="<?php bloginfo( 'rss2_url' ); ?>"><span class="screen-reader-text"><?php _e('RSS Feed', 'folia' ); ?></span></a>
		</div><!-- .social -->
	<?php
	endif;
}

/**
 * Add social sharing
 *
 * @since Folia 1.0
 */
function folia_share() {
	?>
	<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>
	<?php
}

/**
 * Display the map 
 *
 * @since Folia 1.0
 */
function folia_the_map() {
	
	if(function_exists('mapasdevista_view'))
	{
		mapasdevista_view();
	}

}

/**
 * Display the map filters
 *
 * @since Folia 1.0
 */
function folia_the_map_filters() {
	
	if(function_exists('mapasdevista_view'))
	{
		?>
		<div id="map-filters">
		<?php
			mapasdevista_view_filters('filter', array('data'));
		?>
			<div id="filter-link-to-map" class="filter-link-to-map" ><a href="<?php echo get_bloginfo('url').'/mapa'; ?>">Veja o mapa completo</a></div>
		</div>
		<?php
	} 
}

function folia_mapasdevista_filters_label($label)
{
	$ikey = filter_var($label, FILTER_SANITIZE_NUMBER_INT);
	if(intval($ikey) > 0)
	{
		return substr($ikey, 0, 2).'/'.substr($ikey, 2);// TODO arrumar um jeito de definir para datas
	}
	return $label;
}
add_filter('mapasdevista_filters_label', 'folia_mapasdevista_filters_label');

?>
