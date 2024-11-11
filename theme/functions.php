<?php
/**
 * rakan functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package rakan
 */

if (!defined('RAKAN_VERSION')) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define('RAKAN_VERSION', '0.1.0');
}

if (!defined('RAKAN_TYPOGRAPHY_CLASSES')) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `rakan_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'RAKAN_TYPOGRAPHY_CLASSES',
		'prose prose-neutral max-w-none prose-a:text-primary'
	);
}

if (!function_exists('rakan_setup')):
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function rakan_setup()
	{
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on rakan, use a find and replace
		 * to change 'rakan' to the name of your theme in all the template files.
		 */
		load_theme_textdomain('rakan', get_template_directory() . '/languages');

		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __('Primary', 'rakan'),
				'menu-2' => __('Footer Menu', 'rakan'),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		// Add support for editor styles.
		add_theme_support('editor-styles');

		// Enqueue editor styles.
		add_editor_style('style-editor.css');
		add_editor_style('style-editor-extra.css');

		// Add support for responsive embedded content.
		add_theme_support('responsive-embeds');

		// Remove support for block templates.
		remove_theme_support('block-templates');
	}
endif;
add_action('after_setup_theme', 'rakan_setup');

function add_menu_link_class($atts, $item, $args)
{
	if (property_exists($args, 'link_class')) {
		$atts['class'] = $args->link_class;
	}
	return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

function add_menu_list_item_class($classes, $item, $args)
{
	if (property_exists($args, 'list_item_class')) {
		$classes[] = $args->list_item_class;
	}
	return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function rakan_widgets_init()
{
	register_sidebar(
		array(
			'name' => __('Footer', 'rakan'),
			'id' => 'sidebar-1',
			'description' => __('Add widgets here to appear in your footer.', 'rakan'),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h2 class="widget-title">',
			'after_title' => '</h2>',
		)
	);
}
add_action('widgets_init', 'rakan_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function rakan_scripts()
{
	wp_enqueue_style('rakan-style', get_stylesheet_uri(), array(), RAKAN_VERSION);
	wp_enqueue_script('rakan-script', get_template_directory_uri() . '/js/script.min.js', array(), RAKAN_VERSION, true);
	wp_enqueue_script('preline-ui', get_template_directory_uri() . '/js/preline.js', array(), RAKAN_VERSION, true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts', 'rakan_scripts');

/**
 * Enqueue the block editor script.
 */
function rakan_enqueue_block_editor_script()
{
	if (is_admin()) {
		wp_enqueue_script(
			'rakan-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			RAKAN_VERSION,
			true
		);
		wp_add_inline_script('rakan-editor', "tailwindTypographyClasses = '" . esc_attr(RAKAN_TYPOGRAPHY_CLASSES) . "'.split(' ');", 'before');
	}
}
add_action('enqueue_block_assets', 'rakan_enqueue_block_editor_script');

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function rakan_tinymce_add_class($settings)
{
	$settings['body_class'] = RAKAN_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter('tiny_mce_before_init', 'rakan_tinymce_add_class');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

// Register Custom Post Type Startups
function register_startups_cpt()
{
	$labels = array(
		'name' => 'Startups',
		'singular_name' => 'Startup',
		'menu_name' => 'Startups',
		'name_admin_bar' => 'Startup'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'has_archive' => true,
		'supports' => array('title', 'editor', 'thumbnail'),
		'show_in_rest' => true,
		'taxonomies' => array('area_atuacao')
	);

	register_post_type('startups', $args);
}
add_action('init', 'register_startups_cpt');

// Register Custom Taxonomy for Area of Expertise
function register_area_atuacao_taxonomy()
{
	$labels = array(
		'name' => 'Areas de Atuação',
		'singular_name' => 'Area de Atuação'
	);

	$args = array(
		'labels' => $labels,
		'public' => true,
		'hierarchical' => true,
		'show_in_rest' => true
	);

	register_taxonomy('area_atuacao', 'startups', $args);
}
add_action('init', 'register_area_atuacao_taxonomy');

// Add ACF Fields for Page Content
if (function_exists('acf_add_local_field_group')) {
	acf_add_local_field_group(array(
		'key' => 'group_about_page_fields',
		'title' => 'Sobre Page Fields',
		'fields' => array(
			array(
				'key' => 'field_hero_description',
				'label' => 'Hero Description',
				'name' => 'hero_description',
				'type' => 'textarea'
			),
			array(
				'key' => 'field_professional_academic_experience',
				'label' => 'Professional and Academic Experience',
				'name' => 'professional_academic_experience',
				'type' => 'wysiwyg'
			),
			array(
				'key' => 'field_blog_theme',
				'label' => 'Blog/Site Theme',
				'name' => 'blog_theme',
				'type' => 'textarea'
			),
			array(
				'key' => 'field_startups_description',
				'label' => 'Startups Description',
				'name' => 'startups_description',
				'type' => 'textarea'
			)
		),
		'location' => array(
			array(
				array(
					'param' => 'page',
					'operator' => '==',
					'value' => 'about'
				)
			)
		)
	));

	// Add ACF Field for Link in Startups CPT
	acf_add_local_field_group(array(
		'key' => 'group_startup_link',
		'title' => 'Startup Fields',
		'fields' => array(
			array(
				'key' => 'field_startup_link',
				'label' => 'Link',
				'name' => 'link',
				'type' => 'url'
			)
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'startups'
				)
			)
		)
	));
}

function custom_alert_shortcode($atts)
{
	$atts = shortcode_atts(
		array(
			'tipo' => 'info',
			'titulo' => '',
			'mensagem' => '',
		),
		$atts,
		'alerta'
	);

	$output = '';

	switch ($atts['tipo']) {
		case 'sucesso':
			$output = '<div class="relative w-full rounded-lg border border-transparent bg-blue-600 p-4 [&>svg]:absolute [&>svg]:text-foreground [&>svg]:left-4 [&>svg]:top-4 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-11 text-white">'
				. '<svg class="w-5 h-5 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" /></svg>'
				. '<h5 class="mb-1 font-medium leading-none tracking-tight">' . esc_html($atts['titulo']) . '</h5>'
				. '<div class="text-sm opacity-80">' . esc_html($atts['mensagem']) . '</div>'
				. '</div>';
			break;

		case 'alerta':
			$output = '<div class="relative w-full rounded-lg border border-transparent bg-red-600 p-4 [&>svg]:absolute [&>svg]:text-foreground [&>svg]:left-4 [&>svg]:top-4 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-11 text-white">'
				. '<svg class="w-5 h-5 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" /></svg>'
				. '<h5 class="mb-1 font-medium leading-none tracking-tight">' . esc_html($atts['titulo']) . '</h5>'
				. '<div class="text-sm opacity-80">' . esc_html($atts['mensagem']) . '</div>'
				. '</div>';
			break;

		case 'info':
		default:
			$output = '<div class="relative w-full rounded-lg border border-transparent bg-yellow-500 p-4 [&>svg]:absolute [&>svg]:text-foreground [&>svg]:left-4 [&>svg]:top-4 [&>svg+div]:translate-y-[-3px] [&:has(svg)]:pl-11 text-white">'
				. '<svg class="w-5 h-5 -translate-y-0.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M12 18a9 9 0 100-18 9 9 0 000 18z" /></svg>'
				. '<h5 class="mb-1 font-medium leading-none tracking-tight">' . esc_html($atts['titulo']) . '</h5>'
				. '<div class="text-sm opacity-80">' . esc_html($atts['mensagem']) . '</div>'
				. '</div>';
			break;
	}

	return $output;
}
add_shortcode('alerta', 'custom_alert_shortcode');

function testimonials_shortcode()
{
	ob_start();
	get_template_part('template-parts/layout/testimonials', '');
	return ob_get_clean();
}
add_shortcode('depoimentos', 'testimonials_shortcode');

add_action('acf/include_fields', function () {
	if (!function_exists('acf_add_local_field_group')) {
		return;
	}

	acf_add_local_field_group(array(
		'key' => 'group_6723e2fd0824d',
		'title' => 'Home',
		'fields' => array(
			array(
				'key' => 'field_6723e2fd77319',
				'label' => 'Hero',
				'name' => 'hero',
				'aria-label' => '',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'acfe_seamless_style' => 0,
				'acfe_group_modal' => 0,
				'sub_fields' => array(
					array(
						'key' => 'field_6723e30b7731a',
						'label' => 'Título',
						'name' => 'titulo',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_6723e3167731b',
						'label' => 'Descrição',
						'name' => 'descricao',
						'aria-label' => '',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'acfe_textarea_code' => 0,
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'rows' => '',
						'placeholder' => '',
						'new_lines' => '',
					),
					array(
						'key' => 'field_6723e31d7731c',
						'label' => 'Imagem',
						'name' => 'imagem',
						'aria-label' => '',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'uploader' => '',
						'return_format' => 'array',
						'library' => 'all',
						'acfe_thumbnail' => 0,
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
						'allow_in_bindings' => 0,
						'preview_size' => 'medium',
					),
				),
				'acfe_group_modal_close' => 0,
				'acfe_group_modal_button' => '',
				'acfe_group_modal_size' => 'large',
			),
			array(
				'key' => 'field_6723e3c97d219',
				'label' => 'Funcionalidades',
				'name' => 'funcionalidades',
				'aria-label' => '',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'acfe_seamless_style' => 0,
				'acfe_group_modal' => 0,
				'sub_fields' => array(
					array(
						'key' => 'field_6723e3d47d21a',
						'label' => 'Título',
						'name' => 'titulo',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_6723e3de7d21b',
						'label' => 'Descrição',
						'name' => 'descricao',
						'aria-label' => '',
						'type' => 'textarea',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'acfe_textarea_code' => 0,
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'rows' => '',
						'placeholder' => '',
						'new_lines' => '',
					),
					array(
						'key' => 'field_6723e3e97d21c',
						'label' => 'Soluções',
						'name' => 'solucoes',
						'aria-label' => '',
						'type' => 'repeater',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'acfe_repeater_stylised_button' => 0,
						'layout' => 'table',
						'pagination' => 0,
						'min' => 0,
						'max' => 0,
						'collapsed' => '',
						'button_label' => 'Adicionar linha',
						'rows_per_page' => 20,
						'sub_fields' => array(
							array(
								'key' => 'field_6723e4037d21d',
								'label' => 'SVG',
								'name' => 'svg',
								'aria-label' => '',
								'type' => 'textarea',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'acfe_textarea_code' => 0,
								'maxlength' => '',
								'allow_in_bindings' => 0,
								'rows' => '',
								'placeholder' => '',
								'new_lines' => '',
								'parent_repeater' => 'field_6723e3e97d21c',
							),
							array(
								'key' => 'field_6723e40c7d21e',
								'label' => 'Título',
								'name' => 'titulo',
								'aria-label' => '',
								'type' => 'text',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'maxlength' => '',
								'allow_in_bindings' => 0,
								'placeholder' => '',
								'prepend' => '',
								'append' => '',
								'parent_repeater' => 'field_6723e3e97d21c',
							),
							array(
								'key' => 'field_6723e4117d21f',
								'label' => 'Descrição',
								'name' => 'descricao',
								'aria-label' => '',
								'type' => 'textarea',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'acfe_textarea_code' => 0,
								'maxlength' => '',
								'allow_in_bindings' => 0,
								'rows' => '',
								'placeholder' => '',
								'new_lines' => '',
								'parent_repeater' => 'field_6723e3e97d21c',
							),
							array(
								'key' => 'field_6723e4177d220',
								'label' => 'Link',
								'name' => 'link',
								'aria-label' => '',
								'type' => 'url',
								'instructions' => '',
								'required' => 0,
								'conditional_logic' => 0,
								'wrapper' => array(
									'width' => '',
									'class' => '',
									'id' => '',
								),
								'default_value' => '',
								'allow_in_bindings' => 1,
								'placeholder' => '',
								'parent_repeater' => 'field_6723e3e97d21c',
							),
						),
					),
					array(
						'key' => 'field_6723e458dbeaf',
						'label' => 'CTA',
						'name' => 'cta',
						'aria-label' => '',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'allow_in_bindings' => 1,
					),
				),
				'acfe_group_modal_close' => 0,
				'acfe_group_modal_button' => '',
				'acfe_group_modal_size' => 'large',
			),
			array(
				'key' => 'field_6723f7b00ec7e',
				'label' => 'Destaques',
				'name' => 'destaques',
				'aria-label' => '',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'acfe_seamless_style' => 0,
				'acfe_group_modal' => 0,
				'sub_fields' => array(
					array(
						'key' => 'field_6723f7bb0ec7f',
						'label' => 'Título',
						'name' => 'titulo',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_6723f7c30ec80',
						'label' => 'Descrição',
						'name' => 'descricao',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_6723f7cd0ec81',
						'label' => 'Posts',
						'name' => 'featured_posts',
						'aria-label' => '',
						'type' => 'relationship',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'post_type' => '',
						'post_status' => '',
						'taxonomy' => '',
						'filters' => array(
							0 => 'search',
							1 => 'post_type',
							2 => 'taxonomy',
						),
						'return_format' => 'object',
						'min' => '',
						'max' => 2,
						'allow_in_bindings' => 1,
						'elements' => '',
						'bidirectional' => 0,
						'bidirectional_target' => array(
						),
					),
					array(
						'key' => 'field_6723f7ef0ec83',
						'label' => 'Texto Destaque',
						'name' => 'texto_destaque',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_6723f8080ec84',
						'label' => 'Link Destaque',
						'name' => 'link_destaque',
						'aria-label' => '',
						'type' => 'link',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'allow_in_bindings' => 0,
					),
				),
				'acfe_group_modal_close' => 0,
				'acfe_group_modal_button' => '',
				'acfe_group_modal_size' => 'large',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page_type',
					'operator' => '==',
					'value' => 'front_page',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'label_placement' => 'left',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(
			0 => 'permalink',
			1 => 'the_content',
			2 => 'excerpt',
			3 => 'discussion',
			4 => 'comments',
			5 => 'revisions',
			6 => 'slug',
			7 => 'author',
			8 => 'format',
			9 => 'page_attributes',
			10 => 'featured_image',
			11 => 'categories',
			12 => 'tags',
			13 => 'send-trackbacks',
		),
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));

	acf_add_local_field_group(array(
		'key' => 'group_673118cc0f703',
		'title' => 'Opções',
		'fields' => array(
			array(
				'key' => 'field_673118cc3ba23',
				'label' => 'Depoimentos',
				'name' => 'depoimentos',
				'aria-label' => '',
				'type' => 'repeater',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'table',
				'pagination' => 0,
				'min' => 0,
				'max' => 0,
				'collapsed' => '',
				'button_label' => 'Adicionar linha',
				'rows_per_page' => 20,
				'sub_fields' => array(
					array(
						'key' => 'field_673118df3ba24',
						'label' => 'Foto',
						'name' => 'foto',
						'aria-label' => '',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
						'allow_in_bindings' => 0,
						'preview_size' => 'medium',
						'parent_repeater' => 'field_673118cc3ba23',
					),
					array(
						'key' => 'field_673118e63ba25',
						'label' => 'Nome',
						'name' => 'nome',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_673118cc3ba23',
					),
					array(
						'key' => 'field_673118f33ba26',
						'label' => 'Descrição',
						'name' => 'descricao',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'parent_repeater' => 'field_673118cc3ba23',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'opcoes',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));

	acf_add_local_field_group(array(
		'key' => 'group_672b68d0d292c',
		'title' => 'Sobre',
		'fields' => array(
			array(
				'key' => 'field_672b68d2b827a',
				'label' => 'Hero',
				'name' => 'hero',
				'aria-label' => '',
				'type' => 'group',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'layout' => 'block',
				'sub_fields' => array(
					array(
						'key' => 'field_672b68e4b827b',
						'label' => 'Subtitulo',
						'name' => 'subtitulo',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_672b68eab827c',
						'label' => 'Titulo',
						'name' => 'titulo',
						'aria-label' => '',
						'type' => 'text',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'maxlength' => '',
						'allow_in_bindings' => 0,
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array(
						'key' => 'field_672b68efb827d',
						'label' => 'Descrição',
						'name' => 'descricao',
						'aria-label' => '',
						'type' => 'wysiwyg',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'default_value' => '',
						'allow_in_bindings' => 1,
						'tabs' => 'all',
						'toolbar' => 'full',
						'media_upload' => 1,
						'delay' => 0,
					),
					array(
						'key' => 'field_672b6904b827e',
						'label' => 'Foto',
						'name' => 'foto',
						'aria-label' => '',
						'type' => 'image',
						'instructions' => '',
						'required' => 0,
						'conditional_logic' => 0,
						'wrapper' => array(
							'width' => '',
							'class' => '',
							'id' => '',
						),
						'return_format' => 'array',
						'library' => 'all',
						'min_width' => '',
						'min_height' => '',
						'min_size' => '',
						'max_width' => '',
						'max_height' => '',
						'max_size' => '',
						'mime_types' => '',
						'allow_in_bindings' => 0,
						'preview_size' => 'medium',
					),
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'page',
					'operator' => '==',
					'value' => '204',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	));
});

// Registrar os Campos do Anúncio
if (function_exists('acf_add_local_field_group')):

	acf_add_local_field_group(array(
		'key' => 'group_anuncio',
		'title' => 'Anúncio',
		'fields' => array(
			array(
				'key' => 'field_habilitar_anuncio',
				'label' => 'Habilitar Anúncio',
				'name' => 'habilitar_anuncio',
				'type' => 'true_false',
				'instructions' => 'Marque para exibir o anúncio no header.',
				'default_value' => 0,
				'ui' => 1,
			),
			array(
				'key' => 'field_titulo_anuncio',
				'label' => 'Título do Anúncio',
				'name' => 'titulo_anuncio',
				'type' => 'text',
				'placeholder' => 'Insira o título do anúncio',
			),
			array(
				'key' => 'field_subtitulo_anuncio',
				'label' => 'Subtítulo do Anúncio',
				'name' => 'subtitulo_anuncio',
				'type' => 'text',
				'placeholder' => 'Insira o subtítulo do anúncio',
			),
			array(
				'key' => 'field_texto_botao',
				'label' => 'Texto do Botão',
				'name' => 'texto_botao',
				'type' => 'text',
				'default_value' => 'Learn More',
				'placeholder' => 'Insira o texto do botão',
			),
			array(
				'key' => 'field_link_botao',
				'label' => 'Link do Botão',
				'name' => 'link_botao',
				'type' => 'url',
				'placeholder' => 'https://',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'opcoes', // Certifique-se de que este é o slug correto
				),
			),
		),
		'menu_order' => 0,
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
	));

endif;

// Função para adicionar ao functions.php do seu tema WordPress
function custom_stock_info_display($content) {
    if (is_single() && in_the_loop() && is_main_query() && has_tag('ações')) {
        global $post;

        // Verificar se já existe um meta para armazenar os dados da API e a data da última atualização
        $cached_data = get_post_meta($post->ID, '_stock_api_data', true);
        $last_updated = get_post_meta($post->ID, '_stock_api_last_updated', true);
        $current_time = current_time('timestamp');

        // Atualizar os dados se não existir ou se a última atualização foi há mais de um dia
        if (!$cached_data || ($last_updated && ($current_time - $last_updated) > DAY_IN_SECONDS)) {
            // Pegando o conteúdo do post
            $post_content = strtolower($content);

            // URL da lista de ações disponíveis
            $api_url = 'https://brapi.dev/api/available';
            
            // Fazendo a requisição para obter as ações disponíveis
            $response = wp_remote_get($api_url);
            
            if (is_wp_error($response)) {
                return $content; // Retornar o conteúdo original se ocorrer um erro
            }

            $body = wp_remote_retrieve_body($response);
            $data = json_decode($body, true);
            $stocks = $data['stocks'] ?? [];
            
            // Verificar quais ações estão mencionadas no post
            $mentioned_stocks = [];
            foreach ($stocks as $stock) {
                if (strpos($post_content, strtolower($stock)) !== false) {
                    $mentioned_stocks[] = $stock;
                }
            }

            $cached_data = [];

            // Para cada ação mencionada, buscar dados adicionais
            foreach ($mentioned_stocks as $stock) {
                $quote_url = "https://brapi.dev/api/quote/{$stock}?range=1d&interval=1d&fundamental=true&modules=summaryProfile&token=nXqUR2kcFhfAC5Cn6To97d";
                $quote_response = wp_remote_get($quote_url);

                if (is_wp_error($quote_response)) {
                    continue; // Pular esta ação se ocorrer um erro
                }

                $quote_body = wp_remote_retrieve_body($quote_response);
                $quote_data = json_decode($quote_body, true);

                if (isset($quote_data['results'][0])) {
                    $cached_data[] = $quote_data['results'][0];
                }
            }

            // Armazenar os dados em um meta do post para evitar novas requisições
            update_post_meta($post->ID, '_stock_api_data', $cached_data);
            update_post_meta($post->ID, '_stock_api_last_updated', $current_time);
        }

        // Gerar o conteúdo a partir dos dados armazenados
        foreach ($cached_data as $quote) {
            $longName = $quote['longName'] ?? '';
            $symbol = $quote['symbol'] ?? '';
            $industry = $quote['summaryProfile']['industry'] ?? '';
            $website = $quote['summaryProfile']['website'] ?? '';
            $regularMarketPreviousClose = $quote['regularMarketPreviousClose'] ?? '';
            $logourl = $quote['logourl'] ?? '';
            $last_updated_date = date_i18n(get_option('date_format'), $last_updated);

            // Criando a tabela com Tailwind
            $table = "<div class='my-8 p-4 border rounded-lg bg-gray-50'>";
            $table .= "<table class='w-full text-left'>";
            $table .= "<thead><tr><th colspan='2' class='text-lg font-bold text-gray-800'>{$longName} ({$symbol})</th></tr></thead>";
            $table .= "<tbody>";
            $table .= "<tr><td colspan='2' class='text-center'><img src='{$logourl}' alt='Logo de {$longName}' class='mx-auto' style='max-width: 128px; max-height: 128px;'></td></tr>";
            $table .= "<tr><td class='font-semibold'>Valor do Último Fechamento</td><td>R$ {$regularMarketPreviousClose} <span class='text-sm text-gray-500'>(Última atualização: {$last_updated_date})</span></td></tr>";
            $table .= "<tr><td class='font-semibold'>Empresa</td><td>{$longName} ({$symbol})</td></tr>";
            $table .= "<tr><td class='font-semibold'>Indústria</td><td>{$industry}</td></tr>";
            $table .= "<tr><td class='font-semibold'>Website</td><td><a href='{$website}' target='_blank' class='text-purple-500 hover:underline'>{$website}</a></td></tr>";
            $table .= "</tbody></table></div>";

            // Adicionar a tabela ao conteúdo do post
            $content .= $table;
        }
    }

    return $content;
}
add_filter('the_content', 'custom_stock_info_display');

