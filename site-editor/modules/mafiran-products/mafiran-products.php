<?php
/*
Module Name: Mafiran Products
Module URI: http://www.siteeditor.org/modules/mafiran-products
Description: Module Mafiran Products For Page Builder Application
Author: Site Editor Team
Author URI: http://www.siteeditor.org
Version: 1.0.0
*/

/**
 * Class PBMafiranProductsShortcode
 */
class PBMafiranProductsShortcode extends PBShortcodeClass{

    /**
     * Register module with siteeditor.
     */
    function __construct() {
        parent::__construct( array(
                "name"        => "sed_mafiran_products",                               //*require
                "title"       => __("Mafiran Products","site-editor"),                 //*require for toolbar
                "description" => __("List of mafiran products for built-in and custom post types","site-editor"),
                "icon"        => "icon-mafiran-products",                               //*require for icon toolbar
                "module"      =>  "mafiran-products"         //*require
                //"is_child"    =>  "false"       //for childe shortcodes like sed_tr , sed_td for table module
            ) // Args
        );

    }

    function get_atts(){

        $atts = array(
            "images_size"                   => 'thumbnail'
        );

        return $atts;

    }

    function add_shortcode( $atts , $content = null ){



    }
    
    /*function styles(){
        return array(
            array('posts-skin-default', get_stylesheet_directory_uri().'/site-editor/modules/posts/skins/default/css/style.css' ,'1.0.0' ) ,
        );
    }*/

    function shortcode_settings(){

        $this->add_panel( 'mafiran_products_settings_panel' , array(
            'title'               =>  __('Mafiran Products Settings',"site-editor")  ,
            'capability'          => 'edit_theme_options' ,
            'type'                => 'inner_box' ,
            'priority'            => 9 ,
            'btn_style'           => 'menu' ,
            'has_border_box'      => false ,
            'icon'                => 'sedico-setting' ,
            'field_spacing'       => 'sm'
        ) );

        $params = array();

        $params['images_size'] = array(
            "type"          => "image-size" ,
            "label"         => __("Image Size Field", "site-editor"),
            "description"   => __("This option allows you to set a title for your image.", "site-editor"),
            "panel"         => "mafiran_products_settings_panel" ,
        );

        $params['show_title'] = array(
            'label'             => __('Show Title', 'site-editor'),
            'type'              => 'switch',
            'choices'           => array(
                "on"       =>    "ON" ,
                "off"      =>    "OFF" ,
            ),
            "panel"         => "posts_settings_panel" ,
        );

        $params['title'] = array(
            "type"              => "text" ,
            "label"             => __("Title", "site-editor"),
            "description"       => __("Module Title", "site-editor"),
            "placeholder"       => __("Enter Module Title", "site-editor"),
            "panel"             => "posts_settings_panel",
            'dependency'    => array(
                'queries'  =>  array(
                    array(
                        "key"       => "show_title" ,
                        "value"     => true ,
                        "compare"   => "==="
                    )
                )
            )
        );

       

        return $params;

    }

}

new PBMafiranProductsShortcode();

global $sed_pb_app;                      

$sed_pb_app->register_module(array(
    "group"                 =>  "basic" ,
    "name"                  =>  "mafiran-products",
    "title"                 =>  __("Mafiran Products","site-editor"),
    "description"           =>  __("List of mafiran products for built-in and custom post types","site-editor"),
    "icon"                  =>  "icon-mafiran-products",
    "type_icon"             =>  "font",
    "shortcode"             =>  "sed_mafiran_products",
    //"priority"              =>  10 ,
    "transport"             =>  "ajax" ,
));


