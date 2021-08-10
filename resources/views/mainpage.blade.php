@extends('template')

@section('content')
<div class="newsMainPage">
	<h3 class="seactionHeader">Новости</h3>
	<div class="twoNwesPlace">
		@foreach($newsList as $i=>$news)
			@if($i<=1)
			<div class="news">
				<a href="{{route('news.indetail', $news->news_id)}}"><img  class="newsPicture" src="{{ URL::asset('storage/'.$news->newsIcon) }}" /></a>
				<div class="newsInfo">
					<a href="{{route('news.indetail', $news->news_id)}}" class="newsHead">{{$news->newsName}}</a>
					<span class="newsAuthor">Автор: {{$news->userName}}</span>
					<div class="newsText">{!! $news->newsText !!}</div>
					<div class="newsStats">
						<div class="newsLikes">
							<i class="fas fa-thumbs-up"></i>
							<span>124</span>
						</div>
						<div class="newsViews">
							<i class="fas fa-comments"></i>
							<span>{{NewsComments::countComments($news->news_id)}}</span>
						</div>
					</div>
				</div>
			</div>
			@endif
		@endforeach
	</div>
	<div class="otherNewsPlace">
		@foreach($newsList as $i=>$news)
			@if($i>=2 && $i<=7)
				<div class="news">
					<a href="{{route('news.indetail', $news->news_id)}}"><img  class="newsPicture" src="{{ URL::asset('storage/'.$news->newsIcon) }}" /></a>
					<div class="newsInfo">
						<a href="{{route('news.indetail', $news->news_id)}}" class="newsHead">{{$news->newsName}}</a>
						<span class="newsAuthor">Автор: {{$news->userName}}</span>
						<div class="newsText">{!! $news->newsText !!}</div>
						<div class="newsStats">
							<div class="newsLikes">
								<i class="fas fa-thumbs-up"></i>
								<span>124</span>
							</div>
							<div class="newsViews">
								<i class="fas fa-comments"></i>
								<span>{{NewsComments::countComments($news->news_id)}}</span>
							</div>
						</div>
					</div>
				</div>
			@endif
		@endforeach
	</div>
</div>
	
<div class="newsPlaceAllNews">
	<h3 class="seactionHeader">Категории</h3>
	<nav>
		<div class="nav nav-tabs" id="nav-tab" role="tablist">
			<a class="nav-item nav-link active" id="nav-AllNews-tab" data-toggle="tab" href="#nav-AllNews" role="tab" aria-controls="nav-AllNews" aria-selected="true">Все новости</a>
			<a class="nav-item nav-link" id="nav-adminNews-tab" data-toggle="tab" href="#nav-adminNews" role="tab" aria-controls="nav-adminNews" aria-selected="false">Новости техникума</a>
			<a class="nav-item nav-link" id="nav-studNews-tab" data-toggle="tab" href="#nav-studNews" role="tab" aria-controls="nav-studNews" aria-selected="false">Новости студентов</a>
			<a class="nav-item nav-link" id="nav-meeting-tab" data-toggle="tab" href="#nav-meeting" role="tab" aria-controls="nav-meeting" aria-selected="false">Мероприятия</a>
		</div>
	</nav>
	<div class="tab-content" id="nav-tabContent">
		<div class="tab-pane fade show active" id="nav-AllNews" role="tabpanel" aria-labelledby="nav-AllNews-tab">
			@foreach($newsList as $i=>$news)
				@if($i<=5)
					<div class="news">
						<a href="{{route('news.indetail', $news->news_id)}}"><img  class="newsPicture" src="{{ URL::asset('storage/'.$news->newsIcon) }}" /></a>
						<div class="newsInfo">
							<a href="{{route('news.indetail', $news->news_id)}}" class="newsHead">{{$news->newsName}}</a>
							<span class="newsAuthor">Автор: {{$news->userName}}</span>
							<div class="newsText">{!! $news->newsText !!}</div>
							<div class="newsStats">
								<div class="newsLikes">
									<i class="fas fa-thumbs-up"></i>
									<span>124</span>
								</div>
								<div class="newsViews">
									<i class="fas fa-comments"></i>
									<span>{{NewsComments::countComments($news->news_id)}}</span>
								</div>
							</div>
						</div>
					</div>
				@endif
			@endforeach
			<div class="goNext">
				<span><a href="{{route('news.all.newsList')}}">→</a></span>
			</div>
		</div>
		<div class="tab-pane fade" id="nav-adminNews" role="tabpanel" aria-labelledby="nav-adminNews-tab">
			@foreach($newsListAdmin as $i=>$news)
				@if($i<=5)
					<div class="news">
						<a href="{{route('news.indetail', $news->news_id)}}"><img  class="newsPicture" src="{{ URL::asset('storage/'.$news->newsIcon) }}" /></a>
						<div class="newsInfo">
							<a href="{{route('news.indetail', $news->news_id)}}" class="newsHead">{{$news->newsName}}</a>
							<span class="newsAuthor">Автор: {{$news->userName}}</span>
							<div class="newsText">{!! $news->newsText !!}</div>
							<div class="newsStats">
								<div class="newsLikes">
									<i class="fas fa-thumbs-up"></i>
									<span>124</span>
								</div>
								<div class="newsViews">
									<i class="fas fa-comments"></i>
									<span>{{NewsComments::countComments($news->news_id)}}</span>
								</div>
							</div>
						</div>
					</div>
				@endif
			@endforeach
			<div class="goNext">
				<span><a href="{{route('news.admin.newslist')}}">→</a></span>
			</div>
		</div>
		<div class="tab-pane fade" id="nav-studNews" role="tabpanel" aria-labelledby="nav-studNews-tab">
			@foreach($newsListStud as $i=>$news)
				@if($i<=5)
					<div class="news">
						<a href="{{route('news.indetail', $news->news_id)}}"><img  class="newsPicture" src="{{ URL::asset('storage/'.$news->newsIcon) }}" /></a>
						<div class="newsInfo">
							<a href="{{route('news.indetail', $news->news_id)}}" class="newsHead">{{$news->newsName}}</a>
							<span class="newsAuthor">Автор: {{$news->userName}}</span>
							<div class="newsText">{!! $news->newsText !!}</div>
							<div class="newsStats">
								<div class="newsLikes">
									<i class="fas fa-thumbs-up"></i>
									<span>124</span>
								</div>
								<div class="newsViews">
									<i class="fas fa-comments"></i>
									<span>{{NewsComments::countComments($news->news_id)}}</span>
								</div>
							</div>
						</div>
					</div>
				@endif
			@endforeach
			<div class="goNext">
				<span><a href="{{route('news.admin.newslist')}}">→</a></span>
			</div>
		</div>
		<div class="tab-pane fade" id="nav-meeting" role="tabpanel" aria-labelledby="nav-meeting-tab" style="display: flex;">Мероприятия</div>
	</div>
</div>
@endsection