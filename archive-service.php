<div class="wrap">

    <div id="primary" class="content-area archive-custom-post-type archive-service-post-type">
        <main id="main" class="site-main" role="main">

            <?php
            if ( have_posts() ) : ?>

                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        ?>

                        <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>

                            <div class="post-thumbnail sed-archive-featured-image">

                                <header class="entry-header">

                                    <h2 class="entry-title"> <?php the_title(); ?> </h2>

                                    <div class="service-desc">

                                        <?php

                                        $post_content = get_the_excerpt();

                                        $excerpt_length = 250;

                                        if( strlen( $post_content ) > $excerpt_length ){

                                            $post_content = mb_substr( $post_content, 0, $excerpt_length ) . "...";

                                        }

                                        echo $post_content;

                                        ?>

                                    </div>

                                    <span class="read-more">
                                        <i class="fa fa-chevron-down"></i>
			                        </span>

                                </header><!-- .entry-header -->

                            </div>
                            <!-- .post-thumbnail -->

                            <div class="entry-content">

                                <?php

                                the_content();

                                wp_link_pages( array(
                                    'before'      => '<div class="page-links">' . __( 'Pages:', 'twentyseventeen' ),
                                    'after'       => '</div>',
                                    'link_before' => '<span class="page-number">',
                                    'link_after'  => '</span>',
                                ) );

                                ?>

                            </div><!-- .entry-content -->


                        </article><!-- #post-## -->

                        <?php

                    endwhile;

                    ?>

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
