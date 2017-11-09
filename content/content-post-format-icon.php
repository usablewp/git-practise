<?php
  $format       = get_post_format();
  $format_icon  = '';
  if( 'aside' === $format )
    $format_icon = '<span aria-hidden="true" class="fa fa-file-text-o format-icon"></span>';
  elseif( 'audio' === $format )
    $format_icon = '<span aria-hidden="true" class="fa fa-music format-icon"></span>';
  elseif( 'chat' === $format )
    $format_icon = '<span aria-hidden="true" class="fa fa-comments format-icon"></span>';
  elseif( 'image' === $format )
    $format_icon = '<span aria-hidden="true" class="fa fa-image format-icon"></span>';
  elseif( 'gallery' === $format )
    $format_icon = '<span aria-hidden="true" class="fa fa-image format-icon"></span>';
  elseif( 'link' === $format )
    $format_icon = '<span aria-hidden="true" class="fa fa-link format-icon"></span>';
  elseif( 'quote' === $format )
    $format_icon = '<span aria-hidden="true" class="fa fa-quote-left format-icon"></span>';
  elseif( 'status' === $format )
    $format_icon = '<span aria-hidden="true" class="fa fa-commenting format-icon"></span>';
  elseif( 'video' === $format )
    $format_icon = '<span aria-hidden="true" class="fa fa-video-camera format-icon"></span>';
  else
    $format_icon = '';
?>

<?php if( ! empty( $format_icon ) ): ?>
  <div class="post-format-icon-container">
    <?php echo $format_icon; ?>
  </div>
<?php endif; ?>
