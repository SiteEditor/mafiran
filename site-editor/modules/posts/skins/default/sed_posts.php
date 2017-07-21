<div <?php echo $sed_attrs; ?> class="module module-posts module-posts-skin1 <?php echo $class; ?> ">

    <?php

    $custom_query = new WP_Query( $args );

    if ( $custom_query->have_posts() ){

        ?>

        <div class="about-company-container">

            <div class="about-company-slider">

                <?php
                // Start the Loop.
                while ( $custom_query->have_posts() ){
                    $custom_query->the_post();

                    include dirname(__FILE__) . '/content.php';

                }

                ?>

            </div>

        </div>

        <?php

        wp_reset_postdata();

    }else{ ?>
        
        <div class="not-found-post">
            <p><?php echo __("Not found result" , "site-editor" ); ?> </p>
        </div>
        
    <?php 
        
    }
    
    wp_reset_query();
    
    ?>
    
</div>