<?php
add_action('after_setup_theme', function(){
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', ['search-form','gallery','caption','comment-form','comment-list','style','script']);
	register_nav_menus([
		'menu_primary' => __('Primary Menu','mokrenko'),
		'menu_footer'  => __('Footer Menu','mokrenko'),
	]);
});

// Custom Post Type: Отзывы
add_action('init', function(){
	register_post_type('reviews', [
		'labels' => [
			'name' => 'Отзывы',
			'singular_name' => 'Отзыв',
			'add_new' => 'Добавить отзыв',
			'add_new_item' => 'Добавить новый отзыв',
			'edit_item' => 'Редактировать отзыв',
			'new_item' => 'Новый отзыв',
			'view_item' => 'Просмотреть отзыв',
			'search_items' => 'Поиск отзывов',
			'not_found' => 'Отзывы не найдены',
			'not_found_in_trash' => 'В корзине отзывов не найдено'
		],
		'public' => true,
		'has_archive' => false,
		'menu_icon' => 'dashicons-star-filled',
		'supports' => ['title', 'editor', 'thumbnail'],
		'show_in_rest' => true
	]);
});

// Мета-поля для отзывов
add_action('add_meta_boxes', function(){
	add_meta_box(
		'reviews_meta',
		'Данные отзыва',
		'reviews_meta_callback',
		'reviews',
		'normal',
		'high'
	);
});

function reviews_meta_callback($post){
	wp_nonce_field('reviews_meta_nonce', 'reviews_meta_nonce');
	$fio = get_post_meta($post->ID, '_reviews_fio', true);
	$video_url = get_post_meta($post->ID, '_reviews_video_url', true);
	$show_on_home = get_post_meta($post->ID, '_reviews_show_on_home', true);
	?>
	<table class="form-table">
		<tr>
			<th><label for="reviews_fio">ФИО пациента</label></th>
			<td><input type="text" id="reviews_fio" name="reviews_fio" value="<?php echo esc_attr($fio); ?>" style="width: 100%;" /></td>
		</tr>
		<tr>
			<th><label for="reviews_video_url">Ссылка на видео</label></th>
			<td><input type="url" id="reviews_video_url" name="reviews_video_url" value="<?php echo esc_attr($video_url); ?>" style="width: 100%;" placeholder="https://youtube.com/watch?v=..." /></td>
		</tr>
		<tr>
			<th><label for="reviews_show_on_home">Показать на главной</label></th>
			<td>
				<input type="checkbox" id="reviews_show_on_home" name="reviews_show_on_home" value="1" <?php checked($show_on_home, '1'); ?> />
				<label for="reviews_show_on_home">Отметить этот отзыв для показа на главной странице</label>
			</td>
		</tr>
	</table>
	<?php
}

// Сохранение мета-полей
add_action('save_post', function($post_id){
	if (!isset($_POST['reviews_meta_nonce']) || !wp_verify_nonce($_POST['reviews_meta_nonce'], 'reviews_meta_nonce')) {
		return;
	}
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
		return;
	}
	if (!current_user_can('edit_post', $post_id)) {
		return;
	}
	
	if (isset($_POST['reviews_fio'])) {
		update_post_meta($post_id, '_reviews_fio', sanitize_text_field($_POST['reviews_fio']));
	}
	if (isset($_POST['reviews_video_url'])) {
		update_post_meta($post_id, '_reviews_video_url', esc_url_raw($_POST['reviews_video_url']));
	}
	
	// Сохранение чекбокса "Показать на главной"
	$show_on_home = isset($_POST['reviews_show_on_home']) ? '1' : '0';
	update_post_meta($post_id, '_reviews_show_on_home', $show_on_home);
});

