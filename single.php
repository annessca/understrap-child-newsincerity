<?php
/**
 * The template for displaying all single posts.
 *
 * @package understrap
 */

get_header();
$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<div class="wrapper" id="single-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">
			<div class="col-md-12">
			<!-- Do the left sidebar check -->
				<?php //get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

				<main class="site-main" id="main">
                    <div id="first-post">
					<?php while ( have_posts() ) : the_post(); ?>

						<?php get_template_part( 'loop-templates/content', 'single' ); ?>

							<?php //understrap_post_nav(); ?>

						<?php
						// If comments are open or we have at least one comment, load up the comment template.
						/*if ( comments_open() || get_comments_number() ) :
							comments_template();
						endif;*/
						?>

					<?php endwhile; // end of the loop. 
						wp_reset_postdata();
					?>
                    </div>
				</main><!-- #main -->

		<!-- Do the right sidebar check -->
		<?php //if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php //get_sidebar( 'right' ); ?>

		<?php //endif; ?>

			</div>
		</div><!-- #primary -->

	</div><!-- Container end -->
<div class="bottom-bar"></div>
	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<div class="row">
			<div class="col-md-12">
			<!-- Do the left sidebar check -->
				<?php //get_template_part( 'global-templates/left-sidebar-check', 'none' ); ?>

				<main class="site-main" id="main">
					<?php
						$cats = get_the_category( $post->ID );
						//echo '<pre>'; print_r($cats);
						$cat_url = get_category_link( $cats[0]->term_id );
						$cat_id = $cats[0]->term_id;
						//$catgory = get_term( $cat_id );
						$term_meta_color = get_term_meta($cats[0]->term_id, 'color', true);
						$cat_name = $cats[0]->name; 
					//print_r($current_category);
    					$recent_post = new WP_Query(array(
										    'cat'            => $cat_id,
										    'post__not_in'   => array($post->ID),
										    'orderby'        => 'date',
										    'order'			 => 'DESC',
										    'posts_per_page' => 1
										));
    					//echo '<pre>'; print_r($recent_post); echo '</pre>'; ?>
                    <?php if ( $recent_post -> have_posts() ) : while ($recent_post -> have_posts()) : 
                    //$firstPosts = $recent_post->the_post();
                    //print_r( $firstPosts );
                    $recent_post -> the_post(); 
                    $firstposts = $post->ID;
                    ?>
                        <div id="second-post">
						    <?php //get_template_part( 'loop-templates/content', 'single' ); ?>
						    <?php 
								$facebook_share  = 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink();
								$twitter_share   = 'https://twitter.com/share?url='.get_the_permalink().';&text='.get_the_title().'&via=new_sincerity';
								$email_share = 'mailto:?subject=Fresh from New Sincerity -'.get_the_title().'&body='. get_the_permalink();
								$whatsapp_share = 'whatsapp://send?text='. get_the_permalink();
								?>
							<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
								<?php if ( has_post_thumbnail() ) { ?>
									<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>		
								<?php } else { ?>
									<img class="img-responsive" src="<?php bloginfo('template_directory'); ?>-child-master/images/default.png" alt="<?php the_title(); ?>" />
								<?php } ?>
								<?php //echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
								<?php

									//$cats = wp_get_post_categories( $post->ID );
									//echo '<pre>'; print_r($cats);
									//$cat_url = get_category_link( $cats[0] );
									//$cat_id = $cats[0];
									//$catgory = get_term( $cat_id );
									//$term_meta_color = get_term_meta($cats[0], 'color', true);
									//$cat_name = $catgory->name; 
								?>
								<?php echo '<a href="'.$cat_url.'"><span class="cat_name" style="background-color:#'.$term_meta_color.'">'.$cat_name.'</span></a>'; ?> 
								
									<header class="entry-header">

										<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

									</header><!-- .entry-header -->
									<div class="post_share">
										<div class="row">
											<div class="col-sm-12 col-md-8">
												<div class="entry-meta">

													<?php understrap_posted_on(); ?>

												</div><!-- .entry-meta -->
											</div>
											<div class="col-sm-12 col-md-4 text-right" style="display: none;">
												<ul>
													<li class="social-share facebook"><a href="<?php echo $facebook_share; ?>" target="_blank" title="Share on Faceboook" data-title="<?php echo urlencode(get_the_title()); ?>" class="fb-share" onClick="PopupCenter('<?php echo $facebook_share; ?>','<?php echo get_the_title(); ?>','500','500'); "><i class="fa fa-facebook"></i></a></li>
														<li class="social-share twitter"><a href="<?php echo $twitter_share; ?>" target="_blank" title="Tweet on Twiiter" class="tw-share" onClick="PopupCenter('<?php echo $twitter_share; ?>','<?php echo get_the_title(); ?>','500','500'); "><i class="fa fa-twitter"></i></a></li>
													<li class="social-share email"><a href="<?php echo $email_share; ?>" title="Send email" class="el-share"><i class="fa fa-envelope"></i>
													</a></li>
													<li class="social-share whatsapp"><a href="<?php echo $whatsapp_share; ?>" title="Send whatsapp message" class="wt-share"><i class="fa fa-whatsapp"></i>
													</a></li>
												</ul>
											</div>
										</div>
									</div>
									
								<div class="single-content">
									<div class="entry-content">
										<?php echo '<h3>';
											echo get_secondary_title();
												echo '</h3>';				?>
										<?php the_content(); ?>

									</div><!-- .entry-content -->
								</div>
							</article><!-- #post-## -->

                        </div>

						
					<?php endwhile; wp_reset_postdata(); endif;  // end of the loop. ?>

				</main><!-- #main -->

		<!-- Do the right sidebar check -->
		<?php //if ( 'right' === $sidebar_pos || 'both' === $sidebar_pos ) : ?>

			<?php //get_sidebar( 'right' ); ?>

		<?php //endif; ?>

			</div>
		</div><!-- #primary -->

	</div><!-- Container end -->

	
