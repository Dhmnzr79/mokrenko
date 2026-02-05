<?php
/**
 * Schema.org микроразметка в формате JSON-LD
 * 
 * Реализует полную Schema.org разметку для всех типов страниц сайта
 */

/**
 * Вывод JSON-LD разметки
 * 
 * @param array $data Массив данных для JSON-LD
 * @param string $id @id сущности (для проверки дублей)
 */
function render_schema_json_ld($data, $id = null) {
	static $schema_rendered_ids = [];
	
	// Проверка на дубликаты @id
	if ($id && in_array($id, $schema_rendered_ids)) {
		return;
	}
	
	if ($id) {
		$schema_rendered_ids[] = $id;
	}
	
	// Добавляем @context если его нет
	if (!isset($data['@context'])) {
		$data = array_merge(['@context' => 'https://schema.org'], $data);
	}
	
	// Кодируем в JSON
	$json = wp_json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
	
	if ($json === false) {
		return;
	}
	
	// Выводим script tag
	echo '<script type="application/ld+json">' . "\n";
	echo $json . "\n";
	echo '</script>' . "\n";
}

/**
 * Получение email клиники из настроек WP
 * 
 * @return string|null Email или null если не найден
 */
function get_clinic_email() {
	// Проверяем опции WP
	$email = get_option('admin_email');
	
	// Если admin_email не подходит, можно добавить проверку других опций
	// Или использовать ACF если установлен
	if (function_exists('get_field')) {
		$acf_email = get_field('clinic_email', 'option');
		if (!empty($acf_email)) {
			return $acf_email;
		}
	}
	
	// Если email не найден в настройках, возвращаем null
	// Не используем жестко закодированный email
	return null;
}

/**
 * Глобальная разметка клиники (Dentist)
 * Выводится на всех страницах
 */
function render_global_clinic_schema() {
	$clinic_id = home_url() . '#clinic';
	
	$schema = [
		'@type' => 'Dentist',
		'@id' => $clinic_id,
		'name' => 'Стоматологическая клиника Елены Мокренко',
		'url' => home_url(),
		'logo' => get_stylesheet_directory_uri() . '/assets/svg/logo.svg',
		'telephone' => '+7 (495) 003-54-76',
		'address' => [
			'@type' => 'PostalAddress',
			'streetAddress' => 'ул. Проспект Мира 75, стр. 1',
			'addressLocality' => 'Москва',
			'addressCountry' => 'RU'
		],
		'openingHoursSpecification' => [
			[
				'@type' => 'OpeningHoursSpecification',
				'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
				'opens' => '10:00',
				'closes' => '21:00'
			]
		],
		'contactPoint' => [
			'@type' => 'ContactPoint',
			'telephone' => '+7 (495) 003-54-76',
			'contactType' => 'customer service',
			'availableLanguage' => ['ru']
		],
		'sameAs' => [
			'https://t.me/mokrenko_msk',
			'https://wa.me/79850549339',
			'https://vk.com/mokrenko_msk',
			'https://www.youtube.com/@mokrenko_msk'
		],
		'areaServed' => [
			'@type' => 'City',
			'name' => 'Москва'
		]
	];
	
	// Добавляем email только если он есть в настройках
	$email = get_clinic_email();
	if ($email) {
		$schema['contactPoint']['email'] = $email;
		$schema['email'] = $email;
	}
	
	// Добавляем hasMap если есть карта
	if (is_page_template('page-contacts.php')) {
		$schema['hasMap'] = home_url() . '/#yandex-map';
	}
	
	render_schema_json_ld($schema, $clinic_id);
}
add_action('wp_head', 'render_global_clinic_schema', 5);

/**
 * Получение элементов хлебных крошек через WP-логику
 * 
 * @return array Массив элементов breadcrumbs
 */
