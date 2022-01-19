<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>
<div class="signup_section">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-12 col-lg-offset-3 col-lg-6 text-center">
				<h2 class="section_title">Sign Up to Rise Up</h2>
				<p class="note">Get the latest news in your inbox</p>
				<?php echo do_shortcode('[yikes-mailchimp form="1"]'); ?>
			</div>
			<!-- <div class="col-xs-12 col-md-12 col-lg-6">
				<div class="testimonial_wrap">
					<img class="testimonial_icon" src="<?php echo get_stylesheet_directory_uri(); ?>/images/testimonial-icon.png" />
					<p class="testimonial">New Sincerity is email that lifts me UP! Life is crazy, and these stories and faces are pure inspiration. Love it.<br>
						- Sanna from West Virginia</p>
				</div>
			</div> -->
		</div>
	</div>
</div>
<?php get_sidebar( 'footerfull' ); ?>
<!--div class="home-social">
	<div class="container">
        <div class="row">
            <div class="col-md-12">
            	<section class="social_wrap">
	            	<div class="top_grad"></div>
	                <h2 class="section_title">@NewSincerity</h2>
	            </section>
            </div>
        </div>
		<div class="row">
			<div class="col-md-12">
				<div class="social_wrap">
					<div class="tablet"><div><?php echo do_shortcode('[custom-facebook-feed]'); ?></div></div>
					<div class="phone"><div><?php echo do_shortcode('[instagram-feed num=40 cols=1 showfollow=false showheader=true showbio=false showfollowers=false showbutton=false]'); ?></div></div>
					<div class="facebook-round">
						<?php $facebook = get_field('facebook','option'); ?>
						<a href="<?php echo $facebook; ?>" target="_blank" title="Like us on Facebook"><i class="fa fa-facebook-official"></i>
						</a>
					</div>
					<div class="instagram-round">
					<?php $instagram = get_field('instagram','option'); ?>
						<a href="<?php echo $instagram; ?>" target="_blank" title="Follow us on Instagram"><i class="fa fa-instagram"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div-->
<?php get_sidebar( 'content-bottom' ); ?>
<div class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_html( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<footer class="site-footer" id="colophon">

					<div class="site-info">
						<a href="<?php echo esc_url( __( 'http://wordpress.org/','understrap' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'understrap' ),'WordPress' ); ?></a>
						<span class="sep"> | </span>
						<?php printf( // WPCS: XSS ok.
							esc_html__( 'Theme: %1$s by %2$s.', 'understrap' ), $the_theme->get( 'Name' ),
						'<a href="http://understrap.com/">understrap.com</a>' ); ?>
						(<?php printf( // WPCS: XSS ok.
							esc_html__( 'Version: %1$s', 'understrap' ), $the_theme->get( 'Version' ) ); ?>)
					</div><!-- .site-info -->

				</footer><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</div><!-- wrapper end -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
