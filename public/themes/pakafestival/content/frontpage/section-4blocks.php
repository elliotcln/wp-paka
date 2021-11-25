<section class="bg-light py-8 lg:py-16 lg:my-12">
    <div class="container grid md:grid-cols-2 gap-6 lg:gap-10">
        <div class="py-4 lg:py-8 px-7 lg:px-14">
            <?php if (get_field('hp_block-1_icon')) : ?>
                <img class="h-20" src="<?= wp_get_attachment_url(get_field('hp_block-1_icon')); ?>" alt="">
            <?php else : ?>
                <svg aria-hidden="true" class="icon w-20 h-20 text-green">
                    <use xlink:href="#plane-ticket" />
                </svg>
            <?php endif; ?>
            <h3 class="font-bold text-2xl mt-4"><?= get_field('hp_block-1_titre'); ?></h3>
            <?php if (get_field('hp_block-1_content')) : ?>
                <p class="mt-2"><?= get_field('hp_block-1_content'); ?></p>
            <?php endif; ?>
        </div>
        <div class="py-4 lg:py-8 px-7 lg:px-14">
            <?php if (get_field('hp_block-2_icon')) : ?>
                <img class="h-20" src="<?= wp_get_attachment_url(get_field('hp_block-2_icon')); ?>" alt="">
            <?php else : ?>
                <svg aria-hidden="true" class="icon w-20 h-20 text-green">
                    <use xlink:href="#music-notes" />
                </svg>
            <?php endif; ?>
            <h3 class="font-bold text-2xl mt-4"><?= get_field('hp_block-2_titre'); ?></h3>
            <?php if (get_field('hp_block-2_content')) : ?>
                <p class="mt-2"><?= get_field('hp_block-2_content'); ?></p>
            <?php endif; ?>
        </div>
        <div class="py-4 lg:py-8 px-7 lg:px-14">
            <?php if (get_field('hp_block-3_icon')) : ?>
                <img class="h-20" src="<?= wp_get_attachment_url(get_field('hp_block-3_icon')); ?>" alt="">
            <?php else : ?>
                <svg aria-hidden="true" class="icon w-20 h-20 text-green">
                    <use xlink:href="#sunrise" />
                </svg>
            <?php endif; ?>
            <h3 class="font-bold text-2xl mt-4"><?= get_field('hp_block-3_titre'); ?></h3>
            <?php if (get_field('hp_block-3_content')) : ?>
                <p class="mt-2"><?= get_field('hp_block-3_content'); ?></p>
            <?php endif; ?>
        </div>
        <div class="py-4 lg:py-8 px-7 lg:px-14">
            <?php if (get_field('hp_block-4_icon')) : ?>
                <img class="h-20" src="<?= wp_get_attachment_url(get_field('hp_block-4_icon')); ?>" alt="">
            <?php else : ?>
                <svg aria-hidden="true" class="icon w-20 h-20 text-green">
                    <use xlink:href="#treasure-map" />
                </svg>
            <?php endif; ?>
            <h3 class="font-bold text-2xl mt-4"><?= get_field('hp_block-4_titre'); ?></h3>
            <?php if (get_field('hp_block-4_content')) : ?>
                <p class="mt-2"><?= get_field('hp_block-4_content'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</section>