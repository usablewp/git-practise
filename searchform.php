<form role="search" method="get" class="main-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="fields-container">
		<label for="s" class="screen-reader-text"><?php _e( 'Search Field', 'firstshow-tekzenit' ); ?></label>
		<input type="search" class="search-field" placeholder="Search" value="" name="s" title="Search for:" id="s">
		<button type="submit" class="search-submit" value="search">
			<span class="fa fa-search" aria-hidden="true"></span>
		</button>
	</div>
</form>
