<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<!-- open graph -->
	<meta property="og:title" content="Ivid"/>
	<meta property="og:description" content="Сервис для видеонаблюдения"/>
	<meta property="og:image" content="../img/header/logo.svg"/>
	<meta property="og:type" content="profile"/>
	<meta property="og:url" content= "https://ivid.host" />

	<!-- meta Laravel -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- title -->
	<title>Сервис для видеонаблюдения Ivid, установка систем видеонаблюдения</title>
	
	<!-- иконка -->
	<link rel="shortcut icon" href="{{ asset('img/header/logo.svg') }}" type="image/png">
	<!-- fonts, css -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('fonts/ProximaNova/font.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
		@yield('content')
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="{{ asset('js/script.js') }}"></script>
</body>
</html>