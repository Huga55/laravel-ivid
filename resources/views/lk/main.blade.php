@extends('layouts.index')

@section('content')
<div class="popup popup_pay">
	<div class="popup__bg">
		
	</div>
	<div class="popup__content">
		<form class="popup__form" method="POST" action="{{ route('pay.purse.up') }}">
			{{ csrf_field() }}
			<span class="popup__close"></span>
			<div class="popup__title_pay">
				Укажите сумму пополнения
			</div>
			<div class="popup__subtitle">
				Зачисление денег в течение дня
			</div>
			<img src="img/popup/tink.png" alt="" class="popup__icon">
			<label for="" class="popup__label">Сумма пополнения</label>
			<input type="text" class="input popup__input popup__input_money" name="money" placeholder="Укажите желаемую сумму пополнения">
			<div class="popup__min">Минимальная сумма - 10 рублей</div>
			<div class="popup__max">Максимальная сумма - 100 000 рублей</div>
			<div class="popup__buttons_pay">
				<button type="submit" class="button button_blue popup__button_pay">
					Пополнить
				</button>
				<button class="button popup__button_cancel">
					Отмена
				</button>
			</div>
		</form>
		<div class="prompt registr__prompt">
			<div class="prompt__title">
				
			</div>
			<div class="prompt__desribe">
				
			</div>
		</div>
	</div>	
</div>
<div class="modal">
	<div class="modal__bg"></div>
	<div class="modal-cancel__window modal-pay__window">
		<span class="popup__close"></span>
		<img src="{{ asset('img/modal/cancel.svg') }}" alt="" class="modal__img">
		<div class="modal-pay__title modal-cancel__title">
			Вы уверены, что хотите отключить тариф «{{ $tariff_name }}» ?
		</div>
		<div class="modal__buttons">
			<a href="#" class="modal-cancel__cancel modal-cancel__button">
				нет
			</a>
			<a href="{{ route('tariff.delete') }}" class="modal-cancel__success modal-cancel__button">
				Да, отключить
			</a>
		</div>
	</div>
	@if($result_pay['is_exist'] && $result_pay['result'])
	<div class="modal-success__window modal-pay__window">
		<span class="popup__close"></span>
		<img src="{{ asset('img/modal/success.svg') }}" alt="" class="modal__img">
		<div class="modal-pay__title">
			Баланс успешно пополнен
		</div>
		<div class="modal__text">
			на сумму {{ $result_pay['price'] }} рублей 
		</div>
	</div>
	@elseif($result_pay['is_exist'] && !$result_pay['result'])
	<div class="modal-error__window modal-pay__window">
		<span class="popup__close"></span>
		<img src="{{ asset('img/modal/error.svg') }}" alt="" class="modal__img">
		<div class="modal-pay__title">
			Ошибка, оплата не прошла
		</div>
		<div class="modal__text">
			на сумму {{ $result_pay['price'] }} рублей 
		</div>
	</div>
	@endif
</div>
@include('layouts.headers.header-lk')
<section class="office">
	<div class="container">
		<div class="office__content">
			<div class="office__top">
				<div class="office__left window">
					<div class="office__info-top">
						<div class="office__text">
							Ваш тариф сейчас:
						</div>
						<div class="office__buttons">
							<button class="office__button office__button_cancel button">
								отключить
							</button>
							<a href="{{ route('tariff') }}" class="office__button button">
								изменить тариф
							</a>	
						</div>
					</div>
					<div class="office__info-bottom">
						<div class="office__tariff-name">
							{{ $user->info->tariff->name }}
						<span class="office__tariff-price">
							за {{ $user->info->tariff->$month }},00 ₽
						</span>
						</div>
					</div>
				</div>
				<div class="office__right">
					<div class="office__cart-title">
						Ваш баланс
					</div>
					<div class="office__money">
						{{ $user->info->money }}
					</div>	
					<button class="office__cart-button button button_blue">
						Пополнить баланс
					</button>
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
</section>
@include('layouts.footer.footer-lk')
@endsection