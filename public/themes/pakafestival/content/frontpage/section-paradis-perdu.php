<?php
$main_event = get_field('main_event');
$event_id = $main_event[0]->ID;
$event = tribe_get_event($event_id);

$e = new stdClass();
$e->title = $event->post_title;
$e->start_date = tribe_get_start_date($event_id, false, 'j/n');
$e->end_date = tribe_get_end_date($event_id, false, 'j/n');
// $e->year = tribe_get_start_date($event_id, false, 'Y');
$e->venue = tribe_get_venue_single_line_address($event_id, false);
$e->thumbnail_url = get_the_post_thumbnail_url($event_id);
$e->programmation_link = get_field('event_programmation_link', $event_id);
?>
<section class="event relative py-14 lg:py-28 lg:pt-52 -mt-12 lg:-mt-28">
    <div class="absolute right-0 top-14 bottom-14 md:hidden xl:block">
        <img aria-hidden="true" class="h-full" src="<?= get_template_directory_uri(); ?>/assets/images/event-arrow.svg" alt="">
    </div>
    <div class="container">
        <div class="lg:w-1/2">
            <div class="flex md:items-center md:space-x-8">
                <img class="hidden md:block w-full max-w-xs" src="<?= $e->thumbnail_url ?>" alt="">
                <div class="flex-shrink-0">
                    <span class="font-semibold"><?= $e->start_date; ?> — <?= $e->end_date; ?></span>
                    <span class="block font-title text-7xl lg:text-9xl max-w-xs"><?= $e->title; ?></span>
                    <p class="opacity-60 lg:text-xl"><?= $e->venue; ?></p>
                    <?php if ($e->programmation_link) : ?>
                        <a class="lg:text-lg font-medium text-orange mt-4 inline-block" href="<?= $e->programmation_link; ?>">
                        <span class="sr-only"><?= $e->title; ?> -</span> Découvrir la programmation ⟶</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>