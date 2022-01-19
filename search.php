<?php
/**
 * The template for displaying search results pages.
 *
 * @package understrap
 */

get_header();

$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<div class="wrapper" id="search-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">
            <?php
            $search_for = $_GET['s'];
            $key = wp_specialchars($search_for, 1);
            $total_search_results = new WP_Query("s=$key&showposts=-1");
            $total_count = $total_search_results->post_count; //var_dump($total_search_results)?>
			<!-- Do the left sidebar check and opens the primary div -->
			<?php //get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>
			<div class="col-md-12">
				<main class="site-main" id="main">

					<?php if ( have_posts() ) : ?>

						<header class="page-header author-header search-header">

							<h1 class="author-title"><?php printf( esc_html__( 'Ta Da! Search results for %s', 'understrap' ),
							'<span style="color:#CC33FF">' . get_search_query() . '</span>' ); ?></h1>

						</header><!-- .page-header -->

						<?php $i = 0; /* Start the Loop */ ?>
						<div class="row archieve_post">
							<?php while ( have_posts() ) : the_post(); ?>
								<div class="col-sm-12 col-md-6 col-lg-4 author-post">
								<?php
								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
									get_template_part( 'loop-templates/content', 'search' );
									$i++;
								?>
								</div>
							<?php endwhile;
							 wp_reset_postdata(); ?>
						</div>
					<?php else : ?>

						<?php get_template_part( 'loop-templates/content', 'none' ); ?>

					<?php endif; ?>
					<?php //$cats = wp_get_post_categories( $post->ID );
						//$cat_id = $cats[0]; 
					$search_term = (isset($_GET['s'])) ? $_GET['s'] : 0;?>
					<?php //echo do_shortcode('[ajax_load_more]'); ?>
				    <div class="load_more_btn author-load">
                        <?php if($total_count > 6){?>
						<div id="more_search_more_posts" data-category="<?php echo $search_term; ?>"><?php esc_html_e('Load More', 'twentysixteen') ?></div>
                        <?php } ?>
					</div>
				</main><!-- #main -->
			</div>
			<!-- The pagination component -->
			<?php  // understrap_pagination(); ?>

		<!-- Do the right sidebar check -->
		<?php //if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php //get_sidebar( 'right' ); ?>

		<?php //endif; ?>

	</div><!-- .row -->

</div><!-- Container end -->

</div><!-- Wrapper end -->
<script type="text/javascript">
	(function($){
		$(document).ready(function(){
			var ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
			var $content = $('.archieve_post');
			var $loader = $('#more_search_more_posts');
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
							'search': cat,
							'ppp': ppp,
							'offset': offset,
							'action': 'search_more_post_ajax'
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
