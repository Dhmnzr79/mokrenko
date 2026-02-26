<?php
/**
 * Импорт услуг из JSON по схеме из service.md
 *
 * Страница: «Инструменты → Импорт услуг»
 * Поддерживаются два формата:
 * - один объект услуги { ... }
 * - объект с массивом услуг { "services": [ { ... }, ... ] }
 */

// Добавляем страницу импорта в раздел «Инструменты»
add_action('admin_menu', 'mok_service_import_add_page');

function mok_service_import_add_page() {
	add_submenu_page(
		'tools.php',
		'Импорт услуг',
		'Импорт услуг',
		'manage_options',
		'mok_service_import',
		'mok_service_import_render_page'
	);
}

/**
 * Рендер страницы импорта услуг
 */
function mok_service_import_render_page() {
	if (!current_user_can('manage_options')) {
		return;
	}

	$result = null;

	if (isset($_POST['mok_service_import_submit']) && isset($_FILES['mok_service_json'])) {
		$result = mok_service_process_import();
	}

	?>
	<div class="wrap">
		<h1>Импорт услуг из JSON</h1>

		<?php if ($result !== null) : ?>
			<?php if (!empty($result['success'])) : ?>
				<div class="notice notice-success is-dismissible">
					<p><strong>Импорт завершён успешно.</strong></p>
					<ul>
						<li>Создано услуг: <?php echo esc_html((string) ($result['created'] ?? 0)); ?></li>
						<li>Обновлено услуг: <?php echo esc_html((string) ($result['updated'] ?? 0)); ?></li>
						<li>Пропущено записей: <?php echo esc_html((string) ($result['skipped'] ?? 0)); ?></li>
					</ul>
				</div>
			<?php else : ?>
				<div class="notice notice-error is-dismissible">
					<p><strong>Ошибка импорта:</strong> <?php echo esc_html((string) ($result['message'] ?? '')); ?></p>
				</div>
			<?php endif; ?>
		<?php endif; ?>

		<div class="card">
			<h2>Загрузить JSON-файл с услугами</h2>
			<p>Формат файла описан в <code>service.md</code>. Поддерживается один объект услуги или объект с полем <code>services</code>, содержащим массив услуг.</p>

			<form method="post" enctype="multipart/form-data">
				<?php wp_nonce_field('mok_service_import_action', 'mok_service_import_nonce'); ?>

				<table class="form-table">
					<tr>
						<th scope="row">
							<label for="mok_service_json">JSON-файл</label>
						</th>
						<td>
							<input type="file" name="mok_service_json" id="mok_service_json" accept=".json,application/json" required>
							<p class="description">Выберите JSON-файл c описанием услуги или набора услуг.</p>
						</td>
					</tr>
				</table>

				<p class="submit">
					<input type="submit" name="mok_service_import_submit" class="button button-primary" value="Импортировать услуги">
				</p>
			</form>
		</div>
	</div>
	<?php
}

/**
 * Обработка импорта JSON-файла
 *
 * @return array{success:bool,message?:string,created?:int,updated?:int,skipped?:int}
 */
