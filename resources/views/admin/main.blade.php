@extends('admin.layouts.index')

@section('content')
<div class="top">
	<div class="container">
		<nav class="nav">
			<form action="" class="nav__form" method__post>
				<ul class="nav__list">
					<li class="nav__elem"><a href="main.php" class="nav__link nav__link_active">Главная страница</a></li>
					<li class="nav__elem"><a href="list" class="nav__link">Список клиентов</a></li>
					<li class="nav__elem"><a href="date" class="nav__link">Статистика по клиентам</a></li>
				</ul>
			</form>	
		</nav>
	</div>
</div>
<div class="info">
	<div class="container">
		<div class="info__content">
			<div class="info__left">
				<div class="info__date">
					Оплат за сегодня, 15 июля
				</div>
				<div class="info__salary">
					4800 ₽
				</div>
			</div>
			<div class="info__right">
				<div class="info__block">
					<div class="info__name">Всего клиентов</div>
					<div class="info__index">14</div>
				</div>|
				<div class="info__block">
					<div class="info__name">Кол-во платежей</div>
					<div class="info__index">4</div>
				</div>|
				<div class="info__block">
					<div class="info__name">Средняя сумма</div>
					<div class="info__index">1200</div>
				</div>
			</div>
		</div>
		<div class="office__bottom window">
			<ul class="office__nav">
				<li class="office__elem">
					<a href="#" data-status="3" class="office__link office__link_first">
						Все оплаты
					</a>
				</li>
				<li class="office__elem">
					<a href="#" data-status="0" class="office__link">
						Успешные оплаты
					</a>
				</li>
				<li class="office__elem">
					<a href="#" data-status="1" class="office__link">
						Неуспешные оплаты
					</a>
				</li>
			</ul>
			<img class="office__preloader" src="{{ asset('img/other/preloader.gif') }}" alt="">
			<div class="office__table table">
				
			</div>
			<button class="office__add button" data-status="3">
				Показать еще оплаты
			</button>
		</div>
	</div>
</div>


@endsection