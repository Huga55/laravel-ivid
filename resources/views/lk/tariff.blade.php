@extends('layouts.index')

@section('content')
<div class="popup popup_auto-pay_off">
	<div class="popup__bg">
		
	</div>
	<div class="popup__content">
		<div class="popup__window">
			<span class="popup__close"></span>
			<img src="img/popup/complete.svg" alt="" class="popup__img-auto">
			<div class="popup__title popup__title_auto">
				Автопродление отключено
			</div>
			<div class="popup__text">
				С сегодняшнего дня мы больше не будем снимать деньги с Вашей карты
			</div>
		</div>
	</div>	
</div>
<div class="popup popup_auto-pay">
	<div class="popup__bg">
		
	</div>
	<div class="popup__content">
		<form class="popup__form popup__form-auto" method="POST" action="">
			<span class="popup__close"></span>
			<img src="img/popup/cart.svg" alt="" class="popup__img-auto">
			<div class="popup__title popup__title_auto">
				Вы уверены, что хотите отключить автопродление ?
			</div>
			<div class="popup__buttons_auto">
				<button class="button popup__button_auto-no">
					нет
				</button>
				<button class="button button_blue popup__button_auto-yes" data-link="{{ route('auto.off') }}">
					Да, отключить
				</button>
			</div>
		</form>
	</div>	