<input type="hidden" name="first_loading" id="first_loading" value="2">
</div><!-- Wrapper end -->
<!--?php echo rise_up_slider('rise_up_slider', 'option'); ?-->
<div class="load_more_section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<section class="featured_post">
					<div class="top_grad"></div>
					<div class="row">
						<?php
							//$cats = wp_get_post_categories( $post->ID );
						//$cat_url = get_category_link( $cats[0] );
						//$cat_id = $cats[0];
						//$catgory = get_term( $cat_id );
					//	$term_meta_color = get_term_meta($cats[0], 'color', true);
					//	$cat_name = $catgory->name; 
						?>
						<div class="col-md-12">
							<h2 class="section_title">More from <?php echo $cat_name; ?></h2>
						</div>
					</div>
					<div class="row posts">
					<?php
						$main_post = $post->ID;
						$cats = get_the_category( $post->ID );
						//echo '<pre>'; print_r($cats);
						$cat_url = get_category_link( $cats[0]->term_id );
						$cat_id = $cats[0]->term_id;
						//$catgory = get_term( $cat_id );
						$term_meta_color = get_term_meta($cats[0]->term_id, 'color', true);
						$cat_name = $cats[0]->name; 
					$recent_posts_get = new WP_Query( array(
									     'posts_per_page' => 4,
									     'post__not_in'   => array($main_post, $firstposts),
									     'orderby'        => 'date',
									     'order'          => 'DESC',
									     'category__in'       => $cat_id,
									     'post_status'    => 'publish'
									) );
					$flag = 1;
					//echo '<pre>'; print_r($recent_posts);  echo '</pre>';
					//if ( $recent_posts_get->have_posts() ) :
					///	while ( $recent_posts_get->have_posts() ) : $recent_posts_get->the_post();
					$recent_posts_gets = $recent_posts_get->posts;
					//echo '<pre>'; print_r($recent_posts_gets); echo '</pre>';
					foreach( $recent_posts_gets as $recent_posts ):
						$post_thumbnail_id = get_post_thumbnail_id($recent_posts->ID); 
						$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
						$excerpt = wp_trim_words( $recent_posts->post_content, 60);
						//$cats = wp_get_post_categories( $recent_posts->ID );
						//$cat_url = get_category_link( $cats[0] );
						//$cat_id = $cats[0];
						//$catgory = get_term( $cat_id );
						//$term_meta_color = get_term_meta($cats[0], 'color', true);
						//$cat_name = $catgory->name;
						$recent_author = get_user_by( 'ID', $recent_posts->post_author );
						$author_display_name = $recent_author->display_name;
						$author_url = get_author_posts_url( false, $recent_author->user_nicename ); ?>
						<?php 
						if ($flag % 2 == 0) {
							echo '<div class="col-xs-12 col-md-12 col-lg-8 big-title post-loads clear-none">'; 
						} else {
							echo '<div class="col-xs-12 col-md-12 col-lg-4 post-loads clear-both">';
						}?>
						<div class="american_wrapper">
							<div class="american_thumb">
								<?php echo '<a href="'.$cat_url.'"><span class="cat_name" style="background-color:#'.$term_meta_color.'">'.$cat_name.'</span></a>'; ?> 
								<?php if ( !empty($post_thumbnail_url) ) { ?>
									<?php echo '<a href="'.get_permalink($recent_posts->ID).'" title="'.$recent_posts->post_title.'" class="element-wrap">'; ?>
									<img class="img-responsive" src="<?php echo $post_thumbnail_url; ?>" />
									<span class="hover-element"></span>
									</a>		
								<?php } else { ?>
								<img class="img-responsive" src="<?php bloginfo('template_directory'); ?>-child-master/images/default.png" alt="<?php echo $recent_posts->post_title; ?>" />
								<?php } ?>
								<?php echo '<span class="post_date">'.date('F j, Y', strtotime($recent_posts->post_date) ).'</span>'; ?>
							</div>
							<div class="american_content">
								<?php
  								echo '<a href="'.get_permalink($recent_posts->ID).'" title="'.$recent_posts->post_title.'"><h3 class="post_title">'.$recent_posts->post_title.'</h3></a>';
  								echo '<p class="post_author">by <a href="'.$author_url.'">'.$author_display_name.'</a></p>';
  								echo '<p class="post_excerpt">'.$excerpt.'</p>';
								?>
							</div>
						</div>
					<?php echo '</div>'; ?>
					<?php $flag++; endforeach; wp_reset_postdata(); //endif; ?>
					</div>
					<?php //$cats = wp_get_post_categories( $post->ID );
						//$cat_id = $cats[0]; ?>
					<div class="load_more_btn">
						<div id="more_posts" data-category="<?php echo $cat_id; ?>"><?php esc_html_e('Load More', 'twentysixteen') ?></div>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>
