<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<div class="wrap">

    <div id="primary" class="content-area archive-custom-post-type archive-project-post-type">
        <main id="main" class="site-main" role="main">

            <header class="archive-project-header">
                <div class="title"><h4><?php _e("Done Projects","mafiran");?></h4></div>
                <div class="spr-general"></div>
            </header>

            <?php
            if ( have_posts() ) : ?>

                <div class="row carchive-inner-content-container">
                    <?php
                    /* Start the Loop */
                    while ( have_posts() ) : the_post();

                        ?>

                        <div class="col-sm-6 carchive-post-item">
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

            else :

                get_template_part( 'template-parts/post/content', 'none' );

            endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->
    <?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
