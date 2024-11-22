<?php get_header(); ?>

<div class="container mx-auto max-w-[85rem] px-6 py-12">
    <h1 class="text-3xl font-bold text-black mb-8 text-center">Portfolio</h1>
    <?php if (have_posts()): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php while (have_posts()):
                the_post(); ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <?php if (has_post_thumbnail()): ?>
                        <a href="<?php the_field('url_do_site'); ?>" target="_blank">
                            <?php the_post_thumbnail('medium', ['class' => 'w-full h-48 object-cover']); ?>
                        </a>
                    <?php endif; ?>
                    <div class="p-6">
                        <a href="<?php the_field('url_do_site'); ?>" target="_blank" class="block">
                            <h2 class="text-2xl font-semibold text-gray-800 hover:text-purple-600"><?php the_title(); ?></h2>
                        </a>
                        <p class="mt-2 text-gray-600"><strong>Tecnologias:</strong>
                            <?php the_field('tecnologias_utilizadas'); ?></p>
                        <p class="mt-1 text-gray-600"><strong>Ano:</strong> <?php the_field('data_de_conclusao'); ?></p>
                        <?php
                        $imagem_adicional = get_field('imagem_adicional');
                        if ($imagem_adicional): ?>
                            <img src="<?php echo esc_url($imagem_adicional['url']); ?>"
                                alt="<?php echo esc_attr($imagem_adicional['alt']); ?>"
                                class="mt-4 w-full h-48 object-cover rounded">
                        <?php endif; ?>
                        <a href="<?php the_field('url_do_site'); ?>" target="_blank"
                            class="mt-4 inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
                            Visitar
                            <svg class="w-6 h-6 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961" />
                            </svg>

                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <div class="mt-8">
            <?php
            // Paginação personalizada (opcional)
            the_posts_pagination(array(
                'mid_size' => 2,
                'prev_text' => __('« Anterior', 'textdomain'),
                'next_text' => __('Próximo »', 'textdomain'),
            ));
            ?>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-600">Nenhum projeto encontrado no portfolio.</p>
    <?php endif; ?>
</div>

<?php get_footer(); ?>