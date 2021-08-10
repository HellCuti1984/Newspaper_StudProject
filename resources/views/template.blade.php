<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Студенческая газета</title>
		
		<link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
		<link rel="shortcut icon" href="{{ URL::asset('img/newspaper.ico') }}" type="image/x-icon">
		
		<!-- BOOTSTRAP -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		
		<!-- FONT AWESOM -->
		<script src="https://kit.fontawesome.com/1b3b04bd79.js" crossorigin="anonymous"></script>
		
		<!-- CKEDITOR -->
		<script src="{{ URL::asset('plugins/ckeditor/ckeditor.js') }}"></script>
	</head>
    <body>
		<header>
			<div class="menu">
				<a href="/"><img class="logo" src="{{ URL::asset('img/newspaper.png') }}" />
				<div class="papersName">СТУДЕНЧЕСКАЯ ГАЗЕТА</div></a>
				
				<div class="loginMenu">
					<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					@If (Auth::user())
						@If(Auth::user()->avatar == null)
							<div class="login" style="background: url({{ URL::asset('img/user.png') }}"></div>
						@else
							<div class="login" style="background-image: url({{ asset('storage/'.Auth::user()->avatar) }}) !important;"></div>
						@endif
					@else
						<div class="login" style="background: url({{ URL::asset('img/user.png') }}"></div>
					@endif
					</button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
						@If (!Auth::check())
							<a href="{{route('login')}}"><button class="dropdown-item" type="button">Вход</button></a>
							<a href="{{route('register')}}"><button class="dropdown-item" type="button">Регистрация</button></a>
						@else
							<a href="{{route('home')}}"><button class="dropdown-item" type="button">Профиль</button></a>
							<hr>
							<a href="{{route('news.mynews')}}"><button class="dropdown-item" type="button">Мои новости</button></a>
							<a href="{{route('news.newscreate')}}"><button class="dropdown-item" type="button">Написать новость</button></a>
							<hr>
							<a href="{{route('logout')}}"><button class="dropdown-item" type="button">Выход</button></a>
						@endif
					</div>
				</div>
				
				<div class="newsSearch">
					<form action="{{route('search')}}" method="post">
					@csrf
						<input type="text" placeholder="поиск по названию..." class="search" name="search"/>
						<button type="submit" class="btn btn-primary">Поиск</button>
					</form>
					
					<div class="site-navigation">
						<a href="{{route('news.all.newsList')}}">Все новости</a>
						<a href="{{route('news.admin.newslist')}}">Новости техникума</a>
						<a href="{{route('news.stud.newsList')}}">Новости студентов</a>
						<a href="">Мероприятия</a>
						<a href="">Обсуждения</a>
					</div>
				</div>
			</div>
		</header>
		
		<div class="content">
			@yield('content')
		</div>
		
		<footer>СГ <?=date('Y')?></footer>
	</body>
</html>
