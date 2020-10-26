<header class="header {{ $white_style['header'] }}">
	<div class="container">
		<div class="header__top">
			<nav class="header__nav">
				<ul class="header__list">
					@foreach($links as $key => $link)
						<li class="header__elem{{ $link['li'].$white_style['elem'] }}">
							<a href="{{ route($link['uri']) }}" class="header__link{{ $link['link'] .$link['active'].$white_style['link'] }}">
								{{ $link['text'] }}
							</a>
						</li>
					@endforeach
				</ul>
			</nav>
			<div class="header__buttons">
				<a href="{{ route('author') }}" class="header__button button_gray">Личный кабинет</a>
				<a href="{{ route('call') }}" class="header__button button_gray">Перезвоните мне</a>
			</div>
		</div>
	</div>
	<div class="burger mobile"><span class="burger__line"></span></div>	
</header>
<main class="main" id="main">	

