/**
 * JS для админки врачей и кейсов
 */

(function($) {
    'use strict';

    // Инициализация при загрузке страницы
    $(document).ready(function() {
        initCertsGallery();
        initImageSelectors();
        initDoctorPhoto2();
        loadExistingCerts();
    });

    // Галерея сертификатов
    function initCertsGallery() {
        var certsFrame;
        
        $('#select-certs').on('click', function(e) {
            e.preventDefault();
            
            if (certsFrame) {
                certsFrame.open();
                return;
            }

            certsFrame = wp.media({
                title: theme_admin.strings.selectCerts,
                button: {
                    text: theme_admin.strings.select
                },
                multiple: true,
                library: {
                    type: 'image'
                }
            });

            certsFrame.on('select', function() {
                var attachments = certsFrame.state().get('selection').toJSON();
                var newIds = attachments.map(function(attachment) {
                    return attachment.id;
                });
                
                // Получаем текущие ID сертификатов
                var currentIds = getCurrentCertIds();
                
                // Объединяем существующие и новые ID (убираем дубликаты)
                var allIds = currentIds.concat(newIds);
                allIds = allIds.filter(function(id, index) {
                    return allIds.indexOf(id) === index;
                });
                
                // Сохраняем обновленный список
                $('#doctor_certs_json').val(JSON.stringify(allIds));
                
                // Обновляем превью
                renderCertsPreview(allIds);
            });

            certsFrame.open();
        });
        
        // Обработчик удаления сертификата
        $(document).on('click', '.cert-item-remove', function(e) {
            e.preventDefault();
            var $item = $(this).closest('.cert-item');
            var certId = parseInt($item.data('cert-id'));
            
            // Удаляем элемент из DOM
            $item.remove();
            
            // Обновляем JSON
            updateCertsJson();
        });
    }

    // Получение текущих ID сертификатов из JSON
    function getCurrentCertIds() {
        var certsJson = $('#doctor_certs_json').val();
        if (certsJson) {
            try {
                var certIds = JSON.parse(certsJson);
                if (Array.isArray(certIds)) {
                    return certIds;
                }
            } catch(e) {
                console.error('Error parsing certs JSON:', e);
            }
        }
        return [];
    }

    // Обновление JSON на основе текущих сертификатов в DOM
    function updateCertsJson() {
        var certIds = [];
        $('#certs-preview .cert-item').each(function() {
            var certId = parseInt($(this).data('cert-id'));
            if (certId) {
                certIds.push(certId);
            }
        });
        $('#doctor_certs_json').val(JSON.stringify(certIds));
    }

    // Отрисовка превью сертификатов
    function renderCertsPreview(certIds) {
        var preview = $('#certs-preview');
        preview.empty();
        
        if (!Array.isArray(certIds) || certIds.length === 0) {
            return;
        }
        
        // Загружаем все сертификаты
        certIds.forEach(function(certId) {
            var attachment = wp.media.attachment(certId);
            attachment.fetch().done(function() {
                var certItem = createCertItem(certId, attachment);
                preview.append(certItem);
            });
        });
    }

    // Создание элемента сертификата с кнопкой удаления
    function createCertItem(certId, attachment) {
        var $item = $('<div>').addClass('cert-item').attr('data-cert-id', certId);
        var imgUrl = attachment.attributes.sizes && attachment.attributes.sizes.thumbnail 
            ? attachment.attributes.sizes.thumbnail.url 
            : attachment.attributes.url;
        
        var $img = $('<img>').attr({
            src: imgUrl,
            alt: attachment.attributes.alt || attachment.attributes.title || 'Сертификат'
        });
        
        var $removeBtn = $('<button>')
            .addClass('cert-item-remove')
            .attr('type', 'button')
            .attr('title', 'Удалить сертификат')
            .html('×');
        
        $item.append($img).append($removeBtn);
        return $item;
    }

    // Загрузка существующих сертификатов при открытии страницы
    function loadExistingCerts() {
        var certIds = getCurrentCertIds();
        if (certIds.length > 0) {
            renderCertsPreview(certIds);
        }
    }

    // Селекторы изображений для кейсов
    function initImageSelectors() {
        var beforeFrame, afterFrame;
        
        // Выбор изображения "До"
        $('#select-before-image').on('click', function(e) {
            e.preventDefault();
            
            if (beforeFrame) {
                beforeFrame.open();
                return;
            }

            beforeFrame = wp.media({
                title: theme_admin.strings.selectBeforeImage,
                button: {
                    text: theme_admin.strings.select
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            beforeFrame.on('select', function() {
                var attachment = beforeFrame.state().get('selection').first().toJSON();
                $('#case_before_image').val(attachment.id);
                updateImagePreview('#before-image-preview', attachment);
            });

            beforeFrame.open();
        });

        // Выбор изображения "После"
        $('#select-after-image').on('click', function(e) {
            e.preventDefault();
            
            if (afterFrame) {
                afterFrame.open();
                return;
            }

            afterFrame = wp.media({
                title: theme_admin.strings.selectAfterImage,
                button: {
                    text: theme_admin.strings.select
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            afterFrame.on('select', function() {
                var attachment = afterFrame.state().get('selection').first().toJSON();
                $('#case_after_image').val(attachment.id);
                updateImagePreview('#after-image-preview', attachment);
            });

            afterFrame.open();
        });
    }

    // Обновление превью изображения
    function updateImagePreview(selector, attachment) {
        var preview = $(selector);
        preview.empty();
        
        var img = $('<img>').attr({
            src: attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url,
            alt: attachment.alt || attachment.title
        });
        preview.append(img);
    }

    // Селектор второго фото врача
    function initDoctorPhoto2() {
        var doctorPhoto2Frame;
        
        // Используем делегирование событий на случай, если метабокс загружается динамически
        $(document).on('click', '#select-doctor-photo-2', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            // Проверяем, что wp.media доступен
            if (typeof wp === 'undefined' || !wp.media) {
                console.error('WordPress Media Library не загружена');
                return;
            }
            
            if (doctorPhoto2Frame) {
                doctorPhoto2Frame.open();
                return;
            }

            doctorPhoto2Frame = wp.media({
                title: theme_admin.strings.selectDoctorPhoto2 || 'Выберите второе фото врача',
                button: {
                    text: theme_admin.strings.select || 'Выбрать'
                },
                multiple: false,
                library: {
                    type: 'image'
                }
            });

            doctorPhoto2Frame.on('select', function() {
                var attachment = doctorPhoto2Frame.state().get('selection').first().toJSON();
                $('#doctor_photo_2').val(attachment.id);
                updateImagePreview('#doctor-photo-2-preview', attachment);
            });

            doctorPhoto2Frame.open();
        });
    }

})(jQuery);
