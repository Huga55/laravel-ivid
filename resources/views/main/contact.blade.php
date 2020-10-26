@extends('layouts.index')

@section('content')
@include('layouts.headers.header-main')
<section class="score">
	<div class="container">
		<div class="score__content">
			<div class="score__top window">
				<div class="score__title">
					Контакты
				</div>
				<div class="score__name-company">
					ООО «Агаев Диджитал»
				</div>
				<ul class="score__list score__list_top">
					<li class="score__elem">
						<p class="score__left">Генеральный директор</p>
						<p class="score__right">Агаев Мехман Тельман оглы</p>
					</li>
					<li class="score__elem">
						<p class="score__left">Адрес</p>
						<p class="score__right">г. Москва, ул. Фортунатовская, д 11</p>
					</li>
					<li class="score__elem">
						<p class="score__left">ИНН</p>
						<p class="score__right">7719487467</p>
					</li>
					<li class="score__elem">
						<p class="score__left">КПП</p>
						<p class="score__right">771901001</p>
					</li>
					<li class="score__elem">
						<p class="score__left">ОГРН</p>
						<p class="score__right">1197746149974</p>
					</li>
					<li class="score__elem">
						<p class="score__left">Почта</p>
						<p class="score__right">hello@agaev.digital</p>
					</li>
				</ul>
				<div class="score__button">
					<div class="score__button-title">
						Данные компании на rusprofile
					</div>
					<a href="" target="_blank" class="score__button-link">
						Перейти 
					</a>
				</div>
			</div>
			@if(false)
			<!--<div class="score__bottom window">
				<div class="score__name-bank">
					АО «ТИНЬКОФФ БАНК» г. Москва
				</div>
				<ul class="score__list score__list_bottom">
					<li class="score__elem">
						<p class="score__left">Расчётный счёт</p>
						<p class="score__right">40702810510000502926</p>
					</li>
					<li class="score__elem">
						<p class="score__left">Корреспондентский счёт</p>
						<p class="score__right">30101810145250000974</p>
					</li>
					<li class="score__elem">
						<p class="score__left">БИК</p>
						<p class="score__right">044525974</p>
					</li>
				</ul>
			</div>-->
			@endif
		</div>
	</div>
</section>
@include('layouts.footer.footer')
@endsection