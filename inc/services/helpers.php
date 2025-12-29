<?php
/**
 * Helper-функции для работы с услугами
 */

/**
 * Загружает все meta-данные услуги одним запросом
 * 
 * @param int $post_id ID услуги
 * @return array Ассоциативный массив всех meta-полей (без префикса _service_)
 */
function get_service_meta($post_id) {
    // Кешируем в памяти на время запроса
    static $cache = [];
    if (isset($cache[$post_id])) {
        return $cache[$post_id];
    }
    
    $meta = get_post_meta($post_id);
    $result = [];
    
    foreach ($meta as $key => $value) {
        // Обрабатываем только поля с префиксом _service_
        if (strpos($key, '_service_') !== 0) {
            continue;
        }
        
        // Убираем префикс _service_
        $clean_key = str_replace('_service_', '', $key);
        
        // Если массив - десериализуем
        if (is_array($value) && count($value) === 1) {
            $result[$clean_key] = maybe_unserialize($value[0]);
        } elseif (is_array($value)) {
            $result[$clean_key] = $value[0];
        } else {
            $result[$clean_key] = $value;
        }
    }
    
    $cache[$post_id] = $result;
    return $result;
}

/**
 * Получает включенные секции для услуги
 * 
 * @param int $post_id ID услуги
 * @return array Массив slug'ов включенных секций
 */
function get_service_enabled_sections($post_id) {
    $meta = get_service_meta($post_id);
    $enabled = isset($meta['sections_enabled']) 
        ? (is_array($meta['sections_enabled']) ? $meta['sections_enabled'] : [])
        : [];
    
    return $enabled;
}

/**
 * Проверяет, включена ли секция
 * 
 * @param int $post_id ID услуги
 * @param string $section_slug Slug секции
 * @return bool
 */
function is_service_section_enabled($post_id, $section_slug) {
    $enabled = get_service_enabled_sections($post_id);
    return in_array($section_slug, $enabled);
}

/**
 * Получает данные конкретной секции
 * 
 * @param int $post_id ID услуги
 * @param string $section_slug Slug секции (может содержать дефисы, например 'clinic-benefits')
 * @return array Ассоциативный массив данных секции (без префикса секции в ключах)
 */
function get_service_section_data($post_id, $section_slug) {
    $meta = get_service_meta($post_id);
    $data = [];
    
    // get_service_meta уже убрал префикс _service_, поэтому ищем ключи с префиксом {section_slug}_
    // Преобразуем дефисы в подчеркивания для поиска meta-полей
    // Например: 'clinic-benefits' -> 'clinic_benefits'
    $prefix = str_replace('-', '_', $section_slug) . '_';
    
    foreach ($meta as $key => $value) {
        if (strpos($key, $prefix) === 0) {
            $field_name = str_replace($prefix, '', $key);
            $data[$field_name] = $value;
        }
    }
    
    return $data;
}

/**
 * Проверяет, есть ли данные для отображения секции
 * 
 * @param int $post_id ID услуги
 * @param string $section_slug Slug секции
 * @return bool
 */
function has_service_section_data($post_id, $section_slug) {
    $data = get_service_section_data($post_id, $section_slug);
    // Убираем пустые значения
    $data = array_filter($data, function($value) {
        return !empty($value);
    });
    return !empty($data);
}

