<?php
/**
 * Шаблон для страницы врача
 */

get_header();

$doctor_id = get_the_ID();
$position = get_field('position', $doctor_id);
$experience = get_field('experience_years', $doctor_id);
$rating = get_field('rating', $doctor_id);
$short_bio = get_field('short_bio', $doctor_id);
$education = get_field('education', $doctor_id);
$certs = get_field('certs', $doctor_id);
$contacts = get_field('contacts', $doctor_id);
$cta_link = get_field('cta_link', $doctor_id);
?>

<main class="main">
    <div class="container">
        <!-- Шапка врача -->
        <section class="doctor-header">
            <div class="row">
                <div class="col-sm-12 col-lg-4">
                    <div class="doctor-header__photo">
                        <?php if (has_post_thumbnail()): ?>
                            <?php the_post_thumbnail('large', ['class' => 'doctor-header__img']); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-8">
                    <div class="doctor-header__content">
                        <h1 class="doctor-header__name"><?php the_title(); ?></h1>
                        <?php if ($position): ?>
                            <p class="doctor-header__position"><?php echo esc_html($position); ?></p>
                        <?php endif; ?>
                        
                        <?php if ($experience): ?>
                            <div class="doctor-header__experience">
                                <span class="doctor-header__label">Стаж:</span>
                                <span class="doctor-header__value"><?php echo esc_html($experience); ?> лет</span>
                            </div>
                        <?php endif; ?>

                        <?php if ($rating): ?>
                            <div class="doctor-header__rating">
                                <span class="doctor-header__label">Рейтинг:</span>
                                <div class="doctor-header__stars">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <span class="star <?php echo $i <= $rating ? 'star--active' : ''; ?>">★</span>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($short_bio): ?>
                            <div class="doctor-header__bio">
                                <p><?php echo esc_html($short_bio); ?></p>
                            </div>
                        <?php endif; ?>

                        <?php if ($cta_link): ?>
                            <div class="doctor-header__cta">
                                <a href="<?php echo esc_url($cta_link); ?>" class="btn btn--primary">
                                    Записаться на прием
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Образование -->
        <?php if ($education && is_array($education)): ?>
            <section class="doctor-education">
                <h2>Образование</h2>
                <div class="row">
                    <?php foreach ($education as $edu): ?>
                        <div class="col-sm-12 col-lg-6">
                            <div class="education-item">
                                <div class="education-item__year"><?php echo esc_html($edu['year']); ?></div>
                                <div class="education-item__desc"><?php echo esc_html($edu['desc']); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- Сертификаты -->
        <?php if ($certs && is_array($certs)): ?>
            <section class="doctor-certs">
                <h2>Курсы и сертификаты</h2>
                <div class="row">
                    <?php foreach ($certs as $cert): ?>
                        <div class="col-sm-12 col-lg-4">
                            <div class="cert-item">
                                <div class="cert-item__year"><?php echo esc_html($cert['year']); ?></div>
                                <div class="cert-item__title"><?php echo esc_html($cert['title']); ?></div>
                                <div class="cert-item__issuer"><?php echo esc_html($cert['issuer']); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </section>
        <?php endif; ?>

        <!-- Портфолио врача -->
        <section class="doctor-portfolio-section">
            <?php echo do_shortcode('[doctor_portfolio doctor="current" limit="10"]'); ?>
        </section>

        <!-- Контакты -->
        <?php if ($contacts && is_array($contacts)): ?>
            <section class="doctor-contacts">
                <h2>Контакты</h2>
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <?php if (!empty($contacts['phone'])): ?>
                            <div class="contact-item">
                                <span class="contact-item__label">Телефон:</span>
                                <a href="tel:<?php echo esc_attr($contacts['phone']); ?>" class="contact-item__value">
                                    <?php echo esc_html($contacts['phone']); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($contacts['email'])): ?>
                            <div class="contact-item">
                                <span class="contact-item__label">Email:</span>
                                <a href="mailto:<?php echo esc_attr($contacts['email']); ?>" class="contact-item__value">
                                    <?php echo esc_html($contacts['email']); ?>
                                </a>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($contacts['tg'])): ?>
                            <div class="contact-item">
                                <span class="contact-item__label">Telegram:</span>
                                <a href="<?php echo esc_url($contacts['tg']); ?>" class="contact-item__value">
                                    <?php echo esc_html($contacts['tg']); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
