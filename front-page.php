<?php get_header(); ?>
    <main>
        <div class="container pt-5">
            <h1>
                Вывод стандартных постов
            </h1>
            <div class="row">
                <?php
                    $args = array(
                        'posts_per_page' => 99,
                    );
                    $query = new WP_Query( $args );

                    if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) {
                            $query->the_post();
                            get_template_part('/template/article');
                        }        
                    } else {
                        echo '<h4>Ничего нет</h4>';
                    }                      
                    wp_reset_postdata();                    
                ?>
            </div><!--row-->
            
            <h1 class="mb-5">
                Новый тип записи Видео
            </h1>
            <div class="row">
                    <?php
                    $video_args = array(
                        'post_type' => 'video',
                        'posts_per_page' => 99,
                    );
                    $video_query = new WP_Query( $video_args );

                    if ( $video_query->have_posts() ) {
                        while ( $video_query->have_posts() ) {
                            $video_query->the_post();
                            get_template_part('/template/article');
                        }
                    } else {
                        echo '<h4>Ничего нет</h4>';
                    }
                    wp_reset_postdata();
                ?>
            </div>
        </div>
    </main>
<?php get_footer(); ?>