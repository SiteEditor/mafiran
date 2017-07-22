<div class="wrap">

    <div id="primary" class="content-area archive-custom-post-type archive-service-post-type">
        <main id="main" class="site-main" role="main">

            <div class="archive-service-tabs">

              <ul class="sed-row-boxed">
                <li><a href="#tabs-1">Nunc tincidunt</a></li>
                <li><a href="#tabs-2">Proin dolor</a></li>
                <li><a href="#tabs-3">Aenean lacinia</a></li>
              </ul>
              <div id="tabs-1">
              
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

                                        <div class="read-more">
                                            <i class="fa fa-angle-down"></i>
                                        </div>

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
                                        <i class="fa fa-angle-up"></i>
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

              </div>
              <div id="tabs-2">
                <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
              </div>
              <div id="tabs-3">
                <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem. Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales. Quisque eu urna vel enim commodo pellentesque. Praesent eu risus hendrerit ligula tempus pretium. Curabitur lorem enim, pretium nec, feugiat nec, luctus a, lacus.</p>
                <p>Duis cursus. Maecenas ligula eros, blandit nec, pharetra at, semper at, magna. Nullam ac lacus. Nulla facilisi. Praesent viverra justo vitae neque. Praesent blandit adipiscing velit. Suspendisse potenti. Donec mattis, pede vel pharetra blandit, magna ligula faucibus eros, id euismod lacus dolor eget odio. Nam scelerisque. Donec non libero sed nulla mattis commodo. Ut sagittis. Donec nisi lectus, feugiat porttitor, tempor ac, tempor vitae, pede. Aenean vehicula velit eu tellus interdum rutrum. Maecenas commodo. Pellentesque nec elit. Fusce in lacus. Vivamus a libero vitae lectus hendrerit hendrerit.</p>
              </div>

            </div>

        </main><!-- #main -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div><!-- .wrap -->
