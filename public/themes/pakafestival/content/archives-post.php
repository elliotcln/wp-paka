<?php $page_id = get_queried_object_id();
global $wp_query;
?>
<header class="flex flex-col space-y-3 items-center pt-6 lg:pt-12">
    <?php get_breadcrumb($page_id); ?>
    <h1 class="text-5xl lg:text-6xl font-title text-center"><?= get_the_title($page_id); ?></h1>
</header>
<section class="mx-auto max-w-5xl lg:px-16 xl:px-24 content pt-4 lg:pt-12 pb-12 lg:pb-24">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <article class="<?= $wp_query->current_post > 0 ? 'mt-8 lg:mt-16' : '' ?>">
                <h2><a href="<?= get_the_permalink(); ?>"><?= get_the_title(); ?></a></h2>
                <span class="text-sm opacity-60">Posté le <?= get_the_date('d/m/Y'); ?></span>
                <?php the_excerpt(); ?>
            </article>

    <?php endwhile;
    endif; ?>
</section>