function get_breadcrumb_items() {
	$items = [];
	$position = 1;
	
	// Главная всегда первая
	$items[] = [
		'@type' => 'ListItem',
		'position' => $position++,
		'name' => 'Главная',
		'item' => home_url()
	];
	
	// Определяем текущую страницу
	if (is_singular('doctor')) {
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => 'Врачи',
			'item' => get_page_url_by_template('page-doctors.php')
		];
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => get_the_title(),
			'item' => get_permalink()
		];
	} elseif (is_singular('service')) {
		// Для услуг можно добавить категорию если есть
		$terms = wp_get_post_terms(get_the_ID(), 'service_category');
		if (!empty($terms) && !is_wp_error($terms)) {
			$term = $terms[0];
			$term_link = get_term_link($term);
			if (!is_wp_error($term_link)) {
				$items[] = [
					'@type' => 'ListItem',
					'position' => $position++,
					'name' => $term->name,
					'item' => $term_link
				];
			}
		}
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => get_the_title(),
			'item' => get_permalink()
		];
	} elseif (is_single() && get_post_type() === 'post') {
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => 'Блог',
			'item' => get_page_url_by_template('page-blog.php')
		];
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => get_the_title(),
			'item' => get_permalink()
		];
	} elseif (is_page_template('page-about.php')) {
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => 'О клинике',
			'item' => get_permalink()
		];
	} elseif (is_page_template('page-contacts.php')) {
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => 'Контакты',
			'item' => get_permalink()
		];
	} elseif (is_page_template('page-blog.php')) {
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => 'Блог',
			'item' => get_permalink()
		];
	} elseif (is_page_template('page-reviews.php')) {
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => 'Отзывы',
			'item' => get_permalink()
		];
	} elseif (is_page_template('page-doctors.php')) {
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => 'Врачи',
			'item' => get_permalink()
		];
	} elseif (is_page_template('page-prices.php')) {
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => 'Цены',
			'item' => get_permalink()
		];
	} elseif (is_page_template('page-portfolio.php')) {
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => 'Портфолио',
			'item' => get_permalink()
		];
	} elseif (is_page()) {
		// Для обычных страниц просто добавляем название
		$items[] = [
			'@type' => 'ListItem',
			'position' => $position++,
			'name' => get_the_title(),
			'item' => get_permalink()
		];
	}
	
	return $items;
}

/**
 * Разметка хлебных крошек (BreadcrumbList)
 * Выводится на всех страницах кроме главной
 */
function render_breadcrumb_schema() {
	if (is_front_page()) {
		return;
	}
	
	$items = get_breadcrumb_items();
	
	if (empty($items)) {
		return;
	}
	
	$schema = [
		'@type' => 'BreadcrumbList',
		'itemListElement' => $items
	];
	
	render_schema_json_ld($schema);
}
add_action('wp_head', 'render_breadcrumb_schema', 10);

/**
 * Страничная разметка по типам страниц
 */
