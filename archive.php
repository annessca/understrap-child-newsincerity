<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

get_header();
?>

<?php
$container   = get_theme_mod( 'understrap_container_type' );
$sidebar_pos = get_theme_mod( 'understrap_sidebar_position' );
?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">


			<main class="site-main" id="main">

				<?php $current_category = get_queried_object_id();
					$catgory = get_term( $current_category );
					$cat_name = $catgory->name;
        $term_meta_color = get_term_meta( $current_category, 'color', true);
					$query = new WP_Query('category_name='.$cat_name.'&posts_per_page=4');
					if ( $query->have_posts() ) : ?>

					<header class="page-header">
					<div class="top_grad"></div>
						<?php
            
						//the_archive_title( '<h1 class="page-title" style="color:#'.$term_meta_color.';">', '</h1>' );
						echo '<h1 class="page-title" style="color:#'.$term_meta_color.'">'.$cat_name.'</h1>';
						//the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
					</header><!-- .page-header -->
					<div class="row archieve_post">
					<?php /* Start the Loop */ $flag = 0;  ?>
					<?php while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php if($flag == 0){ ?>
						<div class="col-sm-12 col-md-12 col-lg-12 big-title"> 
							<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
								<?php 
									$current_category = get_queried_object_id();
									$cat_url = get_category_link( $current_category );
									$term_meta_color = get_term_meta( $current_category, 'color', true);
									$catgory = get_term( $current_category );
									$cat_name = $catgory->name;
									$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
									if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
										$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
									}
									$time_string = sprintf( $time_string,
										esc_attr( get_the_date( 'c' ) ),
										esc_html( get_the_date() ),
										esc_attr( get_the_modified_date( 'c' ) ),
										esc_html( get_the_modified_date() )
									);
									$posted_on = sprintf(
										esc_html_x( '%s', 'post date', 'understrap' ),
										'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
									);
									$byline = sprintf(
										esc_html_x( 'by %s', 'post author', 'understrap' ),
										'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
									);
								?>
								<div class="american_wrapper row">
									<div class="american_thumb col-sm-12 col-md-12 col-lg-6">
										<?php echo '<a href="'.$cat_url.'"><span class="cat_name" style="background-color:#'.$term_meta_color.'">'.$cat_name.'</span></a>'; ?>
										<?php if ( has_post_thumbnail() ) { ?>
										<?php echo '<a href="'.get_permalink($recent->ID).'" class="element-wrap">'; ?>
											<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
											<span class="hover-element"></span>
										</a>
										<?php } else { ?>
										<img class="img-responsive" src="<?php bloginfo('template_directory'); ?>-child-master/images/default.png" alt="<?php the_title(); ?>" />
										<?php } ?>
										<?php echo '<span class="post_date">'.$posted_on.'</span>'; ?>
									</div>
									<div class="american_content col-sm-12 col-md-12 col-lg-6">
										<!-- <header class="entry-header">
											<?php //the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
									//'</a></h2>' ); ?>
										</header>

										<div class="entry-content">

											<?php
											//the_excerpt();
											?>

										</div> -->
										<?php
											the_title( sprintf( '<h3 class="post_title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
									'</a></h3>' );
											echo '<p class="post_author">'.$byline.'</p>';
											/*echo '<p class="post_excerpt">'.the_excerpt().'</p>';*/

											echo '<p class="post_excerpt">'.wp_trim_words( strip_shortcodes($post->post_content), 100).'</p>';
										?>
									</div>
								</div>
							</article><!-- #post-## -->
						<?php } else { ?>
						<div class="col-sm-12 col-md-6 col-lg-4">
						
						<?php

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'loop-templates/content', get_post_format() );
						?>
						<?php } ?>
						</div>
					<?php $flag++; endwhile; ?>
					</div>
				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php //understrap_pagination(); ?>

		
		<?php //echo partner_box(); 
		$queried_object = get_queried_object(); 
		$taxonomy = $queried_object->taxonomy;
		$term_id = $queried_object->term_id;  
					if( have_rows('partner_content', $queried_object) ) { ?>

			        <section class="partner_section" style="background-color: <?php echo get_field('partner_box_color', $queried_object); ?>">
			        <?php while ( have_rows('partner_content', $queried_object) ) : the_row(); ?>
			        	<div class="row">
			        	<?php if( get_row_layout() == 'partner_box' ) { ?>
			                <?php 
			                $partner_posts = get_sub_field('partner_posts', $queried_object); 
			                if ( !empty ($partner_posts) ) {
			                ?>
			                <div class="col-xs-12 col-md-12 col-lg-6">
			                <?php } else { ?>
			                <div class="col-xs-12 col-md-12 col-lg-12">
			                <?php }
			                    $partner_title = get_sub_field('partner_title', $queried_object); 
			                    $partner_content = get_sub_field('partner_content', $queried_object);
			                    $partner_button_url = get_sub_field('partner_button_url', $queried_object);
			                    $partner_button_text = get_sub_field('partner_button_text', $queried_object);
			                ?>
			                    <div class="partner_content">
			                        <h3 class="partner_title"><?php if ( !empty ($partner_title) ) { echo $partner_title; } ?></h3>
			                        <div class="height20"></div>
			                        <?php if ( !empty ($partner_content) ) { echo $partner_content; } ?>
			                        <?php if ( !empty ($partner_button_text) ) { ?>
			                        <div class="height30"></div>
			                        <div class="partner-btn">
			                            <a href="<?php echo $partner_button_url; ?>" target="_blank"><?php echo $partner_button_text; ?></a>
			                        </div>
			                        <?php } ?>
			                    </div>
			                </div>
			                <?php if ( !empty ($partner_posts) ) { ?>
			                <div class="col-xs-12 col-md-12 col-lg-6">
			                    <div class="row">
			                        <?php
			                        foreach( $partner_posts as $recent ):
			                        $post_thumbnail_id = get_post_thumbnail_id($recent->ID); 
			                        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
			                        $excerpt = wp_trim_words( $recent->post_content, 30);
			                        $cats = get_the_category( $recent->ID);
			                        $term_meta_color = get_term_meta($cats[0]->cat_ID, 'color', true);
			                        $cat_name = $cats[0]->name;
			                        $cat_url = get_category_link( $cats[0]->cat_ID ); 
			                        ?>
			                        <?php echo '<div class="col-xs-12 col-md-6 margin-top">'; ?>
			                            <div class="partner_post_wrapper">
			                                <div class="partner_post_thumb">
			                                    <?php echo '<a href="'.$cat_url.'"><span class="cat_name" style="background-color:#'.$term_meta_color.'">'.$cat_name.'</span></a>'; ?> 
			                                    <?php echo '<a href="'.get_permalink($recent->ID).'" title="'.$recent->post_title.'" class="element-wrap">'; ?>
			                                        <img class="img-responsive" src="<?php echo $post_thumbnail_url; ?>" />
			                                        <span class="hover-element"></span>
			                                    <?php echo '</a>'; ?>
			                                </div>
			                                <div class="partner_post_content">
			                                    <?php echo '<a href="'.get_permalink($recent->ID).'" title="'.$recent->post_title.'"><h3 class="post_title">'.$recent->post_title.'</h3></a>'; ?>
			                                </div>
			                            </div>
			                        <?php echo '</div>'; ?>
			                        <?php endforeach; wp_reset_postdata(); ?>
			                    </div>
			                </div>
			            	<?php } ?>
			        	<?php } ?>
			        	</div>
			    		<?php endwhile; ?>
			    	</section>
			    	<?php }?>

							<div class="height60"></div>
		<?php echo rise_up_post(); ?>
