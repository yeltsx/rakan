<?php
if( have_rows('funcionalidades') ): while ( have_rows('funcionalidades') ) : the_row();  ?>
<section id="funcionalidades" class="bg-gray-900 text-white">
  <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
    <div class="mx-auto max-w-lg text-center">
      <h2 class="text-3xl font-bold sm:text-4xl"><?php echo get_sub_field('titulo'); ?></h2>

      <p class="mt-4 text-gray-300">
        <?php echo get_sub_field('descricao'); ?>
      </p>
    </div>

    <div class="mt-8 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
      <?php if( have_rows('solucoes') ): while ( have_rows('solucoes') ) : the_row(); ?>
      <a
        class="block rounded-xl border border-gray-800 p-8 shadow-xl transition hover:border-purple-500/10 hover:shadow-purple-500/10"
        href="<?php echo get_sub_field('link'); ?>"
      >
        <?php echo get_sub_field('svg'); ?>

        <h2 class="mt-4 text-xl font-bold text-white"><?php echo get_sub_field('titulo'); ?></h2>

        <p class="mt-1 text-sm text-gray-300">
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
        class="inline-block rounded bg-purple-600 px-12 py-3 text-sm font-medium text-white transition hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-400"
      >
      <?php echo esc_html( $cta_title ); ?>
      </a>
      <?php endif; ?>
    </div>
  </div>
</section>
<?php endwhile; endif; ?>