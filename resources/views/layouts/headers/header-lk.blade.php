<section class="header-lk">
	<div class="header-lk__line">
		
	</div>
	<div class="container header-lk__container">
		<div class="header-lk__top">
			<a href="{{ route('main') }}" class="header-lk__link-main"><img src="../img/header/logo-lk.svg" alt="" class="header-lk__logo"></a>
		</div>
		<div class="header-lk__bottom">
			<ul class="header-lk__nav">
				<li class="header-lk__elem">
					@if(url()->full() === route('office') )
					<a href="{{ route('office') }}" class="header-lk__link header-lk__link_active">
					@else
					<a href="{{ route('office') }}" class="header-lk__link">
					@endif
						Главная
					</a>
				</li>
				<li class="header-lk__elem">
					@if(url()->full() === route('tariff') )
					<a href="{{ route('tariff') }}" class="header-lk__link header-lk__link_active">
					@else
					<a href="{{ route('tariff') }}" class="header-lk__link">
					@endif
						Услуги
					</a>
				</li>
				<li class="header-lk__elem">
					<a href="#" class="header-lk__link header-lk__link_no-active">
						Мои камеры
					</a>
				</li>
				<li class="header-lk__elem">
					<a href="#" class="header-lk__link header-lk__link_no-active">
						Магазин
					</a>
				</li>
				<li class="header-lk__elem">
					<a href="#" class="header-lk__link header-lk__link_no-active">
						Настройки
					</a>
				</li>
				<li class="header-lk__elem">
					<a href="#" class="header-lk__link header-lk__link_no-active">
						Контакты
					</a>
				</li>
			</ul>
			<div class="header-lk__login">
				Привет, {{ $user->email }}
				<div class="header-lk__add">
					<div class="header-lk__name">
						{{ $user->name }}
					</div>
					<div class="header-lk__email">
						{{ $user->email }}
					</div>
					<a href="{{ route('logout') }}" class="header-lk__exit" type="submit">
						Выход
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="burger burger_lk mobile"><span class="burger__line"></span></div>	
</section>