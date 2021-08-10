@extends('template')

@section('content')
<div class="container emp-profile">
	<a href="{{route('home')}}">&#8592; Назад</a>
	<h1>Мои новости</h1>
	@if (session('status'))
		<div class="alert alert-success">
			{{ session('status') }}
		</div>
	@endif
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Новость</th>
				<th scope="col">Дата</th>
				<th scope="col">Управление</th>
			</tr>
		</thead>
		<tbody>
		@foreach($news as $myNews)
			<tr>
				<td>{{$myNews->id}}</td>
				<td>{{$myNews->newsName}}</td>
				<td>{{$myNews->created_at}}</td>
				<td>
					<a href="{{route('news.newsedit', $myNews->id)}}" class="btn btn-primary" title="Редактировать" role="button"><i class="fas fa-pen"></i></a>
					<a href="{{route('news.newsdelete', $myNews->id)}}" class="btn btn-danger" title="Удалить" role="button"><i class="fas fa-trash-alt"></i></a>
					@if(!$myNews->isPublish)
						<a href="{{route('news.newspublish', $myNews->id)}}" class="btn btn-danger" title="Доступ закрыт" role="button"><i class="fas fa-lock"></i></a>
					@else
						<a href="{{route('news.newsnonpublish', $myNews->id)}}" class="btn btn-success" title="Доступ открыт" role="button"><i class="fas fa-unlock"></i></a>
					@endif
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>
	
</div>
@endsection