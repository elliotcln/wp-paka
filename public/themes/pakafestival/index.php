<?php get_header(); ?>

<main id="main-content" role="main">
    <div class="container">
        <?php if (have_posts()) : while (have_posts()) : the_post();

                if (is_page()) :
                    get_template_part('content/single', 'page');

                elseif (is_single()) :
                    get_template_part('content/single', get_post_type());

                endif;

            endwhile;
        endif; ?>
    </div>
</main>

<?php get_footer(); ?>