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

    //wp_enqueue_script('jquery-scrollbar');

    //wp_enqueue_style('custom-scrollbar');

    wp_enqueue_style("carousel");

}

add_action( 'wp_enqueue_scripts', 'mafiran_enqueue_styles' , 0 );

add_action( 'after_setup_theme', 'sed_mafiran_theme_setup' );

function sed_mafiran_theme_setup() {

    load_child_theme_textdomain( 'mafiran', get_stylesheet_directory() . '/languages' );

}

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

    /*$module_name = "themes/mafiran/site-editor/modules/iott-events/iott-events.php";
    $modules[$module_name] = $sed_pb_modules->get_module_data(get_stylesheet_directory() . '/site-editor/modules/iott-events/iott-events.php', true, true);
    */
    
    return $modules;

}




