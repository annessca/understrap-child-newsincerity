<?php
/**
 * Partial hero template for content introduction in homepage.php
 *
 * @package understrap
 */

?>

<?php 
  if( have_rows('introduction_content') ) {
    while( have_rows('introduction_content') ) : the_row();
      if( get_row_layout() == 'introduction_box' ) {
        $small_heading = get_sub_field('introduction_header_small');
        $large_heading = get_sub_field('introduction_header_large');
        $intro_content = get_sub_field('introduction_paragraph');
        if ( !empty($small_heading) && !empty($large_heading) && !empty($intro_content)) { ?>
          <div id="Hero" class="hero-v3-section" >
            <div class="div-block-6">
                <div class="mustache" ><?php echo $small_heading; ?></div>
                <h1 class="hero-h1"><?php echo $large_heading; ?></h1>
            </div>
            <div class="section-5 wf-section">
              <div class="div-block-57">
                  <div class="cta-intro">
                      <?php echo $intro_content; ?>
                  </div>
              </div>
            </div>
          </div> 
        <?php
        }	
      }
    endwhile;
  }
?>
