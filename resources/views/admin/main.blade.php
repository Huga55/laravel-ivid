@extends('admin.layouts.index')

@section('content')
@include('admin.layouts.header')
<div class="info">
	<div class="container">
		<div class="info__content">
			<div class="info__left">
				<div class="info__date">
					Оплат за сегодня, {{ $day . " " . $month }}
				</div>
				<div class="info__salary">
					{{ $pay_today }} ₽
				</div>
			</div>
			<div class="info__right">
				<div class="info__block">
					<div class="info__name">Всего клиентов</div>
					<div class="info__index">{{ $clients }}</div>
				</div>
				<div class="info__block info__block_irregular">
					<div class="info__name">Кол-во платежей</div>
					<div class="info__index">{{ $pays }}</div>
				</div>
				<div class="info__block">
					<div class="info__name">Средняя сумма</div>
					<div class="info__index">{{ $salary_avg }}</div>
				</div>
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


@endsection