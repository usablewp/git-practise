<header id="main-header" class="logo-with-menu-icon" role="banner">
   <div class="container">
      <div class="row">
         <div class="col-sm-12 clearfix header-content">
            <?php // Start of Logo ?>
            <div class="logo-and-tagline-container">
              <?php locate_template( 'parts/logo.php', true); ?>
            </div>
            <?php // end of Logo ?>
            <div class="menu-icon-and-cart">
              <a class="mobile-menu-toggle sb-toggle-right" href="#off-canvas">
              	<span class="screen-reader-text"><?php _e('Menu','firstshow-tekzenit'); ?></span>
  				      <span class="fa fa-bars" aria-hidden="true"></span>
  				    </a>
              <?php if ( function_exists( 'edd_get_cart_quantity' ) &&  function_exists( 'edd_get_checkout_uri' ) ): ?>
              <a href="<?php echo edd_get_checkout_uri(); ?>" class="cart">
                <span aria-hidden="true" class="fa fa-shopping-cart"></span>
                <span class="edd-cart-quantity"><?php echo edd_get_cart_quantity(); ?></span>
              </a>
              <?php endif; ?>
            </div>
         </div>
      </div>
   </div>
   <!-- end of logo Container -->
</header>
