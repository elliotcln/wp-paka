<!-- newsletter form include -->
<?php locate_template('includes/newsletter.php', true); ?>

<!-- footer -->
<footer role="contentinfo" class="bg-dark pt-8 lg:pt-16 pb-4 lg:pb-8 text-white">
  <div class="container">
    <div class="flex flex-col space-y-8 items-center lg:flex-row lg:space-y-0 lg:items-end">
      <?php
      wp_nav_menu(array(
        'theme_location' => 'footer',
        'container' => 'nav',
        'container_class' => 'footer-navigation'
      ));
      ?>
      <div class="lg:ml-24">
        <div class="flex justify-center lg:justify-start space-x-4 mb-4">
          <a href="https://www.morbihan.fr/" target="_blank" title="Conseil départemental du Morbihan (nouvelle fenêtre)">
            <img class="h-14" src="<?= get_template_directory_uri(); ?>/assets/images/logos/logo-morbihan.svg" alt="Conseil départemental du Morbihan">
          </a>
          <a href="https://www.la-trinite-sur-mer.fr/" target="_blank" title="La Trinité-sur-mer (nouvelle fenêtre)">
            <img class="h-14" src="<?= get_template_directory_uri(); ?>/assets/images/logos/logo-trinitesurmer.svg" alt="La Trinité-sur-mer">
          </a>
        </div>
        <p class="text-sm text-center">Festival soutenu par le Conseil Départemental du Morbihan</p>
      </div>
      <?php
      wp_nav_menu(array(
        'theme_location' => 'social',
        'container' => 'nav',
        'container_class' => 'lg:ml-auto',
        'walker' => new Social_Nav_Walker
      ))
      ?>
    </div>
    <p class="opacity-60 text-white text-center lg:text-left text-sm mt-7 lg:mt-14">&copy; <?= get_bloginfo('name'); ?> - La Trinité-sur-mer - 2019/<?= date('Y'); ?></p>
  </div>
</footer>

<!-- end site-wrapper -->
</div>
<!-- svg icons pattern -->
<div class="hidden">
  <?php include get_stylesheet_directory() . '/assets/images/icons-pattern.svg'; ?>
  <?php include get_stylesheet_directory() . '/assets/images/socials-pattern.svg'; ?>
</div>
<script src="<?= get_theme_file_uri('assets/app.js') ?>" async></script>
<?php wp_footer(); ?>
</body>

</html>