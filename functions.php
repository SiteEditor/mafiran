<?php
//
// Recommended way to include parent theme styles.
//  (Please see http://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme)
//

function mafiran_enqueue_styles() {

    wp_enqueue_style( 'mafiran-parent-style', get_template_directory_uri() . '/style.css' );

    wp_enqueue_style( 'mafiran-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
    /**
     * Theme Front end main js
     */
    wp_enqueue_script( "mafiran-script" , get_stylesheet_directory_uri() . '/assets/js/script.js' , array( 'jquery', 'carousel' , 'sed-livequery' , 'jquery-ui-accordion' ) , "1.0.0" , true );

    wp_enqueue_script( "mafiran-balls-script" , get_stylesheet_directory_uri() . '/assets/js/balls.js' , array( 'jquery', 'sed-livequery' ) , "1.0.0" , true );

    wp_enqueue_script('sed-masonry');

    wp_enqueue_script('lightbox');

    wp_enqueue_script('jquery-scrollbar');

    wp_enqueue_style('custom-scrollbar');

    wp_enqueue_style("carousel");

    wp_enqueue_style("lightbox");

}

add_action( 'wp_enqueue_scripts', 'mafiran_enqueue_styles' , 0 );

add_action( 'after_setup_theme', 'sed_mafiran_theme_setup' );

function sed_mafiran_theme_setup() {

    load_child_theme_textdomain( 'mafiran', get_stylesheet_directory() . '/languages' );

    remove_filter( 'excerpt_more', 'twentyseventeen_excerpt_more' );

}

function mafiran_excerpt_more( $link ) {
    if ( is_admin() ) {
        return $link;
    }

    return ' &hellip; ';
}
add_filter( 'excerpt_more', 'mafiran_excerpt_more' );

function mafiran_excerpt_length( $length ) {
    return 650;
}

add_filter( 'excerpt_length', 'mafiran_excerpt_length', 999 );

/**
 * Add Site Editor Modules
 *
 * @param $modules
 * @return mixed
 */
function sed_mafiran_add_modules( $modules ){

    global $sed_pb_modules;

    $module_name = "themes/mafiran/site-editor/modules/posts/posts.php";
    $modules[$module_name] = $sed_pb_modules->get_module_data(get_stylesheet_directory() . '/site-editor/modules/posts/posts.php', true, true);

    $module_name = "themes/mafiran/site-editor/modules/mafiran-products/mafiran-products.php";
    $modules[$module_name] = $sed_pb_modules->get_module_data(get_stylesheet_directory() . '/site-editor/modules/mafiran-products/mafiran-products.php', true, true);
    
    return $modules;

}

add_filter("sed_modules" , "sed_mafiran_add_modules" );

/**
 * Get an attachment ID given a URL.
 *
 * @param string $url
 *
 * @return int Attachment ID on success, 0 on failure
 */
function mafiran_get_attachment_id_by_url( $url ) {
    $attachment_id = 0;
    $dir = wp_upload_dir();
    if ( false !== strpos( $url, $dir['baseurl'] . '/' ) ) { // Is URL in uploads directory?
        $file = basename( $url );
        $query_args = array(
            'post_type'   => 'attachment',
            'post_status' => 'inherit',
            'fields'      => 'ids',
            'meta_query'  => array(
                array(
                    'value'   => $file,
                    'compare' => 'LIKE',
                    'key'     => '_wp_attachment_metadata',
                ),
            )
        );
        $query = new WP_Query( $query_args );
        if ( $query->have_posts() ) {
            foreach ( $query->posts as $post_id ) {
                $meta = wp_get_attachment_metadata( $post_id );
                $original_file       = basename( $meta['file'] );
                $cropped_image_files = wp_list_pluck( $meta['sizes'], 'file' );
                if ( $original_file === $file || in_array( $file, $cropped_image_files ) ) {
                    $attachment_id = $post_id;
                    break;
                }
            }
        }
    }
    return $attachment_id;
}




