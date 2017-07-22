<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
    <div id="primary" class="content-area blog-content-area">
        <main id="main" class="site-main" role="main">

            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();

                $product_description = get_post_meta( get_the_ID() , 'wpcf-product_description' , true  );
                $product_subtitle = get_post_meta( get_the_ID() , 'wpcf-product_subtitle' , true );

                $product_image_first = get_post_meta( get_the_ID() , 'wpcf-product_image_first' , true );
                $product_image_first = mafiran_get_attachment_id_by_url( $product_image_first );

                if( !$product_image_first && '' !== get_the_post_thumbnail() ){
                    $product_image_first   = get_post_thumbnail_id();
                }

                $product_image_second = get_post_meta( get_the_ID() , 'wpcf-product_image_second' , true );
                $product_image_second = mafiran_get_attachment_id_by_url( $product_image_second );

                $product_image_third = get_post_meta( get_the_ID() , 'wpcf-product_image_third' , true );
                $product_image_third = mafiran_get_attachment_id_by_url( $product_image_third );

                ?>

                <div class="single-product">

                    <div class="sliders-img">

                        <div class="row">

                            <div class="col-sm-6">

                                <div class="slide-container slide-first">

                                    <?php

                                    $img = get_sed_attachment_image_html( $product_image_first , "" , "800X800" );

                                    if ( ! $img ) {
                                        $img = array();
                                        $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
                                    }

                                    ?>
                                    <?php
                                    if ( $img ) {
                                        echo $img['thumbnail'];
                                    }
                                    ?>

                                </div>

                            </div>

                            <div class="col-sm-6">

                                <div class="content-container">

                                    <div class="content-inner">
                                        <div class="title"><h2><?php the_title(); ?></h2></div>
                                        <div class="subtitle"><?php echo apply_filters( 'the_title' , $product_subtitle ); ?></div>
                                        <div class="spr-general"></div>
                                    </div>

                                    <div class="content-inner">
                                        <div class="title"><h5><?php _e("Short Description" , "mafiran"); ?></h5></div>
                                        <div class="desc"><?php echo apply_filters( 'the_content' , $product_description ); ?></div>
                                        <div class="spr-general"></div>
                                    </div>
                                </div>

                            </div>

                            <div class="clear"></div>

                            <div class="col-sm-6">
                                <div class="single-content-container">

                                    <div class="content-inner">
                                        <div class="title">
                                            <h4><?php _e("Description" , "mafiran"); ?></h4>
                                        </div>
                                        <div class="spr-general"></div>
                                        <div class="desc"><?php the_content(); ?></div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-2">
                                <div class="slide-container slide-second">
                                    <?php

                                    $img = get_sed_attachment_image_html( $product_image_second , "" , "374X374" );

                                    if ( ! $img ) {
                                        $img = array();
                                        $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
                                    }

                                    ?>
                                    <?php
                                    if ( $img ) {
                                        echo $img['thumbnail'];
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="clear"></div>

                            <div class="col-sm-5">&nbsp;</div>

                            <div class="col-sm-1 text-left">
                                <div class="black-box">&nbsp;</div>
                            </div>

                            <div class="col-sm-2">&nbsp;</div>



                            <div class="col-sm-3">
                                <div class="slide-container slide-third">
                                    <?php

                                    $img = get_sed_attachment_image_html( $product_image_third , "" , "560X560" );

                                    if ( ! $img ) {
                                        $img = array();
                                        $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
                                    }

                                    ?>
                                    <?php
                                    if ( $img ) {
                                        echo $img['thumbnail'];
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <?php

            endwhile; // End of the loop.
            ?>

        </main><!-- #main -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();