// ACF поля для врачей
if (function_exists('acf_add_local_field_group')) {
	acf_add_local_field_group([
		'key' => 'doctor_meta',
		'title' => 'Данные врача',
		'fields' => [
			[
				'key' => 'doctor_position',
				'label' => 'Должность',
				'name' => 'position',
				'type' => 'text',
				'required' => 1,
			],
			[
				'key' => 'doctor_experience',
				'label' => 'Стаж (лет)',
				'name' => 'experience_years',
				'type' => 'number',
				'required' => 1,
			],
			[
				'key' => 'doctor_education',
				'label' => 'Образование',
				'name' => 'education',
				'type' => 'repeater',
				'sub_fields' => [
					[
						'key' => 'education_year',
						'label' => 'Год',
						'name' => 'year',
						'type' => 'text',
					],
					[
						'key' => 'education_desc',
						'label' => 'Описание',
						'name' => 'desc',
						'type' => 'text',
					],
				],
			],
			[
				'key' => 'doctor_certs',
				'label' => 'Курсы и сертификаты',
				'name' => 'certs',
				'type' => 'repeater',
				'sub_fields' => [
					[
						'key' => 'cert_year',
						'label' => 'Год',
						'name' => 'year',
						'type' => 'text',
					],
					[
						'key' => 'cert_title',
						'label' => 'Название',
						'name' => 'title',
						'type' => 'text',
					],
					[
						'key' => 'cert_issuer',
						'label' => 'Организация',
						'name' => 'issuer',
						'type' => 'text',
					],
				],
			],
			[
				'key' => 'doctor_short_bio',
				'label' => 'Краткая биография',
				'name' => 'short_bio',
				'type' => 'textarea',
			],
			[
				'key' => 'doctor_contacts',
				'label' => 'Контакты',
				'name' => 'contacts',
				'type' => 'group',
				'sub_fields' => [
					[
						'key' => 'contact_phone',
						'label' => 'Телефон',
						'name' => 'phone',
						'type' => 'text',
					],
					[
						'key' => 'contact_email',
						'label' => 'Email',
						'name' => 'email',
						'type' => 'email',
					],
					[
						'key' => 'contact_telegram',
						'label' => 'Telegram',
						'name' => 'tg',
						'type' => 'text',
					],
				],
			],
			[
				'key' => 'doctor_rating',
				'label' => 'Рейтинг (0-5)',
				'name' => 'rating',
				'type' => 'number',
				'min' => 0,
				'max' => 5,
				'step' => 0.1,
			],
			[
				'key' => 'doctor_cta_link',
				'label' => 'Ссылка "Записаться"',
				'name' => 'cta_link',
				'type' => 'url',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'doctor',
				],
			],
		],
	]);

	// ACF поля для кейсов
	acf_add_local_field_group([
		'key' => 'case_meta',
		'title' => 'Данные кейса',
		'fields' => [
			[
				'key' => 'case_doctor_ref',
				'label' => 'Врач',
				'name' => 'doctor_ref',
				'type' => 'post_object',
				'post_type' => ['doctor'],
				'required' => 1,
			],
			[
				'key' => 'case_before_image',
				'label' => 'Фото "До"',
				'name' => 'before_image',
				'type' => 'image',
				'return_format' => 'id',
				'required' => 1,
			],
			[
				'key' => 'case_before_desc',
				'label' => 'Описание проблемы',
				'name' => 'before_desc',
				'type' => 'textarea',
				'required' => 1,
			],
			[
				'key' => 'case_after_image',
				'label' => 'Фото "После"',
				'name' => 'after_image',
				'type' => 'image',
				'return_format' => 'id',
				'required' => 1,
			],
			[
				'key' => 'case_after_desc',
				'label' => 'Описание решения',
				'name' => 'after_desc',
				'type' => 'textarea',
				'required' => 1,
			],
			[
				'key' => 'case_duration_text',
				'label' => 'Срок выполнения',
				'name' => 'duration_text',
				'type' => 'text',
				'placeholder' => 'Срок 5 месяцев',
			],
		],
		'location' => [
			[
				[
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'case',
				],
			],
		],
	]);
}

// Шорткоды для портфолио
add_shortcode('case_showcase', 'theme_case_showcase_shortcode');
function theme_case_showcase_shortcode($atts) {
	$atts = shortcode_atts([
		'id' => 0,
	], $atts);

	$case_id = intval($atts['id']);
	if (!$case_id || get_post_type($case_id) !== 'case') {
		return '';
	}

	// Подключаем CSS для scroll-snap
	wp_enqueue_style('theme-case-snap', get_stylesheet_directory_uri() . '/assets/css/case-snap.css', [], wp_get_theme()->get('Version'));

	ob_start();
	get_template_part('template-parts/case/showcase', null, ['case_id' => $case_id]);
	return ob_get_clean();
}

add_shortcode('cases_by_doctor', 'theme_cases_by_doctor_shortcode');
function theme_cases_by_doctor_shortcode($atts) {
	$atts = shortcode_atts([
		'doctor' => 0,
		'limit' => 6,
	], $atts);

	$doctor_id = intval($atts['doctor']);
	$limit = intval($atts['limit']);

	if (!$doctor_id) {
		return '';
	}

	$cases = get_posts([
		'post_type' => 'case',
		'posts_per_page' => $limit,
		'meta_query' => [
			[
				'key' => 'doctor_ref',
				'value' => $doctor_id,
				'compare' => '='
			]
		]
	]);

	if (empty($cases)) {
		return '';
	}

	// Подключаем CSS для scroll-snap
	wp_enqueue_style('theme-case-snap', get_stylesheet_directory_uri() . '/assets/css/case-snap.css', [], wp_get_theme()->get('Version'));

	ob_start();
	foreach ($cases as $case) {
		get_template_part('template-parts/case/showcase', null, ['case_id' => $case->ID]);
	}
	return ob_get_clean();
}

