<?php
/**
 * footer.php
 *
 * The template for displaying the footer.
 */
?>
	<!-- FOOTER -->
	<div id="request-callback" role="dialog" class="white popup-block mfp-with-anim mfp-hide">
		<?php echo do_shortcode('[gravityform id="7" title="true" description="false" ajax="true"]'); ?>
	</div>
	<footer id="footer">
		<?php if( ! is_front_page() ): ?>
			<div id="ticker">
				<a href="#" title="Enquire Now">
		        <img src="<?php echo TBE_LIBRARY_IMAGES_URI . 'msg.png'; ?>"> <?php _e( 'Enquire Now', 'firstshow-tekzenit' ); ?>
		    </a>
			</div>
			<div id="enquire-now" role="dialog">
				<a href="#" class="close-form"><span class="fa fa-close" aria-hidden="true"></span></a>
				<?php echo do_shortcode('[gravityform id="1" title="true" description="false" ajax="true"]'); ?>
			</div>
		<?php endif; ?>
		<div class="footer-content">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="copyright">
							<p><?php printf( __( 'Copyright &copy; %s Apollo Sugar. All Rights Reserved.', 'firstshow-tekzenit' ), date_i18n( 'Y' ) ); ?> | <a href="<?php the_permalink(3533); ?>"><?php _e( 'Disclaimer', 'firstshow-tekzenit' ); ?></a> | <a href="<?php the_permalink(3536); ?>"><?php _e( 'Site Map', 'firstshow-tekzenit' ); ?></a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer> <!-- end site-footer -->
</div><!-- End of Page Wrapper -->
	<?php wp_footer(); ?>
	</body>
</html>
