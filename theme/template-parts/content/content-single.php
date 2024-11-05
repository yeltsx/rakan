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
							src="<?php echo get_avatar_url(get_the_author_meta('ID'), array('size' => 96)); ?>" alt="">
						<div>
							<p class="text-gray-900 font-medium leading-none pb-1"><?php the_author() ?></p>
							<p class="text-gray-600 text-xs"><?php the_date() ?></p>
						</div>
					</div>
					<div <?php rakan_content_class('entry-content'); ?>>

						<?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>

						<p class="text-purple-900"><strong>Compartilhar</strong></p>
						<div class="sharing-buttons flex flex-wrap">
							<a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-3 rounded-full text-white border-purple-600 bg-purple-600 hover:bg-purple-700 hover:border-purple-700"
								target="_blank" rel="noopener" href="https://facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"
								aria-label="Share on Facebook">
								<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 512 512" class="w-6 h-6">
									<title>Facebook</title>
									<path
										d="M379 22v75h-44c-36 0-42 17-42 41v54h84l-12 85h-72v217h-88V277h-72v-85h72v-62c0-72 45-112 109-112 31 0 58 3 65 4z">
									</path>
								</svg>
							</a>
							<a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-3 rounded-full text-white border-purple-600 bg-purple-600 hover:bg-purple-700 hover:border-purple-700"
								target="_blank" rel="noopener"
								href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>"
								aria-label="Share on Twitter">
								<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 512 512" class="w-6 h-6">
									<title>Twitter</title>
									<path
										d="m459 152 1 13c0 139-106 299-299 299-59 0-115-17-161-47a217 217 0 0 0 156-44c-47-1-85-31-98-72l19 1c10 0 19-1 28-3-48-10-84-52-84-103v-2c14 8 30 13 47 14A105 105 0 0 1 36 67c51 64 129 106 216 110-2-8-2-16-2-24a105 105 0 0 1 181-72c24-4 47-13 67-25-8 24-25 45-46 58 21-3 41-8 60-17-14 21-32 40-53 55z">
									</path>
								</svg>
							</a>
							<a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-3 rounded-full text-white border-purple-600 bg-purple-600 hover:bg-purple-700 hover:border-purple-700"
								target="_blank" rel="noopener"
								href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>&amp;title=<?php the_title(); ?>&amp;summary=<?php the_title(); ?>&amp;source=<?php the_permalink(); ?>"
								aria-label="Share on Linkedin">
								<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 512 512" class="w-6 h-6">
									<title>Linkedin</title>
									<path
										d="M136 183v283H42V183h94zm6-88c1 27-20 49-53 49-32 0-52-22-52-49 0-28 21-49 53-49s52 21 52 49zm333 208v163h-94V314c0-38-13-64-47-64-26 0-42 18-49 35-2 6-3 14-3 23v158h-94V183h94v41c12-20 34-48 85-48 62 0 108 41 108 127z">
									</path>
								</svg>
							</a>
							<a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-3 rounded-full text-white border-purple-600 bg-purple-600 hover:bg-purple-700 hover:border-purple-700"
								target="_blank" rel="noopener"
								href="https://reddit.com/submit/?url=<?php the_permalink(); ?>&amp;resubmit=true&amp;title=<?php the_title(); ?>"
								aria-label="Share on Reddit" draggable="false">
								<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 512 512" class="w-6 h-6">
									<title>Reddit</title>
									<path
										d="M440 204c-15 0-28 6-38 15-35-24-83-40-137-42l28-125 88 20c0 22 18 39 39 39 22 0 40-18 40-39s-17-40-40-40c-15 0-28 9-35 22l-97-22c-5-1-10 3-11 7l-31 138c-53 2-100 18-136 43a53 53 0 0 0-38-16c-56 0-74 74-23 100l-3 24c0 84 95 152 210 152 117 0 211-68 211-152 0-8-1-17-3-25 50-25 32-99-24-99zM129 309a40 40 0 1 1 80 0 40 40 0 0 1-80 0zm215 93c-37 37-139 37-176 0-4-3-4-9 0-13s10-4 13 0c28 28 120 29 149 0 4-4 10-4 14 0s4 10 0 13zm-1-54c-22 0-39-17-39-39a39 39 0 1 1 39 39z">
									</path>
								</svg>
							</a>
							<a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-3 rounded-full text-white border-purple-600 bg-purple-600 hover:bg-purple-700 hover:border-purple-700"
								target="_blank" rel="noopener" href="https://wa.me/?text=<?php the_title(); ?>%20<?php the_permalink(); ?>"
								aria-label="Share on Whatsapp" draggable="false">
								<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 512 512" class="w-6 h-6">
									<title>Whatsapp</title>
									<path
										d="M413 97A222 222 0 0 0 64 365L31 480l118-31a224 224 0 0 0 330-195c0-59-25-115-67-157zM256 439c-33 0-66-9-94-26l-7-4-70 18 19-68-4-7a185 185 0 0 1 287-229c34 36 56 82 55 131 1 102-84 185-186 185zm101-138c-5-3-33-17-38-18-5-2-9-3-12 2l-18 22c-3 4-6 4-12 2-32-17-54-30-75-66-6-10 5-10 16-31 2-4 1-7-1-10l-17-41c-4-10-9-9-12-9h-11c-4 0-9 1-15 7-5 5-19 19-19 46s20 54 23 57c2 4 39 60 94 84 36 15 49 17 67 14 11-2 33-14 37-27s5-24 4-26c-2-2-5-4-11-6z">
									</path>
								</svg>
							</a>
							<a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-3 rounded-full text-white border-purple-600 bg-purple-600 hover:bg-purple-700 hover:border-purple-700"
								target="_blank" rel="noopener" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_permalink(); ?>"
								aria-label="Share by Email" draggable="false">
								<svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 512 512" class="w-6 h-6">
									<title>Email</title>
									<path
										d="M464 64a48 48 0 0 1 29 86L275 314c-11 8-27 8-38 0L19 150a48 48 0 0 1 29-86h416zM218 339c22 17 54 17 76 0l218-163v208c0 35-29 64-64 64H64c-35 0-64-29-64-64V176l218 163z">
									</path>
								</svg>
							</a>
						</div>

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