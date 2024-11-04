<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rakan
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="max-w-[85rem] px-4 py-2 sm:px-6 lg:px-8 lg:py-2 mx-auto relative">
		<div class="bg-cover bg-center text-center overflow-hidden"
			style="min-height: 500px; background-image: url('<?php echo get_the_post_thumbnail_url('', 'full'); ?>')"
			title="Woman holding a mug">
		</div>
		<div class="max-w-3xl mx-auto">
			<div
				class="mt-3 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
				<div class="bg-white relative top-0 -mt-32 p-5 sm:p-10">
					<?php the_title('<h1 class="entry-title text-center">', '</h1>'); ?>
					<div class="sm:w-4/12 flex items-center sm:px-6 pb-4">
						<img class="w-10 h-10 rounded-full mr-2"
							src="<?php echo get_avatar_url(get_the_author_meta('ID'), array('size' => 96)); ?>"
							alt="">
						<div>
							<p class="text-gray-900 font-medium leading-none pb-1"><?php the_author() ?></p>
							<p class="text-gray-600 text-xs"><?php the_date() ?></p>
						</div>
					</div>
					<div <?php rakan_content_class('entry-content'); ?>>
						<?php
						the_content(
							sprintf(
								wp_kses(
									/* translators: %s: Name of current post. Only visible to screen readers. */
									__('Continue reading<span class="sr-only"> "%s"</span>', 'rakan'),
									array(
										'span' => array(
											'class' => array(),
										),
									)
								),
								get_the_title()
							)
						);

						wp_link_pages(
							array(
								'before' => '<div>' . __('Pages:', 'rakan'),
								'after' => '</div>',
							)
						);
						?>
					</div><!-- .entry-content -->

					<?php // If comments are open, or we have at least one comment, load
					// the comment template.
					if (comments_open() || get_comments_number()) {
						comments_template();
					} ?>

				</div>

			</div>
		</div>
	</div>
</article>