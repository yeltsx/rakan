<?php
if (have_rows('startups')):
    while (have_rows('startups')):
        the_row(); ?>
        <div class="container mx-auto px-6 py-12 max-w-[85rem]">

            <div class="mx-auto max-w-lg text-center">
                <h2 class="text-3xl font-bold sm:text-4xl pt-4"><?php echo get_sub_field('titulo'); ?></h2>

                <p class="mt-4 text-gray-950">
                    <?php echo get_sub_field('descricao'); ?>
                </p>
            </div>

            <div class="grid grid-cols-3 gap-4 px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
                <?php if (have_rows('startup')):
                    while (have_rows('startup')):
                        the_row(); ?>
                        <a class="flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-lg focus:outline-none focus:shadow-lg transition dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70"
                            href="<?php echo get_sub_field('url'); ?>" target="_blank">
                            <?php
                            $image = get_sub_field('imagem');
                            if (!empty($image)): ?>
                                <img class="w-full h-auto rounded-t-xl" src="<?php echo esc_url($image['url']); ?>"
                                    alt="<?php echo esc_attr($image['alt']); ?>">
                            <?php endif; ?>
                            <div class="p-4 md:p-5">
                                <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                    <?php echo get_sub_field('nome'); ?>
                                </h3>
                                <p class="mt-1 text-gray-500 dark:text-neutral-400">
                                    <?php echo get_sub_field('descricao'); ?>
                                </p>
                            </div>
                        </a>
                    <?php endwhile; endif; ?>

            </div>

        </div>
    <?php endwhile; endif; ?>