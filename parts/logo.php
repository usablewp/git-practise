<?php global $retina; ?>
<div class="logo" id="main-logo">
    <a href="<?php echo home_url(); ?>" title="<?php bloginfo( 'name' ); ?>">
    <?php
      	$custom_logo_id = get_theme_mod( 'custom_logo' );
      	$logo 			= wp_get_attachment_image_src( $custom_logo_id , 'full' );
    	$retina_logo 	= get_theme_mod( 'oi_retina_logo' );
    ?>
    <?php if( !empty( $logo[0] ) || !empty( $retina_logo ) ): ?>
    	<span class="screen-reader-text"><?php bloginfo( 'name' ); ?></span>
    	<?php
      $final_logo_url = '';
			if( $retina ):
				if( !empty( $retina_logo ) ):
					$final_logo_url =  $retina_logo;
		    else:
		   			$final_logo_url =  $logo[0];
		    endif;
		   else:
		    	$final_logo_url =  $logo[0];
		   endif;
			?>
			<img src = "<?php echo $final_logo_url; ?>" alt="<?php bloginfo( 'name' ); ?>"/>
    <?php else: ?>
        	<?php bloginfo( 'name' ); ?>
    <?php endif; ?>
    </a>
</div>
<?php $description = get_bloginfo( 'description' ); ?>
<?php if( ! empty( $description ) && get_theme_mod( 'fst_display_tagline', true ) ) : ?>
  <h2 class="site-tagline"><?php echo $description; ?></h2>
<?php endif; ?>
