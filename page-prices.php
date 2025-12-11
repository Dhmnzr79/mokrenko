<?php
/**
 * Template Name: Цены
 */
get_header();
?>

<section class="section section--page-intro-mobile page-intro-mobile">
	<div class="container">
		<div class="page-intro-mobile__box">
			<h1>30 лет опыта в каждом решении и улыбке пациента</h1>
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mokrenko_first_mobile.png" alt="Доктор Мокренко" class="page-intro-mobile__image">
		</div>
		<div class="page-intro-mobile__benefits">
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Беспроцентная рассрочка 0% на 12 мес.</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Высококлассные врачи с опытом более<br>10 лет</p>
			</div>
			<div class="page-intro-mobile__benefit-item">
				<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_2.svg" alt="Галочка" class="page-intro-mobile__benefit-icon">
				<p>Честные цены без накруток и скрытых<br>платежей</p>
			</div>
		</div>
		<button class="btn page-intro-mobile__cta-btn">
			Записаться на консультацию
			<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
		</button>
	</div>
</section>

<section class="section section--page-intro page-intro">
	<div class="container">
		<div class="page-intro__box bg-gradient-brand">
			<div class="hero__menu">
				<div class="hero__menu-burger">
					<button class="hero__burger-btn">
						<span class="hero__burger-icon"></span>
						<span class="hero__burger-text">Услуги</span>
					</button>
				</div>
				<nav class="hero__menu-nav">
					<a href="<?php echo esc_url(get_page_url_by_template('page-about.php')); ?>" class="hero__menu-link">О клинике</a>
					<a href="#" class="hero__menu-link">Портфолио</a>
					<a href="<?php echo esc_url(get_page_url_by_template('page-doctors.php')); ?>" class="hero__menu-link">Врачи</a>
					<a href="<?php echo esc_url(get_page_url_by_template('page-prices.php')); ?>" class="hero__menu-link">Прайс</a>
					<a href="#" class="hero__menu-link">Акции</a>
					<a href="<?php echo esc_url(get_page_url_by_template('page-blog.php')); ?>" class="hero__menu-link">Блог</a>
					<a href="<?php echo esc_url(get_page_url_by_template('page-reviews.php')); ?>" class="hero__menu-link">Отзывы</a>
					<a href="<?php echo esc_url(get_page_url_by_template('page-contacts.php')); ?>" class="hero__menu-link">Контакты</a>
				</nav>
				<div class="hero__menu-search">
					<button class="hero__search-btn">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/search.svg" alt="Поиск" class="hero__search-icon">
					</button>
				</div>
			</div>
			<div class="page-intro__layout">
				<div class="page-intro__content">
					<h1>30 лет опыта в каждом решении и улыбке пациента</h1>
					<div class="page-intro__benefits">
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Беспроцентная рассрочка 0% на 12 мес.</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Высококлассные врачи с опытом более<br>10 лет</p>
						</div>
						<div class="page-intro__benefit-item">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/chk_1.svg" alt="Галочка" class="page-intro__benefit-icon">
							<p>Честные цены без накруток и скрытых<br>платежей</p>
						</div>
					</div>
					<button class="btn page-intro__cta-btn">
						Записаться на консультацию
						<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка">
					</button>
				</div>
				<div class="page-intro__info">
					<h4>Главный врач:</h4>
					<p>Елена Мокренко - стоматолог-ортопед с опытом работы более 33-х лет</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section section--breadcrumbs">
	<div class="container">
		<div class="breadcrumbs">
			<a href="/" class="breadcrumbs__link">Главная</a>
			<span class="breadcrumbs__separator">→</span>
			<span class="breadcrumbs__current">Цены</span>
		</div>
	</div>
</section>

