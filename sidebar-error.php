<?php if ( is_active_sidebar( 'error' ) ) : ?>
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
          <?php dynamic_sidebar( 'error' ); ?>
      </div>
    </div>
  </div>
<?php endif; ?>
