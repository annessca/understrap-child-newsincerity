<?php
/**
 * The template for displaying the author pages.
 *
 * Learn more: https://codex.wordpress.org/Author_Templates
 *
 * @package understrap
 */

get_header();
$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>


<div class="wrapper" id="author-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

			<main class="site-main" id="main">

				<header class="page-header author-header">

					<?php
					$curauth = ( isset( $_GET['author_name'] ) ) ? get_user_by( 'slug',
						$author_name ) : get_userdata( intval( $author ) );
					?>

					<h1 class="author-title"><?php if ( ! empty( $curauth->ID ) ) : ?>
						<?php echo get_avatar( $curauth->ID ); ?>
					<?php endif; ?> <?php echo esc_html( $curauth->display_name ); ?></h1>
					<?php //echo '<pre>'; print_r($curauth); echo '</pre>';?>


					

				</header><!-- .page-header -->

				<div class="row archieve_post">

					<!-- The Loop -->
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="col-sm-12 col-md-6 col-lg-4 author-post">
						
								<?php

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'loop-templates/content', 'author' );
								?>
							</div>
						<?php endwhile; ?>
					<?php else : ?>

						<?php get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>

					<!-- End Loop -->
				</div>
				<?php //$cats = wp_get_post_categories( $post->ID );
						//$cat_id = $cats[0]; 
						$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
						//print_r($author);
						?>
				<div class="load_more_btn author-load">
						<div id="search_more_posts" data-category="<?php echo $author->ID; ?>"><?php esc_html_e('Load More', 'twentysixteen') ?></div>
					</div>
			</main><!-- #main -->

			<!-- The pagination component -->
			<?php //understrap_pagination(); ?>

		</div><!-- #primary -->

		<!-- Do the right sidebar check -->
		<?php //if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php //get_sidebar( 'right' ); ?>

		<?php // endif; ?>

	</div> <!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->
<script type="text/javascript">
	(function($){
		$(document).ready(function(){
			var ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
			var $content = $('.archieve_post');
			var $loader = $('#search_more_posts');
			var cat = $loader.data('category');
			var ppp = 6;
			var offset = $('.archieve_post').find('.author-post').length;
		 
			$loader.on( 'click', load_ajax_posts );
		 
			function load_ajax_posts() {
				if (!($loader.hasClass('post_loading_loader') || $loader.hasClass('post_no_more_posts'))) {
					var ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
					$.ajax({
						type: 'POST',
						dataType: 'html',
						url: ajaxUrl,
						data: {
							'author': cat,
							'ppp': ppp,
							'offset': offset,
							'action': 'author_more_post_ajax'
						},
						beforeSend : function () {
							$loader.addClass('post_loading_loader').html('loading...');
						},
						success: function (data) {
							var $data = $(data);
							if ($data.length) {
								var $newElements = $data.css({ opacity: 0 });
								$content.append($newElements);
								$newElements.animate({ opacity: 1 });
								$loader.removeClass('post_loading_loader').html('load more');
							} else {
								$loader.removeClass('post_loading_loader').addClass('post_no_more_posts').html('no more posts');
								$loader.hide();
								var nomore = "<a href=<?php echo get_site_url(); ?> class=post_no_more_posts>THAT'S ABOUT IT! HEAD HOME</a>";
								$('.load_more_btn').html(nomore);
							}
						},
						error : function (jqXHR, textStatus, errorThrown) {
							$loader.html($.parseJSON(jqXHR.responseText) + ' :: ' + textStatus + ' :: ' + errorThrown);
							console.log(jqXHR);
						},
					});
				}
			offset += ppp;
			return false;
			}
		});
	})(jQuery);
	</script>
<?php get_footer(); ?>
