@extends('admin.layouts.index')

@section('content')
@include('admin.layouts.header')
<div class="add">
	<div class="add__bg">
		
	</div>
	<div class="add__window">
		<div class="add__top">
			Добавление клиента
		</div>
		<form class="add__form">
			<div class="add__content">
				<div class="add__subtitle">
					Данные клиента
				</div>
				<div class="add__row">
					<label for="" class="add__label">Имя</label>
					<input type="text" name="name" class="add__input add__input_name">
				</div>
				<div class="add__row">
					<label for="" class="add__label">Почта</label>
					<input type="text" name="email" class="add__input add__input_email">
				</div>
				<div class="add__row">
					<label for="" class="add__label">Телефон</label>
					<input type="text" name="phone" class="add__input add__input_phone">
				</div>
				<div class="add__row">
					<label for="" class="add__label">Пароль</label>
					<input type="text" name="password" class="add__input add__input_password">
				</div>
				<div class="add__row">
					<label for="" class="add__label">Статус</label>
					<div class="add__radios">
						<input type="radio" name="status" value="active" class="add__radio" id="radio-active" checked>
						<label for="radio-active" class="add__label-radio">Активный</label>
						<input type="radio" name="status" value="inactive" class="add__radio" id="radio-inactive">
						<label for="radio-inactive" class="add__label-radio">Неактивный</label>
					</div>
				</div>
			</div>
			<div class="add__bottom">
				<button class="add__button button add__button-accept">
					Сохранить
				</button>
				<button class="add__button button add__button-cancel">
					Отмена
				</button>
			</div>
		</form>
	</div>
</div>
<div class="modal">
	<div class="modal__bg">
		
	</div>
	<div class="modal__window">
		<div class="modal__title">
			Клиент добавлен
		</div>
		<div class="modal__text">
			Клиент {почтаклиента} успешно добавлен.
		</div>
		<button class="modal__button button">
			Спасибо
		</button>
	</div>
</div>
<section class="search">
	<div class="container">
		<div class="search__top">
			<div class="search__title">
				Список клиентов
			</div>
			<button class="search__button button_blue button client__addition">
				Добавить клиента
			</button>
		</div>
		<div class="search__all">
			клиентов всего: {{ $count_users }} 
		</div>
		<div class="search__content">
			<table class="search__table">
				<thead class="search__table-head">
					<tr class="search__line search__line_head">
						<th class="search__head-cell search__cell_checkbox">
							<input type="checkbox" class="search__checkbox" id="select-all"><label for="select-all" class="search__label"></label>
						</th>
						<th class="search__head-cell search__cell_email">
							Почта клиента
						</th>
						<th class="search__head-cell search__cell_phone">
							телефон
						</th>
						<th class="search__head-cell search__cell_tariff">
							тариф
						</th>
						<th class="search__head-cell search__cell_status">
							Статус
						</th>
					</tr>
					<tr class="search__line-find">
						<td>
							<div action="{{ route('admin.search') }}" class="search__form" method="get">
								<input type="text" class="search__input input">
								<div class="search__find"></div>
							</div>
						</td>
					</tr>
				</thead>
				<tbody class="search__table-result">
					
				</tbody>
			</table>
		</div>
	</div>
</section>
<div class="delete">
	<div class="delete__window">
		<div class="delete__info">
			Выбрано контрагентов:
			<span class="delete__count">
				0
			</span>
		</div>
		<button class="delete__button">
			Удалить выделенные
		</button>
	</div>
</div>
<div class="prompt">
	<div class="prompt__title">

	</div>
	<div class="prompt__desribe">

	</div>
</div>
@endsection