function mok_service_process_import() {
	if (!isset($_POST['mok_service_import_nonce']) || !wp_verify_nonce($_POST['mok_service_import_nonce'], 'mok_service_import_action')) {
		return [
			'success' => false,
			'message' => 'Ошибка безопасности. Обновите страницу и попробуйте снова.',
		];
	}

	if (!current_user_can('manage_options')) {
		return [
			'success' => false,
			'message' => 'Недостаточно прав для выполнения импорта.',
		];
	}

	if (!isset($_FILES['mok_service_json']) || $_FILES['mok_service_json']['error'] !== UPLOAD_ERR_OK) {
		return [
			'success' => false,
			'message' => 'Ошибка загрузки файла. Проверьте, что файл выбран и не превышает максимальный размер.',
		];
	}

	$file = $_FILES['mok_service_json'];

	// Простая проверка расширения
	$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
	if ($ext !== 'json') {
		return [
			'success' => false,
			'message' => 'Неверный формат файла. Требуется JSON-файл.',
		];
	}

	$contents = file_get_contents($file['tmp_name']);
	if ($contents === false || $contents === '') {
		return [
			'success' => false,
			'message' => 'Не удалось прочитать содержимое файла.',
		];
	}

	$data = json_decode($contents, true);
	if (!is_array($data)) {
		return [
			'success' => false,
			'message' => 'JSON не распознан. Проверьте синтаксис файла.',
		];
	}

	$services = [];

	// Формат { "services": [ { ... }, ... ] }
	if (isset($data['services']) && is_array($data['services'])) {
		$services = $data['services'];
	} else {
		// Либо один объект услуги, либо массив объектов услуг
		if (isset($data[0]) && is_array($data[0])) {
			$services = $data;
		} else {
			$services = [$data];
		}
	}

	$created = 0;
	$updated = 0;
	$skipped = 0;

	foreach ($services as $service_data) {
		if (!is_array($service_data)) {
			$skipped++;
			continue;
		}

		$result = mok_service_import_single($service_data);
		if ($result === 'created') {
			$created++;
		} elseif ($result === 'updated') {
			$updated++;
		} else {
			$skipped++;
		}
	}

	return [
		'success' => true,
		'created' => $created,
		'updated' => $updated,
		'skipped' => $skipped,
	];
}

/**
 * Импорт одной услуги по данным JSON
 *
 * @param array $data
 * @return 'created'|'updated'|'skipped'
 */
