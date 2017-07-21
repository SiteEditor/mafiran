<?php get_header(); ?>

    <div class="wrap">

        <div id="primary" class="content-area archive-custom-post-type">
            <main id="main" class="site-main" role="main">
                <section class="content">

                    <div class="row">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        <div class="col-sm-6 col-md-4">
                            <article id="post-<?php the_ID(); ?>" <?php post_class('post custom-post-item'); ?>>
                                <?php if ('' !== get_the_post_thumbnail() && !is_single()) : ?>
                                    <div class="post-thumbnail">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php

                                                $attachment_id   = get_post_thumbnail_id();

                                                $img = get_sed_attachment_image_html( $attachment_id , "" , "600X400" );

                                            ?>
                                            <?php 
                                                if ( $img ) {
                                                    echo $img['thumbnail'];
                                                }
                                            ?>
                                            <?php //the_post_thumbnail('s1x1'); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <header class="entry-header entry-header--archive">
                                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                        <div class="entry-title"><?php the_title(); ?></div>
                                        <div class="entry-content"><?php the_content(); ?></div>
                                    </a>
                                </header>
                            </article>
                        </div>
                        <?php endwhile; ?>
                    </div>

                        <?php else :
                            echo '<h2 class="text-center">page not fond!</h2>';
                        endif; ?>

                </section>
            </main><!-- #main -->
        </div><!-- #primary -->
        <?php get_sidebar(); ?>
    </div><!-- .wrap -->

<?php get_footer();