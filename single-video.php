<?php get_header(); ?>
    <div class="container mt-5">
    <p class="alert alert-primary">Это сообщение будет выведено только на странице кастомных постов видео</p>
        <?php
            while ( have_posts() ) :
                the_post();
                the_title( '<h1 class="mb-5">', '</h1>');
                the_content();
            endwhile;
        ?>
    </div>
<?php get_footer(); ?>