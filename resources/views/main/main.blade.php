@extends('layouts.index')

@section('content')
@include('layouts.headers.header-main')
<section class="general" id="general">
	<div class="container">
		<h1 class="general__title">
			Установка систем видеонаблюдения
		</h1>
		<h2 class="general__subtitle button button_blue">
			«под ключ» за 1 день
		</h2>
		<div class="general__order order">
			<div class="order__title">
				Закажите установку видеонаблюдения
			</div>
			<div class="order__sutitle">
				И получите дополнительный терабайт на жестком диске бесплатно!
			</div>
			<form action="" class="order__form">
				<input type="text" class="order__input input" placeholder="Ваше имя">
				<input type="text" class="order__input input" placeholder="+7 (___) - __ - __">
				<button type="submit" class="order__button button button_blue">
					Получить подарок
				</button>
			</form>
		</div>
	</div>
</section>
<section class="offer">
	<div class="container">
		<div class="offer__top">
			<div class="offer__window offer__window_1">
				<div class="offer__title">Поддержка в любом месенджере</div>
				<div class="offer__describe">Получайте ответы на вопросы в любое время в удобном формате прямо в мессенджере или нашем сайте</div>
			</div>
			<div class="offer__window offer__window_2">
				<div class="offer__title">Только качественный монтаж</div>
				<div class="offer__describe">Осуществим монтаж без пыли и мусора, согласно СНиП и ГОСТу</div>
			</div>
			<div class="offer__window offer__window_3">
				<div class="offer__title">Гарантия от производителей</div>
				<div class="offer__describe">Гарантия на оборудование 36 месяцев от производителей систем видеонаблюдений</div>
			</div>
		</div>
		<div class="offer__bottom">
			<div class="offer__left">
				<div class="offer__title_bottom">
					Расчет стоимости подключения
				</div>
				<div class="offer__describe_bottom">
					Оставьте заявку и получите расчет стоимости подключения нашей системы под ваши потребности и задачаи
				</div>
			</div>
			<div class="offer__right">
				<a href="call" class="offer__button button button_blue">оставить заявку</a>
			</div>
		</div>
	</div>
</section>
<section class="about">
	<div class="container">
		<div class="about__content">
			<div class="about__box">
				<img src="{{ asset('img/about/icon1.svg') }}" alt="" class="about__icon">
				<div class="about__title">Экономия на оборудовании</div>
				<div class="about__text">Камеры в рассрочку до 36 месяцев, просмотр и управление через веб-сервис </div>
			</div>
			<div class="about__box">
				<img src="{{ asset('img/about/icon2.svg') }}" alt="" class="about__icon">
				<div class="about__title">Доступ откуда угодно</div>
				<div class="about__text">Трансляция и записи с камер доступны Вам из любой точки мира, где есть интернет</div>
			</div>
			<div class="about__box">
				<img src="{{ asset('img/about/icon3.svg') }}" alt="" class="about__icon">
				<div class="about__title">Профессиональная установка</div>
				<div class="about__text">Опытный специалист изучит ваше помещение и выполнит установку видеонаблюдения</div>
			</div>
			<div class="about__box">
				<img src="{{ asset('img/about/icon4.svg') }}" alt="" class="about__icon">
				<div class="about__title">Техническая поддержка</div>
				<div class="about__text">Поможем в любых вопросах и проблемах, если в них есть необходимость. Всегда придем на помощь</div>
			</div>
			<div class="about__box">
				<img src="{{ asset('img/about/icon5.svg') }}" alt="" class="about__icon">
				<div class="about__title">Облако для видео</div>
				<div class="about__text">Можно хранить записи на удаленных серверах, если нет своих — от 3 до 90 дней</div>
			</div>
			<div class="about__box">
				<img src="{{ asset('img/about/icon6.svg') }}" alt="" class="about__icon">
				<div class="about__title">Любой интернет</div>
				<div class="about__text">Видеонаблюдение работает с интернетом любого провайдера</div>
			</div>
		</div>
	</div>
</section>
<section class="key">
	<div class="container">
		<h2 class="key__title">
			Интересует решение «под ключ»?
		</h2>
		<div class="key__top">
			<div class="key__box">
				<img src="{{ asset('img/key/icon1.svg') }}" alt="" class="key__img">
				<div class="key__subtitle">Изучим</div>
				<div class="key__describe">Наш специалист изучит ваше помещение, подготовит решение и произведёт монтаж</div>
			</div>
			<div class="key__box">
				<img src="{{ asset('img/key/icon2.svg') }}" alt="" class="key__img">
				<div class="key__subtitle">Подберем камеры</div>
				<div class="key__describe">Под ваши потребности: для дома, улицы, магазина или офиса</div>
			</div>
			<div class="key__box">
				<img src="{{ asset('img/key/icon3.svg') }}" alt="" class="key__img">
				<div class="key__subtitle">Реализуем</div>
				<div class="key__describe">Любые сложные проекты, например в условиях нестабильного интернета</div>
			</div>
		</div>
		<div class="key__bottom">
			<div class="key__left">
				<div class="key__subtitle">
					Расчет стоимости
				</div>
				<div class="key__text">
					Оставьте заявку и наш специалист подготовит для вас комплексное решение Вашей задачи и рассчитает стоимость
				</div>
			</div>
			<div class="key__right">
				<a href="call" class="key__button button button_blue">
					оставить заявку
				</a>
			</div>
		</div>
	</div>
</section>
<section class="pairs">
	<div class="container">
		<div class="pairs__title">
			Мы официальные партнеры
		</div>
		<div class="pairs__content">
			<div class="pairs__box">
				<img class="pairs__img" alt="" src="{{ asset('img/pairs/img1.jpg') }}">
			</div>
			<div class="pairs__box">
				<img class="pairs__img" alt="" src="{{ asset('img/pairs/img2.jpg') }}">
			</div>
			<div class="pairs__box">
				<img class="pairs__img" alt="" src="{{ asset('img/pairs/img3.jpg') }}">
			</div>
		</div>
	</div>
</section>
@include('layouts.footer.footer')
@endsection

