<?php
get_header();

// Seção Hero
?>
<section class="bg-purple-700 py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold text-white">Soluções</h1>
    </div>
</section>

<?php
// Query para obter os posts do CPT "solucoes"
$args = array(
    'post_type'      => 'solucoes',
    'posts_per_page' => -1, // Define quantos posts deseja exibir
    'post_status'    => 'publish',
);
$solucoes_query = new WP_Query( $args );

if ( $solucoes_query->have_posts() ) : ?>
    <section id="funcionalidades" class="bg-gradient-to-r from-white via-gray-200 to-purple-100 py-16">
        <div class="mx-auto max-w-screen-xl px-4 py-12 sm:px-6 sm:py-12 lg:px-8 lg:py-16">
            <div class="mx-auto max-w-2xl text-center text-gray-900">
                <h2 class="text-4xl font-bold sm:text-5xl">Como podemos lhe ajudar?</h2>
                <p class="mt-4 text-lg text-gray-700">
                    Explore as soluções que minha equipe e eu oferecemos para você e sua empresa. Aprenda técnicas inovadoras para sua carreira e vida ou otimize o desenvolvimento e hospedagem do seu site.
                </p>
            </div>

            <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php while ( $solucoes_query->have_posts() ) : $solucoes_query->the_post(); ?>
                    <a
                        class="block rounded-xl border border-gray-200 p-8 shadow-md hover:shadow-xl transition-transform transform hover:scale-105 hover:border-purple-500/50 hover:shadow-purple-500/20 bg-white"
                        href="<?php the_permalink(); ?>"
                    >
                        <div class="flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-4">
                            <?php
                            // Obter o código SVG do campo "Home"
                            $home_svg_code = get_field('home_svg_code');
                            if ( $home_svg_code ) {
                                // Sanitização do código SVG
                                $allowed_svg = array(
                                    'svg' => array(
                                        'xmlns' => true,
                                        'width' => true,
                                        'height' => true,
                                        'viewbox' => true,
                                        'fill' => true,
                                        'stroke' => true,
                                        'stroke-width' => true,
                                        'stroke-linecap' => true,
                                        'stroke-linejoin' => true,
                                        'class' => true,
                                    ),
                                    'path' => array(
                                        'd' => true,
                                        'fill' => true,
                                        'stroke' => true,
                                        'stroke-linecap' => true,
                                        'stroke-linejoin' => true,
                                        'stroke-width' => true,
                                    ),
                                    // Adicione outros elementos SVG conforme necessário
                                );
                                echo '<div class="w-10 h-10 text-purple-950">';
                                echo wp_kses( $home_svg_code, $allowed_svg );
                                echo '</div>';
                            }
                            ?>
                        </div>
                        <h2 class="mt-4 text-xl font-bold text-gray-800">
                            <?php the_title(); ?>
                        </h2>
                        <p class="mt-2 text-gray-600">
                            <?php
                            // Obter a descrição do campo "Home"
                            $home_descricao = get_field('home_descricao');
                            if ( $home_descricao ) {
                                echo esc_html( $home_descricao );
                            } else {
                                // Fallback para o resumo do post
                                echo wp_trim_words( get_the_excerpt(), 20, '...' );
                            }
                            ?>
                        </p>
                    </a>
                <?php endwhile; ?>
            </div>

            <div class="mt-12 text-center">
                <a
                    href="/contato/"
                    class="inline-block rounded bg-purple-600 px-12 py-3 text-sm font-medium text-white transition transform hover:scale-105 hover:bg-purple-700 focus:outline-none focus:ring focus:ring-purple-400 focus:ring-opacity-50 shadow-lg hover:shadow-xl"
                >
                    Entre em contato
                </a>
            </div>
        </div>
    </section>
<?php endif;
// Resetar dados do post
wp_reset_postdata();

get_footer();
?>
