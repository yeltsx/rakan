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

<?php if (have_rows('depoimentos', 'option')) : ?>
    <section class="bg-white mt-16">
        <div class="mx-auto max-w-screen-xl px-4 py-6 sm:px-6 lg:px-8 lg:py-16">
            <h2 class="text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">
                Confira alguns depoimentos de clientes
            </h2>

            <div class="mt-8">
                <div id="keen-slider" class="keen-slider">
                    <?php while (have_rows('depoimentos', 'option')) : the_row(); 
                        $foto = get_sub_field('foto');
                        $nome = get_sub_field('nome');
                        $descricao = get_sub_field('descricao');
                    ?>
                        <div class="keen-slider__slide opacity-40 transition-opacity duration-500">
                            <blockquote class="rounded-lg bg-gray-50 p-6 shadow-sm sm:p-8">
                                <div class="flex items-center gap-4">
                                    <?php if ($foto) : ?>
                                        <img
                                            alt="<?php echo esc_attr($nome); ?>"
                                            src="<?php echo esc_url($foto['url']); ?>"
                                            class="size-14 rounded-full object-cover"
                                        />
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
                    <button
                        aria-label="Previous slide"
                        id="keen-slider-previous"
                        class="text-gray-600 transition-colors hover:text-gray-900"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="size-5"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                        </svg>
                    </button>

                    <p class="w-16 text-center text-sm text-gray-700">
                        <span id="keen-slider-active"></span>
                        /
                        <span id="keen-slider-count"></span>
                    </p>

                    <button
                        aria-label="Next slide"
                        id="keen-slider-next"
                        class="text-gray-600 transition-colors hover:text-gray-900"
                    >
                        <svg
                            class="size-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M9 5l7 7-7 7"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                            />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>