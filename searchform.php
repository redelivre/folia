<?php
/**
 * The template for displaying search forms in Quizumba
 *
 * @package Quizumba
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'quizumba' ); ?></span>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Type your search and press enter', 'placeholder', 'quizumba' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	</label>
	<button type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'quizumba' ); ?>">
		<span class="icon-search"></span>
	</button>
</form>