<section class="section section--prices prices">
	<div class="container">
		<div class="prices__category">
			<h3 class="prices__category-title">Имплантация зубов</h3>
			<div class="prices__list">
				<div class="prices__item">
					<div class="prices__service">Операция по установке винтового имплантата Osstem (Южная Корея)</div>
					<div class="prices__price prices__price--discount">
						<div class="prices__price-old">52 000</div>
						<div class="prices__price-new">19 500 руб.</div>
					</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция по установке винтового имплантата Nobel Biocare (Швейцария)</div>
					<div class="prices__price prices__price--discount">
						<div class="prices__price-old">80 000</div>
						<div class="prices__price-new">65 000 руб.</div>
					</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция по установке винтового имплантата Astra Tech (Швеция)</div>
					<div class="prices__price prices__price--discount">
						<div class="prices__price-old">80 000</div>
						<div class="prices__price-new">65 000 руб.</div>
					</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция установки имплантатов для дальнейшего зубопротезирования "Все на 4-х" (Osstem)</div>
					<div class="prices__price prices__price--discount">
						<div class="prices__price-old">219 000</div>
						<div class="prices__price-new">159 000 руб.</div>
					</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция установки имплантатов для дальнейшего зубопротезирования ALL-ON-4 (Nobel)</div>
					<div class="prices__price prices__price--discount">
						<div class="prices__price-old">319 000</div>
						<div class="prices__price-new">259 000 руб.</div>
					</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция установки имплантатов для дальнейшего зубопротезирования "Все на 4-x" (Neodent)</div>
					<div class="prices__price prices__price--discount">
						<div class="prices__price-old">279 000</div>
						<div class="prices__price-new">204 000 руб.</div>
					</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Протетические компоненты для системы NobelSpeedy Groovy</div>
					<div class="prices__price">100 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция установки имплантатов для дальнейшего зубопротезирования ALL-ON-6 (Nobel)</div>
					<div class="prices__price">349 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция по установке винтового имплантата Straumann (Швейцария)</div>
					<div class="prices__price">80 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Установка формирователя десны Straumann (Швейцария)</div>
					<div class="prices__price">5 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Хирургический шаблон</div>
					<div class="prices__price">30 000 руб.</div>
				</div>
				<div class="prices__item prices__item--last">
					<div class="prices__service">Операция установки имплантатов для дальнейшего зубопротезирования "Все на 6-ти" (Osstem)</div>
					<div class="prices__price">189 000 руб.</div>
				</div>
			</div>
		</div>
		
		<div class="prices__category">
			<h3 class="prices__category-title">Лечение</h3>
			<div class="prices__list">
				<div class="prices__item">
					<div class="prices__service">Восстановление центральных зубов высокоэстетичным композитом (1 поверхность)</div>
					<div class="prices__price">7 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Восстановление центральных зубов высокоэстетичным композитом (2 поверхности)</div>
					<div class="prices__price">8 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Восстановление центральных зубов высокоэстетичным композитом (3 поверхности)</div>
					<div class="prices__price">9 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Восстановление жевательных зубов из высокопрочного композита (1 поверхность)</div>
					<div class="prices__price">7 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Восстановление жевательных зубов из высокопрочного композита (2 поверхности)</div>
					<div class="prices__price">8 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Восстановление жевательных зубов из высокопрочного композита (3 поверхности)</div>
					<div class="prices__price">9 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Восстановление зуба композитом, лечение кариеса (художественная реставрация с повышенными эстетическими показателями 1 категории)</div>
					<div class="prices__price">11 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Восстановление зуба композитом, лечение кариеса (художественная реставрация с повышенными эстетическими показателями 2 категории)</div>
					<div class="prices__price">15 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Прямое восстановление скола керамики</div>
					<div class="prices__price">7 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Наложение временной пломбы</div>
					<div class="prices__price">400 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Наложение композитной временной пломбы</div>
					<div class="prices__price">1 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Прямое моделирование штифтовой культи (билд ап)</div>
					<div class="prices__price">10 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Восстановление зуба под ортопедическую конструкцию</div>
					<div class="prices__price">6 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Установка стекловолоконного штифта</div>
					<div class="prices__price">4 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Установка стекловолоконного штифта с прямым моделированием штифтовой культи (билд ап)</div>
					<div class="prices__price">13 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Эстетическая (художественная) реставрация фронтального зуба</div>
					<div class="prices__price">15 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Механическая и медикаментозная обработка 1-но каналального зуба</div>
					<div class="prices__price">1 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Механическая и медикаментозная обработка 2-х каналального зуба</div>
					<div class="prices__price">3 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Механическая и медикаментозная обработка 3-х канального зуба</div>
					<div class="prices__price">4 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Механическая и медикаментозная обработка 1-го (дополнительного канала)</div>
					<div class="prices__price">1 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Временное пломбирование 1-но канального зуба пастами Каласепт</div>
					<div class="prices__price">1 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Временное пломбирование 2-х канального зуба пастами Каласепт</div>
					<div class="prices__price">2 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Временное пломбирование 3-х канального зуба пастами Каласепт</div>
					<div class="prices__price">3 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Временное пломбирование 1-го (дополнительного) канала пастами Каласепт</div>
					<div class="prices__price">900 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Распломбирование 1-го канала</div>
					<div class="prices__price">2 300 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Использование коффердама</div>
					<div class="prices__price">1 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Использование Optra Gate</div>
					<div class="prices__price">1 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Установка анкерного штифта</div>
					<div class="prices__price">3 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Лечение периодонтита</div>
					<div class="prices__price">от 15 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Лечение пульпита</div>
					<div class="prices__price">от 10 000 руб.</div>
				</div>
				<div class="prices__item prices__item--last">
					<div class="prices__service">Лечение пульпита под микроскопом</div>
					<div class="prices__price">от 20 000 руб.</div>
				</div>
			</div>
		</div>
		
		<div class="prices__category">
			<h3 class="prices__category-title">Хирургия</h3>
			<div class="prices__list">
				<div class="prices__item">
					<div class="prices__service">Удаление постоянного зуба (простое)</div>
					<div class="prices__price">3 570 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удаление постоянного зуба 1 степени сложности</div>
					<div class="prices__price">4 590 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удаление постоянного зуба 2 степени сложности</div>
					<div class="prices__price">6 732 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удаление постоянного зуба 3-4 степени подвижности</div>
					<div class="prices__price">1 938 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удаление молочного зуба</div>
					<div class="prices__price">3 570 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удаление ретинированного и дистопированного зуба</div>
					<div class="prices__price">12 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удаление экзостозов в области 1 зуба</div>
					<div class="prices__price">4 080 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Резекция верхушки корня (1 единица)</div>
					<div class="prices__price">15 300 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удаление подвижного зуба</div>
					<div class="prices__price">2 100 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удаление постоянного зуба простое</div>
					<div class="prices__price">3 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удаление постоянного зуба сложное (с рассечением корней)</div>
					<div class="prices__price">4 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удаление 8-го зуба (зуб мудрости)</div>
					<div class="prices__price">9 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удаление фрагмента зуба</div>
					<div class="prices__price">5 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция открытый синус-лифтинг</div>
					<div class="prices__price">72 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция закрытый синус-лифтинг</div>
					<div class="prices__price">45 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Аутотрансплантация соединительного лоскута</div>
					<div class="prices__price">11 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Забор аутокости с донорских участков при помощи "Костной ловушки" или костного скребка</div>
					<div class="prices__price">12 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Увеличение альвеолярного гребня методом расщепления</div>
					<div class="prices__price">35 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Коррекция десневого края</div>
					<div class="prices__price">30 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Увеличение коронковой части в области 1-го зуба</div>
					<div class="prices__price">6 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Иссечение доброкачественного образования слизистой оболочки</div>
					<div class="prices__price">10 200 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция направленной регенерации костной ткани (от 1-3 зубов)</div>
					<div class="prices__price">24 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция направленной регенерации костной ткани (более 3-х зубов)</div>
					<div class="prices__price">32 700 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Операция направленной регенерации костной ткани (1/2 челюсти)</div>
					<div class="prices__price">42 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Костный материал 1,0 гр.</div>
					<div class="prices__price">15 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Костный материал 0,5 гр.</div>
					<div class="prices__price">7 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Пины (1 пин)</div>
					<div class="prices__price">1 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Малая мембрана 10х15</div>
					<div class="prices__price">15 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Большая мембрана 20х30</div>
					<div class="prices__price">20 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Малая мембрана 1/2</div>
					<div class="prices__price">7 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Большая мембрана 1/2</div>
					<div class="prices__price">10 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Использование PRF</div>
					<div class="prices__price">17 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Цистотомия или цистэктомия одонтогенной кисты</div>
					<div class="prices__price">6 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Гингивоэктомия 1-го зуба</div>
					<div class="prices__price">2 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Пластика уздечки языка</div>
					<div class="prices__price">9 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Пластика уздечки верхней губы</div>
					<div class="prices__price">9 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Пластика уздечки нижней губы</div>
					<div class="prices__price">9 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Пластика альвеолярного отростка: при костных экзостозах</div>
					<div class="prices__price">7 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Удлинение клинической коронки одного зуба</div>
					<div class="prices__price">13 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Лоскутная операция в области однокорневого зуба</div>
					<div class="prices__price">9 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Лоскутная операция в области многокорневого зуба</div>
					<div class="prices__price">10 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Лоскутная операция в полости рта 1 квадрант</div>
					<div class="prices__price">39 500 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Костная пластика челюстно-лицевой области с использованием костного материала Bio Oss 1гр (Швейцария)</div>
					<div class="prices__price">20 000 руб.</div>
				</div>
				<div class="prices__item prices__item--last">
					<div class="prices__service">Костная пластика челюстно-лицевой области с использованием мембраны Bio-Gide 20x30 (Швейцария)</div>
					<div class="prices__price">20 000 руб.</div>
				</div>
			</div>
		</div>
		
		<div class="prices__category">
			<h3 class="prices__category-title">Анестезиология</h3>
			<div class="prices__list">
				<div class="prices__item">
					<div class="prices__service">Аппликационная анестезия</div>
					<div class="prices__price">800 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Инфильтрационная анестезия</div>
					<div class="prices__price">1 800 руб.</div>
				</div>
				<div class="prices__item prices__item--last">
					<div class="prices__service">Проводниковая анестезия</div>
					<div class="prices__price">1 800 руб.</div>
				</div>
			</div>
		</div>
		
		<div class="prices__category">
			<h3 class="prices__category-title">Консультация и диагностика</h3>
			<div class="prices__list">
				<div class="prices__item">
					<div class="prices__service">Справка о санации</div>
					<div class="prices__price">1 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Изготовление диагностической модели</div>
					<div class="prices__price">5 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Слепок поливинилсилоксановый</div>
					<div class="prices__price">3 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Слепок альгинатный (как отдельная процедура)</div>
					<div class="prices__price">3 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">WAX-UP восковое моделирование (1 зуб)</div>
					<div class="prices__price">4 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">WAX-UP восковое эстетическое моделирование (1 зуб) сделанный в артикуляторе с настройкой индивидуальных параметров</div>
					<div class="prices__price">5 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">WAX-UP восковое моделирование (1 зуб) сделанный в артикуляторе с настройкой индивидуальных параметров</div>
					<div class="prices__price">5 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Ретракция десны (как отдельная процедура)</div>
					<div class="prices__price">100 руб.</div>
				</div>
				<div class="prices__item prices__item--last">
					<div class="prices__service">Функциональный анализ: снятие оттисков, изготовление диагностических моделей, определение пространственного положения верхней челюсти, регистрация центрального соотношения челюстей, функциональный анализ челюстно-лицевой области (мышцы, связочный аппарат)</div>
					<div class="prices__price">50 000 руб.</div>
				</div>
			</div>
		</div>
		
		<div class="prices__category">
			<h3 class="prices__category-title">Отбеливание</h3>
			<div class="prices__list">
				<div class="prices__item">
					<div class="prices__service">Профессиональное отбеливание. Дополнительный материал для домашнего отбеливания Opalescence (2 каппы; отбеливающий гель)</div>
					<div class="prices__price">30 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Профессиональное отбеливание. Дополнительный материал для домашнего отбеливания Opalescence Boost (1шт)</div>
					<div class="prices__price">15 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Профессиональное отбеливание зубов. Дополнительные шприцы (1 шт) отбеливающего материала из набора для домашнего отбеливания</div>
					<div class="prices__price">15 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Профессиональное отбеливание зубов аппаратом "Zoom" (1 челюсть)</div>
					<div class="prices__price">30 000 руб.</div>
				</div>
				<div class="prices__item">
					<div class="prices__service">Профессиональное отбеливание зубов аппаратом "Zoom" (2 челюсти)</div>
					<div class="prices__price">60 000 руб.</div>
				</div>
				<div class="prices__item prices__item--last">
					<div class="prices__service">Внутриканальное отбеливание</div>
					<div class="prices__price">от 2 500 руб.</div>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Contacts Section -->
<section class="section section--contacts contacts">
	<div class="container">
		<div class="contacts__box">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/images/mokrenko_first.png" alt="Врач" class="contacts__bg">
			<div class="row">
				<div class="col-sm-12 col-lg-6">
					<!-- Пустая колонка для фото -->
				</div>
				<div class="col-sm-12 col-lg-6">
					<div class="contacts__content">
						<h2>Контакты</h2>
						<ul class="contacts__list">
							<li data-emoji="📍">г. Москва, проспект Мира, д. 57, корп. 2</li>
							<li data-emoji="📞">+7 (495) 123-45-67</li>
							<li data-emoji="✉️">info@mokrenko.ru</li>
							<li data-emoji="🕒">Пн-Пт: 9:00 - 21:00<br>Сб-Вс: 10:00 - 18:00</li>
						</ul>
						<div class="contacts__question">
							<h3>Остались вопросы?</h3>
							<p>Задайте свой вопрос, и мы бесплатно проконсультируем Вас в течении 5 минут</p>
						</div>
						<button class="btn contacts__cta-btn">
							Записаться на приём
							<img src="<?php echo get_template_directory_uri(); ?>/assets/svg/arrow_btn.svg" alt="Стрелка" class="contacts__cta-arrow">
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>

