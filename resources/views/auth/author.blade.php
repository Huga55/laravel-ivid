@extends('layouts.index')

@section('content')
<section class="author" data-link="">
	<div class="container">
		<div class="author__content">
			<div class="form-window author__window window">
				<a href="{{ route('main') }}" class="form-link-logo registr__link-logo">
					<img src="img/registr/logo.svg" alt="" class="registr__icon-logo">
				</a>
				<div class="author__title form-title">
					Начните работать с нами
				</div>
				<div class="form-subtitle author__subtitle">
					Войдите или <a href="{{ route('register') }}" class="registr__link-entry form-link-entry">зарегистрируйтесь</a>
				</div>
				<form action="{{ route('enter') }}" class="author__form" method="post">
					{{ csrf_field() }}
					<input type="text" name="login" class="input form-input author__input author__email author__input_login" placeholder="Email или телефон">
					<input type="password" name="password" class="input form-input author__input author__pass author__input_password" placeholder="Пароль">
					<input type="submit" class="form-button autor__button button button_blue" value="Войти">
					<input class="registr__agree" type="checkbox" name="agree" id="agree" checked>
					<label for="agree" class="registr__check">Нажимая на кнопку, вы даете согласие на<a class="registr__link-contract" href="">Обработку персональных данных</a></label>
				</form>
			</div>
		</div>
	</div>
	<div class="prompt">
		<div class="prompt__title">

		</div>
		<div class="prompt__desribe">

		</div>
	</div>
</section>
@endsection