</div>
@include('layouts.headers.header-lk')
<section class="tariff section">
	<div class="tariff__describe">
		<div class="container">
			<div class="tariff__describe-content">		
				<div class="tariff__describe-title">
					Тарифы
				</div>
				<div class="tariff__describe-text">
					Список тарифов и период их действия. Чем больше период действия, тем больше Ваша скидка.
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="tariff__choice">
			<div class="tariff__choice-box tariff__choice-box_first" data-season="1">
				1 месяц
			</div>
			<div class="tariff__choice-box" data-season="3">
				3 месяца
			</div>
			<div class="tariff__choice-box" data-season="6">
				6 месяцев
			</div>
		</div>
		<div class="tariff__content">			
			<div class="tariff__window window">
				<div class="tariff__box-title">
					Эконом
				</div>
				<ul class="tariff__list">
					<li class="tariff__elem">—Полная запись всех событий в облако за последний день</li>
					<li class="tariff__elem">—Интеллектуальные уведомления о движении и звуке</li>
					<li class="tariff__elem">—Локальный видеоархив без ограничений</li>
					<li class="tariff__elem">—Экспорт видео в файл (неограниченное число клипов, длина клипа до 1 часа)</li>
					<li class="tariff__elem">—Передача доступа к камерам 2 другим пользователям</li>
				</ul>
				<div class="tariff__box-bottom">
					<button class="tariff__button button button_blue">
						ВЫБРАТЬ ТАРИФ
					</button>
					<div class="tariff__price">
						299 ₽
					</div>
				</div>
			</div>
			<div class="tariff__window window tariff__window_active">
				<div class="tariff__box-title">
					Стандарт
				</div>
				<ul class="tariff__list">
					<li class="tariff__elem">—Полная запись всех событий в облако за последние 10 дней</li>
					<li class="tariff__elem">—Интеллектуальные уведомления о движении и звуке</li>
					<li class="tariff__elem">—Локальный видеоархив без ограничений</li>
					<li class="tariff__elem">—Экспорт видео в файл (неограниченное число клипов, длина клипа до 2 часаов)</li>
					<li class="tariff__elem">—Передача доступа к камерам 4 другим пользователям</li>
				</ul>
				<div class="tariff__box-bottom">
					<button class="tariff__button button button_blue">
						ВЫБРАТЬ ТАРИФ
					</button>
					<div class="tariff__price">
						299 ₽
					</div>
				</div>
			</div>
			<div class="tariff__window window">
				<div class="tariff__box-title">
					Супер
				</div>
				<ul class="tariff__list">
					<li class="tariff__elem">—Полная запись всех событий в облако за последние 30 дней</li>
					<li class="tariff__elem">—Интеллектуальные уведомления о движении и звуке</li>
					<li class="tariff__elem">—Локальный видеоархив без ограничений</li>
					<li class="tariff__elem">—Экспорт видео в файл (неограниченное число клипов, длина клипа до 1 часа)</li>
					<li class="tariff__elem">—Передача доступа к камерам 2 другим пользователям</li>
				</ul>
				<div class="tariff__box-bottom">
					<button class="tariff__button button button_blue">
						ВЫБРАТЬ ТАРИФ
					</button>
					<div class="tariff__price">
						299 ₽
					</div>
				</div>
			</div>
			<div class="tariff__window window">
				<div class="tariff__box-title">
					Мега
				</div>
				<ul class="tariff__list">
					<li class="tariff__elem">—Полная запись всех событий в облако за последние 10 дней</li>
					<li class="tariff__elem">—Интеллектуальные уведомления о движении и звуке</li>
					<li class="tariff__elem">—Локальный видеоархив без ограничений</li>
					<li class="tariff__elem">—Экспорт видео в файл (неограниченное число клипов, длина клипа до 2 часаов)</li>
					<li class="tariff__elem">—Передача доступа к камерам 4 другим пользователям</li>
				</ul>
				<div class="tariff__box-bottom">
					<button class="tariff__button button button_blue">
						ВЫБРАТЬ ТАРИФ
					</button>
					<div class="tariff__price">
						299 ₽
					</div>
				</div>
			</div>
			<div class="tariff__window window">
				<div class="tariff__box-title">
					Космос
				</div>
				<ul class="tariff__list">
					<li class="tariff__elem">—Полная запись всех событий в облако за последние 30 дней</li>
					<li class="tariff__elem">—Интеллектуальные уведомления о движении и звуке</li>
					<li class="tariff__elem">—Локальный видеоархив без ограничений</li>
					<li class="tariff__elem">—Экспорт видео в файл (неограниченное число клипов, длина клипа до 1 часа)</li>
					<li class="tariff__elem">—Передача доступа к камерам 2 другим пользователям</li>
				</ul>
				<div class="tariff__box-bottom">
					<button class="tariff__button button button_blue">
						ВЫБРАТЬ ТАРИФ
					</button>
					<div class="tariff__price">
						299 ₽
					</div>
				</div>
			</div>
			<div class="tariff__window window">
				<div class="tariff__box-title">
					TEST
				</div>
				<ul class="tariff__list">
					<li class="tariff__elem">—Полная запись всех событий в облако за последние 30 дней</li>
					<li class="tariff__elem">—Интеллектуальные уведомления о движении и звуке</li>
					<li class="tariff__elem">—Локальный видеоархив без ограничений</li>
					<li class="tariff__elem">—Экспорт видео в файл (неограниченное число клипов, длина клипа до 1 часа)</li>
					<li class="tariff__elem">—Передача доступа к камерам 2 другим пользователям</li>
				</ul>
				<div class="tariff__box-bottom">
					<button class="tariff__button button button_blue">
						ВЫБРАТЬ ТАРИФ
					</button>
					<div class="tariff__price">
						299 ₽
					</div>
				</div>
			</div>
		</div>
		<div class="tariff__window_auto window">
			<div class="tariff__subtitle">
				Автопродление
			</div>
			<div class="tariff__box">
				Для вашего удобства мы можем автоматически продлевать установленный вами тарифный план на данной камере с помощью списания денег с вашего баланса или привязанной к аккаунту банковской карты.
			</div>
			<div class="tariff__buttons">
				<form action="{{ route('pay.tariff') }}" method="POST">
					{{ csrf_field() }}
					<input type="hidden" name="price">
					<input type="hidden" name="month">
					<button class="button tariff__pay-buttons tariff__pay-button"  disabled>
						Оплатить
					</button>
				</form>
				@if($data['status'] && $data['auto_pay'])
					<button class="button button_blue tariff__pay-buttons tariff__autopay">
						Выключить
					</button>
				@elseif($data['status'] && !$data['auto_pay'])
					<button class="button button_blue tariff__pay-buttons tariff__autopay" data-link="{{ route('auto.on') }}">
						Включить
					</button>
				@endif
			</div>
		</div>
	</div>
</section>
@endsection