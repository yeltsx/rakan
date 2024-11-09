<?php
/**
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package rakan
 */
get_header();
?>
<?php
$hero = get_field('hero');
if( $hero ): ?>
<section class="bg-purple-100">
  <div class="container relative py-24">
    <div class="mx-auto flex flex-wrap items-center 2xl:max-w-7xl">
      <div class="mb-16 flex flex-col items-start text-left md:mb-0 lg:w-1/2 lg:grow lg:pr-24">
        <span class="mb-8 text-xs font-bold uppercase tracking-widest text-blue-950">
            <?php echo $hero['subtitulo']; ?>
        </span>
        <h1 class="mb-8 text-4xl font-bold leading-none tracking-tighter text-gray-600 md:text-7xl lg:text-5xl">
            <?php echo $hero['titulo']; ?>
        </h1>
        <div class="prose prose-stone mb-4 text-left text-base leading-relaxed text-gray-700">
            <?php echo $hero['descricao']; ?>
        </div>
        <div class="mt-0 max-w-7xl sm:flex lg:mt-6">
          <div class="mt-3 rounded-lg sm:mt-0">
            <a
              class="block items-center rounded-xl bg-purple-600 px-10 py-4 text-center text-base font-medium text-white transition duration-500 ease-in-out hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2" href="#saibaMais">Saiba mais</a>
          </div>
          <div class="mt-3 rounded-lg sm:ml-3 sm:mt-0">
            <a
              class="flex items-center rounded-xl border border-gray-600 px-5 py-4 text-center font-medium text-gray-600 transition duration-500 ease-in-out hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 lg:px-8" href="<?php home_url() ?>/contato/">Entre em contato<svg width="24" height="24" viewBox="0 0 24 24" class="ml-1 size-6">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 12h14m-4 4l4-4m-4-4l4 4"></path>
              </svg></a>
          </div>
        </div>
      </div>
      <div class="mt-12 w-full rounded-xl lg:w-5/6 lg:max-w-lg xl:mt-0">
        <div>
          <div class="relative w-full max-w-lg">

            <div class="relative">
              <img class="mx-auto rounded-lg object-cover object-center" alt="hero"
                src="<?php echo esc_url( $hero['foto']['url'] ); ?>" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>



<?php
get_footer();