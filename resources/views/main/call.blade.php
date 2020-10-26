@extends('layouts.index')

@section('content')
<div class="popup">
	<div class="popup__bg">
		
	</div>
	<div class="popup__content">
		<div class="popup__window">
			<span class="popup__close"></span>
			<div class="popup__img popup__img_accept">
				
			</div>
			<div class="popup__title">
				Ваша заявка оформлена
			</div>
			<div class="popup__text">
				Совсем скоро мы с Вами свяжемся
			</div>
		</div>
	</div>	
	<a href="{{ route('main') }}" class="popup__button-ok"></a>
</div>
<section class="call">
	<div class="container">
		<div class="call__content">
			<div class="form-window window call__window">
				<a href="{{ route('main') }}" class="form-link-logo registr__link-logo">
					<img src="img/registr/logo.svg" alt="" class="registr__icon-logo">
				</a>
				<form action="" class="call__form">
					<div class="form-title call__title">
						Есть вопросы? Хотите оставить заявку на услугу?
					</div>
					<div class="form-subtitle call__subtitle">
						Мы перезвоним Вам в ближайшее время!
					</div>
					<input name="name" type="text" class="input form-input call__input call__input_name" placeholder="Ваше имя" pattern=".{1,}">
					<input name="phone" type="text" class="input form-input call__input call__input_phone" placeholder="+7 (___) - __ - __">
					<button type="submit" class="button form-button call__button button_blue button_disabled">Оставить заявку</button>
					<input class="registr__agree" type="checkbox" name="agree" id="agree" checked>
					<label for="agree" class="registr__check">Нажимая на кнопку, вы даете согласие на<a class="registr__link-contract" href="">Обработку персональных данных</a></label>
				</form>
			</div>
		</div>
	</div>
	<div class="prompt registr__prompt">
		<div class="prompt__title">
			<div class="prmpt__title"></div>
		</div>
		<div class="prompt__desribe">
			<div class="prompt__describe"></div>
		</div>
	</div>
</section>
@endsection