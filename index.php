<?php 
$term_id = get_queried_object()->term_id;
$term_title = get_queried_object()->name;
$term_tax = get_queried_object()->taxonomy;
get_header(); ?>
    <main>
        <div class="container pt-5">
            <h1>
                <?php echo $term_title; ?>
            </h1>
            <div class="row">
            <?php
                $term_args = array(
                    'posts_per_page' => 99,
                    'post_type' => array( 'post', 'video' ),
                    'tax_query' => array(
                        array(
                        'taxonomy' => $term_tax,
                        'field' => 'term_id',
                        'terms' => $term_id,
                        )
                      )
                );
                $term_query = new WP_Query( $term_args );
                    if ( $term_query->have_posts() ) {
                        while ( $term_query->have_posts() ) {
                            $term_query->the_post();
                            get_template_part('/template/article');
                        }        
                    }                   
                wp_reset_postdata();                    
            ?>
            </div>
        </div>
    </main>
<?php get_footer(); ?>