</div><!-- Container end -->
<div class="load_more_section">
	<div class="container">
		<section class="featured_post">
			<div class="top_grad"></div>
			<div class="row">
				<?php
					$current_category = get_queried_object_id();
					//echo '<pre>'; print_r($current_category);
					//echo '</pre>';
					//$cats = $current_category[0]->cat_ID;
					$cat_url = get_category_link( $current_category );
					$term_meta_color = get_term_meta($current_category, 'color', true);
					$catgory = get_term( $current_category );
					$cat_name = $catgory->name; 
				?>
				<div class="col-md-12">
					<h2 class="section_title">More from <?php echo $cat_name; ?></h2>
				</div>
			</div>
			<div class="row posts">
			<?php
			$current_category = get_queried_object_id();
			//$cats = $current_category[0]->cat_ID;
			//echo $cats;
			$recent_posts_get = get_posts( array(
							     'posts_per_page' => 4,
							     'orderby'        => 'date',
							     'order'          => 'DESC',
							     'offset'         => 4,
							     'category'       => $current_category,
							     'post_status'    => 'publish'
							) );
			$flag = 1;
			//echo '<pre>'; print_r($recent_posts);  echo '</pre>';
			foreach( $recent_posts_get as $recent_posts ): 
				$post_thumbnail_id = get_post_thumbnail_id($recent_posts->ID); 
				$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
				$excerpt = wp_trim_words( $recent_posts->post_content, 60);
				$current_category = get_queried_object_id();
				$cat_url = get_category_link( $current_category );
				$term_meta_color = get_term_meta( $current_category, 'color', true);
				$catgory = get_term( $current_category );
				$cat_name = $catgory->name;
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
						<?php if ( has_post_thumbnail() ) { ?>
							<?php echo '<a href="'.get_permalink($recent_posts->ID).'" title="'.$recent_posts->post_title.'" class="element-wrap">'; ?>
							<img class="img-responsive" src="<?php echo $post_thumbnail_url; ?>" />
							<span class="hover-element"></span>
							</a>		
						<?php } else { ?>
						<img class="img-responsive" src="<?php bloginfo('template_directory'); ?>-child-master/images/default.png" alt="<?php the_title(); ?>" />
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
			<?php $flag++; endforeach; wp_reset_postdata(); ?>
			</div>
			<?php $current_category = get_queried_object_id(); ?>
			<div class="load_more_btn">
			<div id="more_posts" data-category="<?php echo $current_category; ?>"><?php esc_html_e('Load More', 'twentysixteen') ?></div>
			</div>
		</section>
	</div>
</div>
<script type="text/javascript">
	(function($){
	$(document).ready(function(){
		var ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
		/*var ajaxUrl = "<?php //echo admin_url('admin-ajax.php')?>";
		var page = 1; // What page we are on.
		var ppp = 10; // Post per page

		$("#more_posts").on("click",function(){ // When btn is pressed.
		    $("#more_posts").attr("disabled",true); // Disable the button, temp.
		    $.post(ajaxUrl, {
		        action:"more_post_ajax",
		        offset: (page * ppp) + 1,
		        ppp: ppp
		    }).success(function(posts){
		        page++;
		        $(".posts").append(posts); // CHANGE THIS!
		        $("#more_posts").attr("disabled",false);
		    });

		});*/


			var $content = $('.posts');
		var $loader = $('#more_posts');
		var cat = $loader.data('category');
		var ppp = 4;
		var offset = 8;
		 
		$loader.on( 'click', load_ajax_posts );
		 
		function load_ajax_posts() {
			if (!($loader.hasClass('post_loading_loader') || $loader.hasClass('post_no_more_posts'))) {
				var ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
				$.ajax({
					type: 'POST',
					dataType: 'html',
					url: ajaxUrl,
					data: {
						'cat': cat,
						'ppp': ppp,
						'offset': offset,
						'action': 'more_post_ajax'
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
<div class="height80"></div>
<?php echo ps_categories(); ?>
<div class="height40"></div>
</div><!-- Wrapper end -->

<?php get_footer(); ?>
