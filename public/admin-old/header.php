<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- open graph -->
	<meta property="og:title" content="Мэрилин Монро"/>
	<meta property="og:description" content="Американская киноактриса и певица"/>
	<meta property="og:image" content="https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/Marilyn_Monroe_-_publicity.JPG/210px-Marilyn_Monroe_-_publicity.JPG"/>
	<meta property="og:type" content="profile"/>
	<meta property="og:url" content= "https://ru.wikipedia.org/wiki/Мэрилин_Монро" />
	
	<!-- title -->
	<title></title>

	<!-- fonts, css -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="../fonts/ProximaNova/font.css">
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<div class="modal modal_active">
		<div class="modal__bg"></div>
		<div class="modal__client modal__client_active">
			<form action="" class="modal__form">
				<div class="modal__title">
					Добавление клиентов
				</div>
				<div class="modal__body">
					<div class="modal__subtitle">
						Данные клиента
					</div>
					<label for="" class="label modal__label">
						Имя
					</label>
					<input name="name" type="text" class="input modal__input" placeholder="Введите имя">
					<label for="" class="label modal__label">
						Почта
					</label>
					<input name="email" type="text" class="input modal__input" placeholder="Введите почту">
					<label for="" class="label modal__label modal__label_phone">
						Телефон (необязательно)
					</label>
					<input name="phone" type="text" class="input modal__input registr__input_phone" placeholder="Номер телефона">
					<label for="" class="label modal__label">
						Пароль
					</label>
					<input name="password" type="password" class="input modal__input" placeholder="Введите пароль">
					<label for="" class="label modal__label">
						Повторите пароль
					</label>
					<input name="password-double" type="password" class="input modal__input" placeholder="Введите пароль">
					<label for="">
						Статус
					</label>
					<input type="radio">активный
					<input type="radio">неактивный
					
				</div>
				<div class="modal__buttons">
					<button type="submit" class="button modal__button">Сохранить</button>
					<button type="button" class="button modal__button">Отмена</button>
				</div>
			</form>
		</div>
		<div class="modal__client-luck client-luck">
			<span class="client-luck__close"></span>
			<img src="img/luck.svg" alt="" class="client-luck__icon">
			<div class="client-luck__title">
				Клиент добавлен
			</div>
			<div class="client-luck__text">
				Клиент <span class="clien-luck__email"></span> успешно добавлен.
			</div>
			<button class="client-luck__button button">
				Спасибо
			</button>
		</div>
	</div>
	<header class="header-lk">
		<div class="header-lk__line">
			
		</div>
		<div class="container">
			<div class="header-lk__top">
				<a href="" class="header-lk__link-main"><img src="../img/header/logo-lk.svg" alt="" class="header-lk__logo"></a>
				<a href="" class="header-lk__link-page">Перейти на сайт</a>
			</div>
			<div class="header-lk__bottom">
				<ul class="header-lk__nav">
					<li class="header-lk__elem">
						<a href="/<?= $lk_link; ?>" class="header-lk__link">
							Статистика
						</a>
					</li>
					<li class="header-lk__elem">
						<a href="/<?= $tariff_link; ?>" class="header-lk__link">
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
					Привет, <?= $email; ?>
					<form class="header-lk__add" action="" method="POST">
						<div class="header-lk__name">
							Имя
						</div>
						<div class="header-lk__email">
							<?= $email; ?>
						</div>
						<input type="hidden" name="exit" value="1">
						<button class="header-lk__exit" type="submit">
							Выход
						</button>
					</form>
				</div>
			</div>
		</div>
	</section>
<main class="main" id="main">