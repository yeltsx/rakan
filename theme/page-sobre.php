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

<?php if( have_rows('timeline') ): ?>
<section class="timeline-section py-12">
    <div class="container mx-auto max-w-[85rem] px-6">
        <h2 class="text-3xl font-bold mb-8">Linha do Tempo</h2>
        <ol class="relative border-l border-gray-200 dark:border-gray-700">
            <?php while ( have_rows('timeline') ) : the_row(); 
                $data = get_sub_field('data');
                $titulo = get_sub_field('titulo');
                $descricao = get_sub_field('descricao');
                $botao = get_sub_field('botao'); 
            ?>
            <li class="mb-10 ml-6">
                <span class="absolute flex items-center justify-center w-8 h-8 bg-blue-200 rounded-full -left-4 ring-8 ring-white dark:ring-gray-900 dark:bg-blue-900">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 10h16M8 14h8m-4-7V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Z"/>
</svg>

                </span>
                <time class="block mb-2 text-sm font-normal leading-none text-gray-400 dark:text-gray-500"><?php echo esc_html($data); ?></time>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white"><?php echo esc_html($titulo); ?></h3>
                <div class="mb-4 prose dark:prose-dark">
                    <?php echo wp_kses_post($descricao); ?>
                </div>
                <?php if( $botao ): ?>
                <a href="<?php echo esc_url($botao['url']); ?>" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <?php echo esc_html($botao['title']); ?>
                </a>
                <?php endif; ?>
            </li>
            <?php endwhile; ?>
        </ol>
    </div>
</section>
<?php endif; ?>



<?php
get_footer();