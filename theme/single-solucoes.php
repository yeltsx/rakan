<?php
get_header(); ?>

<link href="https://cdn.jsdelivr.net/npm/keen-slider@6.8.6/keen-slider.min.css" rel="stylesheet" />

<script type="module">
    import KeenSlider from 'https://cdn.jsdelivr.net/npm/keen-slider@6.8.6/+esm'

    const keenSliderActive = document.getElementById('keen-slider-active')
    const keenSliderCount = document.getElementById('keen-slider-count')

    const keenSlider = new KeenSlider(
        '#keen-slider',
        {
            loop: true,
            defaultAnimation: {
                duration: 750,
            },
            slides: {
                origin: 'center',
                perView: 1,
                spacing: 16,
            },
            breakpoints: {
                '(min-width: 640px)': {
                    slides: {
                        origin: 'center',
                        perView: 1.5,
                        spacing: 16,
                    },
                },
                '(min-width: 768px)': {
                    slides: {
                        origin: 'center',
                        perView: 1.75,
                        spacing: 16,
                    },
                },
                '(min-width: 1024px)': {
                    slides: {
                        origin: 'center',
                        perView: 3,
                        spacing: 16,
                    },
                },
            },
            created(slider) {
                slider.slides[slider.track.details.rel].classList.remove('opacity-40')

                keenSliderActive.innerText = slider.track.details.rel + 1
                keenSliderCount.innerText = slider.slides.length
            },
            slideChanged(slider) {
                slider.slides.forEach((slide) => slide.classList.add('opacity-40'))

                slider.slides[slider.track.details.rel].classList.remove('opacity-40')

                keenSliderActive.innerText = slider.track.details.rel + 1
            },
        },
        []
    )

    const keenSliderPrevious = document.getElementById('keen-slider-previous')
    const keenSliderNext = document.getElementById('keen-slider-next')

    keenSliderPrevious.addEventListener('click', () => keenSlider.prev())
    keenSliderNext.addEventListener('click', () => keenSlider.next())
</script>

