<?php
if (have_rows('destaques')):
  while (have_rows('destaques')):
    the_row(); ?>
    <!-- Card Blog -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <!-- Title -->
      <div class="max-w-3xl mx-auto text-center mb-10 lg:mb-14">
        <h2 class="text-3xl font-bold md:text-5xl md:leading-tight dark:text-white"><?php echo get_sub_field('titulo'); ?></h2>
        <p class="mt-4 text-lg text-gray-600 dark:text-neutral-400"><?php echo get_sub_field('descricao'); ?></p>
      </div>
      <!-- End Title -->

      <!-- Grid -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        // Custom WordPress loop
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => 5,
          'orderby' => 'date',
          'order' => 'DESC'
        );
        $query = new WP_Query($args);
        if ($query->have_posts()):
          while ($query->have_posts()): $query->the_post(); ?>
          <!-- Card -->
          <a class="group flex flex-col focus:outline-none hover:shadow-xl rounded-lg transition-transform transform hover:scale-105 bg-white dark:bg-neutral-800" href="<?php the_permalink(); ?>">
            <div class="relative pt-[56.25%] rounded-t-lg overflow-hidden">
              <img
                class="absolute top-0 left-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out"
                src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>"
                alt="<?php echo esc_attr(get_the_title()); ?>">
            </div>

            <div class="p-6">
              <h3 class="text-xl font-semibold text-gray-900 dark:text-white group-hover:text-purple-600">
                <?php the_title(); ?>
              </h3>
              <p class="mt-3 text-gray-700 dark:text-neutral-300">
                <?php echo wp_strip_all_tags(wp_trim_words(get_the_excerpt(), 10), true); ?>
              </p>
              <p
                class="mt-5 inline-flex items-center gap-x-1 text-sm text-purple-600 decoration-2 group-hover:underline font-medium dark:text-purple-500">
                Leia mais
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m9 18 6-6-6-6" />
                </svg>
              </p>
            </div>
          </a>
          <!-- End Card -->
          <?php endwhile;
        endif;
        wp_reset_postdata();
        ?>

        <?php
        $link = get_sub_field('link_destaque');
        if ($link):
          $link_url = $link['url'];
          $link_title = $link['title'];
          $link_target = $link['target'] ? $link['target'] : '_self';
          ?>
          <!-- Card -->
          <a class="group relative flex flex-col w-full min-h-60 bg-[url('https://images.unsplash.com/photo-1634017839464-5c339ebe3cb4?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=560&q=80')] bg-center bg-cover rounded-xl hover:shadow-lg focus:outline-none focus:shadow-lg transition" href="<?php echo esc_url( $link_url ); ?>">
            <div class="flex-auto p-4 md:p-6">
              <h3 class="text-xl text-white/90 group-hover:text-white"><?php echo get_sub_field('texto_destaque'); ?></h3>
            </div>
            <div class="pt-0 p-4 md:p-6">
              <div
                class="inline-flex items-center gap-2 text-sm font-medium text-white group-hover:text-white/70 group-focus:text-white/70">
                <?php echo esc_html( $link_title ); ?>
                <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m9 18 6-6-6-6" />
                </svg>
              </div>
            </div>
          </a>
          <!-- End Card -->
        <?php endif; ?>
      </div>
      <!-- End Grid -->
    </div>
    <!-- End Card Blog -->
  <?php endwhile;
endif;
?>
