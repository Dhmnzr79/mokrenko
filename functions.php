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


// Подключение файлов системы врачей и кейсов
require_once get_template_directory() . '/inc/custom-types.php';
require_once get_template_directory() . '/inc/meta-boxes.php';
require_once get_template_directory() . '/inc/shortcodes.php';
require_once get_template_directory() . '/inc/prices-import.php';
require_once get_template_directory() . '/inc/svg-upload.php';

// Подключение файлов системы услуг
require_once get_template_directory() . '/inc/services/post-type.php';
require_once get_template_directory() . '/inc/services/taxonomy.php';
require_once get_template_directory() . '/inc/services/helpers.php';
require_once get_template_directory() . '/inc/services/sections-registry.php';
require_once get_template_directory() . '/inc/services/meta-fields.php';
require_once get_template_directory() . '/inc/services/meta-boxes.php';

add_action('init', function () {
	if (!taxonomy_exists('service_category')) {
		return;
	}

	$default_terms = [
		['name' => 'Имплантация зубов', 'slug' => 'implantation'],
		['name' => 'Протезирование', 'slug' => 'prosthetics'],
		['name' => 'Реставрация', 'slug' => 'restoration'],
	];

	foreach ($default_terms as $t) {
		if (term_exists($t['slug'], 'service_category')) {
			continue;
		}

		wp_insert_term($t['name'], 'service_category', ['slug' => $t['slug']]);
	}
}, 20);

// Подключение админских скриптов и стилей
add_action('admin_enqueue_scripts', 'theme_admin_scripts');
function theme_admin_scripts($hook) {
    global $post_type;
    
    // Подключаем на страницах врачей, кейсов и услуг
    if (in_array($post_type, ['doctor', 'case', 'service']) && in_array($hook, ['post.php', 'post-new.php'])) {
        wp_enqueue_media();
        
        // Для врачей и кейсов
        if (in_array($post_type, ['doctor', 'case'])) {
            $admin_cd_js = get_stylesheet_directory() . '/assets/admin/admin-cases-doctors.js';
            $admin_cd_css = get_stylesheet_directory() . '/assets/admin/admin-cases-doctors.css';
            wp_enqueue_script('theme-admin-cases-doctors', get_stylesheet_directory_uri() . '/assets/admin/admin-cases-doctors.js', ['jquery'], file_exists($admin_cd_js) ? filemtime($admin_cd_js) : wp_get_theme()->get('Version'), true);
            wp_enqueue_style('theme-admin-cases-doctors', get_stylesheet_directory_uri() . '/assets/admin/admin-cases-doctors.css', [], file_exists($admin_cd_css) ? filemtime($admin_cd_css) : wp_get_theme()->get('Version'));
        }
        
        // Для услуг
        if ($post_type === 'service') {
            $admin_services_js = get_stylesheet_directory() . '/assets/admin/admin-services.js';
            wp_enqueue_script('theme-admin-services', get_stylesheet_directory_uri() . '/assets/admin/admin-services.js', ['jquery'], file_exists($admin_services_js) ? filemtime($admin_services_js) : wp_get_theme()->get('Version'), true);
        }
        
        // Локализация для JS
        if (in_array($post_type, ['doctor', 'case'])) {
            wp_localize_script('theme-admin-cases-doctors', 'theme_admin', [
                'strings' => [
                    'year' => __('Год', 'mokrenko'),
                    'desc' => __('Описание', 'mokrenko'),
                    'remove' => __('Удалить', 'mokrenko'),
                    'select' => __('Выбрать', 'mokrenko'),
                    'selectCerts' => __('Выберите сертификаты', 'mokrenko'),
                    'selectBeforeImage' => __('Выберите фото "До"', 'mokrenko'),
                    'selectAfterImage' => __('Выберите фото "После"', 'mokrenko'),
                    'selectDoctorPhoto2' => __('Выберите второе фото врача', 'mokrenko')
                ]
            ]);
        }
    }
}

/**
 * ИНСТРУКЦИЯ ПО ИСПОЛЬЗОВАНИЮ СИСТЕМЫ ВРАЧЕЙ И КЕЙСОВ
 * 
 * 1. СОЗДАНИЕ ВРАЧЕЙ:
 *    - Перейдите в админку: Врачи → Добавить врача
 *    - Заполните основные поля: ФИО, должность, стаж, фото
 *    - Заполните "Краткое превью" (excerpt) и "Подробная информация" (content) в разделе "Дополнительная информация"
 *    - Добавьте 3 факта о враче
 *    - Заполните образование (простое текстовое поле с разбивкой на параграфы)
 *    - Выберите сертификаты (кнопка "Выбрать сертификаты")
 *    - Добавьте видео (YouTube URL)
 *    - Назначьте специализацию и клинику
 * 
 * 2. СОЗДАНИЕ КЕЙСОВ:
 *    - Перейдите: Кейсы → Добавить кейс
 *    - Выберите врача из списка
 *    - Загрузите фото "До" и "После"
 *    - Заполните описания проблемы и решения
 *    - Укажите срок выполнения
 * 
 * 3. ШОРТКОДЫ ДЛЯ ВЫВОДА:
 *    [case_showcase id="123" slider="0|1"] - один кейс
 *    [cases_by_doctor doctor="456" limit="6" slider="0|1"] - кейсы врача
 *    [doctor_card id="123"] - карточка врача
 *    [doctor_portfolio doctor="current|123" limit="10" slider="1"] - портфолио врача
 * 
 * 4. АДАПТИВНОСТЬ:
 *    - Мобилка: горизонтальный скролл с snap (3 панели)
 *    - Планшет: 2 колонки в ряд
 *    - Десктоп: 3 колонки (врач + до + после)
 *    - В слайдере: вертикальный стек на мобилке
 * 
 * 5. СТРУКТУРА ФАЙЛОВ:
 *    - inc/custom-types.php - CPT и метаполя
 *    - inc/meta-boxes.php - админские формы
 *    - inc/shortcodes.php - шорткоды
 *    - template-parts/case/showcase.php - шаблон кейса
 *    - template-parts/doctor/card.php - шаблон карточки врача
 *    - assets/admin/ - JS и CSS для админки
 */

