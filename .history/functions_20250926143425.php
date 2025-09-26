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

// Custom Post Types: Врачи и Кейсы
add_action('init', function(){
	// CPT: Врачи
	register_post_type('doctor', [
		'labels' => [
			'name' => 'Врачи',
			'singular_name' => 'Врач',
			'add_new' => 'Добавить врача',
			'add_new_item' => 'Добавить нового врача',
			'edit_item' => 'Редактировать врача',
			'new_item' => 'Новый врач',
			'view_item' => 'Просмотреть врача',
			'search_items' => 'Поиск врачей',
			'not_found' => 'Врачи не найдены',
			'not_found_in_trash' => 'В корзине врачей не найдено'
		],
		'public' => true,
		'has_archive' => true,
		'menu_icon' => 'dashicons-admin-users',
		'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
		'show_in_rest' => true,
		'rewrite' => ['slug' => 'doctors']
	]);

	// CPT: Кейсы портфолио
	register_post_type('case', [
		'labels' => [
			'name' => 'Кейсы',
			'singular_name' => 'Кейс',
			'add_new' => 'Добавить кейс',
			'add_new_item' => 'Добавить новый кейс',
			'edit_item' => 'Редактировать кейс',
			'new_item' => 'Новый кейс',
			'view_item' => 'Просмотреть кейс',
			'search_items' => 'Поиск кейсов',
			'not_found' => 'Кейсы не найдены',
			'not_found_in_trash' => 'В корзине кейсов не найдено'
		],
		'public' => true,
		'has_archive' => false,
		'menu_icon' => 'dashicons-portfolio',
		'supports' => ['title', 'editor', 'thumbnail'],
		'show_in_rest' => true
	]);

	// Таксономия: Специализация врачей
	register_taxonomy('specialty', 'doctor', [
		'labels' => [
			'name' => 'Специализации',
			'singular_name' => 'Специализация',
			'search_items' => 'Поиск специализаций',
			'all_items' => 'Все специализации',
			'edit_item' => 'Редактировать специализацию',
			'update_item' => 'Обновить специализацию',
			'add_new_item' => 'Добавить специализацию',
			'new_item_name' => 'Название специализации',
			'menu_name' => 'Специализации'
		],
		'hierarchical' => true,
		'public' => true,
		'show_in_rest' => true,
		'rewrite' => ['slug' => 'specialty']
	]);

	// Таксономия: Клиники/филиалы
	register_taxonomy('clinic', 'doctor', [
		'labels' => [
			'name' => 'Клиники',
			'singular_name' => 'Клиника',
			'search_items' => 'Поиск клиник',
			'all_items' => 'Все клиники',
			'edit_item' => 'Редактировать клинику',
			'update_item' => 'Обновить клинику',
			'add_new_item' => 'Добавить клинику',
			'new_item_name' => 'Название клиники',
			'menu_name' => 'Клиники'
		],
		'hierarchical' => false,
		'public' => true,
		'show_in_rest' => true,
		'rewrite' => ['slug' => 'clinic']
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
