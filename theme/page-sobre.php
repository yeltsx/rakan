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
        <h1 class="mb-8 text-4xl font-bold leading-none tracking-tighter text-gray-600 md:text-7xl lg:text-5xl">
          Yeltsin Lima
        </h1>
        <div class="prose prose-stone prose-xl mb-4 text-left leading-relaxed text-gray-700">
            <?php echo $hero['descricao']; ?>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 mt-4">
          <a
              class="block items-center rounded bg-purple-900 px-8 py-4 text-center text-lg font-semibold text-white transition duration-300 ease-in-out hover:bg-purple-950 focus:outline-none focus:ring-4 focus:ring-purple-950 focus:ring-offset-2 shadow-md hover:shadow-lg" href="<?php home_url() ?>/solucoes/">Conheça minhas soluções</a>
          <a
              class="flex items-center rounded border-2 border-gray-700 px-8 py-4 text-center font-medium text-gray-700 transition duration-300 ease-in-out hover:bg-white focus:outline-none focus:ring-4 focus:ring-gray-500 focus:ring-offset-2 shadow-md hover:shadow-lg" href="<?php home_url() ?>/contato/">Entre em contato<svg width="24" height="24" viewBox="0 0 24 24" class="ml-2">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 12h14m-4 4l4-4m-4-4l4 4"></path>
              </svg></a>
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