<header id="main-header" class="logo-with-menu sb-slide" role="banner">
    <div class="clearfix header-content">
      <?php // Start of Logo ?>
      <div class="logo-and-tagline-container">
        <a href="#" id="nav-menu-1" class="mobile-menu-toggle sb-toggle-left">
        	<span class="screen-reader-text"><?php _e('Menu','firstshow-tekzenit'); ?></span>
		      <span class="fa fa-bars" aria-hidden="true"></span>
		    </a>
        <?php locate_template( 'parts/logo.php', true); ?>
      </div>
      <?php // end of Logo ?>
      <div class="menu-icon-and-links">
        <?php get_template_part( 'menu','secondary' ); ?>
      </div>
   </div>
   <div class="primary-navigation">
      <?php get_template_part( 'menu','primary' ); ?>
      <?php get_template_part( 'menu', 'social' ); ?>
   </div>
   <!-- end of logo Container -->
</header>
<h2 class="mobile-tagline"><?php _e( '30 Years of Apollo Legacy & Trust ' ); ?></h2>
