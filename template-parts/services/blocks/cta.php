<?php
$post_id = $args['post_id'] ?? 0;
$section_data = $args['section_data'] ?? [];

$title = $section_data['title'] ?? '';
$subtitle = $section_data['subtitle'] ?? '';
$cards = $section_data['cards'] ?? [];
if (!is_array($cards)) $cards = [];

// Фильтруем заполненные карточки
$cards = array_filter($cards, function($card) {
    return !empty($card['text']);
});

if (empty($title) && empty($subtitle) && empty($cards)) {
    return;
}
?>
<section class="section section--service-cta service-cta">
    <div class="container">
        <div class="row">
            <?php if ($title || $subtitle) : ?>
                <div class="col-sm-12 col-lg-6">
                    <div class="service-cta__content">
                        <?php if ($title) : ?>
                            <h2 class="service-cta__title"><?php echo esc_html($title); ?></h2>
                        <?php endif; ?>
                        <?php if ($subtitle) : ?>
                            <p class="service-cta__subtitle"><?php echo esc_html($subtitle); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($cards)) : ?>
                <div class="col-sm-12 col-lg-6">
                    <div class="row">
                        <?php foreach ($cards as $index => $card) : 
                            $card_text = isset($card['text']) ? $card['text'] : '';
                        ?>
                            <div class="col-sm-6">
                                <div class="service-cta__card">
                                    <p class="service-cta__card-text"><?php echo esc_html($card_text); ?></p>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        

        <div class="row">
            <div class="col-sm-12">
                <div class="service-cta__form-wrapper">
                    <h3 class="service-cta__form-title">Оставьте заявку</h3>
                    <p class="service-cta__form-subtitle">И мы свяжемся с вами в ближайшее время</p>
                    <?php echo do_shortcode('[contact-form-7 id="7615b47" title="Контактная форма CTA"]'); ?>
                    <div class="form-consent">
                        <label class="form-consent__label">
                            <input type="checkbox" class="form-consent__checkbox" checked required>
                            <span class="form-consent__text">Я даю согласие на обработку <a href="https://mokrenko-msk.ru/privacy.pdf" target="_blank" rel="noopener" class="form-consent__link">персональных данных</a></span>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>