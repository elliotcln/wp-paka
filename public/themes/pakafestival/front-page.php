<?php get_header(); ?>

<main id="main-content" role="main">
    <?php if (!empty(get_the_content())) : ?>
        <section class="pt-4 lg:pt-8 relative z-20">
            <div class="container">
                <?php the_content(); ?>
            </div>
        </section>
        <?php
        get_template_part('content/frontpage/section', 'paradis-perdu');
        get_template_part('content/frontpage/section', 'waiting-for');
        get_template_part('content/frontpage/section', '4blocks');
        // get_template_part('content/frontpage/section', 'ils-parlent-de-nous');
        ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>