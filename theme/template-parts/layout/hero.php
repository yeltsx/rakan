<?php
$hero = get_field('hero');
if( $hero ): ?>
<div class="relative overflow-hidden bg-gradient-to-br from-purple-700 via-purple-800 to-purple-900 text-white">
  <div class="absolute top-0 left-0 w-32 h-32 bg-purple-600 opacity-50 rounded-full blur-xl -z-10"></div>
  <div class="absolute bottom-0 right-0 w-48 h-48 bg-purple-500 opacity-70 rounded-full blur-2xl -z-10"></div>
  <div class="container mx-auto max-w-[85rem] px-6 pt-16 pb-0 flex flex-col md:flex-row items-center">
    <!-- Left Section - Text and Form -->
    <div class="flex-1 text-center md:text-left">
      <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php echo $hero['titulo']; ?></h1>
      <p class="text-lg mb-6"><?php echo $hero['descricao']; ?></p>
      <iframe src="https://embeds.beehiiv.com/b7697ebc-a633-4d63-be26-39c84d931a2d?slim=true" data-test-id="beehiiv-embed" height="52" class="max-w-lg mt-8" width="100%" frameborder="0" scrolling="no"></iframe>
    </div>

    <!-- Right Section - Image -->
    <div class="flex-1 mt-10 md:mt-0 md:ml-10 relative flex items-end">
      <img src="<?php echo esc_url( $hero['imagem']['url'] ); ?>" alt="Ilustração criativa" class="w-full h-auto max-w-lg mx-auto" style="object-position: bottom;" />
      <div class="absolute top-0 -right-10 w-16 h-16 bg-purple-400 opacity-40 rounded-full blur-md"></div>
      <div class="absolute bottom-0 -left-12 w-24 h-24 bg-purple-300 opacity-30 rounded-full blur-lg"></div>
    </div>
  </div>
</div>
<?php endif; ?>