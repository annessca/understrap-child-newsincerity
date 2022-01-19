<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );

?>

<div class="wrapper" id="page-wrapper">
	<div class="page-title-section" style="background-color:<?php the_field('color'); ?>">
    	<div class="container">
    		<div class="row">
        		<div class="col-md-12 text-center">
            		<h2><?php echo get_the_title($post->ID); ?></h2>
          		</div>
        	</div>
    	</div>
  	</div>
	<div id="content" tabindex="-1">
		<div class="content-section">

			<!-- Do the left sidebar check -->
			<?php //get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>
			<main class="site-main" id="main">

				<?php while ( have_posts() ) : the_post(); ?>
			
					<?php get_template_part( 'loop-templates/content', 'page' ); ?>

					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
					?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
			
      	</div>
</div><!-- Wrapper end -->

<?php get_footer(); ?>
