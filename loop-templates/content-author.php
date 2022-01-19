<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<?php 
		$cats = wp_get_post_categories( $post->ID );
						$cat_url = get_category_link( $cats[0] );
						$cat_id = $cats[0];
						$catgory = get_term( $cat_id );
						$term_meta_color = get_term_meta($cats[0], 'color', true);
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
	<div class="american_wrapper">
		<div class="american_thumb">
			<?php echo '<a href="'.$cat_url.'"><span class="cat_name" style="background-color:#'.$term_meta_color.'">'.$cat_name.'</span></a>'; ?>
			<?php if ( has_post_thumbnail() ) { ?>
			<?php echo '<a href="'.get_permalink($recent->ID).'" title="'.$recent->post_title.'" class="element-wrap">'; ?>
				<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
				<span class="hover-element"></span>
			</a>
			<?php } else { ?>
			<img class="img-responsive" src="<?php bloginfo('template_directory'); ?>-child-master/images/default.png" alt="<?php the_title(); ?>" />
			<?php } ?>
			<?php echo '<span class="post_date">'.$posted_on.'</span>'; ?>
		</div>
		<div class="american_content">
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
				echo '<p class="post_excerpt">'.wp_trim_words( $post->post_content, 40).'</p>';
			?>
		</div>
	</div>
</article><!-- #post-## -->
