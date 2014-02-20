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
					<img src="http://lorempixel.com/g/350/263/abstract" class="wp-post-image" />
				<?php endif; ?>
			</div>
			
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<?php if ( 'post' == get_post_type() ) : ?>
				<div class="entry-meta">
					<?php folia_posted_on( true ); ?>
				</div><!-- .entry-meta -->
				<?php endif; ?>
			</header><!-- .entry-header -->
		</a>
</article><!-- #post-## -->