function render_page_specific_schema() {
	$clinic_id = home_url() . '#clinic';
	
	// Главная страница
	if (is_front_page()) {
		// WebSite с SearchAction
		$website_schema = [
			'@type' => 'WebSite',
			'@id' => home_url() . '#website',
			'url' => home_url(),
			'name' => 'Стоматологическая клиника Елены Мокренко',
			'publisher' => [
				'@id' => $clinic_id
			],
			'potentialAction' => [
				'@type' => 'SearchAction',
				'target' => [
					'@type' => 'EntryPoint',
					'urlTemplate' => home_url() . '/?s={search_term_string}'
				],
				'query-input' => 'required name=search_term_string'
			]
		];
		render_schema_json_ld($website_schema, home_url() . '#website');
		
		// WebPage опционально (можно закомментировать если не нужен)
		// $webpage_schema = [
		// 	'@type' => 'WebPage',
		// 	'mainEntity' => [
		// 		'@id' => $clinic_id
		// 	]
		// ];
		// render_schema_json_ld($webpage_schema);
	}
	
	// Услуга
	if (is_singular('service')) {
		$post_id = get_the_ID();
		$procedure_id = get_permalink() . '#procedure';
		
		$schema = [
			'@type' => 'MedicalProcedure',
			'@id' => $procedure_id,
			'name' => get_the_title(),
			'url' => get_permalink(),
			'provider' => [
				'@id' => $clinic_id
			],
			'medicalSpecialty' => 'Dentistry'
		];
		
		$excerpt = get_the_excerpt();
		if (!empty($excerpt)) {
			$schema['description'] = $excerpt;
		}
		
		// Категории из таксономии
		$terms = wp_get_post_terms($post_id, 'service_category');
		if (!empty($terms) && !is_wp_error($terms)) {
			$categories = [];
			foreach ($terms as $term) {
				$categories[] = $term->name;
			}
			$schema['category'] = $categories;
		}
		
		render_schema_json_ld($schema, $procedure_id);
	}
	
	// Врач
	if (is_singular('doctor')) {
		$post_id = get_the_ID();
		
		$schema = [
			'@type' => 'Physician',
			'name' => get_the_title(),
			'url' => get_permalink(),
			'worksFor' => [
				'@id' => $clinic_id
			]
		];
		
		$position = get_post_meta($post_id, 'doctor_position', true);
		if (!empty($position)) {
			$schema['jobTitle'] = $position;
		}
		
		$experience = get_post_meta($post_id, 'doctor_experience_years', true);
		if (!empty($experience)) {
			$schema['yearsOfExperience'] = (int) $experience;
		}
		
		$excerpt = get_the_excerpt();
		if (!empty($excerpt)) {
			$schema['description'] = $excerpt;
		}
		
		$image = get_the_post_thumbnail_url($post_id, 'large');
		if ($image) {
			$schema['image'] = $image;
		}
		
		// Специализация из таксономии
		$specialties = wp_get_post_terms($post_id, 'specialty');
		if (!empty($specialties) && !is_wp_error($specialties)) {
			$specialty_names = [];
			foreach ($specialties as $specialty) {
				$specialty_names[] = $specialty->name;
			}
			$schema['medicalSpecialty'] = $specialty_names;
		}
		
		// Образование и квалификация
		$education = get_post_meta($post_id, 'doctor_education', true);
		$qualification = get_post_meta($post_id, 'doctor_qualification', true);
		if (!empty($education) || !empty($qualification)) {
			$credentials = [];
			if (!empty($education)) {
				$credentials[] = $education;
			}
			if (!empty($qualification)) {
				$credentials[] = $qualification;
			}
			$schema['hasCredential'] = implode('; ', $credentials);
		}
		
		// Видео если есть
		$video_url = get_post_meta($post_id, 'doctor_video_url', true);
		if (!empty($video_url)) {
			$schema['video'] = [
				'@type' => 'VideoObject',
				'contentUrl' => $video_url,
				'embedUrl' => $video_url
			];
		}
		
		render_schema_json_ld($schema);
	}
	
	// О клинике
	if (is_page_template('page-about.php')) {
		$schema = [
			'@type' => 'AboutPage',
			'mainEntity' => [
				'@id' => $clinic_id
			]
		];
		render_schema_json_ld($schema);
	}
	
	// Контакты
	if (is_page_template('page-contacts.php')) {
		$schema = [
			'@type' => 'ContactPage',
			'mainEntity' => [
				'@id' => $clinic_id
			]
		];
		
		// Дополнительный contactPoint с email если он явно указан на странице
		$email = get_clinic_email();
		if ($email) {
			$schema['contactPoint'] = [
				'@type' => 'ContactPoint',
				'email' => $email,
				'contactType' => 'customer service',
				'availableLanguage' => ['ru']
			];
		}
		
		render_schema_json_ld($schema);
	}
	
	// Блог-архив
	if (is_page_template('page-blog.php')) {
		$schema = [
			'@type' => 'CollectionPage',
			'about' => [
				'@type' => 'Blog',
				'name' => 'Блог'
			]
		];
		render_schema_json_ld($schema);
	}
	
	// Пост блога
	if (is_single() && get_post_type() === 'post') {
		$post_id = get_the_ID();
		
		$schema = [
			'@type' => 'BlogPosting',
			'headline' => get_the_title(),
			'url' => get_permalink(),
			'datePublished' => get_the_date('c'),
			'dateModified' => get_the_modified_date('c'),
			'publisher' => [
				'@id' => $clinic_id
			],
			'mainEntityOfPage' => get_permalink()
		];
		
		$excerpt = get_the_excerpt();
		if (!empty($excerpt)) {
			$schema['description'] = $excerpt;
		}
		
		$image = get_the_post_thumbnail_url($post_id, 'large');
		if ($image) {
			$schema['image'] = $image;
		}
		
		render_schema_json_ld($schema);
	}
	
	// Страница отзывов - не добавляем AggregateRating без реальных данных
	// Review можно добавить только если есть полные данные (имя, текст, дата)
}
add_action('wp_head', 'render_page_specific_schema', 15);
