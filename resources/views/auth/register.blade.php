@extends('layouts.index')

@section('content')

<div class="popup popup_register" id="popup">
	<div class="popup__bg">
		
	</div>
	<div class="popup__content">
		<div class="popup__window">
			<span class="popup__close"></span>
			<div class="popup__img popup__img_registr">
				
			</div>
			<div class="popup__title">
				Спасибо за регистрацию
			</div>
			<div class="popup__text">
				Теперь вы можете войти<br>в личный кабинет
			</div>
			<a href="{{ route('register-accept') }}" class="button button_blue popup__button registr__button-popup">
				Войти
			</a>
		</div>
	</div>	
</div>
<section class="registr">
	<div class="container">
		<div class="registr__content">
			<div class="form-window registr__window window">
				<a href="{{ route('main') }}" class="form-link-logo registr__link-logo">
					<img src="img/registr/logo.svg" alt="" class="registr__icon-logo">
				</a>
				<form action="{{ route('user-create') }}" class="registr__form" method="POST">
					<div class="form-title registr__title">
						Начните работать с нами
					</div>
					<div class="form-subtitle registr__subtitle">
						Зарегистрируйтесь или <a href="{{ route('author') }}" class="registr__link-entry form-link-entry">войдите</a> 
					</div>
					{{ csrf_field() }}
					<input type="text" name="name" class="input form-input registr__input_name" placeholder="Ваше имя" value="">
					<input type="text" name="email" class="input form-input registr__input_email" placeholder="Ваш email" value="">
					<input type="text" name="phone" class="input form-input registr__input registr__input_phone" placeholder="+7 (___) - __ - __" value="">
					<input type="password" name="password" class="input form-input registr__input_password" placeholder="Введите пароль">
					<input type="password" name="password_double" class="input form-input registr__input_password_double" placeholder="Повторите пароль">
					<button type="submit" class="button form-button registr__button button_blue">Зарегистрироваться</button>
					<input class="registr__agree" type="checkbox" name="agree" id="agree" checked>
					<label for="agree" class="registr__check">Нажимая на кнопку, вы даете согласие на<a class="registr__link-contract" href="">Обработку персональных данных</a></label>
				</form>
			</div>
		</div>
	</div>
	<div class="prompt registr__prompt">
		<div class="prompt__title">
			
		</div>
		<div class="prompt__desribe">
			
		</div>
	</div>
</section>
@endsection