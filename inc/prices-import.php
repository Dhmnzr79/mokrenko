<?php
/**
 * Система импорта прайса услуг из CSV
 * 
 * Функционал:
 * - Кастомный тип записей price_item
 * - Таксономия price_category
 * - Админ-страница для импорта CSV
 * - Shortcode для вывода прайса
 */

// Разделитель CSV (можно изменить на запятую для английского Excel)
define('PRICE_CSV_DELIMITER', ';');

/**
 * Регистрация кастомного типа записей и таксономии
 */
add_action('init', 'register_price_post_type_and_taxonomy');

function register_price_post_type_and_taxonomy() {
	// Регистрация кастомного типа записей price_item
	register_post_type('price_item', [
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_icon' => 'dashicons-money-alt',
		'menu_position' => 25,
		'labels' => [
			'name' => 'Услуги прайса',
			'singular_name' => 'Услуга прайса',
			'add_new' => 'Добавить услугу',
			'add_new_item' => 'Добавить новую услугу',
			'edit_item' => 'Редактировать услугу',
			'new_item' => 'Новая услуга',
			'view_item' => 'Просмотреть услугу',
			'search_items' => 'Искать услуги',
			'not_found' => 'Услуги не найдены',
			'not_found_in_trash' => 'В корзине услуг не найдено',
		],
		'supports' => ['title'],
		'has_archive' => false,
		'rewrite' => false,
	]);

	// Регистрация таксономии price_category
	register_taxonomy('price_category', 'price_item', [
		'hierarchical' => true,
		'public' => false,
		'show_ui' => true,
		'show_admin_column' => true,
		'labels' => [
			'name' => 'Категории прайса',
			'singular_name' => 'Категория прайса',
			'search_items' => 'Искать категории',
			'all_items' => 'Все категории',
			'edit_item' => 'Редактировать категорию',
			'update_item' => 'Обновить категорию',
			'add_new_item' => 'Добавить новую категорию',
			'new_item_name' => 'Название новой категории',
			'menu_name' => 'Категории',
		],
		'rewrite' => false,
	]);
}

/**
 * Добавление страницы импорта в админ-меню
 */
add_action('admin_menu', 'add_price_import_page');

function add_price_import_page() {
	add_submenu_page(
		'tools.php',
		'Импорт прайса',
		'Импорт прайса',
		'manage_options',
		'clinic_price_import',
		'render_price_import_page'
	);
}

/**
 * Рендер страницы импорта прайса
 */
function render_price_import_page() {
	// Обработка формы импорта
	if (isset($_POST['import_prices']) && isset($_FILES['csv_file'])) {
		$result = process_price_import();
	}

	?>
	<div class="wrap">
		<h1>Импорт прайса услуг</h1>
		
		<?php if (isset($result)) : ?>
			<?php if ($result['success']) : ?>
				<div class="notice notice-success is-dismissible">
					<p><strong>Импорт завершён успешно!</strong></p>
					<ul>
						<li>Создано записей: <?php echo esc_html($result['created']); ?></li>
						<li>Обновлено записей: <?php echo esc_html($result['updated']); ?></li>
						<li>Пропущено строк: <?php echo esc_html($result['skipped']); ?></li>
						<?php if (isset($result['deleted']) && $result['deleted'] > 0) : ?>
							<li>Удалено старых записей: <?php echo esc_html($result['deleted']); ?></li>
						<?php endif; ?>
					</ul>
				</div>
			<?php else : ?>
				<div class="notice notice-error is-dismissible">
					<p><strong>Ошибка импорта:</strong> <?php echo esc_html($result['message']); ?></p>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<div class="card">
			<h2>Загрузить CSV-файл с прайсом</h2>
			<p>Формат CSV-файла: <code>category;service;price;old_price</code></p>
			<p>Разделитель: точка с запятой (<code>;</code>). Первая строка — заголовки.</p>
			
			<form method="post" enctype="multipart/form-data">
				<?php wp_nonce_field('price_import_action', 'price_import_nonce'); ?>
				
				<table class="form-table">
					<tr>
						<th scope="row">
							<label for="csv_file">CSV-файл</label>
						</th>
						<td>
							<input type="file" name="csv_file" id="csv_file" accept=".csv" required>
							<p class="description">Выберите CSV-файл с прайсом услуг.</p>
						</td>
					</tr>
				</table>
				
				<p class="submit">
					<input type="submit" name="import_prices" class="button button-primary" value="Импортировать прайс">
				</p>
			</form>
		</div>

		<div class="card" style="margin-top: 20px;">
			<h2>Пример CSV-файла</h2>
			<pre style="background: #f5f5f5; padding: 15px; overflow-x: auto;">category;service;price;old_price
Имплантация зубов;Операция по установке винтового имплантата Osstem (Южная Корея);19500 руб.;52000
Имплантация зубов;Операция по установке винтового имплантата Nobel Biocare (Швейцария);65000 руб.;80000
Лечение;Восстановление центральных зубов высокоэстетичным композитом (1 поверхность);7 500 руб.;
Хирургия;Удаление постоянного зуба (простое);3 570 руб.;</pre>
		</div>
	</div>
	<?php
}

