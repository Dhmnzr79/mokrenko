/**
 * JS для админки врачей и кейсов
 */

(function($) {
    'use strict';

    // Инициализация при загрузке страницы
    $(document).ready(function() {
        initEducationRepeater();
        initCertsGallery();
        initImageSelectors();
    });

    // Репитер для образования
    function initEducationRepeater() {
        // Добавление нового образования
        $('#add-education').on('click', function() {
            var template = '<div class="education-item">' +
                '<input type="text" name="education_year[]" placeholder="' + theme_admin.strings.year + '" />' +
                '<input type="text" name="education_desc[]" placeholder="' + theme_admin.strings.desc + '" style="width: 60%;" />' +
                '<button type="button" class="remove-education">' + theme_admin.strings.remove + '</button>' +
                '</div>';
            $('#education-list').append(template);
            updateEducationJSON();
        });

        // Удаление образования
        $(document).on('click', '.remove-education', function() {
            $(this).closest('.education-item').remove();
            updateEducationJSON();
        });

        // Обновление JSON при изменении полей
        $(document).on('input', 'input[name="education_year[]"], input[name="education_desc[]"]', function() {
            updateEducationJSON();
        });
    }

    // Обновление JSON для образования
    function updateEducationJSON() {
        var education = [];
        $('.education-item').each(function() {
            var year = $(this).find('input[name="education_year[]"]').val();
            var desc = $(this).find('input[name="education_desc[]"]').val();
            if (year && desc) {
                education.push({
                    year: year,
                    desc: desc
                });
            }
        });
        $('#doctor_education_json').val(JSON.stringify(education));
    }

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
                var ids = attachments.map(function(attachment) {
                    return attachment.id;
                });
                
                updateCertsPreview(attachments);
                $('#doctor_certs_json').val(JSON.stringify(ids));
            });

            certsFrame.open();
        });
    }

    // Обновление превью сертификатов
    function updateCertsPreview(attachments) {
        var preview = $('#certs-preview');
        preview.empty();
        
        attachments.forEach(function(attachment) {
            var img = $('<img>').attr({
                src: attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url,
                alt: attachment.alt || attachment.title
            });
            preview.append(img);
        });
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

})(jQuery);
