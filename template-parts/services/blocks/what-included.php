<?php
/**
 * What Included секция услуги (Что входит в услугу)
 *
 * @var array $args {
 *     @type int    $post_id
 *     @type string $section_slug
 *     @type array  $meta
 *     @type array  $section_data
 * }
 */

$post_id = $args['post_id'] ?? 0;
$section_data = $args['section_data'] ?? [];

$left_title = $section_data['title'] ?? '';

$items = $section_data['items'] ?? [];
if (!is_array($items)) {
    $items = [];
}

$items = array_values(array_filter($items, function($item) {
    return is_array($item) && (!empty($item['title']) || !empty($item['description']));
}));

if (empty($items)) {
    return;
}
?>
<section class="section section--service-what-included service-what-included">
    <div class="container">
        <div class="row">
            <!-- Левая часть: тут позже будет общий графический декор (одинаковый для всех услуг) -->
            <div class="col-sm-12 col-lg-6">
                <div class="service-what-included__left">
                    <?php if ($left_title) : ?>
                        <h2 class="service-what-included__title"><?php echo esc_html($left_title); ?></h2>
                    <?php endif; ?>
                    <div class="service-what-included__decor">
                        <!-- TODO: сюда вставишь общий набор графических элементов -->
                    </div>
                </div>
            </div>

            <!-- Правая часть: чек-лист -->
            <div class="col-sm-12 col-lg-6">
                <div class="service-what-included__right">
                    <ul class="service-what-included__list">
                        <?php foreach ($items as $item) :
                            $title = $item['title'] ?? '';
                            $desc  = $item['description'] ?? '';
                        ?>
                            <li class="service-what-included__item">
                                <?php if ($title) : ?>
                                    <h3 class="service-what-included__item-title"><?php echo esc_html($title); ?></h3>
                                <?php endif; ?>

                                <?php if ($desc) : ?>
                                    <p class="service-what-included__item-desc"><?php echo esc_html($desc); ?></p>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>