<?php
while (have_posts()):
    the_post();

    if (have_rows('conteudo_solucoes')):
        while (have_rows('conteudo_solucoes')):
            the_row();

            switch (get_row_layout()) {

                case 'hero':
                    $titulo = get_sub_field('titulo');
                    $subtitulo = get_sub_field('subtitulo');
                    $imagem = get_sub_field('imagem');
                    $texto_botao_primario = get_sub_field('texto_botao_primario');
                    $url_botao_primario = get_sub_field('url_botao_primario');
                    $texto_botao_secundario = get_sub_field('texto_botao_secundario');
                    $url_botao_secundario = get_sub_field('url_botao_secundario');
                    $badge_texto = get_sub_field('badge_texto');
                    $badge_icone = get_sub_field('badge_icone');
                    ?>
                    <section class="my-16 container mx-auto max-w-[85rem]">
                        <div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-20">
                            <div class="flex justify-end bg-zinc-100">
                                <?php if ($imagem): ?>
                                    <img src="<?php echo esc_url($imagem['url']); ?>" alt="<?php echo esc_attr($titulo); ?>"
                                        class="max-h-[600px] w-full rounded-md object-cover lg:max-h-[800px]" />
                                <?php endif; ?>
                            </div>
                            <div class="flex flex-col items-center text-center lg:max-w-3xl lg:items-start lg:text-left">
                                <?php if ($badge_texto): ?>
                                    <div
                                        class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-base font-semibold transition-colors focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 border-transparent bg-purple-900 text-white hover:bg-purple-950">
                                        <?php echo esc_html($badge_texto); ?>
                                        <?php if ($badge_icone): ?>
                                            <span class="ml-2">
                                                <?php
                                                // Sanitização do código SVG do ícone do badge
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
                                                echo wp_kses($badge_icone, $allowed_svg);
                                                ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <h1 class="my-6 text-3xl font-bold text-purple-950 lg:text-3xl xl:text-3xl">
                                    <?php echo esc_html($titulo); ?>
                                </h1>
                                <p class="mb-8 max-w-xl text-zinc-600 lg:text-xl">
                                    <?php echo esc_html($subtitulo); ?>
                                </p>
                                <div class="flex w-full flex-col justify-center gap-2 sm:flex-row lg:justify-start">
                                    <?php if ($texto_botao_primario && $url_botao_primario): ?>
                                        <a href="<?php echo esc_url($url_botao_primario); ?>"
                                            class="inline-flex items-center justify-center whitespace-nowrap rounded text-base font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-purple-600 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-purple-900 text-white hover:bg-purple-950 h-10 px-4 py-2 w-full sm:w-auto">
                                            <?php echo esc_html($texto_botao_primario); ?>
                                        </a>
                                    <?php endif; ?>
                                    <?php if ($texto_botao_secundario && $url_botao_secundario): ?>
                                        <a href="<?php echo esc_url($url_botao_secundario); ?>"
                                            class="inline-flex items-center justify-center whitespace-nowrap rounded text-base font-medium transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-purple-600 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 border border-input bg-white text-purple-900 hover:bg-purple-100 hover:text-purple-800 h-10 px-4 py-2 w-full sm:w-auto">
                                            <?php echo esc_html($texto_botao_secundario); ?>
                                            <!-- Ícone opcional no botão secundário -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 w-4 h-4" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path d="M7 7l10 10"></path>
                                                <path d="M17 7v10H7"></path>
                                            </svg>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;

                case 'descricao':
                    $titulo = get_sub_field('titulo');
                    $conteudo = get_sub_field('conteudo');
                    ?>
                    <section class="descricao py-16">
                        <div class="container mx-auto max-w-[85rem] px-6">
                            <h2 class="text-3xl font-bold text-purple-950 text-center"><?php echo esc_html($titulo); ?></h2>
                            <div class="mt-6 prose text-xl">
                                <?php echo wp_kses_post($conteudo); ?>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;

                case 'funcionalidades':
                    $titulo = get_sub_field('titulo');
                    ?>
                    <section class="bg-white">
                        <div class="container mx-auto max-w-[85rem] max-w-[85rem] px-6 py-10">
                        <h2 class="text-3xl font-bold text-purple-950 text-center"><?php echo esc_html($titulo); ?></h2>

                            <div class="grid grid-cols-1 gap-8 mt-8 xl:mt-12 xl:gap-16 md:grid-cols-2 xl:grid-cols-3">
                                <?php if (have_rows('lista_de_funcionalidades')):
                                    while (have_rows('lista_de_funcionalidades')):
                                        the_row();
                                        $svg_code = get_sub_field('svg_code');
                                        $titulo_item = get_sub_field('titulo');
                                        $descricao = get_sub_field('descricao');
                                        ?>
                                        <div class="flex flex-col items-center p-6 space-y-3 text-center bg-gray-100 rounded-xl">
                                            <span class="inline-block p-3 bg-purple-100 rounded-full">
                                                <?php if ($svg_code): ?>
                                                    <div class="w-6 h-6 text-purple-950">
                                                        <?php
                                                        // Sanitização do código SVG
                                                        $allowed_html = array(
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
                                                            // Adicione outras tags e atributos permitidos conforme necessário
                                                        );
                                                        // Exibindo o código SVG de forma segura
                                                        echo wp_kses($svg_code, $allowed_html);
                                                        ?>
                                                    </div>
                                                <?php else: ?>
                                                    <!-- Ícone SVG padrão -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-950" fill="none"
                                                        viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                <?php endif; ?>
                                            </span>

                                            <h5 class="text-xl font-semibold text-gray-700 capitalize">
                                                <?php echo esc_html($titulo_item); ?>
                                            </h5>

                                            <p class="text-gray-500">
                                                <?php echo esc_html($descricao); ?>
                                            </p>
                                        </div>
                                        <?php
                                    endwhile;
                                endif; ?>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;

                case 'texto_e_imagem':
                    $titulo = get_sub_field('titulo');
                    $conteudo = get_sub_field('conteudo');
                    $imagem = get_sub_field('imagem');
                    $texto_botao = get_sub_field('texto_do_botao');
                    $url_botao = get_sub_field('url_do_botao');
                    ?>
                    <section>
                        <div class="container mx-auto max-w-[85rem] px-4 py-16 mb-16 sm:px-6 lg:px-8">
                            <div class="grid grid-cols-1 lg:h-screen lg:grid-cols-2">
                                <div class="relative z-10 lg:py-16">
                                    <div class="relative h-64 sm:h-80 lg:h-full">
                                        <?php if ($imagem): ?>
                                            <img alt="<?php echo esc_attr($titulo); ?>" src="<?php echo esc_url($imagem['url']); ?>"
                                                class="absolute inset-0 h-full w-full object-cover" />
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="relative flex items-center bg-purple-200">
                                    <span class="hidden lg:absolute lg:inset-y-0 lg:-left-16 lg:block lg:w-16 lg:bg-purple-200"></span>

                                    <div class="p-8 sm:p-16 lg:p-24">
                                        <h2 class="text-2xl font-bold sm:text-3xl">
                                            <?php echo esc_html($titulo); ?>
                                        </h2>

                                        <div class="mt-4 prose text-black">
                                            <?php echo wp_kses_post($conteudo); ?>
                                        </div>

                                        <?php if ($texto_botao && $url_botao): ?>
                                            <a href="<?php echo esc_url($url_botao); ?>"
                                                class="mt-8 inline-block rounded border border-purple-900 bg-purple-900 px-12 py-3 text-sm font-medium text-white hover:bg-transparent hover:text-purple-950 focus:outline-none focus:ring active:text-purple-950 transition-all ease-in-out">
                                                <?php echo esc_html($texto_botao); ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;

                case 'imagem_e_texto':
                    $titulo = get_sub_field('titulo');
                    $conteudo = get_sub_field('conteudo');
                    $imagem = get_sub_field('imagem');
                    ?>
                    <section class="imagem-e-texto py-16 bg-gray-50">
                        <div class="container mx-auto max-w-[85rem] px-6 flex flex-col md:flex-row items-center">
                            <div class="md:w-1/2 md:mr-10">
                                <?php if ($imagem): ?>
                                    <img src="<?php echo esc_url($imagem['url']); ?>" alt="<?php echo esc_attr($titulo); ?>" class="w-full">
                                <?php endif; ?>
                            </div>
                            <div class="md:w-1/2 mt-8 md:mt-0">
                                <h2 class="text-3xl font-bold text-purple-600"><?php echo esc_html($titulo); ?></h2>
                                <div class="mt-6 text-lg">
                                    <?php echo wp_kses_post($conteudo); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;

                case 'video_e_texto_esquerda_video':
                    $titulo = get_sub_field('titulo');
                    $conteudo = get_sub_field('conteudo');
                    $iframe_video = get_sub_field('iframe_do_video');
                    ?>
                    <section class="py-32">
                        <div class="container mx-auto max-w-[85rem] px-4">
                            <div class="grid items-center gap-8 lg:grid-cols-2">
                                <div class="flex flex-col items-center text-center lg:items-start lg:text-left">
                                    <h1 class="my-6 text-3xl font-bold lg:text-4xl text-purple-950">
                                        <?php echo esc_html($titulo); ?>
                                    </h1>
                                    <div class="mb-8 max-w-xl text-zinc-600 lg:text-lg prose">
                                        <?php echo wp_kses_post($conteudo); ?>
                                    </div>
                                </div>
                                <?php if ($iframe_video): ?>
                                    <div class="max-h-96 w-full rounded-md overflow-hidden">
                                        <?php
                                        // Sanitização do código do iframe
                                        $allowed_tags = array(
                                            'iframe' => array(
                                                'src' => array(),
                                                'width' => array(),
                                                'height' => array(),
                                                'frameborder' => array(),
                                                'allow' => array(),
                                                'allowfullscreen' => array(),
                                                'title' => array(),
                                            ),
                                        );
                                        echo wp_kses($iframe_video, $allowed_tags);
                                        ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;

                    case 'video_e_texto_video_no_topo':
                        $titulo = get_sub_field('titulo');
                        $conteudo = get_sub_field('conteudo');
                        $iframe_video = get_sub_field('iframe_do_video');
                        ?>
                        <section>
                          <div class="container mx-auto max-w-[85rem] px-4 py-16">
                          <div class="mb-16 flex flex-col items-center text-center">
                              <h1 class="mb-8 max-w-6xl text-3xl font-semibold leading-none tracking-tight text-gray-800 md:text-3xl">
                                <?php echo esc_html($titulo); ?>
                              </h1>
                              <div class="max-w-3xl prose prose-lg text-black">
                                <?php echo wp_kses_post($conteudo); ?>
                              </div>
                            </div>
                            <?php if ( $iframe_video ) : ?>
                              <div class="relative overflow-hidden w-full pb-[56.25%]"> <!-- 16:9 Aspect Ratio -->
                                <div class="absolute inset-0">
                                  <?php
                                  // Sanitização do código do iframe
                                  $allowed_tags = array(
                                    'iframe' => array(
                                      'src' => array(),
                                      'width' => array(),
                                      'height' => array(),
                                      'frameborder' => array(),
                                      'allow' => array(),
                                      'allowfullscreen' => array(),
                                      'title' => array(),
                                      'style' => array(),
                                      'loading' => array(),
                                    ),
                                  );
                                  echo wp_kses( $iframe_video, $allowed_tags );
                                  ?>
                                </div>
                              </div>
                            <?php endif; ?>
                          </div>
                        </section>
                        <?php
                        break;

                case 'depoimentos':
                    ?>
                    <?php if (have_rows('depoimentos', 'option')): ?>
                        <section class="bg-white mt-16">
                            <div class="mx-auto max-w-[85rem] px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
                                <h2 class="text-center text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                                    Confira alguns depoimentos de clientes
                                </h2>

                                <div class="mt-8">
                                    <div id="keen-slider" class="keen-slider">
                                        <?php while (have_rows('depoimentos', 'option')):
                                            the_row();
                                            $foto = get_sub_field('foto');
                                            $nome = get_sub_field('nome');
                                            $descricao = get_sub_field('descricao');
                                            ?>
                                            <div class="keen-slider__slide opacity-40 transition-opacity duration-500">
                                                <blockquote class="rounded-lg bg-gray-50 p-6 shadow-sm sm:p-8">
                                                    <div class="flex items-center gap-4">
                                                        <?php if ($foto): ?>
                                                            <img alt="<?php echo esc_attr($nome); ?>" src="<?php echo esc_url($foto['url']); ?>"
                                                                class="size-14 rounded-full object-cover" />
                                                        <?php endif; ?>

                                                        <div>
                                                            <p class="mt-0.5 text-lg font-medium text-gray-900"><?php echo esc_html($nome); ?></p>
                                                        </div>
                                                    </div>

                                                    <p class="mt-4 text-gray-700">
                                                        <?php echo esc_html($descricao); ?>
                                                    </p>
                                                </blockquote>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>

                                    <div class="mt-6 flex items-center justify-center gap-4">
                                        <button aria-label="Previous slide" id="keen-slider-previous"
                                            class="text-gray-600 transition-colors hover:text-gray-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                                            </svg>
                                        </button>

                                        <p class="w-16 text-center text-sm text-gray-700">
                                            <span id="keen-slider-active"></span>
                                            /
                                            <span id="keen-slider-count"></span>
                                        </p>

                                        <button aria-label="Next slide" id="keen-slider-next"
                                            class="text-gray-600 transition-colors hover:text-gray-900">
                                            <svg class="size-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    <?php endif; ?>
                    <?php
                    break;

                case 'tabela_de_precos':
                    $titulo = get_sub_field('titulo');
                    $descricao = get_sub_field('descricao');
                    ?>
                    <section id="precos" class="tabela-de-precos py-16 bg-gradient-to-b from-gray-100 to-gray-200">
                        <div class="mx-auto max-w-[85rem] px-4 py-8 sm:px-6 sm:py-12 lg:px-8">
                            <div class="text-center">
                                <h2 class="text-3xl font-bold text-purple-950"><?php echo esc_html($titulo); ?></h2>
                                <div class="mt-6 text-lg">
                                    <?php echo wp_kses_post($descricao); ?>
                                </div>
                            </div>
                            <div class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-3 sm:items-center md:gap-4">
                                <?php
                                if (have_rows('planos')):
                                    while (have_rows('planos')):
                                        the_row();
                                        $nome_plano = get_sub_field('nome_do_plano');
                                        $preco = get_sub_field('preco');
                                        $periodo = get_sub_field('periodo');
                                        $caracteristicas = get_sub_field('caracteristicas');
                                        $link = get_sub_field('link');
                                        $destaque = get_sub_field('destaque');

                                        // Classes CSS baseadas no destaque
                                        $border_class = $destaque ? 'border-purple-900' : 'border-gray-200';
                                        $bg_class = $destaque ? 'bg-purple-900' : 'bg-white';
                                        $text_class = $destaque ? 'text-gray-900' : 'text-gray-900';
                                        $ring_class = $destaque ? 'ring-1 ring-purple-900' : '';
                                        $button_class = $destaque ? 'bg-white text-purple hover:bg-gray-100' : 'bg-purple-900 text-white hover:bg-purple-950';
                                        $text_secondary_class = $destaque ? 'text-gray-700' : 'text-gray-700';
                                        ?>
                                        <div
                                            class="rounded border <?php echo $border_class; ?> p-6 shadow-sm <?php echo $ring_class; ?> sm:px-8 lg:p-12">
                                            <div class="text-center">
                                                <h2 class="text-lg font-medium <?php echo $text_class; ?>">
                                                    <?php echo esc_html($nome_plano); ?>
                                                    <span class="sr-only">Plano</span>
                                                </h2>
                                                <p class="mt-2 sm:mt-4">
                                                    <strong class="text-3xl font-bold <?php echo $text_class; ?> sm:text-4xl">
                                                        <?php echo esc_html($preco); ?> </strong>
                                                    <span
                                                        class="text-sm font-medium <?php echo $text_secondary_class; ?>"><?php echo esc_html($periodo); ?></span>
                                                </p>
                                            </div>

                                            <?php if ($caracteristicas): ?>
                                                <ul class="mt-6 space-y-2">
                                                    <?php foreach ($caracteristicas as $caracteristica):
                                                        $item = $caracteristica['item'];
                                                        ?>
                                                        <li class="flex items-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                                stroke="currentColor"
                                                                class="w-5 h-5 <?php echo $destaque ? 'text-purple-700' : 'text-purple-700'; ?>">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                            </svg>
                                                            <span class="<?php echo $text_secondary_class; ?>"> <?php echo esc_html($item); ?> </span>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>

                                            <?php if ($link): ?>
                                                <a href="<?php echo esc_url($link); ?>"
                                                    class="mt-8 block rounded border border-purple-950 px-12 py-3 text-center text-sm font-medium <?php echo $button_class; ?> hover:ring-1 hover:ring-purple-950 focus:outline-none focus:ring active:text-purple-950">
                                                    Contrate Agora
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                        <?php
                                    endwhile;
                                endif;
                                ?>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;

                case 'formulario_de_contato':
                    $titulo = get_sub_field('titulo');
                    $descricao = get_sub_field('descricao');
                    $shortcode = get_sub_field('shortcode_do_formulario');
                    ?>
                    <section id="contato" class="formulario-de-contato py-16">
                        <div class="container mx-auto max-w-[85rem] px-6">
                            <h2 class="text-4xl font-bold text-center text-purple-950"><?php echo esc_html($titulo); ?></h2>
                            <div class="mt-6 text-lg text-center">
                                <?php echo wp_kses_post($descricao); ?>
                            </div>
                            <div class="mt-10">
                                <?php echo do_shortcode($shortcode); ?>
                            </div>
                        </div>
                    </section>
                    <?php
                    break;
            }

        endwhile;
    endif;

endwhile; ?>

<?php
get_footer();
?>