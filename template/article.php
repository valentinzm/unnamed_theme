<div class="col-md-4 mb-5">
    <div class="card">
    <div class="card-body">
        <h5 class="card-title"><?php the_title(); ?></h5>
        <p class="card-text">
            <small class="text-muted">
                <?php   
                    $cur_terms = get_the_terms( $post->ID, 'post_tag' );
                    if( is_array( $cur_terms ) ){
                        foreach( $cur_terms as $cur_term ){
                            echo '<a class="d-block" href="'. get_term_link( $cur_term->term_id, $cur_term->taxonomy ) .'">'. $cur_term->name .'</a>';
                        }
                    }
                ?>
            </small>
        </p>
        <p class="card-text">
            <small class="text-muted">
                <?php   
                    $cur_terms = get_the_terms( $post->ID, 'category' );
                    if( is_array( $cur_terms ) ){
                        foreach( $cur_terms as $cur_term ){
                            echo '<a class="d-block" href="'. get_term_link( $cur_term->term_id, $cur_term->taxonomy ) .'">'. $cur_term->name .'</a>';
                        }
                    }
                ?>
            </small>
        </p>
        <p class="card-text">
            <small class="text-muted">
                <?php get_the_category(); ?>
            </small>
        </p>
        <p class="card-text"><?php the_excerpt(); ?></p>
        <a href="<?php the_permalink(); ?>" class="btn btn-primary">Перейти</a>
    </div>
    </div>
</div>