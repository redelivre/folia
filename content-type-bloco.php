<?php
/**
 * @package Folia
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header clear">
		<?php
		if ( has_post_thumbnail() ) :
			the_post_thumbnail( 'thumbnail-small' );
		else :
		?>
			<img class="wp-post-image" src="http://placehold.it/75&text=Logo" />
		<?php endif; ?>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-meta">
			<div class="social">
				<?php
				$custom_keys = array(
					'_folia_bloco_facebook',
					'_folia_bloco_instagram',
					'_folia_bloco_twitter'
				);

				foreach ( $custom_keys as $custom_key ) :
					$custom_value = get_post_meta( $post->ID, $custom_key, true );
					if ( ! empty ( $custom_value ) ) : ?>
						<a class="social-link <?php echo 'icon-' . $custom_key; ?>" href="<?php echo esc_url( $custom_value ); ?>">
							<span class="screen-reader-text"><?php echo esc_url( $custom_value ); ?></span>
						</a>
					<?php
					endif;
				endforeach;
				?>
			</div>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-image">
		<?php
		$attachments = get_posts( array(
			'post_parent' 		=> $post->ID,
			'post_type' 		=> 'attachment',
			'post_mime_type'	=> 'image',
			'orderby' 			=> 'menu_order',
			'exclude'     		=> get_post_thumbnail_id()
		) );

		if ( $attachments ) :
			$first_attachment = array_shift( $attachments );
			echo wp_get_attachment_image(
				$first_attachment->ID,
				'feature-single',
				'',
				array( 'class' => 'attachment-feature-single wp-post-image' )
			);
		endif;
		?>
	</div><!-- .entry-image -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'folia' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'folia' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php if ( 'post' == get_post_type() ) : // Hide category and tag text for pages on Search ?>
			<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'folia' ) );
				if ( $categories_list && folia_categorized_blog() ) :
			?>
			<span class="cat-links">
				<?php printf( __( 'Posted in %1$s', 'folia' ), $categories_list ); ?>
			</span>
			<?php endif; // End if categories ?>

			<?php
				/* translators: used between list items, there is a space after the comma */
				$tags_list = get_the_tag_list( '', __( ', ', 'folia' ) );
				if ( $tags_list ) :
			?>
			<span class="tags-links">
				<?php printf( __( 'Tagged %1$s', 'folia' ), $tags_list ); ?>
			</span>
			<?php endif; // End if $tags_list ?>
		<?php endif; // End if 'post' == get_post_type() ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'folia' ), __( '1 Comment', 'folia' ), __( '% Comments', 'folia' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'folia' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
