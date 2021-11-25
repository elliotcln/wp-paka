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
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '2400798253298763');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=2400798253298763&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->ƒ
<script src="<?= get_theme_file_uri('assets/app.js') ?>" async></script>
<?php wp_footer(); ?>
</body>

</html>