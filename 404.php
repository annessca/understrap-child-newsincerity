<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package understrap
 */

get_header();
?>
<style type="text/css">
	#wrapper-navbar {
		display: none;
	}
	.error-404{
		border: 1px solid #e7e7e8;
	    border-top: 10px solid #CC33FF;
	    margin: 64px 0;
	    max-width: 700px;
	    padding: 32px 32px 52px 32px;
	}
	.page-header{
		margin: 0 0 20px
	}
	.navbar-brand{
		float: none;
	}
	.error-404 a{
		  color: #41BCD8;
      text-decoration: none;
    transition: color 0.3s ease-in-out;
    border-bottom: solid 2px #41BCD8;
	}
	.error-404 a:hover{
		color: #ccc;
  text-decoration: none;
  border-bottom-color: #ccc;
	}
	.assistive-text {
		display: none;
	}
	#searchform .input-group .form-control{
		color: #c3f;
    	border: 1px solid #c3f;
    	border-radius: 0;
	}
	.btn-primary {
    color: #fff;
    background-color: #cc33ff;
    border-color: #cc33ff;
    border-radius: 0;
}
</style>
<div class="wrapper" id="404-wrapper">

	<div class="container" id="content">

		<div class="row">

			<div class="content-area" id="primary">

				<main class="site-main" id="main" role="main">

					<section class="error-404 not-found">
						<?php if ( ! has_custom_logo() ) { ?>



						<?php if ( is_front_page() && is_home() ) : ?>



							<h1 class="navbar-brand mb-0"><a rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>

							

						<?php else : ?>



							<a class="navbar-brand" rel="home" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"><?php bloginfo( 'name' ); ?></a>

						

						<?php endif; ?>

						

					

						<?php } else {

							the_custom_logo();

						} ?>

						<header class="page-header">

							<h1 class="page-title"><?php esc_html_e( '404 Not found',
							'understrap' ); ?></h1>

						</header><!-- .page-header -->

						<div class="page-content">

							<p>Whoa, that page couldnt be found! Swing back to the <a href="<?php echo get_page_link( 2 ); ?>">The New Sincerity home page</a> if you like. Hang in there.</p>

							<?php get_search_form(); ?>

							<?php //the_widget( 'WP_Widget_Recent_Posts' ); ?>

							

							<?php
							/* translators: %1$s: smiley */
							/*$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s',
							'understrap' ), convert_smilies( ':)' ) ) . '</p>';
							the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );*/
							?>

							<?php //the_widget( 'WP_Widget_Tag_Cloud' ); ?>

						</div><!-- .page-content -->

					</section><!-- .error-404 -->

				</main><!-- #main -->

			</div><!-- #primary -->

		</div> <!-- .row -->

	</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