/**
 * Обработка импорта CSV-файла
 */
function process_price_import() {
	// Проверка nonce
	if (!isset($_POST['price_import_nonce']) || !wp_verify_nonce($_POST['price_import_nonce'], 'price_import_action')) {
		return [
			'success' => false,
			'message' => 'Ошибка безопасности. Обновите страницу и попробуйте снова.',
		];
	}

	// Проверка прав
	if (!current_user_can('manage_options')) {
		return [
			'success' => false,
			'message' => 'Недостаточно прав для выполнения этой операции.',
		];
	}

	// Проверка загрузки файла
	if (!isset($_FILES['csv_file']) || $_FILES['csv_file']['error'] !== UPLOAD_ERR_OK) {
		return [
			'success' => false,
			'message' => 'Ошибка загрузки файла. Проверьте, что файл выбран и не превышает максимальный размер.',
		];
	}

	$file = $_FILES['csv_file'];
	
	// Проверка расширения
	$file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
	if ($file_ext !== 'csv') {
		return [
			'success' => false,
			'message' => 'Неверный формат файла. Требуется CSV-файл.',
		];
	}

	// Проверка MIME-типа
	$allowed_mimes = ['text/csv', 'text/plain', 'application/csv', 'application/vnd.ms-excel'];
	if (!in_array($file['type'], $allowed_mimes) && $file['type'] !== '') {
		return [
			'success' => false,
			'message' => 'Неверный MIME-тип файла.',
		];
	}

	// Открытие файла
	$handle = fopen($file['tmp_name'], 'r');
	if ($handle === false) {
		return [
			'success' => false,
			'message' => 'Не удалось открыть файл для чтения.',
		];
	}

	// Счётчики
	$created = 0;
	$updated = 0;
	$skipped = 0;
	$deleted = 0;
	$line_number = 0;
	
	// Массив ID записей, которые есть в новом CSV (для удаления старых)
	$imported_post_ids = [];

	// Чтение заголовков (первая строка)
	$headers = fgetcsv($handle, 0, PRICE_CSV_DELIMITER);
	$line_number++;

	if (!$headers || count($headers) < 3) {
		fclose($handle);
		return [
			'success' => false,
			'message' => 'Неверный формат CSV. Ожидаются колонки: category, service, price, old_price',
		];
	}

	// Нормализация заголовков (убираем пробелы, приводим к нижнему регистру)
	$headers = array_map('trim', $headers);
	$headers = array_map('strtolower', $headers);

	// Поиск индексов колонок
	$category_index = array_search('category', $headers);
	$service_index = array_search('service', $headers);
	$price_index = array_search('price', $headers);
	$old_price_index = array_search('old_price', $headers);

	if ($category_index === false || $service_index === false || $price_index === false) {
		fclose($handle);
		return [
			'success' => false,
			'message' => 'Не найдены обязательные колонки: category, service, price',
		];
	}

	// Обработка каждой строки
	while (($row = fgetcsv($handle, 0, PRICE_CSV_DELIMITER)) !== false) {
		$line_number++;

		// Пропуск пустых строк
		if (count($row) < 3) {
			$skipped++;
			continue;
		}

		// Получение значений с обрезкой пробелов
		$category = isset($row[$category_index]) ? trim($row[$category_index]) : '';
		$service = isset($row[$service_index]) ? trim($row[$service_index]) : '';
		$price = isset($row[$price_index]) ? trim($row[$price_index]) : '';
		$old_price = ($old_price_index !== false && isset($row[$old_price_index])) ? trim($row[$old_price_index]) : '';

		// Пропуск строк с пустым названием услуги
		if (empty($service)) {
			$skipped++;
			continue;
		}

		// Пропуск строк с пустой категорией
		if (empty($category)) {
			$skipped++;
			continue;
		}

		// Находим или создаём категорию
		$term = get_term_by('name', $category, 'price_category');
		if (!$term) {
			$term_result = wp_insert_term($category, 'price_category');
			if (is_wp_error($term_result)) {
				$skipped++;
				continue;
			}
			$term_id = $term_result['term_id'];
		} else {
			$term_id = $term->term_id;
		}

		// Поиск существующей услуги по точному совпадению title и категории
		$existing_post = null;
		$query = new WP_Query([
			'post_type' => 'price_item',
			'post_status' => 'any',
			'posts_per_page' => -1,
			'tax_query' => [
				[
					'taxonomy' => 'price_category',
					'field' => 'term_id',
					'terms' => $term_id,
				],
			],
		]);

		// Ищем точное совпадение по заголовку
		foreach ($query->posts as $post) {
			if ($post->post_title === $service) {
				$existing_post = $post;
				break;
			}
		}
		wp_reset_postdata();

		// Обновление или создание записи
		if ($existing_post) {
			// Обновление существующей записи
			wp_update_post([
				'ID' => $existing_post->ID,
				'post_title' => $service,
				'post_status' => 'publish', // Убеждаемся, что статус publish
			]);

			// Обновление мета-полей
			update_post_meta($existing_post->ID, '_price', $price);
			if (!empty($old_price)) {
				update_post_meta($existing_post->ID, '_old_price', $old_price);
			} else {
				delete_post_meta($existing_post->ID, '_old_price');
			}

			// Обновление категории
			wp_set_object_terms($existing_post->ID, [$term_id], 'price_category');

			$updated++;
			$imported_post_ids[] = $existing_post->ID;
		} else {
			// Создание новой записи
			$post_id = wp_insert_post([
				'post_type' => 'price_item',
				'post_title' => $service,
				'post_status' => 'publish',
			]);

			if (is_wp_error($post_id) || $post_id === 0) {
				$skipped++;
				continue;
			}

			// Привязка категории
			wp_set_object_terms($post_id, [$term_id], 'price_category');

			// Сохранение мета-полей
			update_post_meta($post_id, '_price', $price);
			if (!empty($old_price)) {
				update_post_meta($post_id, '_old_price', $old_price);
			}

			$created++;
			$imported_post_ids[] = $post_id;
		}
	}

	fclose($handle);

	// Удаляем старые записи, которых нет в новом CSV
	if (!empty($imported_post_ids)) {
		// Получаем все записи price_item
		$all_posts = new WP_Query([
			'post_type' => 'price_item',
			'post_status' => 'any',
			'posts_per_page' => -1,
			'fields' => 'ids', // Получаем только ID для экономии памяти
		]);

		foreach ($all_posts->posts as $post_id) {
			// Если записи нет в списке импортированных - удаляем
			if (!in_array($post_id, $imported_post_ids)) {
				wp_delete_post($post_id, true); // true = удалить навсегда, не в корзину
				$deleted++;
			}
		}
		wp_reset_postdata();
	}

	return [
		'success' => true,
		'created' => $created,
		'updated' => $updated,
		'skipped' => $skipped,
		'deleted' => $deleted,
	];
}

