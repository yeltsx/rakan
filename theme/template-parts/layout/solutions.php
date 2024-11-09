<?php
if( have_rows('funcionalidades') ): while ( have_rows('funcionalidades') ) : the_row(); ?>
<section id="funcionalidades" class="bg-gradient-to-r from-white via-gray-200 to-purple-100 py-16">
  <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
    <div class="mx-auto max-w-2xl text-center text-gray-900">
      <h2 class="text-4xl font-bold sm:text-5xl"><?php echo get_sub_field('titulo'); ?></h2>
      <p class="mt-4 text-lg text-gray-700">
        <?php echo get_sub_field('descricao'); ?>
      </p>
    </div>

    <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
      <?php if( have_rows('solucoes') ): while ( have_rows('solucoes') ) : the_row(); ?>
      <a
        class="block rounded-xl border border-gray-200 p-8 shadow-md hover:shadow-xl transition-transform transform hover:scale-105 hover:border-purple-500/50 hover:shadow-purple-500/20 bg-white"
        href="<?php echo get_sub_field('link'); ?>"
      >
        <div class="flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
          <?php echo get_sub_field('svg'); ?>
        </div>
        <h2 class="mt-4 text-xl font-bold text-gray-800">
          <?php echo get_sub_field('titulo'); ?>
        </h2>
        <p class="mt-2 text-gray-600">
          <?php echo get_sub_field('descricao'); ?>
        </p>
      </a>
      <?php endwhile; endif; ?>
    </div>

    <div class="mt-12 text-center">
      <?php 
      $cta = get_sub_field('cta');
      if( $cta ): 
      $cta_url = $cta['url'];
      $cta_title = $cta['title'];
      $cta_target = $cta['target'] ? $cta['target'] : '_self';
      ?>
      <a
        href="<?php echo esc_url( $cta_url ); ?>"
        class="inline-block rounded bg-purple-600 px-12 py-3 text-sm font-medium text-white transition transform hover:scale-105 hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-400 focus:ring-opacity-50 shadow-lg hover:shadow-xl"
      >
        <?php echo esc_html( $cta_title ); ?>
      </a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endwhile; endif; ?>
