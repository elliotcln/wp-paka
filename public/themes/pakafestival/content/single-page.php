<article>
    <header class="flex flex-col space-y-3 items-center pt-6 lg:pt-12">
        <?php get_breadcrumb(get_the_ID()); ?>
        <h1 class="text-5xl lg:text-6xl font-title text-center"><?= get_the_title(); ?></h1>
    </header>
    <?php if (has_post_thumbnail()) : ?>
        <figure class="mx-auto max-w-5xl mb-4 mt-4 lg:mt-8">
            <?= the_post_thumbnail('full', ['class' => 'w-full rounded-2xl']); ?>
            <?php if (get_the_post_thumbnail_caption()) : ?>
                <figcaption class="text-center italic text-xs lg:text-sm opacity-60 pt-3"><?= get_the_post_thumbnail_caption(); ?></figcaption>
            <?php endif; ?>
        </figure>
    <?php endif; ?>

    <!-- check if parent or child -->
    <?php
    $children = get_children(array(
        'post_parent' => get_the_ID(),
        'post_type' => 'page',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ));

    // print_r($children);

    // is child
    if (empty($children)) : ?>
        <div class="mx-auto max-w-5xl lg:px-16 xl:px-24 content pt-4 lg:pt-8 pb-12 lg:pb-24">
            <?php the_content(); ?>
        </div>
    <?php
    // is parent
    else : ?>
        <div class="mx-auto max-w-5xl lg:px-16 xl:px-24 content pt-4 lg:pt-12 pb-12 lg:pb-24">
            <div class="grid md:grid-cols-2 gap-6">
                <?php foreach ($children as $c) : ?>
                    <div class="text-center border-3 border-dark p-4">
                        <h2><?= $c->post_title; ?></h2>
                        <a class="hover:text-orange" href="<?= get_the_permalink($c->ID); ?>">Visiter la page <span class="sr-only"><?= $c->post_title; ?></span></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </d>
    <?php endif; ?>

</article>