function mok_service_import_single(array $data) {
	$slug = isset($data['slug']) ? sanitize_title((string) $data['slug']) : '';
	if ($slug === '') {
		return 'skipped';
	}

	$title = isset($data['title']) ? sanitize_text_field((string) $data['title']) : '';
	$excerpt = isset($data['excerpt']) ? sanitize_textarea_field((string) $data['excerpt']) : '';

	// Ищем существующую услугу по slug
	$existing = get_page_by_path($slug, OBJECT, 'service');

	$post_args = [
		'post_type'   => 'service',
		'post_status' => 'publish',
		'post_title'  => $title,
		'post_name'   => $slug,
		'post_excerpt'=> $excerpt,
	];

	if ($existing && $existing instanceof WP_Post) {
		$post_args['ID'] = $existing->ID;
		$post_id = wp_update_post($post_args, true);
		$action = 'updated';
	} else {
		$post_id = wp_insert_post($post_args, true);
		$action = 'created';
	}

	if (is_wp_error($post_id) || !$post_id) {
		return 'skipped';
	}

	$post_id = (int) $post_id;

	// Таксономия service_category
	if (isset($data['service_category']) && is_array($data['service_category'])) {
		$terms = [];
		foreach ($data['service_category'] as $term_slug) {
			$term_slug = sanitize_title((string) $term_slug);
			if ($term_slug === '') {
				continue;
			}
			$terms[] = $term_slug;
		}
		if (!empty($terms)) {
			wp_set_object_terms($post_id, $terms, 'service_category');
		}
	}

	// HERO
	$hero = isset($data['hero']) && is_array($data['hero']) ? $data['hero'] : [];
	update_post_meta($post_id, '_service_hero_title', isset($hero['title']) ? sanitize_text_field((string) $hero['title']) : '');
	update_post_meta($post_id, '_service_hero_subtitle', isset($hero['subtitle']) ? sanitize_textarea_field((string) $hero['subtitle']) : '');
	update_post_meta($post_id, '_service_hero_extra_line', isset($hero['extra_line']) ? sanitize_text_field((string) $hero['extra_line']) : '');
	update_post_meta($post_id, '_service_hero_button_text', isset($hero['button_text']) ? sanitize_text_field((string) $hero['button_text']) : '');
	update_post_meta($post_id, '_service_hero_info_text', isset($hero['button_note']) ? sanitize_textarea_field((string) $hero['button_note']) : '');

	$hero_benefits = [];
	if (isset($hero['benefits']) && is_array($hero['benefits'])) {
		foreach ($hero['benefits'] as $benefit_text) {
			$benefit_text = trim((string) $benefit_text);
			if ($benefit_text === '') {
				continue;
			}
			$hero_benefits[] = [
				'icon' => 0,
				'text' => sanitize_text_field($benefit_text),
			];
		}
	}
	update_post_meta($post_id, '_service_hero_benefits', $hero_benefits);

	// BENEFITS
	$benefits = isset($data['benefits']) && is_array($data['benefits']) ? $data['benefits'] : [];
	$benefits_icon_id = 0;
	if (!empty($benefits['icon_url']) && is_string($benefits['icon_url'])) {
		$benefits_icon_id = mok_service_import_get_attachment_id_by_url($benefits['icon_url']);
	}

	$benefits_items_meta = [];
	if (isset($benefits['items']) && is_array($benefits['items'])) {
		foreach ($benefits['items'] as $item) {
			if (!is_array($item)) {
				continue;
			}
			$item_title = isset($item['title']) ? sanitize_text_field((string) $item['title']) : '';
			$item_text  = isset($item['text']) ? sanitize_textarea_field((string) $item['text']) : '';
			if ($item_title === '' && $item_text === '') {
				continue;
			}
			$benefits_items_meta[] = [
				'icon'  => $benefits_icon_id,
				'title' => $item_title,
				'text'  => $item_text,
			];
		}
	}
	update_post_meta($post_id, '_service_benefits_items', $benefits_items_meta);

	// CLINIC BENEFITS
	$clinic = isset($data['clinic_benefits']) && is_array($data['clinic_benefits']) ? $data['clinic_benefits'] : [];
	update_post_meta($post_id, '_service_clinic_benefits_title', isset($clinic['title']) ? sanitize_text_field((string) $clinic['title']) : '');
	update_post_meta($post_id, '_service_clinic_benefits_subtitle', isset($clinic['subtitle']) ? sanitize_textarea_field((string) $clinic['subtitle']) : '');

	$clinic_cards_meta = [];
	if (isset($clinic['left_cards']) && is_array($clinic['left_cards'])) {
		foreach ($clinic['left_cards'] as $card) {
			if (!is_array($card)) {
				continue;
			}
			$card_title = isset($card['title']) ? sanitize_text_field((string) $card['title']) : '';
			$card_text  = isset($card['text']) ? sanitize_textarea_field((string) $card['text']) : '';
			if ($card_title === '' && $card_text === '') {
				continue;
			}
			$clinic_cards_meta[] = [
				'icon'  => 0,
				'title' => $card_title,
				'text'  => $card_text,
			];
		}
	}
	update_post_meta($post_id, '_service_clinic_benefits_cards', $clinic_cards_meta);

	$feature_card = isset($clinic['feature_card']) && is_array($clinic['feature_card']) ? $clinic['feature_card'] : [];
	$feature_icon_id = 0;
	if (!empty($feature_card['icon_url']) && is_string($feature_card['icon_url'])) {
		$feature_icon_id = mok_service_import_get_attachment_id_by_url($feature_card['icon_url']);
	}
	$feature_meta = [
		'title'       => isset($feature_card['title']) ? sanitize_text_field((string) $feature_card['title']) : '',
		'text'        => isset($feature_card['text']) ? sanitize_textarea_field((string) $feature_card['text']) : '',
		'button_text' => isset($feature_card['cta']) ? sanitize_text_field((string) $feature_card['cta']) : '',
		'button_link' => '',
		'icon'        => $feature_icon_id,
	];
	update_post_meta($post_id, '_service_clinic_benefits_feature_card', $feature_meta);

	// CTA
	$cta = isset($data['cta']) && is_array($data['cta']) ? $data['cta'] : [];
	update_post_meta($post_id, '_service_cta_title', isset($cta['title']) ? sanitize_text_field((string) $cta['title']) : '');
	update_post_meta($post_id, '_service_cta_subtitle', isset($cta['subtitle']) ? sanitize_textarea_field((string) $cta['subtitle']) : '');

	$cta_cards_meta = [];
	if (isset($cta['bullets']) && is_array($cta['bullets'])) {
		foreach ($cta['bullets'] as $bullet) {
			$text = trim((string) $bullet);
			if ($text === '') {
				continue;
			}
			$cta_cards_meta[] = [
				'text' => sanitize_text_field($text),
			];
		}
	}
	update_post_meta($post_id, '_service_cta_cards', $cta_cards_meta);

	// WORK STAGES
	$work = isset($data['work_stages']) && is_array($data['work_stages']) ? $data['work_stages'] : [];
	update_post_meta($post_id, '_service_work_stages_title', isset($work['title']) ? sanitize_text_field((string) $work['title']) : '');
	update_post_meta($post_id, '_service_work_stages_subtitle', isset($work['subtitle']) ? sanitize_textarea_field((string) $work['subtitle']) : '');

	$stage_1_meta = [
		'title'     => '',
		'image'     => 0,
		'checklist' => [],
	];
	if (isset($work['stage_1']) && is_array($work['stage_1'])) {
		$stage_1_meta['title'] = isset($work['stage_1']['title']) ? sanitize_text_field((string) $work['stage_1']['title']) : '';
		if (isset($work['stage_1']['checklist']) && is_array($work['stage_1']['checklist'])) {
			foreach ($work['stage_1']['checklist'] as $item) {
				if (!is_array($item)) {
					continue;
				}
				$item_title = isset($item['title']) ? sanitize_text_field((string) $item['title']) : '';
				$item_desc  = isset($item['description']) ? sanitize_textarea_field((string) $item['description']) : '';
				if ($item_title === '' && $item_desc === '') {
					continue;
				}
				$stage_1_meta['checklist'][] = [
					'title'       => $item_title,
					'description' => $item_desc,
				];
			}
		}
	}
	update_post_meta($post_id, '_service_work_stages_stage_1', $stage_1_meta);

	$stage_2_meta = [
		'title'     => '',
		'image'     => 0,
		'checklist' => [],
	];
	if (isset($work['stage_2']) && is_array($work['stage_2'])) {
		$stage_2_meta['title'] = isset($work['stage_2']['title']) ? sanitize_text_field((string) $work['stage_2']['title']) : '';
		if (isset($work['stage_2']['checklist']) && is_array($work['stage_2']['checklist'])) {
			foreach ($work['stage_2']['checklist'] as $item) {
				if (!is_array($item)) {
					continue;
				}
				$item_title = isset($item['title']) ? sanitize_text_field((string) $item['title']) : '';
				$item_desc  = isset($item['description']) ? sanitize_textarea_field((string) $item['description']) : '';
				if ($item_title === '' && $item_desc === '') {
					continue;
				}
				$stage_2_meta['checklist'][] = [
					'title'       => $item_title,
					'description' => $item_desc,
				];
			}
		}
	}
	update_post_meta($post_id, '_service_work_stages_stage_2', $stage_2_meta);

	// WHAT INCLUDED
	$what = isset($data['what_included']) && is_array($data['what_included']) ? $data['what_included'] : [];
	update_post_meta($post_id, '_service_what_included_title', isset($what['title']) ? sanitize_text_field((string) $what['title']) : '');

	$what_items_meta = [];
	if (isset($what['items']) && is_array($what['items'])) {
		foreach ($what['items'] as $item) {
			if (!is_array($item)) {
				continue;
			}
			$item_title = isset($item['title']) ? sanitize_text_field((string) $item['title']) : '';
			$item_desc  = isset($item['description']) ? sanitize_textarea_field((string) $item['description']) : '';
			if ($item_title === '' && $item_desc === '') {
				continue;
			}
			$what_items_meta[] = [
				'title'       => $item_title,
				'description' => $item_desc,
			];
		}
	}
	update_post_meta($post_id, '_service_what_included_items', $what_items_meta);

	// INFO BLOCKS
	$info_blocks_meta = [];
	if (isset($data['info_blocks']) && is_array($data['info_blocks'])) {
		foreach ($data['info_blocks'] as $block) {
			if (!is_array($block)) {
				continue;
			}
			$block_title    = isset($block['title']) ? sanitize_text_field((string) $block['title']) : '';
			$block_subtitle = isset($block['subtitle']) ? sanitize_textarea_field((string) $block['subtitle']) : '';
			$items_raw      = isset($block['items']) && is_array($block['items']) ? $block['items'] : [];

			$items_meta = [];
			foreach ($items_raw as $text) {
				$text = trim((string) $text);
				if ($text === '') {
					continue;
				}
				$items_meta[] = [
					'text' => sanitize_text_field($text),
				];
			}

			if ($block_title === '' && $block_subtitle === '' && empty($items_meta)) {
				continue;
			}

			$info_blocks_meta[] = [
				'image'       => 0,
				'reverse'     => 0,
				'position'    => 'after_what-included',
				'title'       => $block_title,
				'subtitle'    => $block_subtitle,
				'footer_text' => '',
				'button_text' => '',
				'button_link' => '',
				'items'       => $items_meta,
			];
		}
	}
	update_post_meta($post_id, '_service_info_blocks_blocks', $info_blocks_meta);

	// CTA-2
	$cta2 = isset($data['cta_2']) && is_array($data['cta_2']) ? $data['cta_2'] : [];
	update_post_meta($post_id, '_service_cta_2_title', isset($cta2['title']) ? sanitize_text_field((string) $cta2['title']) : '');
	update_post_meta($post_id, '_service_cta_2_subtitle', isset($cta2['subtitle']) ? sanitize_textarea_field((string) $cta2['subtitle']) : '');
	update_post_meta($post_id, '_service_cta_2_button_text', isset($cta2['button_text']) ? sanitize_text_field((string) $cta2['button_text']) : '');
	update_post_meta($post_id, '_service_cta_2_button_link', isset($cta2['button_link']) ? esc_url_raw((string) $cta2['button_link']) : '');

	// INDICATIONS
	$indications = isset($data['indications']) && is_array($data['indications']) ? $data['indications'] : [];
	update_post_meta($post_id, '_service_indications_left_title', isset($indications['left_title']) ? sanitize_text_field((string) $indications['left_title']) : '');
	update_post_meta($post_id, '_service_indications_right_title', isset($indications['right_title']) ? sanitize_text_field((string) $indications['right_title']) : '');

	$left_items = [];
	if (isset($indications['left_items']) && is_array($indications['left_items'])) {
		foreach ($indications['left_items'] as $text) {
			$text = trim((string) $text);
			if ($text === '') {
				continue;
			}
			$left_items[] = sanitize_text_field($text);
		}
	}
	update_post_meta($post_id, '_service_indications_left_items', $left_items);

	$right_items = [];
	if (isset($indications['right_items']) && is_array($indications['right_items'])) {
		foreach ($indications['right_items'] as $text) {
			$text = trim((string) $text);
			if ($text === '') {
				continue;
			}
			$right_items[] = sanitize_text_field($text);
		}
	}
	update_post_meta($post_id, '_service_indications_right_items', $right_items);

	// SEO
	$seo = isset($data['seo']) && is_array($data['seo']) ? $data['seo'] : [];
	update_post_meta($post_id, '_service_meta_description', isset($seo['meta_description']) ? sanitize_textarea_field((string) $seo['meta_description']) : '');

	// Включённые секции по умолчанию
	$sections_enabled = [
		'hero',
		'benefits',
		'clinic-benefits',
		'cta',
		'work-stages',
		'what-included',
		'info-blocks',
		'cta-2',
		'indications',
	];
	update_post_meta($post_id, '_service_sections_enabled', $sections_enabled);

	return $action;
}

/**
 * Получение ID вложения по его URL
 *
 * @param string $url
 * @return int
 */
function mok_service_import_get_attachment_id_by_url($url) {
	$url = trim((string) $url);
	if ($url === '') {
		return 0;
	}

	if (!function_exists('attachment_url_to_postid')) {
		return 0;
	}

	$attachment_id = attachment_url_to_postid($url);
	if (!$attachment_id) {
		return 0;
	}

	return (int) $attachment_id;
}

