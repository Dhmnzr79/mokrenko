/**
 * JS для админки услуг
 */

(function($) {
    'use strict';

    // Инициализация при загрузке страницы
    $(document).ready(function() {
        initHeroImageSelector();
        initHeroBenefitIcons();
        initBenefitsIcons();
        initClinicBenefitsIcons();
        initWorkStagesImages();
        initInfoBlocksImages();
        initPricesRepeater();
    });

    // Выбор изображения для Hero
    function initHeroImageSelector() {
        var heroImageFrame;
        
        $('#select-hero-image').on('click', function(e) {
            e.preventDefault();
            
            if (heroImageFrame) {
                heroImageFrame.open();
                return;
            }

            heroImageFrame = wp.media({
                title: 'Выберите изображение для Hero секции',
                button: {
                    text: 'Выбрать'
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            heroImageFrame.on('select', function() {
                var attachment = heroImageFrame.state().get('selection').first().toJSON();
                $('#service_hero_image').val(attachment.id);
                $('#hero-image-preview').html(
                    '<img src="' + attachment.url + '" style="max-width: 300px; height: auto;" />' +
                    '<br><button type="button" class="button" id="remove-hero-image" style="margin-top: 5px;">Удалить</button>'
                );
            });

            heroImageFrame.open();
        });
        
        // Удаление изображения
        $(document).on('click', '#remove-hero-image', function(e) {
            e.preventDefault();
            $('#service_hero_image').val('');
            $('#hero-image-preview').html('');
        });
    }

    // Выбор иконок для преимуществ
    function initHeroBenefitIcons() {
        var benefitIconFrames = {};
        
        $(document).on('click', '.select-hero-benefit-icon', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            var frameKey = 'benefit_' + index;
            
            if (benefitIconFrames[frameKey]) {
                benefitIconFrames[frameKey].open();
                return;
            }

            benefitIconFrames[frameKey] = wp.media({
                title: 'Выберите иконку для преимущества ' + (parseInt(index) + 1),
                button: {
                    text: 'Выбрать'
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            benefitIconFrames[frameKey].on('select', function() {
                var attachment = benefitIconFrames[frameKey].state().get('selection').first().toJSON();
                var $preview = $('.hero-benefit-icon-preview[data-index="' + index + '"]');
                var $input = $('.hero-benefit-icon-input[data-index="' + index + '"]');
                
                $input.val(attachment.id);
                $preview.html(
                    '<img src="' + attachment.url + '" style="max-width: 100px; height: auto;" />' +
                    '<br><button type="button" class="button remove-hero-benefit-icon" data-index="' + index + '" style="margin-top: 5px;">Удалить</button>'
                );
            });

            benefitIconFrames[frameKey].open();
        });
        
        // Удаление иконки преимущества
        $(document).on('click', '.remove-hero-benefit-icon', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            var $preview = $('.hero-benefit-icon-preview[data-index="' + index + '"]');
            var $input = $('.hero-benefit-icon-input[data-index="' + index + '"]');
            
            $input.val('');
            $preview.html('');
        });
    }

    // Выбор иконок для Benefits карточек
    function initBenefitsIcons() {
        var benefitsIconFrames = {};
        
        $(document).on('click', '.select-benefits-icon', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            var frameKey = 'benefits_' + index;
            
            if (benefitsIconFrames[frameKey]) {
                benefitsIconFrames[frameKey].open();
                return;
            }

            benefitsIconFrames[frameKey] = wp.media({
                title: 'Выберите иконку для карточки ' + (parseInt(index) + 1),
                button: {
                    text: 'Выбрать'
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            benefitsIconFrames[frameKey].on('select', function() {
                var attachment = benefitsIconFrames[frameKey].state().get('selection').first().toJSON();
                var $preview = $('.benefits-icon-preview[data-index="' + index + '"]');
                var $input = $('.benefits-icon-input[data-index="' + index + '"]');
                
                $input.val(attachment.id);
                $preview.html(
                    '<img src="' + attachment.url + '" style="max-width: 100px; height: auto;" />' +
                    '<br><button type="button" class="button remove-benefits-icon" data-index="' + index + '" style="margin-top: 5px;">Удалить</button>'
                );
            });

            benefitsIconFrames[frameKey].open();
        });
        
        // Удаление иконки Benefits карточки
        $(document).on('click', '.remove-benefits-icon', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            var $preview = $('.benefits-icon-preview[data-index="' + index + '"]');
            var $input = $('.benefits-icon-input[data-index="' + index + '"]');
            
            $input.val('');
            $preview.html('');
        });
    }

    // Выбор иконок для Clinic Benefits карточек
    function initClinicBenefitsIcons() {
        var clinicBenefitsCardIconFrames = {};
        var clinicBenefitsFeatureIconFrame;
        
        // Иконки для 4 карточек
        $(document).on('click', '.select-clinic-benefits-card-icon', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            var frameKey = 'clinic_benefits_card_' + index;
            
            if (clinicBenefitsCardIconFrames[frameKey]) {
                clinicBenefitsCardIconFrames[frameKey].open();
                return;
            }

            clinicBenefitsCardIconFrames[frameKey] = wp.media({
                title: 'Выберите иконку для карточки ' + (parseInt(index) + 1),
                button: {
                    text: 'Выбрать'
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            clinicBenefitsCardIconFrames[frameKey].on('select', function() {
                var attachment = clinicBenefitsCardIconFrames[frameKey].state().get('selection').first().toJSON();
                var $preview = $('.clinic-benefits-card-icon-preview[data-index="' + index + '"]');
                var $input = $('.clinic-benefits-card-icon-input[data-index="' + index + '"]');
                
                $input.val(attachment.id);
                $preview.html(
                    '<img src="' + attachment.url + '" style="max-width: 100px; height: auto;" />' +
                    '<br><button type="button" class="button remove-clinic-benefits-card-icon" data-index="' + index + '" style="margin-top: 5px;">Удалить</button>'
                );
            });

            clinicBenefitsCardIconFrames[frameKey].open();
        });
        
        // Удаление иконки карточки
        $(document).on('click', '.remove-clinic-benefits-card-icon', function(e) {
            e.preventDefault();
            var index = $(this).data('index');
            var $preview = $('.clinic-benefits-card-icon-preview[data-index="' + index + '"]');
            var $input = $('.clinic-benefits-card-icon-input[data-index="' + index + '"]');
            
            $input.val('');
            $preview.html('');
        });
        
        // Иконка для большой карточки
        $('.select-clinic-benefits-feature-icon').on('click', function(e) {
            e.preventDefault();
            
            if (clinicBenefitsFeatureIconFrame) {
                clinicBenefitsFeatureIconFrame.open();
                return;
            }

            clinicBenefitsFeatureIconFrame = wp.media({
                title: 'Выберите иконку для большой карточки',
                button: {
                    text: 'Выбрать'
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            clinicBenefitsFeatureIconFrame.on('select', function() {
                var attachment = clinicBenefitsFeatureIconFrame.state().get('selection').first().toJSON();
                var $preview = $('.clinic-benefits-feature-icon-preview');
                var $input = $('.clinic-benefits-feature-icon-input');
                
                $input.val(attachment.id);
                $preview.html(
                    '<img src="' + attachment.url + '" style="max-width: 100px; height: auto;" />' +
                    '<br><button type="button" class="button remove-clinic-benefits-feature-icon" style="margin-top: 5px;">Удалить</button>'
                );
            });

            clinicBenefitsFeatureIconFrame.open();
        });
        
        // Удаление иконки большой карточки
        $(document).on('click', '.remove-clinic-benefits-feature-icon', function(e) {
            e.preventDefault();
            var $preview = $('.clinic-benefits-feature-icon-preview');
            var $input = $('.clinic-benefits-feature-icon-input');
            
            $input.val('');
            $preview.html('');
        });
    }

    // Выбор изображений для Work Stages этапов
    function initWorkStagesImages() {
        var stage1ImageFrame, stage2ImageFrame;
        
        // Этап 1
        $('.select-work-stages-stage-1-image').on('click', function(e) {
            e.preventDefault();
            
            if (stage1ImageFrame) {
                stage1ImageFrame.open();
                return;
            }

            stage1ImageFrame = wp.media({
                title: 'Выберите изображение для этапа 1',
                button: {
                    text: 'Выбрать'
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            stage1ImageFrame.on('select', function() {
                var attachment = stage1ImageFrame.state().get('selection').first().toJSON();
                $('.work-stages-stage-1-image-input').val(attachment.id);
                $('.work-stages-stage-1-image-preview').html(
                    '<img src="' + attachment.url + '" style="max-width: 300px; height: auto;" />' +
                    '<br><button type="button" class="button remove-work-stages-stage-1-image" style="margin-top: 5px;">Удалить</button>'
                );
            });

            stage1ImageFrame.open();
        });
        
        $(document).on('click', '.remove-work-stages-stage-1-image', function(e) {
            e.preventDefault();
            $('.work-stages-stage-1-image-input').val('');
            $('.work-stages-stage-1-image-preview').html('');
        });
        
        // Этап 2
        $('.select-work-stages-stage-2-image').on('click', function(e) {
            e.preventDefault();
            
            if (stage2ImageFrame) {
                stage2ImageFrame.open();
                return;
            }

            stage2ImageFrame = wp.media({
                title: 'Выберите изображение для этапа 2',
                button: {
                    text: 'Выбрать'
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            stage2ImageFrame.on('select', function() {
                var attachment = stage2ImageFrame.state().get('selection').first().toJSON();
                $('.work-stages-stage-2-image-input').val(attachment.id);
                $('.work-stages-stage-2-image-preview').html(
                    '<img src="' + attachment.url + '" style="max-width: 300px; height: auto;" />' +
                    '<br><button type="button" class="button remove-work-stages-stage-2-image" style="margin-top: 5px;">Удалить</button>'
                );
            });

            stage2ImageFrame.open();
        });
        
        $(document).on('click', '.remove-work-stages-stage-2-image', function(e) {
            e.preventDefault();
            $('.work-stages-stage-2-image-input').val('');
            $('.work-stages-stage-2-image-preview').html('');
        });
    }

    // Выбор изображений для секции "Инфо-блоки" (2 блока)
    function initInfoBlocksImages() {
        var frames = {};

        $(document).on('click', '.select-info-block-image', function(e) {
            e.preventDefault();

            var blockIndex = $(this).data('block');
            var key = 'info_block_' + blockIndex;

            if (frames[key]) {
                frames[key].open();
                return;
            }

            frames[key] = wp.media({
                title: 'Выберите изображение для инфо-блока ' + (parseInt(blockIndex, 10) + 1),
                button: { text: 'Выбрать' },
                multiple: false,
                library: { type: 'image' }
            });

            frames[key].on('select', function() {
                var attachment = frames[key].state().get('selection').first().toJSON();

                var $input = $('.info-block-image-input[data-block="' + blockIndex + '"]');
                var $preview = $('.info-block-image-preview[data-block="' + blockIndex + '"]');

                $input.val(attachment.id);
                $preview.html(
                    '<img src="' + attachment.url + '" style="max-width: 300px; height: auto;" />' +
                    '<br><button type="button" class="button remove-info-block-image" data-block="' + blockIndex + '" style="margin-top: 5px;">Удалить</button>'
                );
            });

            frames[key].open();
        });

        $(document).on('click', '.remove-info-block-image', function(e) {
            e.preventDefault();

            var blockIndex = $(this).data('block');
            var $input = $('.info-block-image-input[data-block="' + blockIndex + '"]');
            var $preview = $('.info-block-image-preview[data-block="' + blockIndex + '"]');

            $input.val('');
            $preview.html('');
        });
    }

    function initPricesRepeater() {
        var $box = $('.service-prices-meta-box');
        if (!$box.length) return;
        
        var $items = $box.find('#service-prices-items');
        
        function rebuildIndexes() {
            $items.find('.service-prices-item').each(function(idx) {
                var $row = $(this);
                $row.find('input').each(function() {
                    var $input = $(this);
                    var name = $input.attr('name');
                    if (!name) return;
                    
                    name = name.replace(/service_prices_items\[\d+\]/, 'service_prices_items[' + idx + ']');
                    $input.attr('name', name);
                });
            });
            $items.attr('data-next-index', $items.find('.service-prices-item').length);
        }
        
        function addRow() {
            var index = parseInt($items.attr('data-next-index'), 10);
            if (isNaN(index)) index = $items.find('.service-prices-item').length;
            
            var html =
                '<div class="service-prices-item" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 15px; border-radius: 4px;">' +
                    '<div style="display: flex; gap: 10px; align-items: flex-start;">' +
                        '<div style="flex: 1; min-width: 0;">' +
                            '<label style="display: block; margin-bottom: 5px; font-weight: 600;">Название</label>' +
                            '<input type="text" name="service_prices_items[' + index + '][name]" value="" style="width: 100%;" />' +
                        '</div>' +
                        '<div style="flex: 0 0 160px;">' +
                            '<label style="display: block; margin-bottom: 5px; font-weight: 600;">Цена</label>' +
                            '<input type="text" name="service_prices_items[' + index + '][price]" value="" style="width: 100%;" />' +
                        '</div>' +
                        '<div style="flex: 0 0 160px;">' +
                            '<label style="display: block; margin-bottom: 5px; font-weight: 600;">Старая цена</label>' +
                            '<input type="text" name="service_prices_items[' + index + '][old_price]" value="" style="width: 100%;" />' +
                        '</div>' +
                        '<div style="flex: 0 0 120px; padding-top: 24px;">' +
                            '<button type="button" class="button service-prices-remove">Удалить</button>' +
                        '</div>' +
                    '</div>' +
                '</div>';
            
            $items.append(html);
            rebuildIndexes();
        }
        
        $box.on('click', '.service-prices-add', function(e) {
            e.preventDefault();
            addRow();
        });
        
        $box.on('click', '.service-prices-remove', function(e) {
            e.preventDefault();
            $(this).closest('.service-prices-item').remove();
            rebuildIndexes();
        });
    }
})(jQuery);


