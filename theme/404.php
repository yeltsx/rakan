<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package rakan
 */

get_header();
?>

<style>
	@import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);
</style>
<div class="min-w-screen min-h-screen bg-purple-900 flex items-center p-5 lg:p-20 overflow-hidden relative">
	<div
		class="flex-1 min-h-full min-w-full rounded-3xl bg-white shadow-xl p-10 lg:p-20 text-gray-800 relative md:flex items-center text-center md:text-left">
		<div class="w-full md:w-1/2">
			<div class="mb-10 md:mb-20 text-gray-600 font-light">
				<h1 class="font-black uppercase text-3xl lg:text-5xl text-purple-500 mb-10">Você parece estar perdido :(
				</h1>
				<p>A página que você procurou não foi encontrada.</p>
				<p class="mb-6">Tente usar nosso campo de busca ou volte para a tela inicial.</p>
				<?php get_search_form() ?>
			</div>
			<div class="mb-20 md:mb-0">
				<a href="<?php echo home_url() ?>"
					class="text-lg font-light outline-none focus:outline-none transform transition-all hover:scale-110 text-purple-500 hover:text-purple-600"><i
						class="mdi mdi-arrow-left mr-2"></i>Voltar para a tela inicial</a>
			</div>
		</div>
		<div class="w-full md:w-1/2 text-center">
			<script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
				type="module"></script>

			<dotlottie-player src="https://lottie.host/fac3aa79-a0e3-4a0d-9f12-328b9dd10e42/2iFKfrVyGc.json"
				background="transparent" speed="1" style="width: 100%; height: auto;" loop
				autoplay></dotlottie-player>
		</div>
	</div>
	<div
		class="w-64 md:w-96 h-96 md:h-full bg-blue-200 bg-opacity-30 absolute -top-64 md:-top-96 right-20 md:right-32 rounded-full pointer-events-none -rotate-45 transform">
	</div>
	<div
		class="w-96 h-full bg-purple-200 bg-opacity-20 absolute -bottom-96 right-64 rounded-full pointer-events-none -rotate-45 transform">
	</div>
</div>

<?php
get_footer();
