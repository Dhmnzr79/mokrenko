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

// Подключение админских скриптов и стилей
add_action('admin_enqueue_scripts', 'theme_admin_scripts');
function theme_admin_scripts($hook) {
    global $post_type;
    
    // Подключаем только на страницах врачей и кейсов
    if (in_array($post_type, ['doctor', 'case']) && in_array($hook, ['post.php', 'post-new.php'])) {
        wp_enqueue_media();
        wp_enqueue_script('theme-admin-cases-doctors', get_stylesheet_directory_uri() . '/assets/admin/admin-cases-doctors.js', ['jquery'], wp_get_theme()->get('Version'), true);
        wp_enqueue_style('theme-admin-cases-doctors', get_stylesheet_directory_uri() . '/assets/admin/admin-cases-doctors.css', [], wp_get_theme()->get('Version'));
        
        // Локализация для JS
        wp_localize_script('theme-admin-cases-doctors', 'theme_admin', [
            'strings' => [
                'year' => __('Год', 'mokrenko'),
                'desc' => __('Описание', 'mokrenko'),
                'remove' => __('Удалить', 'mokrenko'),
                'select' => __('Выбрать', 'mokrenko'),
                'selectCerts' => __('Выберите сертификаты', 'mokrenko'),
                'selectBeforeImage' => __('Выберите фото "До"', 'mokrenko'),
                'selectAfterImage' => __('Выберите фото "После"', 'mokrenko')
            ]
        ]);
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
	
	if (is_page(['about', 'reviews', 'contacts', 'team', 'prices', 'doctors', 'o-klinike', 'otzyvy', 'kontakty', 'komanda', 'tseny', 'vrachi']) || is_page_template('page-about.php') || is_page_template('page-reviews.php') || is_page_template('page-contacts.php') || is_page_template('page-prices.php') || is_page_template('page-doctors.php') || is_page_template('page-blog.php') || is_single()) {
		wp_enqueue_style('page-inner', $uri.'pages/inner.css', ['theme-utilities'], $ver);
		wp_enqueue_style('page-home', $uri.'pages/home.css', ['theme-utilities'], $ver);
		wp_enqueue_script('theme-lightbox', get_stylesheet_directory_uri() . '/assets/js/lightbox.js', [], $ver, true);
		wp_enqueue_script('theme-slider', get_stylesheet_directory_uri() . '/assets/js/slider.js', [], $ver, true);
	}
	
	if (is_page_template('page-blog.php') || is_single()) {
		wp_enqueue_style('page-blog', $uri.'pages/blog.css', ['theme-utilities'], $ver);
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
	
	// Enqueue popup script
	wp_enqueue_script('theme-popup', get_stylesheet_directory_uri() . '/assets/js/popup.js', [], $ver, true);
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
	
	$pages = get_pages([
		'meta_key' => '_wp_page_template',
		'meta_value' => $template_name,
		'number' => 1
	]);
	
	if (!empty($pages) && isset($pages[0]->ID)) {
		return get_permalink($pages[0]->ID);
	}
	
	return '#';
}