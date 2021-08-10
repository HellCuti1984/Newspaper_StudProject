@extends('template')

@section('content')
<div class="row justify-content-center newsList">
	<div class="col-md-9 emp-profile">
		<h3>Новости</h3>
		@if(count($newsList)!=0)
			@foreach($newsList as $news)
			<div class="news-field row">
				<div class="col-md-3">
				<a href="{{route('news.indetail', $news->news_id)}}"><img class="img-thumbnail" src="{{URL::asset('storage/'.$news->newsIcon)}}"></a>
					<div class="newsStats">
						<div class="newsLikes">
							<i class="fas fa-thumbs-up" aria-hidden="true"></i>
							<span>{{$news->newsLikes}}</span>
						</div>
						<div class="newsViews">
							<i class="fas fa-comments" aria-hidden="true"></i>
							<span>{{NewsComments::countComments($news->news_id)}}</span>
						</div>
					</div>
				</div>
				<div class="news-field-desc col-md-9">
					<a href="{{route('news.indetail', $news->news_id)}}"><h2>{{ $news->newsName }}</h2></a>
					<div class="newsAuthor">Автор: {{$news->userName}}</br>Дата: {{$news->news_created_at}}</div>
					<div class="newsText">{!! $news->newsText !!}</div>
				</div>
			</div>
			@endforeach
		@else
			<span class="error">\(o_o)/</br>Нет новостей</span>
		@endif
		
		{{$newsList->render()}}
		
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