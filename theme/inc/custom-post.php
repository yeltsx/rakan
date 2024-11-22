<?php

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

function criar_cpt_solucoes()
{
	$labels = array(
		'name' => 'Soluções',
		'singular_name' => 'Solução',
		'menu_name' => 'Soluções',
		'name_admin_bar' => 'Solução',
		'add_new' => 'Adicionar Nova',
		'add_new_item' => 'Adicionar Nova Solução',
		'new_item' => 'Nova Solução',
		'edit_item' => 'Editar Solução',
		'view_item' => 'Ver Solução',
		'all_items' => 'Todas as Soluções',
		'search_items' => 'Procurar Soluções',
		'not_found' => 'Nenhuma solução encontrada.',
		'not_found_in_trash' => 'Nenhuma solução encontrada na lixeira.',
	);

	$args = array(
		'labels' => $labels,
		'description' => 'Custom Post Type para Soluções',
		'public' => true,
		'menu_icon' => 'dashicons-lightbulb',
		'supports' => array('title', 'thumbnail'),
		'has_archive' => true,
		'rewrite' => array('slug' => 'solucoes'),
	);

	register_post_type('solucoes', $args);
}
add_action('init', 'criar_cpt_solucoes');

// Certifique-se de que o ACF esteja disponível
if (function_exists('acf_add_local_field_group')):

	acf_add_local_field_group(array(
		'key' => 'group_solucoes_conteudo',
		'title' => 'Soluções - Conteúdo',
		'fields' => array(
			array(
				'key' => 'field_conteudo_solucoes',
				'label' => 'Conteúdo Soluções',
				'name' => 'conteudo_solucoes',
				'type' => 'flexible_content',
				'layouts' => array(
					'layout_hero' => array(
						'key' => 'layout_hero',
						'name' => 'hero',
						'label' => 'Hero',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_hero_titulo',
								'label' => 'Título',
								'name' => 'titulo',
								'type' => 'text',
							),
							array(
								'key' => 'field_hero_subtitulo',
								'label' => 'Subtítulo',
								'name' => 'subtitulo',
								'type' => 'textarea',
							),
							array(
								'key' => 'field_hero_imagem',
								'label' => 'Imagem',
								'name' => 'imagem',
								'type' => 'image',
								'return_format' => 'array',
								'preview_size' => 'large',
								'library' => 'all',
							),
							array(
								'key' => 'field_hero_texto_botao_primario',
								'label' => 'Texto do Botão Primário',
								'name' => 'texto_botao_primario',
								'type' => 'text',
							),
							array(
								'key' => 'field_hero_url_botao_primario',
								'label' => 'URL do Botão Primário',
								'name' => 'url_botao_primario',
								'type' => 'url',
							),
							array(
								'key' => 'field_hero_texto_botao_secundario',
								'label' => 'Texto do Botão Secundário',
								'name' => 'texto_botao_secundario',
								'type' => 'text',
							),
							array(
								'key' => 'field_hero_url_botao_secundario',
								'label' => 'URL do Botão Secundário',
								'name' => 'url_botao_secundario',
								'type' => 'url',
							),
							array(
								'key' => 'field_hero_badge_texto',
								'label' => 'Texto do Badge',
								'name' => 'badge_texto',
								'type' => 'text',
							),
							array(
								'key' => 'field_hero_badge_icone',
								'label' => 'Ícone do Badge (SVG)',
								'name' => 'badge_icone',
								'type' => 'textarea',
								'instructions' => 'Cole aqui o código SVG do ícone do badge.',
							),
						),
					),
					'layout_descricao' => array(
						'key' => 'layout_descricao',
						'name' => 'descricao',
						'label' => 'Descrição',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_descricao_titulo',
								'label' => 'Título',
								'name' => 'titulo',
								'type' => 'text',
							),
							array(
								'key' => 'field_descricao_conteudo',
								'label' => 'Conteúdo',
								'name' => 'conteudo',
								'type' => 'wysiwyg',
							),
						),
					),
					'layout_funcionalidades' => array(
						'key' => 'layout_funcionalidades',
						'name' => 'funcionalidades',
						'label' => 'Funcionalidades',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_funcionalidades_titulo',
								'label' => 'Título da Seção',
								'name' => 'titulo',
								'type' => 'text',
							),
							array(
								'key' => 'field_funcionalidades_lista',
								'label' => 'Lista de Funcionalidades',
								'name' => 'lista_de_funcionalidades',
								'type' => 'repeater',
								'sub_fields' => array(
									array(
										'key' => 'field_funcionalidades_svg_code',
										'label' => 'Código SVG',
										'name' => 'svg_code',
										'type' => 'textarea',
										'instructions' => 'Cole aqui o código SVG do ícone. Certifique-se de que o SVG seja seguro e não contenha código malicioso.',
									),
									array(
										'key' => 'field_funcionalidades_titulo_item',
										'label' => 'Título',
										'name' => 'titulo',
										'type' => 'text',
									),
									array(
										'key' => 'field_funcionalidades_descricao',
										'label' => 'Descrição',
										'name' => 'descricao',
										'type' => 'textarea',
									),
								),
								'min' => 0,
								'layout' => 'row',
								'button_label' => 'Adicionar Funcionalidade',
							),
						),
					),
					'layout_texto_e_imagem' => array(
						'key' => 'layout_texto_e_imagem',
						'name' => 'texto_e_imagem',
						'label' => 'Texto e Imagem',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_texto_imagem_titulo',
								'label' => 'Título',
								'name' => 'titulo',
								'type' => 'text',
							),
							array(
								'key' => 'field_texto_imagem_conteudo',
								'label' => 'Conteúdo',
								'name' => 'conteudo',
								'type' => 'wysiwyg',
							),
							array(
								'key' => 'field_texto_imagem_imagem',
								'label' => 'Imagem',
								'name' => 'imagem',
								'type' => 'image',
								'return_format' => 'array',
								'preview_size' => 'medium',
								'library' => 'all',
							),
						),
					),
					'layout_texto_e_imagem' => array(
						'key' => 'layout_texto_e_imagem',
						'name' => 'texto_e_imagem',
						'label' => 'Texto e Imagem',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_texto_imagem_titulo',
								'label' => 'Título',
								'name' => 'titulo',
								'type' => 'text',
							),
							array(
								'key' => 'field_texto_imagem_conteudo',
								'label' => 'Conteúdo',
								'name' => 'conteudo',
								'type' => 'wysiwyg',
							),
							array(
								'key' => 'field_texto_imagem_imagem',
								'label' => 'Imagem',
								'name' => 'imagem',
								'type' => 'image',
								'return_format' => 'array',
								'preview_size' => 'medium',
								'library' => 'all',
							),
							array(
								'key' => 'field_texto_imagem_texto_botao',
								'label' => 'Texto do Botão',
								'name' => 'texto_do_botao',
								'type' => 'text',
							),
							array(
								'key' => 'field_texto_imagem_url_botao',
								'label' => 'URL do Botão',
								'name' => 'url_do_botao',
								'type' => 'url',
							),
						),
					),
					'layout_video_e_texto_esquerda' => array(
                    'key' => 'layout_video_e_texto_esquerda',
                    'name' => 'video_e_texto_esquerda_video',
                    'label' => 'Vídeo e Texto (Esquerda, texto)',
                    'display' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_video_texto_esquerda_titulo',
                            'label' => 'Título',
                            'name' => 'titulo',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_video_texto_esquerda_conteudo',
                            'label' => 'Conteúdo',
                            'name' => 'conteudo',
                            'type' => 'wysiwyg',
                        ),
                        array(
                            'key' => 'field_video_texto_esquerda_iframe',
                            'label' => 'Código do Iframe',
                            'name' => 'iframe_do_video',
                            'type' => 'textarea',
                            'instructions' => 'Insira o código do iframe do vídeo aqui. Certifique-se de que o código seja seguro.',
                        ),
                    ),
                ),
					'layout_video_e_texto_topo' => array(
                    'key' => 'layout_video_e_texto_topo',
                    'name' => 'video_e_texto_video_no_topo',
                    'label' => 'Vídeo e Texto (Vídeo no topo)',
                    'display' => 'block',
                    'sub_fields' => array(
                        array(
                            'key' => 'field_video_texto_topo_titulo',
                            'label' => 'Título',
                            'name' => 'titulo',
                            'type' => 'text',
                        ),
                        array(
                            'key' => 'field_video_texto_topo_conteudo',
                            'label' => 'Conteúdo',
                            'name' => 'conteudo',
                            'type' => 'wysiwyg',
                        ),
                        array(
                            'key' => 'field_video_texto_topo_iframe',
                            'label' => 'Código do Iframe',
                            'name' => 'iframe_do_video',
                            'type' => 'textarea',
                            'instructions' => 'Insira o código do iframe do vídeo aqui. Certifique-se de que o código seja seguro.',
                        ),
                    ),
                ),
					'layout_depoimentos' => array(
						'key' => 'layout_depoimentos',
						'name' => 'depoimentos',
						'label' => 'Depoimentos',
						'display' => 'block',
						'sub_fields' => array(
							// Nenhum campo adicional necessário, pois os depoimentos são puxados das opções
						),
					),
					'layout_tabela_de_precos' => array(
						'key' => 'layout_tabela_de_precos',
						'name' => 'tabela_de_precos',
						'label' => 'Tabela de Preços',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_tabela_precos_titulo',
								'label' => 'Título',
								'name' => 'titulo',
								'type' => 'text',
							),
							array(
								'key' => 'field_tabela_precos_descricao',
								'label' => 'Descrição',
								'name' => 'descricao',
								'type' => 'wysiwyg',
							),
							array(
								'key' => 'field_tabela_precos_planos',
								'label' => 'Planos',
								'name' => 'planos',
								'type' => 'repeater',
								'sub_fields' => array(
									array(
										'key' => 'field_tabela_precos_nome_plano',
										'label' => 'Nome do Plano',
										'name' => 'nome_do_plano',
										'type' => 'text',
									),
									array(
										'key' => 'field_tabela_precos_preco',
										'label' => 'Preço',
										'name' => 'preco',
										'type' => 'text',
									),
									array(
										'key' => 'field_tabela_precos_periodo',
										'label' => 'Período',
										'name' => 'periodo',
										'type' => 'text',
									),
									array(
										'key' => 'field_tabela_precos_caracteristicas',
										'label' => 'Características',
										'name' => 'caracteristicas',
										'type' => 'repeater',
										'sub_fields' => array(
											array(
												'key' => 'field_caracteristica_item',
												'label' => 'Item',
												'name' => 'item',
												'type' => 'text',
											),
										),
										'min' => 0,
										'layout' => 'table',
										'button_label' => 'Adicionar Característica',
									),
									array(
										'key' => 'field_tabela_precos_link',
										'label' => 'Link',
										'name' => 'link',
										'type' => 'url',
									),
									array(
										'key' => 'field_tabela_precos_destaque',
										'label' => 'Plano em Destaque',
										'name' => 'destaque',
										'type' => 'true_false',
										'ui' => 1,
										'ui_on_text' => 'Sim',
										'ui_off_text' => 'Não',
									),
								),
								'min' => 0,
								'layout' => 'row',
								'button_label' => 'Adicionar Plano',
							),
						),
					),
					'layout_formulario_de_contato' => array(
						'key' => 'layout_formulario_de_contato',
						'name' => 'formulario_de_contato',
						'label' => 'Formulário de Contato',
						'display' => 'block',
						'sub_fields' => array(
							array(
								'key' => 'field_formulario_contato_titulo',
								'label' => 'Título',
								'name' => 'titulo',
								'type' => 'text',
							),
							array(
								'key' => 'field_formulario_contato_descricao',
								'label' => 'Descrição',
								'name' => 'descricao',
								'type' => 'wysiwyg',
							),
							array(
								'key' => 'field_formulario_contato_shortcode',
								'label' => 'Shortcode do Formulário',
								'name' => 'shortcode_do_formulario',
								'type' => 'text',
							),
						),
					),
				),
				'button_label' => 'Adicionar Seção',
				'min' => '',
				'max' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'solucoes',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal', // 'acf_after_title' para exibir abaixo do título
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
	));

