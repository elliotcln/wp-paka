<?php
$ticket = new stdClass();
$ticket->title = get_field('ticket_title');
$ticket->content = get_field('ticket_content');
$ticket->programmation_link = get_field('ticket_programmation_link');
$billetterie_link = get_permalink(get_page_by_path('billetterie'));
?>
<section>
    <div class="container">
        <div class="event-ticket mx-auto max-w-5xl bg-dark relative overflow-hidden lg:text-lg">
            <div class="w-16 h-16 rounded-full border-r-3 border-t-3 border-dark bg-light absolute left-0 top-1/2 transform rotate-45 -translate-x-1/2 -translate-y-1/2"></div>
            <div class="w-16 h-16 rounded-full border-l-3 border-t-3 border-dark bg-light absolute right-0 top-1/2 transform -rotate-45 translate-x-1/2 -translate-y-1/2"></div>
            <div class="flex flex-col md:flex-row">
                <div class="relative left-ticket text-white p-8 pb-12 md:p-12 lg:p-14">
                    <h2><a href="<?= $ticket->programmation_link; ?>"><?= $ticket->title; ?></a></h2>
                    <p class="opacity-60 mt-4"><?= $ticket->content; ?></p>
                    <a href="<?= $ticket->programmation_link; ?>" class="w-16 h-16 flex items-center justify-center rounded-full border-3 border-dark bg-light absolute top-full right-1/2 md:right-0 md:top-1/2 transform translate-x-1/2 -translate-y-1/2">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" viewBox="0 0 24 24" class="w-7 h-7">
                            <path fill="none" d="M0 0h24v24H0z" />
                            <path d="M18.364 15.536L16.95 14.12l1.414-1.414a5 5 0 1 0-7.071-7.071L9.879 7.05 8.464 5.636 9.88 4.222a7 7 0 0 1 9.9 9.9l-1.415 1.414zm-2.828 2.828l-1.415 1.414a7 7 0 0 1-9.9-9.9l1.415-1.414L7.05 9.88l-1.414 1.414a5 5 0 1 0 7.071 7.071l1.414-1.414 1.415 1.414zm-.708-10.607l1.415 1.415-7.071 7.07-1.415-1.414 7.071-7.07z" />
                        </svg>
                        <span class="sr-only"><?= $ticket->title; ?></span>
                    </a>
                </div>
                <div class="right-ticket flex-shrink-0 border-3 border-dark bg-light md:w-1/2 lg:w-2/5 flex items-center justify-center p-8 pt-12 md:p-12 lg:p-14">
                    <a href="<?= $billetterie_link; ?>" class="w-full lg:w-auto border-3 border-orange px-6 py-5 text-orange font-medium text-center flex items-center justify-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-6 w-6 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        <span>Prendre mes billets</span>
                    </a>
                </div>
            </div>
        </div>

        <!--  -->
        <?php
        $links = get_field('4_links');
        if ($links) :
        ?>
            <div class="md:flex md:justify-center flex-wrap my-3 mx-auto max-w-5xl mt-4 md:mt-8">
                <?php foreach ($links as $k => $link) : ?>
                    <div class="px-2 py-8 lg:py-16 md:w-1/2 text-center">
                        <h2>
                            <?= $link->post_title ?>
                        </h2>
                        <a href="<?= get_page_uri($link->ID); ?>" class="font-medium text-orange"><span class="sr-only"><?= $link->post_title; ?> -</span> En savoir plus</a>
                    </div>
            <?php endforeach;
            endif; ?>
            </div>
    </div>
</section>