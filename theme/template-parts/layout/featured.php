<?php
if (have_rows('destaques')):
  while (have_rows('destaques')):
    the_row(); ?>
    <!-- Card Blog -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
      <!-- Title -->
      <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
        <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white"><?php echo get_sub_field('titulo'); ?>
        </h2>
        <p class="mt-1 text-gray-600 dark:text-neutral-400"><?php echo get_sub_field('descricao'); ?></p>
      </div>
      <!-- End Title -->

      <!-- Grid -->
      <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php
        $featured_posts = get_sub_field('featured_posts');
        if ($featured_posts): ?>
          <?php foreach ($featured_posts as $post):

            // Setup this post for WP functions (variable must be named $post).
            setup_postdata($post);
          
            ?>
            <!-- Card -->
            <a class="group flex flex-col focus:outline-none" href="<?php the_permalink(); ?>">
              <div class="relative pt-[50%] sm:pt-[70%] rounded-xl overflow-hidden">
                <img
                  class="size-full absolute top-0 start-0 object-cover group-hover:scale-105 group-focus:scale-105 transition-transform duration-500 ease-in-out rounded-xl"
                  src="<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), array(300, 300), false, ''); echo $src[0]; ?>"
                  alt="Blog Image">
              </div>

              <div class="mt-7">
                <h3
                  class="text-xl font-semibold text-gray-800 group-hover:text-gray-600 dark:text-neutral-300 dark:group-hover:text-white">
                  <?php the_title(); ?>
                </h3>
                <p class="mt-3 text-gray-800 dark:text-neutral-200">
                  <?php echo get_the_excerpt(); ?>
                </p>
                <p
                  class="mt-5 inline-flex items-center gap-x-1 text-sm text-purple-600 decoration-2 group-hover:underline group-focus:underline font-medium dark:text-purple-500">
                  Leia mais
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                  </svg>
                </p>
              </div>
            </a>
            <!-- End Card -->
          <?php endforeach; ?>
          <?php
          // Reset the global post object so that the rest of the page works correctly.
          wp_reset_postdata(); ?>
        <?php endif; ?>

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
        </div>
        <!-- End Grid -->
      <?php endif; ?>
    </div>
    <!-- End Card Blog -->
  <?php endwhile; endif; ?>