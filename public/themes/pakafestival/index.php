<?php get_header(); ?>

<main id="main-content" role="main" class="relative">
    <div class="main-cover"></div>
    <div class="container relative">
        <?php
        if (is_page()) :
            get_template_part('content/single', 'page');

        elseif (is_single()) :
            get_template_part('content/single', get_post_type());

        elseif (is_home() && !is_front_page()) :
            get_template_part('content/archives', get_post_type());

        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>