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

            <div class="single-product">

                <div class="sliders-img">

                    <div class="row">

                        <div class="col-sm-6">

                            <div class="slide-container slide-first">
                                <img src="https://www.sweetpunk.com/Public/Files/home_slideshow/sweetpunk_home1_a9d13c2ee8.jpg" alt="">
                            </div>

                        </div>

                        <div class="col-sm-6">

                            <div class="content-container">
                                <div class="content-inner">
                                    <div class="title"><h3>Ah oui…</h3></div>
                                    <div class="desc">My goal is to provide you, the reader, with a detailed guide that answers all questions about cross browser testing from start to finish. To get the most out of this guide you should read it once until the end and then take action in all sections that apply to you, your team and the project at hand. No prior knowledge of browser testing is required.</div>
                                    <div class="spr-general"></div>
                                </div>
                            </div>

                        </div>

                        <div class="clear"></div>

                        <div class="col-sm-6">
                            <div class="single-content-container">

                                <div class="content-inner">
                                    <div class="title">
                                        <h4>Ah oui…</h4>
                                    </div>
                                    <div class="spr-general"></div>
                                    <div class="desc">My goal is to provide you, the reader, with a detailed guide that answers all questions about cross browser testing from start to finish. To get the most out of this guide you should read it once until the end and then take action in all sections that apply to you, your team and the project at hand. No prior knowledge of browser testing is required.</div>
                                </div>

                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="slide-container slide-second">
                                <img src="https://www.sweetpunk.com/Public/Files/home_slideshow/sp_site_faceshome_nico_828ef2683b.jpg" alt="">
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
                                <img src="https://www.sweetpunk.com/Public/Files/home_slideshow/sp_site_faceshome_dieynabou_6f9de92330_8b806ff866.jpg" alt="">
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <?php
            /* Start the Loop */
            while ( have_posts() ) : the_post();

                $project_employer = get_post_meta( get_the_ID() , 'wpcf-project_employer' , true  );
                $project_date = get_post_meta( get_the_ID() , 'wpcf-project_date' , true );
                $project_description = get_post_meta( get_the_ID() , 'wpcf-project_description' , true );

                $project_gallery_one = get_post_meta( get_the_ID() , 'wpcf-project_gallery_one' , false );
                $project_gallery_two = get_post_meta( get_the_ID() , 'wpcf-project_gallery_two' , false );
                $project_gallery_three = get_post_meta( get_the_ID() , 'wpcf-project_gallery_three' , false );

                ?>

                <div class="single-project">

                    <div class="sliders-img">

                        <div class="row">

                            <div class="col-sm-3">
                                <div class="single-content-container">
                                    <div class="arrows-box">

                                        <?php
                                        $prev_post = get_previous_post();
                                        if (!empty( $prev_post )): ?>
                                            <a class="arrow previous" href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" title="<?php echo esc_attr( $prev_post->post_title ); ?>"><i class="fa fa-angle-left"></i></a>
                                        <?php endif; ?>

                                        <?php
                                        $next_post = get_next_post();
                                        if (!empty( $next_post )): ?>
                                            <a class="arrow next" href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" title="<?php echo esc_attr( $next_post->post_title ); ?>"><i class="fa fa-angle-right"></i></a>
                                        <?php endif; ?>

                                    </div>

                                    <div class="content-inner">
                                        <div class="title">
                                            <h4><?php the_title(); ?></h4>
                                            <strong><?php echo __( 'Employer:' , 'mafiran' ). " " . apply_filters( 'the_title' , $project_employer );?></strong>
                                            <div class="date"><?php echo __( 'Date:' , 'mafiran' ). " " . apply_filters( 'the_title' , $project_date );?></div>
                                        </div>
                                        <div class="spr-general"></div>
                                        <div class="desc"><?php echo apply_filters( 'the_content' , $project_description );?></div>
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6">

                                <div class="content-container">
                                    <div class="content-inner">
                                        <!--<div class="title"><h3>Ah oui…</h3></div> -->
                                        <div class="desc"><?php the_content();?></div>
                                        <div class="spr-general"></div>
                                    </div>
                                </div>

                                <div class="slide-container slide-first sed-mafiran-slider" data-pause="no" data-slider-nav=".sed-mafiran-slider.slide-second">

                                    <?php

                                    foreach ( $project_gallery_one As $image_url ) {

                                        $attachment_id = mafiran_get_attachment_id_by_url( $image_url );

                                        $img = get_sed_attachment_image_html( $attachment_id , '' , '640X640' );

                                        if ( ! $img ) {
                                            $img = array();
                                            $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
                                        }

                                        ?>
                                        <div class="slide-item">
                                            <?php echo $img['thumbnail'];?>
                                        </div>
                                        <?php

                                    }
                                    ?>


                                </div>

                            </div>

                            <div class="clear"></div>

                            <div class="clear"></div>

                            <div class="col-sm-3">
                                <div class="slide-container slide-second slide-thumb sed-mafiran-slider" data-pause="no" data-slider-nav=".sed-mafiran-slider.slide-first">

                                    <?php

                                    foreach ( $project_gallery_two As $image_url ) {

                                        $attachment_id = mafiran_get_attachment_id_by_url( $image_url );

                                        $img = get_sed_attachment_image_html( $attachment_id , '' , '320X320' );

                                        if ( ! $img ) {
                                            $img = array();
                                            $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
                                        }

                                        ?>
                                        <div class="slide-item">
                                            <?php echo $img['thumbnail'];?>
                                        </div>
                                        <?php

                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="col-sm-6 text-left">
                                <div class="arrows-box mafiran-next-prev-controler">
                                    <a class="arrow previous" href="javascript:;"><i class="fa fa-angle-left"></i></a>
                                    <a class="arrow next" href="javascript:;"><i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="slide-container slide-third slide-thumb sed-mafiran-slider" data-pause="no">
                                    <?php

                                    foreach ( $project_gallery_three As $image_url ) {

                                        $attachment_id = mafiran_get_attachment_id_by_url( $image_url );

                                        $img = get_sed_attachment_image_html( $attachment_id , '' , '320X320' );

                                        if ( ! $img ) {
                                            $img = array();
                                            $img['thumbnail'] = '<img class="sed-image-placeholder sed-image" src="' . sed_placeholder_img_src() . '" />';
                                        }

                                        ?>
                                        <div class="slide-item">
                                            <?php echo $img['thumbnail'];?>
                                        </div>
                                        <?php

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