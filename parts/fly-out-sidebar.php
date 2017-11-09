<div id="off-canvas" off-canvas="id-3 left push">
  <div class="close-container">
    <a href="#" class="sb-close">
            <span class="screen-reader-text"><?php _e( 'Close Menu', 'firstshow-tekzenit' ); ?></span>
            <span class="fa fa-close" aria-hidden="true"></span>
        </a>
  </div>
  <nav role="navigation">
    <?php
    if( has_nav_menu( 'primary' ) ) :
          wp_nav_menu( array(
            'theme_location'    => 'primary',
            'menu_class'        => 'mobile-menu',
          ) );
    endif;
    ?>
  </nav>
  <?php get_sidebar( 'fly-out' ); ?>
</div>
