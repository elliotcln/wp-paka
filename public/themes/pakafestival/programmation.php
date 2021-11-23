<?php

/**
 * Template Name: Programmation
 */

get_header(); ?>


<main id="main-content">
    <div class="container">
        <header class="flex flex-col space-y-3 items-center pt-6 lg:pt-12">
            <?php get_breadcrumb(get_the_ID()); ?>
            <h1 class="text-5xl lg:text-6xl font-title text-center"><?= get_the_title(); ?></h1>
        </header>
        <section class="content pt-4 lg:pt-12 pb-12 lg:pb-24">
            <?php the_content(); ?>
            <div class="<?= (!empty(get_the_content()) ? 'mt-4 lg:mt-8' : ''); ?> grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-2 lg:gap-4">
                <?php
                $i = 0;
                $cat = null;
                if (get_the_ID() == 54) {
                    $cat = 'pour-les-grands';
                } else {
                    $cat = 'pour-les-petits';
                }

                $artists = new WP_Query(array(
                    'post_type' => 'artists',
                    'category_name' => $cat,
                    'meta_key' => 'show_date',
                    'order' => 'ASC',
                    'orderby' => 'meta_value'
                ));
                while ($artists->have_posts()) : $artists->the_post();
                    $i++;
                ?>
                    <div class="group border-3 border-dark focus-within:ring-4 ring-offset-2 ring-yellow col-span-1 aspect-w-1 aspect-h-1 bg-yellow-300 text-white relative overflow-hidden">
                        <?php the_post_thumbnail(null, ['class' => 'absolute inset-0 object-cover transform duration-1000 group-hover:scale-110']); ?>
                        <div class="img-overlay absolute inset-0 z-10 bg-gradient-to-b from-transparent to-gray-900 opacity-80"></div>
                        <div class="absolute inset-0 p-5 z-10 flex flex-col justify-end">
                            <h3 class="text-2xl"><?php the_title(); ?>
                                <small class="block text-base font-normal font-display opacity-70"><?= get_field('show_date'); ?></small>
                            </h3>
                            <?php if (get_field('artist_description')) : ?>
                                <label for="toggle-artist_description-<?= $i; ?>" class="p-5 absolute left-0 top-0 cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6">
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path fill="currentColor" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zM11 7h2v2h-2V7zm0 4h2v6h-2v-6z" />
                                    </svg>
                                </label>
                                <input aria-label="toggle artist description" type="checkbox" class="opacity-0 absolute" id="toggle-artist_description-<?= $i; ?>">
                                <div class="artist_description-container">
                                    <h4 class="text-2xl mb-2 text-yellow-300"><?php the_title(); ?></h4>
                                    <div class="overflow-y-auto">
                                        <?= get_field('artist_description'); ?>
                                    </div>
                                    <label tabindex="0" for="toggle-artist_description-<?= $i; ?>" class="absolute left-0 top-0 p-3 cursor-pointer">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6">
                                            <path fill="none" d="M0 0h24v24H0z" />
                                            <path fill="currentColor" d="M12 22C6.477 22 2 17.523 2 12S6.477 2 12 2s10 4.477 10 10-4.477 10-10 10zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm0-9.414l2.828-2.829 1.415 1.415L13.414 12l2.829 2.828-1.415 1.415L12 13.414l-2.828 2.829-1.415-1.415L10.586 12 7.757 9.172l1.415-1.415L12 10.586z" />
                                        </svg>
                                    </label>
                                </div>
                            <?php endif; ?>
                            <?php if (get_field('youtube_link')) : ?>
                                <a class="absolute top-0 right-0 p-5" href="<?= get_field('youtube_link'); ?>" target="_blank">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-6 w-6">
                                        <path fill="none" d="M0 0h24v24H0z" />
                                        <path fill="currentColor" d="M19.606 6.995c-.076-.298-.292-.523-.539-.592C18.63 6.28 16.5 6 12 6s-6.628.28-7.069.403c-.244.068-.46.293-.537.592C4.285 7.419 4 9.196 4 12s.285 4.58.394 5.006c.076.297.292.522.538.59C5.372 17.72 7.5 18 12 18s6.629-.28 7.069-.403c.244-.068.46-.293.537-.592C19.715 16.581 20 14.8 20 12s-.285-4.58-.394-5.005zm1.937-.497C22 8.28 22 12 22 12s0 3.72-.457 5.502c-.254.985-.997 1.76-1.938 2.022C17.896 20 12 20 12 20s-5.893 0-7.605-.476c-.945-.266-1.687-1.04-1.938-2.022C2 15.72 2 12 2 12s0-3.72.457-5.502c.254-.985.997-1.76 1.938-2.022C6.107 4 12 4 12 4s5.896 0 7.605.476c.945.266 1.687 1.04 1.938 2.022zM10 15.5v-7l6 3.5-6 3.5z" />
                                    </svg>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile;
                wp_reset_postdata(); ?>
            </div>
        </section>

    </div>
</main>

<?php get_footer(); ?>