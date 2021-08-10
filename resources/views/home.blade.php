@extends('template')

@section('content')

<div class="container emp-profile">
    <div class="row">
        <div class="col-md-3">
            <div class="profile-img">
			@If(Auth::user()->avatar == null)
                <div class="login" style="background: url({{ URL::asset('img/user.png') }}"></div>
			@else
				<img class="login" src="{{ asset('storage/'.Auth::user()->avatar) }}" />
			@endif
			</div>
			<div class="profile-work">
                <p>ССЫЛКИ</p>
				<a href="{{route('news.all.newsList')}}">Все новости</a><br/>
				<a href="{{route('news.admin.newslist')}}">Новости техникума</a><br/>
				<a href="{{route('news.stud.newsList')}}">Новости студентов</a><br/>
				<a href="">Обсуждения</a><br/>
				<a href="">Мероприятия</a>
				<p>ПОМОЩЬ</p>
                <a href="{{route('password.request')}}">Изменить пароль</a><br/>
            </div>
        </div>
        <div class="col-md-7">
            <div class="profile-head">
                    <h5>
						{{ Auth::user()->name }}
                    </h5>
                    <h6>
						@if (!Auth::user()->isAdmin) Группа: {{ Auth::user()->group }} @else Администратор @endif
                    </h6>
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#control" role="tab" aria-controls="control" aria-selected="true">Управление</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false">Обо мне</a>
                    </li>
					<li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profileEdit" role="tab" aria-controls="profileEdit" aria-selected="false">Изменить профиль</a>
                    </li>
                </ul>
            </div>
			<div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <label>ID</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ Auth::user()->id }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Имя</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ Auth::user()->name }}</p>
                        </div>
                    </div>
					@if(!Auth::user()->isAdmin)
						<div class="row">
							<div class="col-md-6">
								<label>Группа</label>
							</div>
							<div class="col-md-6">
								<p>{{ Auth::user()->group}}</p>
							</div>
						</div>
					@endif
                    <div class="row">
                        <div class="col-md-6">
                            <label>Email</label>
                        </div>
                        <div class="col-md-6">
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                    </div>
					
					@if(count($userComments)!=0)
					<div class="my-3 p-3 bg-white rounded box-shadow">
						<h6 class="border-bottom border-gray pb-2 mb-0">Мои последние комментарии</h6>
						@foreach($userComments as $comments)	
							<div class="media text-muted pt-3" style="color: black !important; font-size: 18px;">
								<img class="mr-2 rounded" style="width: 32px; height: 32px;" src="{{URL::asset('storage/'.$comments->avatar)}}">
								<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
									<a href=""><strong class="d-block text-gray-dark">{{$comments->name}}</strong></a>
									<a href="{{route('news.indetail', $comments->id)}}"><strong class="d-block text-gray-dark">Новость: {{$comments->newsName}}</strong></a>
									{{$comments->userComment}}
								</p>
							</div>
						@endforeach
						{{$userComments->render()}}
					</div>
					@endif
                </div>
				
				<div class="tab-pane fade  show active" id="control" role="tabpanel" aria-labelledby="profile-tab">
					@if(!Auth::user()->isAdmin)
						<a href="{{route('news.newscreate')}}">Написать новость</a><br/>
						<a href="">Начать обсуждение</a><br/>
						<a href="{{route('news.mynews')}}">Мои новости</a><br/>
						<a href="">Мои обсуждения</a>
					@else
						<a href="{{route('news.newscreate')}}">Написать новость</a><br/>
						<a href="">Начать обсуждение</a><br/>
						<a href="{{route('news.mynews')}}">Мои новости</a><br/>
						<a href="">Мои обсуждения</a><br/>
						<hr><span>Администрирование</span><hr>
						<a href="{{route('admin.createevent')}}">Создать мероприятие</a><br>
						<a href="{{route('admin.createadmin')}}">Регистрация админа</a><br>
						<a href="">Комментарии пользователей</a><br/>
					@endif
				</div>
				
				<div class="tab-pane fade" id="profileEdit" role="tabpanel" aria-labelledby="profile-tab">
					<h4 class="m-y-2">Редактирование профиля</h4>
					<form action="{{ route('changeProfileData', Auth::id()) }}" method="post" enctype="multipart/form-data" role="form">
						@csrf
						<div class="form-group row">
							<label class="col-lg-3 col-form-label form-control-label">ФОТОГРАФИЯ</label>
							<div class="col-lg-9">
								<input type="file" name="avatar">
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label form-control-label">ФИО</label>
							<div class="col-lg-9">
								<input class="form-control" name="name" type="text" value="{{Auth::user()->name}}" required>
							</div>
						</div>
						@if(!Auth::user()->isAdmin)
						<div class="form-group row">
							<label class="col-lg-3 col-form-label form-control-label">ГРУППА</label>
							<div class="col-lg-9">
								<input class="form-control" name="group" type="text" value="{{Auth::user()->group}}" required>
							</div>
						</div>
						@endif
						<div class="form-group row">
							<label class="col-lg-3 col-form-label form-control-label">EMAIL</label>
							<div class="col-lg-9">
								<input class="form-control" name="email" type="email" value="{{Auth::user()->email}}" required>
							</div>
						</div>
						<div class="form-group row">
							<label class="col-lg-3 col-form-label form-control-label"></label>
							<div class="col-lg-9">
								<input type="reset" class="btn btn-secondary" value="Отмена">
								<button type="submit" class="btn btn-primary">Сохранить</button>
							</div>
						</div>
					</form>
				</div>
            </div>
        </div>
    </div>        
</div>

@endsection
