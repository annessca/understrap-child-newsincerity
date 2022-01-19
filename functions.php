<?php

function understrap_remove_scripts() {

    wp_dequeue_style( 'understrap-styles' );

    wp_deregister_style( 'understrap-styles' );



    wp_dequeue_script( 'understrap-scripts' );

    wp_deregister_script( 'understrap-scripts' );



    // Removes the parent themes stylesheet and scripts from inc/enqueue.php

}

add_action( 'wp_enqueue_scripts', 'understrap_remove_scripts', 20 );



add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

function theme_enqueue_styles() {



	// Get the theme data

	$the_theme = wp_get_theme();



    wp_enqueue_style( 'child-understrap-styles', get_stylesheet_directory_uri() . '/css/child-theme.min.css' );

    wp_enqueue_style( 'child-understrap-ps', get_stylesheet_directory_uri() . '/style.css', array(), $the_theme->get( 'Version' ) );
    wp_enqueue_style( 'newsincerty-owl-css', get_stylesheet_directory_uri() . '/assets/owlcarousel/owl.carousel.min.css', array(), false );
    wp_enqueue_style( 'newsincerty-owl-theme', get_stylesheet_directory_uri() . '/assets/owlcarousel/owl.theme.default.min.css', array(), false );

    wp_enqueue_script( 'child-understrap-scripts', get_stylesheet_directory_uri() . '/js/child-theme.min.js', array(), $the_theme->get( 'Version' ), true );

    wp_enqueue_script( 'child-understrap-menu', get_stylesheet_directory_uri() . '/js/menu.js', array(), $the_theme->get( 'Version' ), true );
    wp_enqueue_script( 'newsincerty-owl-js', get_stylesheet_directory_uri() . '/assets/owlcarousel/owl.carousel.js', array( 'jquery' ), false, true );
    wp_enqueue_script('newsincerty-jquery-ui', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', false, '1.8.8');
}


function newsincerity_widgets_init() {

    register_sidebar( array(
        'name'          => __( 'Footer 1', 'newsincerity' ),
        'id'            => 'footer-1',
        'description'   => __( 'Appears at very first footer.', 'newsincerity' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 2', 'newsincerity' ),
        'id'            => 'footer-2',
        'description'   => __( 'Appears at second footer.', 'newsincerity' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer 3', 'newsincerity' ),
        'id'            => 'footer-3',
        'description'   => __( 'Appears at third footer.', 'newsincerity' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'newsincerity_widgets_init' );


/**** secondary menu ****/

/*function sec_menu(){

    register_nav_menus( array(

        'secondary' => __( 'Secondary Menu', 'understrap' ),

    ) );

}

add_action( 'after_setup_theme', 'sec_menu' );*/





/*** categories color ***/

add_action( 'init', 'jt_register_meta' );



function jt_register_meta() {



    register_meta( 'term', 'color', 'jt_sanitize_hex' );

}

function jt_sanitize_hex( $color ) {



    $color = ltrim( $color, '#' );



    return preg_match( '/([A-Fa-f0-9]{3}){1,2}$/', $color ) ? $color : '';

}

function jt_get_term_color( $term_id, $hash = false ) {



    $color = get_term_meta( $term_id, 'color', true );

    $color = jt_sanitize_hex( $color );



    return $hash && $color ? "#{$color}" : $color;

}

add_action( 'category_add_form_fields', 'ccp_new_term_color_field' );



function ccp_new_term_color_field() {



    wp_nonce_field( basename( __FILE__ ), 'jt_term_color_nonce' ); ?>



    <div class="form-field jt-term-color-wrap">

        <label for="jt-term-color"><?php _e( 'Color', 'jt' ); ?></label>

        <input type="text" name="jt_term_color" id="jt-term-color" value="" class="jt-color-field" data-default-color="#ffffff" />

    </div>

<?php }

add_action( 'category_edit_form_fields', 'ccp_edit_term_color_field' );



function ccp_edit_term_color_field( $term ) {



    $default = '#ffffff';

    $color   = jt_get_term_color( $term->term_id, true );



    if ( ! $color )

        $color = $default; ?>



    <tr class="form-field jt-term-color-wrap">

        <th scope="row"><label for="jt-term-color"><?php _e( 'Color', 'jt' ); ?></label></th>

        <td>

            <?php wp_nonce_field( basename( __FILE__ ), 'jt_term_color_nonce' ); ?>

            <input type="text" name="jt_term_color" id="jt-term-color" value="<?php echo esc_attr( $color ); ?>" class="jt-color-field" data-default-color="<?php echo esc_attr( $default ); ?>" />

        </td>

    </tr>

<?php }

add_action( 'edit_category',   'jt_save_term_color' );

add_action( 'create_category', 'jt_save_term_color' );



function jt_save_term_color( $term_id ) {



    if ( ! isset( $_POST['jt_term_color_nonce'] ) || ! wp_verify_nonce( $_POST['jt_term_color_nonce'], basename( __FILE__ ) ) )

        return;



    $old_color = jt_get_term_color( $term_id );

    $new_color = isset( $_POST['jt_term_color'] ) ? jt_sanitize_hex( $_POST['jt_term_color'] ) : '';



    if ( $old_color && '' === $new_color )

        delete_term_meta( $term_id, 'color' );



    else if ( $old_color !== $new_color )

        update_term_meta( $term_id, 'color', $new_color );

}

add_filter( 'manage_edit-category_columns', 'jt_edit_term_columns' );



function jt_edit_term_columns( $columns ) {



    $columns['color'] = __( 'Color', 'jt' );



    return $columns;

}

add_filter( 'manage_category_custom_column', 'jt_manage_term_custom_column', 10, 3 );



function jt_manage_term_custom_column( $out, $column, $term_id ) {



    if ( 'color' === $column ) {



        $color = jt_get_term_color( $term_id, true );



        if ( ! $color )

            $color = '#ffffff';



        $out = sprintf( '<span class="color-block" style="background:%s;">&nbsp;</span>', esc_attr( $color ) );

    }



    return $out;

}

add_action( 'admin_enqueue_scripts', 'jt_admin_enqueue_scripts' );



function jt_admin_enqueue_scripts( $hook_suffix ) {



    if ( 'edit-tags.php' !== $hook_suffix || 'category' !== get_current_screen()->taxonomy )

        return;



    wp_enqueue_style( 'wp-color-picker' );

    wp_enqueue_script( 'wp-color-picker' );



    add_action( 'admin_head',   'jt_term_colors_print_styles' );

    add_action( 'admin_footer', 'jt_term_colors_print_scripts' );

}



function jt_term_colors_print_styles() { ?>



    <style type="text/css">

        .column-color { width: 50px; }

        .column-color .color-block { display: inline-block; width: 28px; height: 28px; border: 1px solid #ddd; }

    </style>

<?php }



function jt_term_colors_print_scripts() { ?>



    <script type="text/javascript">

        jQuery( document ).ready( function( $ ) {

            $( '.jt-color-field' ).wpColorPicker();

        } );

    </script>

<?php }

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title'    => 'Theme Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));

}

function set_new_trim_length( $excerpt_length ) {
    return 70;
}
add_filter( 'excerpt_length', 'set_new_trim_length' );

function all_excerpts_get_more_link( $post_excerpt ) {

        return $post_excerpt;

}
add_filter( 'wp_trim_excerpt', 'all_excerpts_get_more_link' );


$slider = get_field('rise_up_slider', 'option');  
if ( !empty($slider) ) {
    function rise_up_slider($field, $postID) {
    global $post; ?>
    <section class="rise_up_slider">
        <div class="rise_up_title">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="section_title">Rise Up</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="rise_slider">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel">
                            <?php 
                            $recent_post = get_field($field, $postID);
                            //echo '<pre>' ; print_r($recent_posts); echo '</pre>';
                            if ( $recent_post ) {
                                foreach ( $recent_post as $recent ) :
                                        //echo '<pre>' ; print_r($recent); echo '</pre>';
                                    $excerpt = wp_trim_words( $recent->post_content, 25); 
                            ?>
                            <div class="item">
                                <?php echo '<a href="'.get_permalink($recent->ID).'" title="'.$recent->post_title.'">'; ?>
                                    <div class="rise_up_wrapper_slider"> 
                                        <?php echo '<p class="post_date_slider">'.date('F j, Y', strtotime($recent->post_date) ).'</p>'; ?>
                                        <?php echo '<p class="post_excerpt">'.$excerpt.'</p>'; ?>
                                    </div>
                                <?php echo '</a>'; ?>
                            </div>
                                <?php endforeach; 
                            wp_reset_postdata();
                            } ?>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <div class="height20"></div>
    </section>
<?php } 
}

/*wp_localize_script( 'child-understrap-menu', 'ajax_posts', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'noposts' => __('No older posts found', 'understrap'),
));*/


function more_post_ajax(){
        $ppp     = (isset($_POST['ppp'])) ? $_POST['ppp'] : 4;
        $cats     = (isset($_POST['cat'])) ? $_POST['cat'] : 0;
        $offset  = (isset($_POST['offset'])) ? $_POST['offset'] : 4;
        $first_loading = (isset($_POST['first_loading'])) ? $_POST['first_loading'] : 0;

        $offset += $first_loading;
    
    $recent_posts_get = get_posts( array(
                                         'posts_per_page' => $ppp,
                                         'category'       => $cats,
                                         'post_status'    => 'publish',
                                         'offset'          => $offset,
                                         'post_status'      => 'publish',
                                    ) );
                    $flag = 1;
                    //echo '<pre>'; print_r($recent_posts);  echo '</pre>';
                    foreach( $recent_posts_get as $recent_posts ): 
                        $post_thumbnail_id = get_post_thumbnail_id($recent_posts->ID); 
                        $post_thumbnail_url = wp_get_attachment_url( $post_thumbnail_id );
                        $excerpt = wp_trim_words( $recent_posts->post_content, 60);
                        $cat_url = get_category_link( $cats );
                        $term_meta_color = get_term_meta( $cats, 'color', true);
                        $catgory = get_term( $cats );
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
                                <?php if ( $post_thumbnail_url ) { ?>
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
                    <?php $flag++; endforeach;
                    wp_reset_query();
    exit; 
}

add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax'); 
add_action('wp_ajax_more_post_ajax', 'more_post_ajax');

function author_more_post_ajax(){
        $ppp     = (isset($_POST['ppp'])) ? $_POST['ppp'] : 6;
        $author     = (isset($_POST['author'])) ? $_POST['author'] : 0;
        $offset  = (isset($_POST['offset'])) ? $_POST['offset'] : 0; 
         $recent_posts_get = array(
                                         'posts_per_page' => $ppp,
                                         'author' => $author,
                                         'post_status' => 'publish',
                                         'offset' => $offset,
                                     ); ?>
            <?php query_posts( $recent_posts_get ); if ( have_posts() ) : ?>
                <?php while ( have_posts() ) : the_post(); ?>
                <div class="col-sm-12 col-md-6 col-lg-4 author-post">
                        
                    <?php
                        get_template_part( 'loop-templates/content', 'author' );
                    ?>

                </div>
                <?php endwhile; ?>
                <?php endif;
                wp_reset_query();
            exit; 
}

add_action('wp_ajax_nopriv_author_more_post_ajax', 'author_more_post_ajax'); 
add_action('wp_ajax_author_more_post_ajax', 'author_more_post_ajax');

function display_search_more_post_ajax(){
    global $post;
        $ppp     = (isset($_POST['ppp'])) ? $_POST['ppp'] : 6;
        $search     = (isset($_POST['search'])) ? $_POST['search'] : 0;
        $offset  = (isset($_POST['offset'])) ? $_POST['offset'] : 0;



        $recent_posts_get = array(
                                         'posts_per_page' => $ppp,
                                         's'       => $search,
                                         'post_status'    => 'publish',
                                         'offset'          => $offset,
                                     );
         ?>
    <?php //echo serialize(get_posts($recent_posts_get)) ." | ". $ppp . " | ". $offset; exit(0); ?>
    <?php
        $search_posts =  get_posts( $recent_posts_get );
        $html = "";
        ob_start();
        foreach ( $search_posts as $post ) : setup_postdata( $post ); ?>
            <div class="col-sm-12 col-md-6 col-lg-4 author-post">
                <?php
                get_template_part( 'loop-templates/content', 'search' );
                ?>
            </div>
        <?php endforeach;
        wp_reset_postdata();
        $html = ob_get_contents();
        ob_end_clean();
        echo $html;

        exit(0);

}

add_action('wp_ajax_nopriv_search_more_post_ajax', 'display_search_more_post_ajax');
add_action('wp_ajax_search_more_post_ajax', 'display_search_more_post_ajax');

function rise_up_post(){ ?>
    <section class="rise_up_post">
                        
                        <div class="row">
                        <?php 
                            $recent_post = get_posts( array(
                                         'posts_per_page' => 3,
                                         'orderby'        => 'date',
                                         'order'          => 'DESC',
                                         'category'       => 448,
                                         'post_status'    => 'publish'
                                    ) );
                            /*echo '<pre>';
                            print_r( $recent );
                            echo '</pre>';*/
                            if ( $recent_post ) {
                                foreach ( $recent_post as $recent ) :
                                $cats = get_the_category($recent->ID);
                                $cat_name = $cats[0]->name;
                                $cat_url = get_category_link( $cats[0]->cat_ID ); 
                        ?>
                        <?php echo '<div class="col-xs-12 col-md-4 border-right">'; ?>
                                <div class="rise_up_wrraper">
                                <?php echo '<a href="'.$cat_url.'"><span class="cat_name">'.$cat_name.'</span></a>'; ?> 
                                <?php echo '<span class="post_date">'.date('F j, Y', strtotime($recent->post_date) ).'</span>'; ?>
                                <?php echo '<a href="'.get_permalink($recent->ID).'" title="'.$recent->post_title.'"><h3 class="post_title">'.$recent->post_title.'</h3></a>'; ?>
                                </div>
                        <?php echo '</div>'; ?>
                        <?php endforeach; 
                            wp_reset_postdata();
                        } ?>
                        </div>

                    </section>
<?php }

add_filter( 'get_the_archive_title', function ($title) {

    if ( is_category() ) {

            $title = single_cat_title( '', false );

        } elseif ( is_tag() ) {

            $title = single_tag_title( '', false );

        } elseif ( is_author() ) {

            $title = '<span class="vcard">' . get_the_author() . '</span>' ;

        }

    return $title;

});

function ps_categories(){ ?>
    <section class="accordin_category">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <section class="accordin_wrapper">
                        <div class="top_grad"></div>
                        <div class="row">
                            <div class="col-md-12">
                                <h2 class="section_title">Categories</h2>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div id="category_tabs" class="section_tabs">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                                $categories = get_categories( array(
                                                    'orderby' => 'name',
                                                    'order'   => 'ASC'
                                                ) );
                                            ?>  
                                            <ul class="tabs-left">
                                            <?php foreach( $categories as $category ) {
                                                    $category_link = sprintf( 
                                                        '<li style="background-color:#%1$s"><a href="#%2$s" alt="%3$s">%4$s</a>',
                                                        $term_meta_color = get_term_meta($category->cat_ID, 'color', true),
                                                        $category->slug,
                                                        esc_attr( sprintf( __( 'View all posts in %s', 'textdomain' ), $category->name ) ),
                                                        esc_html( $category->name )
                                                    );
                                                     
                                                    echo sprintf( esc_html__( '%s', 'textdomain' ), $category_link );
                                                } wp_reset_postdata();
                                            ?>
                                            </ul>
                                        </div>
                                        <div class="col-md-6">
                                            <?php foreach( $categories as $category ) {
                                            $category_link = sprintf( 
                                                '<div id="%1$s" class="content-tabs"><h3>%2$s</h3><p>%3$s</p><div class="cat_link"><a href="%4$s">GO <i class="fa fa-arrow-circle-right"></i></a></div></div>',
                                                $category->slug,
                                                esc_html( $category->name ),
                                                $category->description,
                                                esc_url( get_category_link( $category->term_id ) )
                                            );
                                             
                                            echo sprintf( esc_html__( '%s', 'textdomain' ), $category_link );
                                            } wp_reset_postdata();
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
<?php }


function understrap_posted_on() {
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
		esc_html_x( '| %s', 'post date', 'understrap' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);
    $author_image = get_avatar( get_the_author_meta( 'ID' ), 45 );
	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'understrap' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">'.$author_image.'</a> by <a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);
	echo '<span class="byline">' . $byline . '</span><span class="posted-on"> ' . $posted_on . '</span>'; // WPCS: XSS OK.
}

add_filter('posts_orderby','my_sort_custom',10,2);
function my_sort_custom( $orderby, $query ){
    global $wpdb;

    if(!is_admin() && is_search())
        $orderby =  "{$wpdb->prefix}posts.post_date DESC";

    return  $orderby;
}

function my_post_object_query( $args, $field, $post ) {
    $args['post_status'] = array('publish');

    return $args;
}

add_filter('acf/fields/post_object/query', 'my_post_object_query', 10, 3);
add_filter('acf/fields/relationship/query', 'my_post_object_query', 10, 3);


add_filter( 'option_active_plugins', function ( $option ) { 
    global $pagenow; 
    if( 'post.php' !== $pagenow || !is_admin() ) 
        return $option; 
    if( !isset( $_GET['post'] ) || '2' !== $_GET['post'] ) 
        return $option; 
    return array_diff( $option, array( 'js_composer/js_composer.php' ) ); 
});


function add_opengraph_doctype( $output ) {
    return $output . ' xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml"';
}

function insert_fb_in_head() {
    global $post;

    if ( is_single() ) {
        echo '<meta property="og:title" content="' . esc_attr( get_the_title() ) . '"/>';
        echo '<meta property="og:type" content="article"/>';
        echo '<meta property="og:url" content="' . get_permalink() . '"/>';
        echo '<meta property="og:description" content="' . esc_attr( get_the_content() ) . '"/>';
            
        if(!has_post_thumbnail( $post->ID )) { //the post does not have featured image, use a default image
            echo '<meta property="og:image" content="'.bloginfo('template_directory').'-child-master/images/default.png" alt="'.esc_attr( the_title() ).'"/>';
        } else {
            echo '<meta property="og:image" content="' .  get_the_post_thumbnail_url( $post->ID, 'large' ) . '"/>';
        }

    }
}

add_filter('language_attributes', 'add_opengraph_doctype');
add_action( 'wp_head', 'insert_fb_in_head', 1 );