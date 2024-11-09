<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package rakan
 */

get_header();
?>

<?php
// Start the main query for the first post
$first_post_query = new WP_Query(
    array(
        'posts_per_page' => 1,
    )
);

if ($first_post_query->have_posts()):
    while ($first_post_query->have_posts()):
        $first_post_query->the_post(); ?>

        <section class="bg-purple-100 dark:bg-gray-900">
            <div class="container px-6 py-10 mx-auto max-w-[85rem]">
                <div class="lg:flex lg:-mx-6">
                    <div class="lg:w-3/4 lg:px-6">
                        <a href="<?php the_permalink(); ?>"><img class="object-cover object-center w-full h-80 xl:h-[28rem] rounded-xl"
                            src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></a>

                        <div>
                            <p class="mt-6 text-sm text-purple-950 uppercase"><?php echo get_the_category_list(', '); ?></p>

                            <h1 class="max-w-lg mt-4 text-2xl font-semibold leading-tight text-gray-800 dark:text-white">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h1>

                            <div class="flex items-center mt-6">
                                <img class="object-cover object-center w-10 h-10 rounded-full"
                                    src="<?php echo get_avatar_url(get_the_author_meta('ID')); ?>" alt="<?php the_author(); ?>">

                                <div class="mx-4">
                                    <p class="text-sm text-gray-700 dark:text-gray-200"><?php the_author(); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endwhile;
endif;
wp_reset_postdata();

// Start the secondary query for the remaining posts, offset by 1
$secondary_posts_query = new WP_Query(
    array(
        'posts_per_page' => 6, // Adjust the number of posts as needed
        'offset' => 1,
    )
);

if ($secondary_posts_query->have_posts()): ?>

                <div class="mt-8 lg:w-1/4 lg:mt-0 lg:px-6">
                    <?php while ($secondary_posts_query->have_posts()):
                        $secondary_posts_query->the_post(); ?>
                        <div>
                            <h3 class="text-purple-950 capitalize"><?php echo get_the_category_list(', '); ?></h3>
                            <a href="<?php the_permalink(); ?>"
                                class="block mt-2 font-medium text-gray-700 hover:underline hover:text-gray-500 dark:text-gray-400 ">
                                <?php the_title(); ?>
                            </a>
                        </div>
                        <hr class="my-6 border-gray-200 dark:border-gray-700">
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif;
wp_reset_postdata();
?>

<?php
// Start the secondary query for the remaining posts, offset by 7
$secondary_posts_query = new WP_Query(
    array(
        'posts_per_page' => 10, // Display 10 posts per page
        'offset' => 7,
    )
);

if ($secondary_posts_query->have_posts()) : ?>
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto max-w-[85rem]">
            <div class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-2" id="post-container">
                <?php while ($secondary_posts_query->have_posts()) : $secondary_posts_query->the_post(); ?>
                    <div class="post-item">
                        <img class="relative z-10 object-cover w-full rounded-md h-96" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

                        <div class="relative z-20 max-w-lg p-6 mx-auto -mt-20 bg-white rounded-md shadow dark:bg-gray-900">
                            <a href="<?php the_permalink(); ?>" class="font-semibold text-gray-800 hover:underline dark:text-white md:text-xl">
                                <?php the_title(); ?>
                            </a>

                            <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                                <?php echo wp_trim_words(get_the_content(), 20); ?>
                            </p>

                            <p class="mt-3 text-sm text-purple-500"><?php echo get_the_date(); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="text-center mt-8">
                <button id="load-more" class="px-4 py-2 font-semibold text-white bg-purple-500 rounded hover:bg-purple-600">Load More</button>
            </div>
        </div>
    </section>

    <script type="text/javascript">
        (function($) {
            var ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
            var page = 1;
            var offset = 7;

            $('#load-more').on('click', function() {
                page++;
                $.ajax({
                    url: ajaxUrl,
                    type: 'post',
                    data: {
                        action: 'load_more_posts',
                        page: page,
                        offset: offset,
                    },
                    success: function(response) {
                        if (response) {
                            $('#post-container').append(response);
                        } else {
                            $('#load-more').hide();
                        }
                    }
                });
            });
        })(jQuery);
    </script>
<?php endif;
wp_reset_postdata();

// Function to handle AJAX request for loading more posts
function load_more_posts() {
    $page = isset($_POST['page']) ? $_POST['page'] : 1;
    $offset = isset($_POST['offset']) ? $_POST['offset'] : 0;
    $args = array(
        'posts_per_page' => 10,
        'paged' => $page,
        'offset' => $offset,
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
            <div class="post-item">
                <img class="relative z-10 object-cover w-full rounded-md h-96" src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">

                <div class="relative z-20 max-w-lg p-6 mx-auto -mt-20 bg-white rounded-md shadow dark:bg-gray-900">
                    <a href="<?php the_permalink(); ?>" class="font-semibold text-gray-800 hover:underline dark:text-white md:text-xl">
                        <?php the_title(); ?>
                    </a>

                    <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                        <?php echo wp_trim_words(get_the_content(), 20); ?>
                    </p>

                    <p class="mt-3 text-sm text-purple-500"><?php echo get_the_date(); ?></p>
                </div>
            </div>
        <?php endwhile;
    endif;
    wp_die();
}
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');
?>

<section class="bg-white dark:bg-gray-900">
    <div class="container px-4 py-16 mx-auto lg:flex lg:items-center lg:justify-between max-w-[85rem]">
        <h2 class="text-2xl font-semibold tracking-tight text-gray-800 xl:text-3xl dark:text-white">
            Join us and get the update from anywhere
        </h2>

        <div class="mt-8 lg:mt-0">
            <div class="flex flex-col sm:space-y-0 sm:flex-row">
                <iframe src="https://embeds.beehiiv.com/b7697ebc-a633-4d63-be26-39c84d931a2d?slim=true"
                    data-test-id="beehiiv-embed" height="68"
                    class="flex flex-col items-center sm:flex-row bg-white rounded-lg p-2 dark:bg-neutral-900"
                    width="400" frameborder="0" scrolling="no"></iframe>
            </div>

            <p class="text-sm text-gray-500 dark:text-gray-300 text-right">Sem SPAM, desinscreva-se a qualquer momento.
            </p>
        </div>
    </div>
</section>

<?php
get_footer();