<?php 
	$facebook_share  = 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink();
	$twitter_share   = 'https://twitter.com/share?url='.get_the_permalink().';&text= '.get_the_title().'&via=new_sincerity';
	$email_share = 'mailto:?subject=Fresh from New Sincerity -'.get_the_title().'&body='. get_the_permalink();
	$whatsapp_share = 'whatsapp://send?text='. get_the_permalink();
	?>
	<div class="post_share footer-fixed open" id="social-share-bar-footer-fixed">
		<ul>
			<li class="social-share facebook"><a href="<?php echo $facebook_share; ?>" target="_blank" title="Share on Faceboook" id="footer-fb-share" onClick="PopupCenter('<?php echo $facebook_share; ?>','<?php echo get_the_title(); ?>','500','500'); return false; " class="fb-share"><i class="fa fa-facebook"></i></a></li>
			<li class="social-share twitter"><a href="<?php //echo $twitter_share; ?>" target="_blank" title="Tweet on Twiiter" id="footer-tw-share" onClick="PopupCenter('<?php echo $twitter_share; ?>','<?php echo get_the_title(); ?>','500','500');  return false;" class="tw-share"><i class="fa fa-twitter"></i></a></li>
			<li class="social-share email"><a href="<?php echo $email_share; ?>" title="Send email" id="footer-el-share" class="el-share"><i class="fa fa-envelope"></i>
			</a></li>
			<li class="social-share whatsapp"><a href="<?php echo $whatsapp_share; ?>" title="Send whatsapp message" id="footer-wt-share" class="wt-share"><i class="fa fa-whatsapp"></i>
			</a></li>
		</ul>
	</div>
