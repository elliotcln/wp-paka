<?php
$artists = array(
    'Abdoul Kamal',
    'Ava Asante',
    'Bako Combé',
    'Billet d’humeur',
    'Bō',
    'Bre.tone',
    'Dee La',
    'Djok',
    'Djtal',
    'Hocine & Philippe',
    'Kazzey',
    'Lagauth',
    'La note magique',
    'Le murmure de la mer',
    'Loya',
    'Maø',
    'Mary-Âm & Caroline',
    'Mask',
    'Noam',
    'Nomade',
    'Paysan',
    'Penrose',
    'Pouvoir Magique',
    'Ronan Gravier',
    'Samifati',
    'Shady Fat Kats',
    'Trinité sur Wax',
    'Yannis Why'
);
?>
<section class="rounded-2xl mx-auto max-w-3xl <?= (!empty(get_the_content()) ? 'my-4 lg:my-8' : ''); ?> p-8 lg:p-12 bg-dark text-light">
    <h2 class="text-center">Ils ont joué au PAKA Festival</h2>
    <div class="flex flex-wrap items-center justify-center mt-4 lg:mt-8">
        <?php foreach ($artists as $index => $artist) : ?>
            <span class="px-2 <?= ($index % 2) == 0 ?  'text-orange' : null; ?>"><?= $artist; ?></span>
        <?php endforeach; ?>
    </div>
</section>