/**
 * Функция форматирования цены
 * Извлекает число из строки, форматирует с пробелами между тысячами и добавляет " руб."
 * 
 * @param string $price_raw Сырая строка с ценой (может быть "15800", "15800 руб.", "15 800 руб." и т.д.)
 * @return string Отформатированная цена (например: "15 800 руб.")
 */
function format_price($price_raw) {
	if (empty($price_raw)) {
		return '';
	}
	
	// Удаляем все пробелы и извлекаем только цифры
	$price_clean = preg_replace('/[^\d]/', '', $price_raw);
	
	// Если не нашли цифры, возвращаем исходную строку
	if (empty($price_clean)) {
		return $price_raw;
	}
	
	// Форматируем число с пробелами между тысячами
	$price_formatted = number_format((int)$price_clean, 0, '', ' ');
	
	// Добавляем " руб." в конце
	return $price_formatted . ' руб.';
}

/**
 * Регистрация shortcode для вывода прайса
 */
add_shortcode('clinic_prices', 'render_clinic_prices');

/**
 * Вывод прайса через shortcode
 */
function render_clinic_prices($atts) {
	// Проверяем, что таксономия зарегистрирована
	if (!taxonomy_exists('price_category')) {
		return '<p>Прайс временно недоступен. Таксономия не зарегистрирована.</p>';
	}

	// Получаем все категории, отсортированные по алфавиту
	// Используем hide_empty => false, чтобы показать все категории, даже если они пустые
	$categories = get_terms([
		'taxonomy' => 'price_category',
		'hide_empty' => false,
		'orderby' => 'name',
		'order' => 'ASC',
	]);

	// Проверка на ошибку
	if (is_wp_error($categories)) {
		return '<p>Ошибка загрузки прайса: ' . esc_html($categories->get_error_message()) . '</p>';
	}

	// Если категорий нет вообще
	if (empty($categories)) {
		return '<p>Прайс временно недоступен. Импортируйте данные через админку: <strong>Инструменты → Импорт прайса</strong></p>';
	}

	// Проверяем, есть ли хотя бы одна услуга в базе
	$check_services = new WP_Query([
		'post_type' => 'price_item',
		'post_status' => 'publish',
		'posts_per_page' => 1,
	]);
	
	if (!$check_services->have_posts()) {
		wp_reset_postdata();
		
		// Дополнительная проверка: может быть записи есть, но с другим статусом
		$check_any = new WP_Query([
			'post_type' => 'price_item',
			'post_status' => 'any',
			'posts_per_page' => 1,
		]);
		
		if ($check_any->have_posts()) {
			wp_reset_postdata();
			return '<p>Прайс временно недоступен. Обнаружены записи с неправильным статусом. Попробуйте импортировать данные снова через админку: <strong>Инструменты → Импорт прайса</strong></p>';
		}
		wp_reset_postdata();
		
		return '<p>Прайс временно недоступен. Импортируйте данные через админку: <strong>Инструменты → Импорт прайса</strong></p>';
	}
	wp_reset_postdata();

	ob_start();
	?>
	<div class="prices">
		<?php foreach ($categories as $category) : ?>
			<?php
			// Получаем все услуги в этой категории
			$services = new WP_Query([
				'post_type' => 'price_item',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'orderby' => 'title',
				'order' => 'ASC',
				'tax_query' => [
					[
						'taxonomy' => 'price_category',
						'field' => 'term_id',
						'terms' => $category->term_id,
					],
				],
			]);
			?>

			<?php if ($services->have_posts()) : ?>
				<div class="prices__category">
					<h3 class="prices__category-title"><?php echo esc_html($category->name); ?></h3>
					<div class="prices__list">
						<?php
						$post_count = 0;
						$total_posts = $services->post_count;
						?>
						<?php while ($services->have_posts()) : $services->the_post(); ?>
							<?php
							$post_count++;
							$price_raw = get_post_meta(get_the_ID(), '_price', true);
							$old_price_raw = get_post_meta(get_the_ID(), '_old_price', true);
							$has_discount = !empty($old_price_raw);
							$is_last = ($post_count === $total_posts);
							
							// Форматируем цены
							$price = format_price($price_raw);
							$old_price = !empty($old_price_raw) ? format_price($old_price_raw) : '';
							?>
							<div class="prices__item<?php echo $is_last ? ' prices__item--last' : ''; ?>">
								<div class="prices__service"><?php echo esc_html(get_the_title()); ?></div>
								<?php if ($has_discount) : ?>
									<div class="prices__price prices__price--discount">
										<div class="prices__price-old"><?php echo esc_html($old_price); ?></div>
										<div class="prices__price-new"><?php echo esc_html($price); ?></div>
									</div>
								<?php else : ?>
									<div class="prices__price"><?php echo esc_html($price); ?></div>
								<?php endif; ?>
							</div>
						<?php endwhile; ?>
					</div>
				</div>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>
		<?php endforeach; ?>
	</div>
	<?php
	return ob_get_clean();
}

