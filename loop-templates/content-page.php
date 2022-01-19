<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">


	<div class="entry-content single-fullwidth">
		<?php 
		// check if the flexible content field has rows of data
			if( have_rows('mixed_content') ):

			     // loop through the rows of data
			    while ( have_rows('mixed_content') ) : the_row();

			        if( get_row_layout() == 'paragraphs-module' ):
			        	echo '<div class="content-paragraph">';
			        	echo '<div class="container text-center">';
			        		echo '<div class="row">';
			        			echo '<div class="col-md-12">';
			        				the_sub_field('paragraphs');
			        			echo '</div>';
			        		echo '</div>';
			        	echo '</div>';
			        	echo '</div>';

			        elseif( get_row_layout() == 'image-module' ): 

			        	echo '<div class="content-image">';
			        		$file = get_sub_field('image');
			        		echo '<img src="'.$file.'" />';
			        	echo '</div>';

			        endif;

			    endwhile;

			else :

			    echo 'nothing here for now ';

			endif;
		?>
		<div class="content-paragraph">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div>
	</div><!-- .entry-content -->


</article><!-- #post-## -->
