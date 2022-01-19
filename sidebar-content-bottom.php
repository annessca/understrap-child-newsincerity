<?php
/**
 * The template for the content bottom widget areas on posts and pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

if ( ! is_active_sidebar( 'footer-1' ) && ! is_active_sidebar( 'footer-2' ) && ! is_active_sidebar( 'footer-3' ) ) {
	return;
}

// If we get this far, we have widgets. Let's do this.
?>
<aside id="content-bottom-widgets" class="content-bottom-widgets" role="complementary">
	<div class="container">
		<div class="row">
		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-1">
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>

		<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</div><!-- .widget-area -->
		<?php endif; ?>

			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5 text-right">
				<h3 class="section_title">New Sincerity Newsletter</h3>
				<?php echo do_shortcode('[yikes-mailchimp form="1"]'); ?>
				<!-- <?php //$support_link = get_field('support_link','option');
					// if( !empty($support_link) ){
				?>
				<div class="support-btn-footer">
					<a href="<?php //echo $support_link; ?>">SUPPORT US</a>
				</div>
				<?php // } ?> -->
				<?php 
					$facebook = get_field('facebook','option'); 
					$instagram = get_field('instagram','option');
					$twitter = get_field('twitter','option');
					if( !empty( $facebook ) || !empty( $twitter ) || !empty ( $instagram ) ){ ?>
				<div class="social-btn-footer">
					<?php if ( !empty( $facebook ) ){ ?><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook-official"></i></a><?php } ?>
					<?php if ( !empty( $instagram ) ){ ?><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a><?php } ?>
					<?php if ( !empty( $twitter ) ){ ?><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a><?php } ?>
				</div>
				<?php } ?>
			</div><!-- .widget-area -->

		</div>
	</div>
</aside><!-- .content-bottom-widgets -->
