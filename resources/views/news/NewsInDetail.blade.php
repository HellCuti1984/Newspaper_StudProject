@extends('template')

@section('content')

<div class="row justify-content-center newsList">
	<div class="col-md-9 emp-profile">
		@foreach($newsDetail as $news)
		<img class="rounded mx-auto d-block" style="max-width: 800px;" src="{{URL::asset('storage/'.$news->newsIcon)}}">
		<h3 class="marin20">{{$news->newsName}}</h3>
		
		<div class="news-field-desc col-md-12">
			<div class="newsAuthor margin20">Автор: {{$news->userName}}</br>Дата: {{$news->news_created_at}}</div>
			<div>{!! $news->newsText !!}</div>
		</div>
		
		<div class="my-3 p-3 bg-white rounded box-shadow">
			
			@if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif
			
			@if ($errors->any())
				<div class="alert alert-danger">
					Комментарий не может превышать 255 символов
				</div>
			@endif
		
			<h6 class="border-bottom border-gray pb-2 mb-0">Комментарии</h6>
			
			<form method="post" action="{{route('news.makecomment', $news->news_id)}}">
				@csrf
				<div class="form-group row">
					<textarea class="form-control" name="userComment" placeholder="оставить комментарий (255 символов)" required></textarea>
				</div>
				<button type="submit" class="btn btn-primary">Оставить комментарий</button>
			</form>
		@endforeach
		
			@if(count($userComments)!=0)
			
				@foreach($userComments as $comments)	
					<div class="media text-muted pt-3" style="color: black !important; font-size: 18px;">
						<img class="mr-2 rounded" style="width: 32px; height: 32px;" src="{{URL::asset('storage/'.$comments->avatar)}}">
						<p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
							<a href=""><strong class="d-block text-gray-dark">{{$comments->name}}</strong></a>
							{{$comments->userComment}}
						</p>
					</div>
				@endforeach
				{{$userComments->render()}}
			@endif
			
		</div>
	</div>
	
	<div class="col-md-2 emp-profile">
		<h3>Последние новости</h3>
		
			@foreach($lastNews as $news)
				<div class="card" style="width: 100%; margin: 10px 0;">
					<img src="{{URL::asset('storage/'.$news->newsIcon)}}" class="card-img-top" alt="...">
					<div class="card-body">
						<h5 class="card-title">{{ $news->newsName }}</h5>
						<div class="newsText">{!! $news->newsText !!}</div>
						<a href="{{route('news.indetail', $news->id)}}" class="btn btn-primary">Читать &rarr;</a>
					</div>
				</div>
			@endforeach

	</div>
</div>
@endsection