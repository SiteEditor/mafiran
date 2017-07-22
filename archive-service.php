<div class="wrap">

    <div id="primary" class="content-area archive-custom-post-type archive-service-post-type">
        <main id="main" class="site-main" role="main">

            <?php
            if ( have_posts() ) : ?>
                <div class="mafiran-services-inner">
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        ?>

                        <div class="header-wrap text-center">

                            <header class="sed-row-boxed">

                                <h4 class="title-wrap"> <?php the_title(); ?> </h4>

                                <div class="service-desc">

                                    <?php

                                    $post_content = get_the_excerpt();

                                    $post_content = apply_filters( 'the_excerpt' , $post_content );

                                    $post_content = strip_tags( $post_content );

                                    $excerpt_length = 580;

                                    if( strlen( $post_content ) > $excerpt_length ){

                                        $post_content = mb_substr( $post_content, 0, $excerpt_length ) . "...";

                                    }

                                    echo $post_content;

                                    ?>

                                </div>

                                <div class="read-more">
                                    <i class="fa fa-chevron-down"></i>
                                </div>

                            </header>

                        </div>


                        <div class="content-wrap text-center">

                            <div class="sed-row-boxed">

                                <?php

                                the_content();

                                wp_link_pages( array(
                                    'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
                                    'after'       => '</div>',
                                    'link_before' => '<span class="page-number">',
                                    'link_after'  => '</span>',
                                ) );

                                ?>

                                <div class="read-more-back">
                                    <i class="fa fa-chevron-up"></i>
                                </div>

                            </div>

                        </div>

                        <?php

                    endwhile;

                    ?>

                </div>
                <?php

                the_posts_pagination( array(
                    'prev_text' => twentyseventeen_get_svg( array( 'icon' => 'arrow-left' ) ) . '<span class="screen-reader-text">' . __( 'Previous page', 'twentyseventeen' ) . '</span>',
                    'next_text' => '<span class="screen-reader-text">' . __( 'Next page', 'twentyseventeen' ) . '</span>' . twentyseventeen_get_svg( array( 'icon' => 'arrow-right' ) ),
                    'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyseventeen' ) . ' </span>',
                ) );

            else :

                get_template_part( 'template-parts/post/content', 'none' );

            endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div><!-- .wrap -->
