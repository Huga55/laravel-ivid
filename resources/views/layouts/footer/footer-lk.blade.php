</main>
	<footer class="footer_mobile mobile">
		<div class="footer__content">
			<a href="#" class="footer__company">
				Разработка сайтов ООО 	«Агаев Диджитал»
			</a>
			<div class="footer__bar">
				<a href="{{ route('main') }}" class="footer__link">
					<img src="{{ asset('img/mobile/home.svg') }}" alt="" class="footer__icon">
				</a>
				<a href="{{ route('author') }}" class="footer__link">
					<img src="{{ asset('img/mobile/lk.svg') }}" alt="" class="footer__icon">
				</a>
				@if($is_auth)
					<a href="{{ route('author') }}" class="footer__link">
						<img src="{{ asset('img/mobile/setting.svg') }}" alt="" class="footer__icon">
					</a>
					<a href="{{ route('author') }}" class="footer__link footer__link_exit">
						<img src="{{ asset('img/mobile/exit.svg') }}" alt="" class="footer__icon">
					</a>
				@endif
			</div>
		</div>
	</footer>
	<div class="footer__modal">
		<div class="footer__modal-content">
			<img src="{{ asset('img/mobile/close.svg') }}" alt="" class="footer__close">
			<img src="{{ asset('img/mobile/agaev.svg') }}" alt="" class="footer__agaev">
			<div class="footer__title">
				Agaev Digital
			</div>
			<div class="footer__text">
				Мы разрабатываем сайты и дизайны под ключ любого уровня и для любого бизнеса, соблюдая все сроки и договоренности.
			</div>
			<a href="https://agaev.digital/" target="_blank" class="footer__button button">
				Перейти на сайт
			</a>
		</div>	
	</div>
	<div class="exit">
		<div class="exit__content">
			<img src="img/mobile/close.svg" alt="" class="exit__close">
			<img src="{{ asset('img/exit/stop.svg') }}" alt="" class="exit__img">
			<div class="exit__text">
				Вы уверены, что хотите выйти?
			</div>
			<div class="exit__buttons">
				<button class="exit__button exit__button_cancel button">
					Нет
				</button>
				<a href="{{ route('logout') }}" class="exit__button exit__button_accept button">
					Да
				</a>
			</div>
		</div>
	</div>
	<footer class="footer-mini desktop">
		<div class="container">
			<div class="footer-mini__content">
				<div class="footer-mini__links">
					<a href="" class="footer-mini__link">Оферта</a>
					<a href="" class="footer-mini__link">Политика конфиденциальности</a>
				</div>
				<a href="https://agaev.digital/" class="footer-mini__logo" target="_blanc">
					<img src="{{ asset('img-admin/footer/logo_company.svg') }}" alt="" class="footer__icon">
				</a>
			</div>
		</div>
	</footer>