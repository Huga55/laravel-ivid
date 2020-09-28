@extends('layouts.index')

@section('content')
@include('layouts.headers.header-main')
<section class="solution">
	<div class="container">
		<div class="solution__content">
			<div class="solution__block">
				<div class="solution__text">Отчётность в ЕГАИС и ФСРАР</div>
			</div>
			<div class="solution__block">
				<div class="solution__text">Работа с маркировкой</div>
			</div>
			<div class="solution__block">
				<div class="solution__text">Работа с ФГИС «Меркурий»</div>
			</div>
			<div class="solution__block">
				<div class="solution__text">Комплекты</div>
			</div>
		</div>
	</div>
</section>
@include('layouts.footer.footer')
@endsection