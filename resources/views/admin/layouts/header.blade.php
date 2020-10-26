<section class="header-lk">
	<div class="header-lk__line">
		
	</div>
	<div class="container header-lk__container">
		<div class="header-lk__top">
			<a href="{{ route('main') }}" class="header-lk__link-main"><img src="../img/header/logo-lk.svg" alt="" class="header-lk__logo"></a>
			<a href="{{ route('main') }}" class="header__link-page">Перейти на сайт</a>
		</div>
		<div class="header-lk__bottom">
			<ul class="header-lk__nav">
				<li class="header-lk__elem">
					@if (route('admin.main') === URL::current())
						<a href="{{ route('admin.main') }}" class="header-lk__link header-lk__link_active">
					@else
					<a href="{{ route('admin.main') }}" class="header-lk__link">
					@endif
						Статистика
					</a>
				</li>
				<li class="header-lk__elem">
					@if (route('admin.search') === URL::current())
					<a href="{{ route('admin.search') }}" class="header-lk__link header-lk__link_active">
					@else
					<a href="{{ route('admin.search') }}" class="header-lk__link">
					@endif
						Список клиентов
					</a>
				</li>
				<li class="header-lk__elem">
					<a href="#" class="header-lk__link header-lk__link_no-active">
						Страницы сайта
					</a>
				</li>
			</ul>
			<div class="header-lk__login">
				Привет, {{ $user }}
				<div class="header-lk__add">
					<div class="header-lk__name">
						{{ $user }}
					</div>
					<div class="header-lk__email">
						{{ $user }}
					</div>
					<a href="{{ route('admin.logout') }}" class="header-lk__exit" type="submit">
						Выход
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="burger burger_lk mobile"><span class="burger__line"></span></div>	
</section>