<script type="text/javascript">
	(function($){
	$(document).ready(function(){
		var ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
			var $content = $('.posts');
		var $loader = $('#more_posts');
		var cat = $loader.data('category');
		var ppp = 4;
		var offset = $('.posts').find('.post-loads').length;
		//console.log(offset);
		 
		$loader.on( 'click', load_ajax_posts );
		 
		function load_ajax_posts() {
			if (!($loader.hasClass('post_loading_loader') || $loader.hasClass('post_no_more_posts'))) {
				var ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
				var first_loading = $("#first_loading").val();
				$.ajax({
					type: 'POST',
					dataType: 'html',
					url: ajaxUrl,
					data: {
						'cat': cat,
						'ppp': ppp,
						'offset': offset,
						'action': 'more_post_ajax',
                        'first_loading': first_loading
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
    $.fn.isOnScreen = function(){

        var win = $(window);

        var viewport = {
            top : win.scrollTop(),
            left : win.scrollLeft()
        };
        viewport.right = viewport.left + win.width();
        viewport.bottom = viewport.top + win.height();

        var bounds = this.offset();
        bounds.right = bounds.left + this.outerWidth();
        bounds.bottom = bounds.top + this.outerHeight();

        //return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));
        return ($(window).scrollTop() > this.offset().top * 0.7);

    };
    $(window).scroll(function() {
        var hT = $('#second-post').offset().top,
            hH = $('#second-post').outerHeight(),
            wH = $(window).height(),
            wS = $(this).scrollTop();
        if ($('#second-post').isOnScreen()){
            var post_title = document.getElementsByClassName("fb-share")[1].getAttribute('data-title');
            var f_url = document.getElementsByClassName("fb-share")[1].href;
            var t_url = document.getElementsByClassName("tw-share")[1].href;
            var e_url = document.getElementsByClassName("el-share")[1].href;
            var w_url = document.getElementsByClassName("wt-share")[1].href;
            $("#footer-fb-share").attr('href', f_url);
            $("#footer-fb-share").attr("onclick","PopupCenter('"+f_url+"', '"+post_title+"', '500', '500'); return false;");
            $("#footer-tw-share").attr('href', t_url);
            $("#footer-tw-share").attr("onclick","PopupCenter('"+t_url+"', '"+post_title+"', '500', '500'); return false;");
            $("#footer-el-share").attr('href', e_url);
            $("#footer-wt-share").attr('href', w_url);
        }
        else /*if(/*$('#first-post').isOnScreen())*/{
            var post_title = document.getElementsByClassName("fb-share")[0].getAttribute('data-title');
            var f_url = document.getElementsByClassName("fb-share")[0].href;
            var t_url = document.getElementsByClassName("tw-share")[0].href;
            var e_url = document.getElementsByClassName("el-share")[0].href;
            var w_url = document.getElementsByClassName("wt-share")[0].href;
            $("#footer-fb-share").attr('href', f_url);
            $("#footer-fb-share").attr("onclick","PopupCenter('"+f_url+"', '"+post_title+"', '500', '500'); return false;");
            $("#footer-tw-share").attr('href', t_url);
            $("#footer-tw-share").attr("onclick","PopupCenter('"+t_url+"', '"+post_title+"', '500', '500'); return false;");
            $("#footer-el-share").attr('href', e_url);
            $("#footer-wt-share").attr('href', w_url);
        }

        if (wS > (hT+hH+150-wH)){
            $( "#social-share-bar-footer-fixed" ).hide( "slide", { direction: "left" }, "slow" );
        }
        else if(wS < (hT+hH+150-wH)){
            $( "#social-share-bar-footer-fixed" ).show( "slide", { direction: "right" }, "slow" );
        }
    });
})(jQuery);
function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}
</script>
<?php get_footer(); ?>