add_action('wp_enqueue_scripts', function(){
	$ver = wp_get_theme()->get('Version');
	$uri = get_stylesheet_directory_uri() . '/assets/css/';
	wp_enqueue_style('theme-base',       $uri.'base.css',       [], $ver);
	wp_enqueue_style('theme-layout',     $uri.'layout.css',     ['theme-base'], $ver);
	wp_enqueue_style('theme-global',     $uri.'global.css',     ['theme-layout'], $ver);
	wp_enqueue_style('theme-components', $uri.'components.css', ['theme-global'], $ver);
	wp_enqueue_style('theme-utilities',  $uri.'utilities.css',  ['theme-components'], $ver);
	if (is_front_page()) {
		wp_enqueue_style('page-home', $uri.'pages/home.css', ['theme-utilities'], $ver);
	}
	
	if (is_page(['about', 'reviews', 'contacts', 'team', 'prices', 'doctors', 'o-klinike', 'otzyvy', 'kontakty', 'komanda', 'tseny', 'vrachi']) || is_page_template('page-about.php') || is_page_template('page-reviews.php') || is_page_template('page-contacts.php') || is_page_template('page-prices.php') || is_page_template('page-doctors.php') || is_page_template('page-blog.php') || is_page_template('page-portfolio.php') || is_page_template('page-thank-you.php') || is_single()) {
		wp_enqueue_style('page-inner', $uri.'pages/inner.css', ['theme-utilities'], $ver);
		wp_enqueue_style('page-home', $uri.'pages/home.css', ['theme-utilities'], $ver);
		wp_enqueue_script('theme-lightbox', get_stylesheet_directory_uri() . '/assets/js/lightbox.js', [], $ver, true);
		wp_enqueue_script('theme-slider', get_stylesheet_directory_uri() . '/assets/js/slider.js', [], $ver, true);
	}
	
	if (is_page_template('page-blog.php') || is_single()) {
		wp_enqueue_style('page-blog', $uri.'pages/blog.css', ['theme-utilities'], $ver);
	}
	
	// Стили для страниц услуг
	if (is_singular('service') || is_post_type_archive('service')) {
		wp_enqueue_style('page-service', $uri.'pages/service.css', ['theme-utilities'], $ver);
	}
	
	// Яндекс карта для страницы контактов
	if (is_page_template('page-contacts.php')) {
		wp_enqueue_script('yandex-map', 'https://api-maps.yandex.ru/2.1/?apikey=YOUR_API_KEY&lang=ru_RU', [], null, true);
		wp_add_inline_script('yandex-map', '
			ymaps.ready(function () {
				var myMap = new ymaps.Map("yandex-map", {
					center: [55.7934, 37.6331],
					zoom: 16,
					controls: []
				});
				
				myMap.behaviors.disable("scrollZoom");
				
				var myPlacemark = new ymaps.Placemark([55.7934, 37.6331], {
					balloonContent: "Москва, проспект Мира, д. 57, корп. 2"
				}, {
					preset: "islands#redDotIcon"
				});
				
				myMap.geoObjects.add(myPlacemark);
				
				var mapContainer = document.getElementById("yandex-map");
				mapContainer.addEventListener("wheel", function(e) {
					if (!e.ctrlKey) {
						e.preventDefault();
					}
				}, { passive: false });
			});
		', 'after');
	}
	
	// Enqueue slider script on front page
	if (is_front_page()) {
		wp_enqueue_script('theme-slider', get_stylesheet_directory_uri() . '/assets/js/slider.js', [], $ver, true);
		wp_enqueue_script('theme-lightbox', get_stylesheet_directory_uri() . '/assets/js/lightbox.js', [], $ver, true);
	}
	
	// Enqueue search script
	wp_enqueue_script('theme-search', get_stylesheet_directory_uri() . '/assets/js/search.js', [], $ver, true);
	wp_enqueue_script('theme-services-menu', get_stylesheet_directory_uri() . '/assets/js/services-menu.js', [], $ver, true);
	
	// Enqueue popup script
	wp_enqueue_script('theme-popup', get_stylesheet_directory_uri() . '/assets/js/popup.js', [], $ver, true);
	
	// Передаем URL страницы благодарности в JavaScript
	$thank_you_page = get_page_by_path('thank-you');
	if (!$thank_you_page) {
		$pages = get_pages([
			'meta_key' => '_wp_page_template',
			'meta_value' => 'page-thank-you.php',
			'number' => 1
		]);
		if (!empty($pages)) {
			$thank_you_page = $pages[0];
		}
	}
	if ($thank_you_page) {
		$thank_you_url = get_permalink($thank_you_page->ID);
		wp_add_inline_script('theme-popup', 'document.body.dataset.thankYouUrl = "' . esc_js($thank_you_url) . '";', 'before');
	}
	
	// Enqueue mobile menu script
	wp_enqueue_script('theme-mobile-menu', get_stylesheet_directory_uri() . '/assets/js/mobile-menu.js', [], $ver, true);
});

// Функция для проверки, нужно ли скрывать обычный header (для страниц с .page-top)
function theme_should_hide_default_header() {
	$template = get_page_template_slug();
	$templates_with_page_top = ['page-contacts.php'];
	
	if (in_array($template, $templates_with_page_top)) {
		return true;
	}
	
	// Можно добавить проверку по классу body или другим условиям
	$body_classes = get_body_class();
	if (in_array('page-has-top', $body_classes)) {
		return true;
	}
	
	return false;
}

// Функция для получения ссылки на страницу по шаблону
function get_page_url_by_template($template_name) {
	if (!function_exists('get_pages')) {
		return '#';
	}
	
	// Сначала ищем по meta_key (шаблон)
	$pages = get_pages([
		'meta_key' => '_wp_page_template',
		'meta_value' => $template_name,
		'number' => 1,
		'post_status' => 'publish'
	]);
	
	if (!empty($pages) && isset($pages[0]->ID)) {
		return get_permalink($pages[0]->ID);
	}
	
	// Если не найдено, пробуем найти по slug (для совместимости)
	$template_slug = str_replace(['page-', '.php'], '', $template_name);
	$page = get_page_by_path($template_slug);
	if ($page && $page->post_status === 'publish') {
		return get_permalink($page->ID);
	}
	
	return '#';
}

// Редирект после отправки Contact Form 7 на страницу благодарности
// Используем JavaScript редирект через событие wpcf7mailsent для корректной работы с AJAX
// Серверный редирект убран, так как он конфликтует с AJAX отправкой CF7

// Исключение из sitemap: пользователи (users)
add_filter('wp_sitemaps_add_provider', function($provider, $name) {
	if ($name === 'users') {
		return false;
	}
	return $provider;
}, 10, 2);

// Исключение из sitemap: post types reviews и case
add_filter('wp_sitemaps_post_types', function($post_types) {
	$excluded_types = ['reviews', 'case'];
	
	foreach ($excluded_types as $type) {
		if (isset($post_types[$type])) {
			unset($post_types[$type]);
		}
	}
	
	return $post_types;
});

// SEO meta description for services
add_action('wp_head', function() {
	if (!is_singular('service')) {
		return;
	}
	
	$post_id = get_queried_object_id();
	$meta_description = get_post_meta($post_id, '_service_meta_description', true);
	
	// Если поле пустое, используем автоматический шаблон
	if (empty($meta_description)) {
		$service_title = get_the_title($post_id);
		$meta_description = $service_title . ' в стоматологической клинике в Москве. Цены, этапы лечения, показания. Запись на консультацию.';
	}
	
	// Обрезаем до 160 символов
	if (mb_strlen($meta_description) > 160) {
		$meta_description = mb_substr($meta_description, 0, 157) . '...';
	}
	
	if (!empty($meta_description)) {
		echo '<meta name="description" content="' . esc_attr($meta_description) . '" />' . "\n";
	}
}, 1);

// Кастомный title для страниц
add_filter('document_title_separator', function($separator) {
	return '|';
});

add_filter('document_title_parts', function($title_parts) {
	$site_name = 'Стоматологическая клиника Елены Мокренко';
	
	// Главная страница
	if (is_front_page()) {
		$title_parts['title'] = $site_name;
		$title_parts['site'] = '';
		return $title_parts;
	}
	
	// Для услуг (post type service)
	if (is_singular('service')) {
		$service_title = get_the_title();
		$title_parts['title'] = $service_title . ' в Москве';
		$title_parts['site'] = $site_name;
		return $title_parts;
	}
	
	// Статьи в блоге (обычные посты)
	if (is_single() && get_post_type() === 'post') {
		$post_title = get_the_title();
		$title_parts['title'] = $post_title;
		$title_parts['site'] = $site_name;
		return $title_parts;
	}
	
	// Для типовых страниц (pages)
	if (is_page()) {
		$page_title = get_the_title();
		$title_parts['title'] = $page_title;
		$title_parts['site'] = $site_name;
		return $title_parts;
	}
	
	// Для остальных страниц тоже добавляем название сайта
	if (!isset($title_parts['site']) || empty($title_parts['site'])) {
		$title_parts['site'] = $site_name;
	}
	
	return $title_parts;
});