endif;

// Certifique-se de que o ACF esteja disponível
if( function_exists('acf_add_local_field_group') ):

// Grupo de Campos "Home" para o CPT "solucoes"
acf_add_local_field_group(array(
    'key' => 'group_home_solucoes',
    'title' => 'Home',
    'fields' => array(
        array(
            'key' => 'field_home_svg_code',
            'label' => 'Código SVG',
            'name' => 'home_svg_code',
            'type' => 'textarea',
            'instructions' => 'Insira o código SVG aqui. Certifique-se de que o SVG seja seguro e não contenha código malicioso.',
        ),
        array(
            'key' => 'field_home_titulo',
            'label' => 'Título',
            'name' => 'home_titulo',
            'type' => 'text',
        ),
        array(
            'key' => 'field_home_descricao',
            'label' => 'Descrição',
            'name' => 'home_descricao',
            'type' => 'textarea',
        ),
    ),
    'location' => array(
        array(
            array(
                'param' => 'post_type',
                'operator' => '==',
                'value' => 'solucoes',
            ),
        ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
));

endif;

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
    'key' => 'group_timeline_sobre',
    'title' => 'Timeline Sobre',
    'fields' => array(
        array(
            'key' => 'field_timeline',
            'label' => 'Timeline',
            'name' => 'timeline',
            'type' => 'repeater',
            'instructions' => '',
            'required' => 0,
            'collapsed' => 'field_titulo',
            'min' => 0,
            'max' => 0,
            'layout' => 'block',
            'button_label' => 'Adicionar Evento',
            'sub_fields' => array(
                array(
                    'key' => 'field_data',
                    'label' => 'Data',
                    'name' => 'data',
                    'type' => 'date_picker',
                    'required' => 0,
                    'display_format' => 'Y',
                    'return_format' => 'Y',
                    'first_day' => 1,
                ),
                array(
                    'key' => 'field_titulo',
                    'label' => 'Título',
                    'name' => 'titulo',
                    'type' => 'text',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_descricao',
                    'label' => 'Descrição',
                    'name' => 'descricao',
                    'type' => 'wysiwyg',
                    'required' => 0,
                    'tabs' => 'all',
                    'toolbar' => 'full',
                    'media_upload' => 1,
                ),
                array(
                    'key' => 'field_botao',
                    'label' => 'Botão',
                    'name' => 'botao',
                    'type' => 'link',
                    'required' => 0,
                    'return_format' => 'array',
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
));

endif;

// Registrar o Custom Post Type Portfolio
function criar_cpt_portfolio() {
    $labels = array(
        'name' => 'Portfolios',
        'singular_name' => 'Portfolio',
        'menu_name' => 'Portfolio',
        'name_admin_bar' => 'Portfolio',
        'add_new' => 'Adicionar Novo',
        'add_new_item' => 'Adicionar Novo Portfolio',
        'new_item' => 'Novo Portfolio',
        'edit_item' => 'Editar Portfolio',
        'view_item' => 'Ver Portfolio',
        'all_items' => 'Todos os Portfolios',
        'search_items' => 'Procurar Portfolios',
        'not_found' => 'Nenhum Portfolio encontrado.',
        'not_found_in_trash' => 'Nenhum Portfolio encontrado na lixeira.',
    );

    $args = array(
        'labels' => $labels,
        'description' => 'Custom Post Type para mostrar projetos do Portfolio',
        'public' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-portfolio',
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
        'rewrite' => array('slug' => 'portfolio'),
        'show_in_rest' => true,
    );

    register_post_type('portfolio', $args);
}
add_action('init', 'criar_cpt_portfolio');

// Redirecionar single portfolio para o arquivo portfolio
function redirecionar_single_portfolio() {
    if (is_singular('portfolio')) {
        wp_redirect(get_post_type_archive_link('portfolio'));
        exit;
    }
}
add_action('template_redirect', 'redirecionar_single_portfolio');

// Registrar campos personalizados do ACF para o CPT Portfolio
add_action('acf/init', 'registrar_campos_portfolio');
function registrar_campos_portfolio() {
    if( function_exists('acf_add_local_field_group') ):

        acf_add_local_field_group(array(
            'key' => 'group_portfolio_detalhes',
            'title' => 'Detalhes do Portfolio',
            'fields' => array(
                array(
                    'key' => 'field_url_do_site',
                    'label' => 'URL do Site',
                    'name' => 'url_do_site',
                    'type' => 'url',
                    'instructions' => 'Insira a URL do site do projeto.',
                    'required' => 1,
                ),
                array(
                    'key' => 'field_tecnologias_utilizadas',
                    'label' => 'Tecnologias Utilizadas',
                    'name' => 'tecnologias_utilizadas',
                    'type' => 'text',
                    'instructions' => 'Liste as tecnologias utilizadas no projeto.',
                    'required' => 0,
                ),
                array(
                    'key' => 'field_data_de_conclusao',
                    'label' => 'Data de Conclusão',
                    'name' => 'data_de_conclusao',
                    'type' => 'date_picker',
                    'instructions' => 'Selecione a data de conclusão do projeto.',
                    'required' => 0,
                    'display_format' => 'Y',
                    'return_format' => 'Y',
                    'first_day' => 1,
                ),
                array(
                    'key' => 'field_imagem_adicional',
                    'label' => 'Imagem de Destaque Adicional',
                    'name' => 'imagem_adicional',
                    'type' => 'image',
                    'instructions' => 'Faça upload de uma imagem adicional para o projeto.',
                    'required' => 0,
                    'return_format' => 'array',
                    'preview_size' => 'medium',
                    'library' => 'all',
                ),
            ),
            'location' => array(
                array(
                    array(
                        'param' => 'post_type',
                        'operator' => '==',
                        'value' => 'portfolio',
                    ),
                ),
            ),
            'menu_order' => 0,
            'position' => 'normal',
            'style' => 'default',
            'active' => true,
            'description' => '',
        ));

    endif;
}