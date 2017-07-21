<div class="slid-item">

    <div class="title"><h2><?php the_title(); ?></h2></div>

    <div class="spr-general"></div>

    <div class="desc">
        <?php

        /*$post_content = get_the_excerpt();

        if( strlen( $post_content ) > $excerpt_length ){

            $post_content = mb_substr( get_the_title(), 0, $excerpt_length ) . "...";

        }

        echo $post_content;*/

        the_content();

        ?>
    </div>

</div>