add_shortcode('doctor_portfolio', 'theme_doctor_portfolio_shortcode');
function theme_doctor_portfolio_shortcode($atts) {
	$atts = shortcode_atts([
		'doctor' => 'current',
		'limit' => 10,
	], $atts);

	$doctor_id = 0;
	if ($atts['doctor'] === 'current') {
		global $post;
		if ($post && $post->post_type === 'doctor') {
			$doctor_id = $post->ID;
		}
	} else {
		$doctor_id = intval($atts['doctor']);
	}

	if (!$doctor_id) {
		return '';
	}

	$cases = get_posts([
		'post_type' => 'case',
		'posts_per_page' => intval($atts['limit']),
		'meta_query' => [
			[
				'key' => 'doctor_ref',
				'value' => $doctor_id,
				'compare' => '='
			]
		]
	]);

	if (empty($cases)) {
		return '';
	}

	// Подключаем CSS для слайдера
	wp_enqueue_style('theme-case-snap', get_stylesheet_directory_uri() . '/assets/css/case-snap.css', [], wp_get_theme()->get('Version'));

	ob_start();
	?>
	<div class="doctor-portfolio">
		<div class="doctor-portfolio__header">
			<h2>Портфолио врача:</h2>
			<div class="doctor-portfolio__nav">
				<button class="js-prev" type="button">←</button>
				<button class="js-next" type="button">→</button>
			</div>
		</div>
		<div class="doctor-portfolio__slider">
			<?php foreach ($cases as $case): ?>
				<div class="doctor-portfolio__slide">
					<?php
					$before_image = get_field('before_image', $case->ID);
					$before_desc = get_field('before_desc', $case->ID);
					$after_image = get_field('after_image', $case->ID);
					$after_desc = get_field('after_desc', $case->ID);
					?>
					<div class="row">
						<div class="col-sm-12 col-lg-6">
							<div class="case-panel case-panel--before">
								<div class="case-panel__image">
									<?php echo wp_get_attachment_image($before_image, 'medium_large', false, ['class' => 'case-panel__img']); ?>
									<div class="case-panel__badge case-panel__badge--before">До</div>
								</div>
								<div class="case-panel__content">
									<h4 class="case-panel__title">Проблема:</h4>
									<p class="case-panel__desc"><?php echo esc_html($before_desc); ?></p>
								</div>
							</div>
						</div>
						<div class="col-sm-12 col-lg-6">
							<div class="case-panel case-panel--after">
								<div class="case-panel__image">
									<?php echo wp_get_attachment_image($after_image, 'medium_large', false, ['class' => 'case-panel__img']); ?>
									<div class="case-panel__badge case-panel__badge--after">После</div>
								</div>
								<div class="case-panel__content">
									<h4 class="case-panel__title">Решение:</h4>
									<p class="case-panel__desc"><?php echo esc_html($after_desc); ?></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
	return ob_get_clean();
}

/**
 * ИНСТРУКЦИЯ ПО ИСПОЛЬЗОВАНИЮ ПОРТФОЛИО ВРАЧЕЙ
 * 
 * 1. Создайте врачей в админке: Врачи → Добавить врача
 *    - Заполните основные поля: ФИО, должность, стаж, фото
 *    - Добавьте специализацию и клинику через таксономии
 * 
 * 2. Создайте кейсы портфолио: Кейсы → Добавить кейс
 *    - Выберите врача в поле "Врач"
 *    - Загрузите фото "До" и "После"
 *    - Заполните описания проблемы и решения
 *    - Укажите срок выполнения
 * 
 * 3. Используйте шорткоды в Gutenberg:
 *    [case_showcase id="123"] - показать один кейс
 *    [cases_by_doctor doctor="456" limit="6"] - кейсы конкретного врача
 *    [doctor_portfolio doctor="current" limit="10"] - портфолио на странице врача
 * 
 * 4. Адаптивность:
 *    - На мобилке: горизонтальный скролл с snap
 *    - На планшете: 2 колонки в ряд
 *    - На десктопе: 3 колонки (врач + до + после)
 */

add_action('wp_enqueue_scripts', function(){
	$ver = wp_get_theme()->get('Version');
	$uri = get_stylesheet_directory_uri() . '/assets/css/';
	wp_enqueue_style('theme-base',       $uri.'base.css',       [], $ver);
	wp_enqueue_style('theme-layout',     $uri.'layout.css',     ['theme-base'], $ver);
	wp_enqueue_style('theme-components', $uri.'components.css', ['theme-layout'], $ver);
	wp_enqueue_style('theme-utilities',  $uri.'utilities.css',  ['theme-components'], $ver);
	if (is_front_page()) {
		wp_enqueue_style('page-home', $uri.'pages/home.css', ['theme-utilities'], $ver);
	}
});
