<?php
/**
 * @package Folia
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'hentry-box' ); ?>>
		<a class="hentry-box-link" href="<?php the_permalink(); ?>">
			
			<div class="entry-image">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'feature-box' ); ?>
				<?php else : ?>
					<img src="http://placehold.it/350x263/eeeeee/eeeeeee&text=." class="wp-post-image" />
				<?php endif; ?>
			</div>
			<header class="entry-header">
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php folia_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
		</a>
</article><!-- #post-## -->
