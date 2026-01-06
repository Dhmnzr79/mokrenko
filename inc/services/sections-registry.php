<?php
/**
 * Реестр секций услуг
 * 
 * Централизованная конфигурация всех доступных секций
 */

/**
 * Получает конфигурацию всех доступных секций
 * 
 * @return array Ассоциативный массив конфигураций секций
 *               Ключ - slug секции, значение - массив с настройками
 */
function get_service_sections_config() {
    return [
        // Общие секции (будут использоваться у многих услуг)
        'hero' => [
            'label' => 'Hero (Главный блок)',
            'type' => 'common',
            'template' => 'hero'
        ],
        'benefits' => [
            'label' => 'Преимущества',
            'type' => 'common',
            'template' => 'benefits'
        ],
        'clinic-benefits' => [
            'label' => 'Общие плюсы клиники',
            'type' => 'common',
            'template' => 'clinic-benefits'
        ],
        'description' => [
            'label' => 'Описание услуги',
            'type' => 'common',
            'template' => 'description'
        ],
        'prices' => [
            'label' => 'Цены',
            'type' => 'common',
            'template' => 'prices'
        ],
        'cta' => [
            'label' => 'Призыв к действию',
            'type' => 'common',
            'template' => 'cta'
        ],
        'reviews' => [
            'label' => 'Отзывы',
            'type' => 'common',
            'template' => 'reviews'
        ],
        'work-stages' => [
            'label' => 'Этапы работ',
            'type' => 'common',
            'template' => 'work-stages'
        ],
        'what-included' => [
            'label' => 'Что входит в услугу',
            'type' => 'common',
            'template' => 'what-included'
        ],
        'info-blocks' => [
            'label' => 'Инфо-блоки (картинка + текст + чек-лист)',
            'type' => 'common',
            'template' => 'info-blocks'
        ],
        'indications' => [
            'label' => 'Показания и противопоказания',
            'type' => 'common',
            'template' => 'indications'
        ],
        
        // Уникальные секции (будут добавляться по мере необходимости)
        // Пример:
        // 'implant_types' => [
        //     'label' => 'Виды имплантов',
        //     'type' => 'unique',
        //     'template' => 'implant-types'
        // ],
    ];
}

/**
 * Получает фиксированный порядок секций для отображения
 * 
 * @return array Массив slug'ов секций в порядке отображения
 */
function get_service_sections_order() {
    return [
        'hero',
        'benefits',
        'clinic-benefits',
        'description',
        'prices',
        'cta',
        'work-stages',
        'what-included',
        'indications',
        'reviews'
    ];
}

