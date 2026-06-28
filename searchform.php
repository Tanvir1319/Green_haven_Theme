<form 
	role="search" 
	method="get" 
	class="gh-newsletter-form" 
	action="<?php echo esc_url( home_url( '/' ) ); ?>"
>
	<input 
		type="search" 
		name="s"
		placeholder="<?php echo esc_attr__( 'Search...', 'green-haven-theme' ); ?>"
		aria-label="<?php esc_attr_e( 'Search', 'green-haven-theme' ); ?>"
		value="<?php echo get_search_query(); ?>"
	/>

	<button type="submit" aria-label="<?php esc_attr_e( 'Search', 'green-haven-theme' ); ?>">
		<i class="fa-solid fa-chevron-right"></i>
	</button>
</form>