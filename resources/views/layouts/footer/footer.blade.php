</main>
	<footer class="footer_mobile mobile">
		<div class="footer__content">
			<a href="#" class="footer__company">
				Разработка сайтов ООО 	«Агаев Диджитал»
			</a>
			<div class="footer__bar">
				<a href="{{ route('main') }}" class="footer__link">
					<img src="img/mobile/home.svg" alt="" class="footer__icon">
				</a>
				<a href="{{ route('author') }}" class="footer__link">
					<img src="img/mobile/lk.svg" alt="" class="footer__icon">
				</a>
				@if($is_auth)
					<a href="{{ route('author') }}" class="footer__link">
						<img src="img/mobile/setting.svg" alt="" class="footer__icon">
					</a>
					<a href="{{ route('author') }}" class="footer__link footer__link_exit">
						<img src="img/mobile/exit.svg" alt="" class="footer__icon">
					</a>
				@endif
			</div>
		</div>
	</footer>
	<div class="footer__modal">
		<div class="footer__modal-content">
			<img src="img/mobile/close.svg" alt="" class="footer__close">
			<img src="img/mobile/agaev.svg" alt="" class="footer__agaev">
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
	<footer class="footer desktop" id="footer">
		<span class="footer__line line"></span>
		<div class="container">
			<div class="footer__content">
				<div class="footer__top">
					<ul class="footer__nav">
						<li class="footer__elem">
							<a href="" class="footer__link">О компании</a>
						</li>
						<li class="footer__elem">
							<a href="" class="footer__link">Услуги</a>
						</li>
						<li class="footer__elem">
							<a href="" class="footer__link footer__link_disabled">НАШ МАГАЗИН</a>
						</li>
						<li class="footer__elem">
							<a href="" class="footer__link">Контакты</a>
						</li>
					</ul>
					<a href="" class="footer__logo"><img src="img/footer/logo.svg" alt="" class="footer__logo-img"></a>
				</div>
				<div class="footer__middle">
					<div class="footer__offer">
						Айвид -  автоматизированная платформа управления системой видеонаблюдений. Установка и настройка камер под ключ
					</div>
					<div class="footer__docs">
						<a href="" class="footer__docs-link">Оферта</a>
						<a href="" class="footer__docs-link">Политика конфиденциальности</a>
					</div>
				</div>
				<div class="footer__bottom">
					<div class="footer__subscribe">
						© 2020 - ООО  «Агаев Диджитал»
					</div>
					<a href="https://agaev.digital/" target="_blank" class="footer__link-company">
						<img src="img/footer/logo_company.svg" alt="" class="footer__company-img">	
					</a>
					<div class="footer__social">
						<a href="" class="footer__social-link">
							<img src="img/footer/social1.svg" alt="" class="footer__icon">
						</a>
						<a href="" class="footer__social-link">
							<img src="img/footer/social2.svg" alt="" class="footer__icon">
						</a>
					</div>
				</div>
			</div>
		</div>
	</footer>