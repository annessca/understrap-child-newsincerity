<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */
$container = get_theme_mod( 'understrap_container_type' );

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
	<style type="text/css">
	/*.ad_wrapper img { width:100%; }*/
	.ad_wrapper { padding:0; }
	</style>
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-T8J7L6T');</script>
<!-- End Google Tag Manager -->
</head>
<body <?php body_class(); ?>>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T8J7L6T"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<!-- ******************* The Navbar Area ******************* -->
	<?php
		$postID = get_queried_object();
		$push_content_block_single = get_field ( 'push_content_block_single', $postID );
		$push_content_block = get_field('push_content_block', $postID );
		if ( !empty ($push_content_block_single) ){ 
	?>
	<div class="ad_wrapper">
		<!--<div class="container">
			<div class="row">
				<div class="col-md-12"> -->
					<?php echo $push_content_block_single; ?>
			<!--	</div>
			</div>
		</div> -->
	</div>
	<?php } elseif ( !empty ($push_content_block) ) { ?>
	<div class="ad_wrapper">
		<!--<div class="container">
			<div class="row">
				<div class="col-md-12"> -->
					<?php echo $push_content_block; ?>
				<!--</div>
			</div>
		</div> -->
	</div>
	<?php }  ?>
	<div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">
		<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content',
		'understrap' ); ?></a>
		<nav class="navbar navbar-toggleable-md navbar-inverse bg-inverse">
			<button type="button" class="hamburger is-closed" data-toggle="offcanvas">
	                <span class="hamb-top"></span>
	    			<span class="hamb-middle"></span>
					<span class="hamb-bottom"></span>
	            </button>
		<?php if ( 'container' == $container ) : ?>
			<div class="container">
		<?php endif; ?>
					<!-- Your site title as branding in the menu -->
					<?php if ( ! has_custom_logo() ) { ?>
						<?php if ( is_front_page() && is_home() ) : ?>
							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
						<?php else : ?>
							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
						<?php endif; ?>
					<?php } else {
						the_custom_logo();
					} ?><!-- end custom logo -->
				<!-- The WordPress Menu goes here -->
					<!-- <button type="button" class="hamburger-push-menu is-closed">
	                <span class="hamb-top"></span>
	    			<span class="hamb-middle"></span>
					<span class="hamb-bottom"></span>
	            </button> -->
			<?php if ( 'container' == $container ) : ?>
			</div><!-- .container -->
			<?php endif; ?>
			<!-- <div class="mailchimp-section">
				<?php //echo do_shortcode('[yikes-mailchimp form="1"]'); ?>
			</div> -->
			<?php 
				$facebook = get_field('facebook','option'); 
				$instagram = get_field('instagram','option');
				$twitter = get_field('twitter','option');
				if( !empty( $facebook ) || !empty( $twitter ) || !empty ( $instagram ) ){ ?>
			<div class="social-icon">
				<?php if ( !empty( $facebook ) ){ ?><a href="<?php echo $facebook; ?>" target="_blank"><i class="fa fa-facebook-official"></i></a><?php } ?>
				<?php if ( !empty( $instagram ) ){ ?><a href="<?php echo $instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a><?php } ?>
				<?php if ( !empty( $twitter ) ){ ?><a href="<?php echo $twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a><?php } ?>
			</div>
			<?php } ?>
			<?php //$support_link = get_field('support_link','option');
				//if( !empty($support_link) ){
			?>
			<!-- <div class="support-btn">
				<a href="<?php //echo $support_link; ?>">SUPPORT US</a>
			</div> -->
			<?php //} ?>
			<div class="menu-side">
				<i class="fa fa-search"></i>
				<i class="fa fa-close"></i>
			</div>
			<div class="search-container">
				<?php echo get_search_form(); ?>
			</div>
		</nav><!-- .site-navigation -->
	</div><!-- .wrapper-navbar end -->
	<div class="hfeed site" id="page">
		<div id="sidebar-wrapper">
			<div class="menu-section">
				<h3 class="menu-section__header">Channels</h3>
				<div class="category_menu">
					<?php
						$categories = get_categories( array(
    							'orderby' => 'name',
    							'order'   => 'ASC'
						) );
						foreach( $categories as $category ) {
							$category_link = sprintf( 
							    '<span class="icon" style="background-color:#%1$s"></span><a href="%2$s" alt="%3$s">%4$s</a>',
							    $term_meta_color = get_term_meta($category->cat_ID, 'color', true),
							    esc_url( get_category_link( $category->term_id ) ),
							    esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
							    esc_html( $category->name )
							);
							echo '<p>' . sprintf( esc_html__( '%s', 'textdomain' ), $category_link ) . '</p> ';
						} wp_reset_postdata();
					?>
					</div>
					<div class="secondary_menu">	
						<h3 class="menu-section__header">MORE FROM NEW SINCERITY</h3>
					<?php wp_nav_menu(
						array(
							'theme_location'  => 'primary',
							'container_class' => 'navbar-collapse',
							'container_id'    => 'sidebar-ps',
							'menu_class'      => 'navbar-nav nav sidebar-nav',
							'fallback_cb'     => '',
							'menu_id'         => 'main-menu',
							'walker'          => new WP_Bootstrap_Navwalker(),
						)
					); ?>
				</div>
				<div class="newsletter_section">
					<h3>Sign Up</h3>
					<p>GET THE LATEST NEWS</p>
					<?php echo do_shortcode('[yikes-mailchimp form="2"]'); ?>
					<?php 
						$facebook = get_field('facebook','option'); 
						$instagram = get_field('instagram','option');
						$twitter = get_field('twitter','option');
						if( !empty( $facebook ) || !empty( $twitter ) || !empty ( $instagram ) ){ ?>
							<div class="social-btn">
								<?php if ( !empty( $facebook ) ){ ?><a href="<?php echo $facebook; ?>"><i class="fa fa-facebook-official"></i></a><?php } ?>
								<?php if ( !empty( $instagram ) ){ ?><a href="<?php echo $instagram; ?>"><i class="fa fa-instagram"></i></a><?php } ?>
								<?php if ( !empty( $twitter ) ){ ?><a href="<?php echo $twitter; ?>"><i class="fa fa-twitter"></i></a><?php } ?>
							</div>
						<?php } 
					?>
				</div>
			</div>
		</div>
		<div class="overlay"></div>
		<!-- <div class="pull-above-section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php $push_content_block = get_field('push_content_block','option'); 
							if( !empty ($push_content_block) ){
								echo $push_content_block;
							}
						?>
					</div>
				</div>
			</div>
		</div> -->







