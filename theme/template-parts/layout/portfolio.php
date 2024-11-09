<?php
if (have_rows('startups')):
    while (have_rows('startups')):
        the_row(); ?>
        <div class="bg-gradient-to-b from-white to-gray-100 py-16">
        <div class="container mx-auto max-w-[85rem] px-6">
            <div class="mx-auto max-w-lg text-center text-gray-900">
                <h2 class="text-4xl font-bold sm:text-5xl"><?php echo get_sub_field('titulo'); ?></h2>
                <p class="mt-4 text-lg">
                    <?php echo get_sub_field('descricao'); ?>
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mt-12">
                <?php if (have_rows('startup')):
                    while (have_rows('startup')):
                        the_row(); ?>
                        <div class="bg-white border border-gray-200 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition dark:bg-neutral-900 dark:border-neutral-700">
                        <?php
                        $image = get_sub_field('imagem');
                        if (!empty($image)): ?>
                            <img class="w-full h-48 object-cover transition-transform duration-300 ease-in-out filter hover:brightness-110 hover:scale-105" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                            <?php endif; ?>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-2">
                                <?php echo get_sub_field('nome'); ?>
                            </h3>
                            <p class="text-gray-600 dark:text-neutral-400 mb-4">
                                <?php echo get_sub_field('descricao'); ?>
                            </p>
                            <a href="<?php echo esc_url(get_sub_field('url')); ?>" target="_blank" class="inline-flex items-center px-6 py-3 mt-auto text-sm font-semibold text-purple-700 bg-purple-100 rounded-lg hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-700 focus:ring-opacity-50 transition dark:bg-purple-800 dark:text-white dark:hover:bg-purple-700">
                                Acessar website
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4 text-purple-700 dark:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 14v4.833A1.166 1.166 0 0 1 16.833 20H5.167A1.167 1.167 0 0 1 4 18.833V7.167A1.166 1.166 0 0 1 5.167 6h4.618m4.447-2H20v5.768m-7.889 2.121 7.778-7.778"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <?php endwhile; endif; ?>

            </div>

        </div>
        </div>
    <?php endwhile; endif; ?>