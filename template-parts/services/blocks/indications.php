<?php
/**
 * Indications секция услуги (Показания и противопоказания)
 *
 * @var array $args {
 *   @type int   $post_id
 *   @type array $section_data
 * }
 */

$post_id = $args['post_id'] ?? 0;
$section_data = $args['section_data'] ?? [];

$left_title  = $section_data['left_title'] ?? '';
$left_items  = $section_data['left_items'] ?? [];
$right_title = $section_data['right_title'] ?? '';
$right_items = $section_data['right_items'] ?? [];

if (!is_array($left_items))  $left_items = [];
if (!is_array($right_items)) $right_items = [];

$left_items  = array_values(array_filter($left_items, fn($t) => is_string($t) && trim($t) !== ''));
$right_items = array_values(array_filter($right_items, fn($t) => is_string($t) && trim($t) !== ''));

if (!$left_title && !$right_title && empty($left_items) && empty($right_items)) {
    return;
}
?>
<section class="section section--service-indications service-indications">
    <div class="container">
        <div class="row">
            <!-- Слева: показания -->
            <div class="col-sm-12 col-lg-6">
                <div class="service-indications__col service-indications__col--left">
                    <?php if ($left_title) : ?>
                        <h2 class="service-indications__title"><?php echo esc_html($left_title); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($left_items)) : ?>
                        <ul class="service-indications__list">
                            <?php foreach ($left_items as $text) : ?>
                                <li class="service-indications__item"><?php echo esc_html($text); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Справа: противопоказания -->
            <div class="col-sm-12 col-lg-6">
                <div class="service-indications__col service-indications__col--right">
                    <?php if ($right_title) : ?>
                        <h2 class="service-indications__title"><?php echo esc_html($right_title); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($right_items)) : ?>
                        <ul class="service-indications__list">
                            <?php foreach ($right_items as $text) : ?>
                                <li class="service-indications__item"><?php echo esc_html($text); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>