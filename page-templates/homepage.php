<?php

/**
 * Template Name: Homepage
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */
get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'loop-templates/content-editable-intro', 'none' ); ?>
<div class="wrapper" id="full-width-page-wrapper">
	<div class="<?php echo esc_html( $container ); ?>" id="content">
		<div class="row">
			<div class="col-md-12 content-area" id="primary">
				<main class="site-main" id="main" role="main">
					<div class="height40"></div>
					<section class="featured_post">
						<?php
							$recent_posts = get_field('featured_post');
							/*echo '<pre>';
							print_r( $recent_posts );
							echo '</pre>';*/
							if( $recent_posts ){
								$post_thumbnail_id = get_post_thumbnail_id($recent_posts->ID); 
								$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
								$excerpt = wp_trim_words( $recent_posts->post_content, 82);
								$cats = get_the_category( $recent_posts->ID);
								$cat_url = get_category_link( $cats[0]->cat_ID );
								$term_meta_color = get_term_meta($cats[0]->cat_ID, 'color', true);
								$cat_name = $cats[0]->name; 
								$recent_author = get_user_by( 'ID', $recent_posts->post_author );
								$author_display_name = $recent_author->display_name; 
								//print_r($recent_author);
								$author_url = get_author_posts_url( false, $recent_author->user_nicename ); ?>
							<?php echo '<div class="row">'; ?>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-7">
								<div class="featured_thumb">
								<?php echo '<a href="'.$cat_url.'"><span class="cat_name" style="background-color:#'.$term_meta_color.'">'.$cat_name.'</span></a>'; ?>
								<?php if ( !empty($post_thumbnail_url) ) { ?> 
								<?php echo '<a href="'.get_permalink($recent_posts->ID).'" title="'.$recent_posts->post_title.'" class="element-wrap">'; ?>
									<img class="img-responsive" src="<?php echo $post_thumbnail_url; ?>" />
									<span class="hover-element"></span>
									</a>
								<?php } else { ?>
								<img class="img-responsive" src="<?php bloginfo('template_directory'); ?>-child-master/images/default.png" alt="<?php the_title(); ?>" />
								<?php } ?>
								<?php echo '<span class="post_date">'.date('F j, Y', strtotime($recent_posts->post_date) ).'</span>'; ?>
								</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-5">
							<?php
  								echo '<a href="'.get_permalink($recent_posts->ID).'" title="'.$recent_posts->post_title.'"><h2 class="post_title">'.$recent_posts->post_title.'</h2></a>';
  								echo '<p class="post_author">by <a href="'.$author_url.'">'.$author_display_name.'</a></p>';
  								echo '<p class="post_excerpt">'.$excerpt.'</p>';
							?>
						</div>
						<?php echo '</div>'; ?>
						<?php } wp_reset_postdata(); ?>
						
					</section>
					<div class="height60"></div>
					<?php echo rise_up_post(); ?>
					<div class="height80"></div>
					<section class="featured_post american_home">
						<div class="top_grad"></div>
						<div class="row">
							<div class="col-md-12">
								<h2 class="section_title">American Stories</h2>
							</div>
						</div>
						<div class="row">
						<?php
							$recent_posts = get_field('american_post');
							/*echo '<pre>';
							print_r( $recent_posts );
							echo '</pre>';*/
							if( $recent_posts ){
								foreach( $recent_posts as $recent ):
								$post_thumbnail_id = get_post_thumbnail_id($recent->ID); 
								$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
								$excerpt = wp_trim_words( $recent->post_content, 30);
								$cats = get_the_category( $recent->ID);
								$term_meta_color = get_term_meta($cats[0]->cat_ID, 'color', true);
								$cat_name = $cats[0]->name; 
								$recent_author = get_user_by( 'ID', $recent->post_author );
								$author_display_name = $recent_author->display_name;
								$cat_url = get_category_link( $cats[0]->cat_ID ); 
								$author_url = get_author_posts_url( false, $recent_author->user_nicename ); ?>
							<?php echo '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-4">'; ?>
						<div class="american_wrapper">
							<div class="american_thumb">
								<?php echo '<a href="'.$cat_url.'"><span class="cat_name" style="background-color:#'.$term_meta_color.'">'.$cat_name.'</span></a>'; ?> 
								<?php echo '<a href="'.get_permalink($recent->ID).'" title="'.$recent->post_title.'" class="element-wrap">'; ?>
									<img class="img-responsive" src="<?php echo $post_thumbnail_url; ?>" />
									<span class="hover-element"></span>
								</a>
								<?php echo '<span class="post_date">'.date('F j, Y', strtotime($recent->post_date) ).'</span>'; ?>
							</div>
							<div class="american_content">
								<?php
  								echo '<a href="'.get_permalink($recent->ID).'" title="'.$recent->post_title.'"><h3 class="post_title">'.$recent->post_title.'</h3></a>';
  								echo '<p class="post_author">by <a href="'.$author_url.'">'.$author_display_name.'</a></p>';
  								echo '<p class="post_excerpt">'.$excerpt.'</p>';
							?>
							</div>
						</div>
						<?php echo '</div>'; ?>
						<?php endforeach; } wp_reset_postdata(); ?>
						</div>

					</section>
					
					<div class="height30"></div>
					
					<div class="row">
					
					<?php //echo partner_box(); 
					if( have_rows('partner_content') ) { ?>
			        <section class="partner_section" style="background-color: <?php echo get_field('partner_box_color'); ?>">
			        <?php while ( have_rows('partner_content') ) : the_row(); ?>
			        	<div class="row">
			        	<?php if( get_row_layout() == 'partner_box' ) { ?>
			                <?php 
			                $partner_posts = get_sub_field('partner_posts'); 
			                if ( !empty ($partner_posts) ) {
			                ?>
			                <div class="col-xs-12 col-md-12 col-lg-6">
			                <?php } else { ?>
			                <div class="col-xs-12 col-md-12 col-lg-12">
			                <?php }
			                    $partner_title = get_sub_field('partner_title'); 
			                    $partner_content = get_sub_field('partner_content');
			                    $partner_button_url = get_sub_field('partner_button_url');
			                    $partner_button_text = get_sub_field('partner_button_text');
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
			    	<?php } ?>

					</div>

					<div class="height80"></div>
					<section class="featured_post most_loved_home">
						<div class="top_grad"></div>
						<div class="row">
							<div class="col-md-12">
								<h2 class="section_title">Most Loved</h2>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-md-12 col-lg-4">
							<?php
							$recent_posts = get_field('most_loved_post_1');
							if( $recent_posts ){
								$post_thumbnail_id = get_post_thumbnail_id($recent_posts->ID); 
								$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
								$excerpt = wp_trim_words( $recent_posts->post_content, 60);
								$cats = get_the_category( $recent_posts->ID);
								$term_meta_color = get_term_meta($cats[0]->cat_ID, 'color', true);
								$cat_name = $cats[0]->name; 
								$recent_author = get_user_by( 'ID', $recent_posts->post_author );
								$author_display_name = $recent_author->display_name;
								$cat_url = get_category_link( $cats[0]->cat_ID ); 
								$author_url = get_author_posts_url( false, $recent_author->user_nicename ); ?>
							<?php echo '<div>'; ?>
								<div class="american_wrapper">
									<div class="american_thumb">
										<?php echo '<a href="'.$cat_url.'"><span class="cat_name" style="background-color:#'.$term_meta_color.'">'.$cat_name.'</span></a>'; ?> 
										<?php echo '<a href="'.get_permalink($recent_posts->ID).'" title="'.$recent_posts->post_title.'" class="element-wrap">'; ?>
											<img class="img-responsive" src="<?php echo $post_thumbnail_url; ?>" />
											<span class="hover-element"></span>
											</a>
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
							<?php } wp_reset_postdata(); ?>
							</div>
							<div class="col-xs-12 col-md-12 col-lg-8">
							<?php
							$recent_posts = get_field('most_loved_post_2');
							if( $recent_posts ){
								$post_thumbnail_id = get_post_thumbnail_id($recent_posts->ID); 
								$post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
								$excerpt = wp_trim_words( $recent_posts->post_content, 60);
								$cats = get_the_category( $recent_posts->ID);
								$term_meta_color = get_term_meta($cats[0]->cat_ID, 'color', true);
								$cat_name = $cats[0]->name; 
								$recent_author = get_user_by( 'ID', $recent_posts->post_author );
								$author_display_name = $recent_author->display_name;
								$cat_url = get_category_link( $cats[0]->cat_ID ); 
								$author_url = get_author_posts_url( false, $recent_author->user_nicename );?>
							<?php echo '<div>'; ?>
								<div class="american_wrapper most_loved">
									<div class="american_thumb">
										<?php echo '<a href="'.$cat_url.'"><span class="cat_name" style="background-color:#'.$term_meta_color.'">'.$cat_name.'</span></a>'; ?> 
										<?php echo '<a href="'.get_permalink($recent_posts->ID).'" title="'.$recent_posts->post_title.'" class="element-wrap">'; ?>
										<img class="img-responsive" src="<?php echo $post_thumbnail_url; ?>" />
										<span class="hover-element"></span>
										</a>
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
							<?php echo '</a>'; ?>
							<?php } wp_reset_postdata(); ?>
							</div>
						</div>
					</section>
				</main><!-- #main -->
			</div><!-- #primary -->
		</div><!-- .row end -->

	</div><!-- Container end -->
	
	<div class="height50"></div>

	<!--?php echo rise_up_slider('rise_up_slider', 'option'); ?-->

	<div class="height80"></div>
	<?php echo ps_categories(); ?>
	<div class="height40"></div>


</div><!-- Wrapper end -->



<?php get_footer(); ?>

