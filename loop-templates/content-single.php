<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

?>
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

		$cats = wp_get_post_categories( $post->ID );
		$cat_url = get_category_link( $cats[0] );
		$cat_id = $cats[0];
		$catgory = get_term( $cat_id );
		$term_meta_color = get_term_meta($cats[0], 'color', true);
		$cat_name = $catgory->name; 
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

			<?php
			/*wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
				'after'  => '</div>',
			) );*/
			?>

		</div><!-- .entry-content -->
	</div>
	<!-- <footer class="entry-footer">

		<?php //understrap_entry_footer(); ?>

	</footer> -->
</article><!-- #post-## -->
