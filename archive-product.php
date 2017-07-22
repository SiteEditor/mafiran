<div class="wrap">

    <div id="primary" class="content-area archive-custom-post-type archive-product-post-type">
        <main id="main" class="site-main" role="main">


            <?php
            if ( have_posts() ) : ?>

                <div class="row">

                    <div class="col-sm-2">

                        <div class="category-items">

                            <ul>

                                <?php
                                $terms = get_terms( array(
                                    'taxonomy' => 'product-category',
                                    'hide_empty' => false
                                ) );

                                if ( !empty($terms) ) {

                                    foreach ( $terms AS $term ) {
                                        ?>

                                        <li><a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a></li>

                                        <?php
                                    }
                                }
                                ?>

                            </ul>

                            <div class="primary-box">&nbsp;</div>

                        </div>

                    </div>

                    <div class="col-sm-10">
                        
                        <?php
                        $products_description = get_theme_mod( 'mafiran_products_archive_description' , '' );

                        if( !empty( $products_description ) ){

                            ?>

                            <div class="products-introduction">

                                <div class="title"> <h4><?php echo __( 'Products' , 'mafiran' ); ?></h4> </div>

                                <div class="desc"><?php echo apply_filters( 'the_content' , $products_description );?></div>

                                <div class="spr-general"></div>

                            </div>

                            <?php

                        }
                        ?>

                        <div class="row">
                            <?php
                            /* Start the Loop */
                            while ( have_posts() ) : the_post();

                                ?>

                                <div class="col-sm-6">
                                    <article id="post-<?php the_ID(); ?>" <?php post_class('post custom-post-item'); ?>>
                                        <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
                                            <div class="post-thumbnail">
                                                <?php

                                                $attachment_id   = get_post_thumbnail_id();

                                                $img = get_sed_attachment_image_html( $attachment_id , "" , "600X400" );

                                                ?>
                                                <?php
                                                if ( $img ) {
                                                    echo $img['thumbnail'];
                                                }
                                                ?>


                                                <div class="info">
                                                    <div class="info-inner">
                                                        <a href="<?php the_permalink(); ?>" class="info-icons"><i class="fa fa-plus"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <header class="entry-header entry-header--archive">
                                            <div class="entry-title"><?php the_title(); ?></div>
                                            <div class="entry-content">
                                                <?php

                                                $post_content = get_the_excerpt();

                                                $post_content = apply_filters( 'the_excerpt' , $post_content );

                                                $excerpt_length = 90;

                                                $post_content = strip_tags( $post_content );

                                                if( strlen( $post_content ) > $excerpt_length ){

                                                    $post_content = mb_substr( $post_content, 0, $excerpt_length ) . "...";

                                                }

                                                echo $post_content;

                                                //the_content();
                                                ?>
                                            </div>
                                        </header>
                                    </article>
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

                        ?>
                    </div>

                </div>

            <?php

            else :

                get_template_part( 'template-parts/post/content', 'none' );

            endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div><!-- .wrap -->
