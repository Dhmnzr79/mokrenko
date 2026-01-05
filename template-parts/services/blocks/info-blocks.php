<?php
$post_id = $args['post_id'] ?? 0;
$section_data = $args['section_data'] ?? [];

$blocks = $section_data['blocks'] ?? [];
if (!is_array($blocks)) $blocks = [];

// фильтр пустых блоков
$blocks = array_values(array_filter($blocks, function($b) {
    if (!is_array($b)) return false;
    $has_text = !empty($b['title']) || !empty($b['subtitle']);
    $has_img  = !empty($b['image']);
    $has_items = !empty($b['items']) && is_array($b['items']) && count(array_filter($b['items'])) > 0;
    return $has_text || $has_img || $has_items;
}));

if (empty($blocks)) return;
?>
<section class="section section--service-info-blocks service-info-blocks">
  <div class="container">
    <?php foreach ($blocks as $block_index => $block) :
      $image_id = isset($block['image']) ? absint($block['image']) : 0;
      $title    = isset($block['title']) ? $block['title'] : '';
      $subtitle = isset($block['subtitle']) ? $block['subtitle'] : '';
      $reverse  = !empty($block['reverse']);

      $items = isset($block['items']) && is_array($block['items']) ? $block['items'] : [];

      $items = array_values(array_filter(array_map(function($item) {
      // поддержка двух форматов: string и {text: "..."}
        if (is_string($item)) {
            return trim($item);
        }
        if (is_array($item) && isset($item['text'])) {
            return trim((string)$item['text']);
        }
        return '';
    }, $items)));
    ?>
      <div class="service-info-blocks__block <?php echo $reverse ? 'service-info-blocks__block--reverse' : ''; ?>">
        <div class="row">
          <?php if (!$reverse) : ?>
            <div class="col-sm-12 col-lg-6 service-info-blocks__col-image">
              <?php if ($image_id) : ?>
                <div class="service-info-blocks__image">
                  <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'service-info-blocks__img']); ?>
                </div>
              <?php endif; ?>
            </div>

            <div class="col-sm-12 col-lg-6">
              <div class="service-info-blocks__content">
                <?php if ($title) : ?><h2 class="service-info-blocks__title"><?php echo esc_html($title); ?></h2><?php endif; ?>
                <?php if ($subtitle) : ?><p class="service-info-blocks__subtitle"><?php echo esc_html($subtitle); ?></p><?php endif; ?>

                <?php if (!empty($items)) : ?>
                  <ul class="service-info-blocks__list">
                    <?php foreach ($items as $text) : ?>
                      <li class="service-info-blocks__item"><?php echo esc_html($text); ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </div>
            </div>
          <?php else : ?>
            <div class="col-sm-12 col-lg-6">
              <div class="service-info-blocks__content">
                <?php if ($title) : ?><h2 class="service-info-blocks__title"><?php echo esc_html($title); ?></h2><?php endif; ?>
                <?php if ($subtitle) : ?><p class="service-info-blocks__subtitle"><?php echo esc_html($subtitle); ?></p><?php endif; ?>

                <?php if (!empty($items)) : ?>
                  <ul class="service-info-blocks__list">
                    <?php foreach ($items as $text) : ?>
                      <li class="service-info-blocks__item"><?php echo esc_html($text); ?></li>
                    <?php endforeach; ?>
                  </ul>
                <?php endif; ?>
              </div>
            </div>

            <div class="col-sm-12 col-lg-6 service-info-blocks__col-image">
              <?php if ($image_id) : ?>
                <div class="service-info-blocks__image">
                  <?php echo wp_get_attachment_image($image_id, 'large', false, ['class' => 'service-info-blocks__img']); ?>
                </div>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>