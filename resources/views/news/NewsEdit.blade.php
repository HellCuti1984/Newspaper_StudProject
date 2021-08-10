@extends('template')

@section('content')

<div class="container emp-profile">
	<a href="{{route('news.mynews')}}">&#8592; Назад</a>
	<h1>Написать новость</h1>
	
	@if (session('status'))
		<div class="alert alert-danger">
			{{ session('status') }}
		</div>
	@endif
	
	@foreach($news as $myNews)
		<form method="POST" action="{{route('news.newsedit.save', $myNews->id)}}" class="newsCreate" enctype="multipart/form-data">
		@csrf
			<div class="margin20">
				@if ($errors->any())
					<div class="alert alert-danger">
						Расширение файлов: jpeg,png,bmp,svg
					</div>
				@endif
				<img class="img-thumbnail" style="height: 300px;" src="{{ asset('storage/'.$myNews->newsIcon) }}" /></br>
				<label for="newsIcon" class="text-md-right" value="{{old('newsIcon')}}">ИКОНКА НОВОСТИ</label></br>
				<input type="file" name="newsIcon">
			</div>
			<div class="form-group row">
				<label for="name" class="text-md-right">ЗАГОЛОВОК НОВОСТИ</label>
				<input id="name" type="text" class="form-control" name="newsHeader" value="{{$myNews->newsName}}">
			</div>
				<label for="newsText" class="text-md-right">ТЕКСТ НОВОСТИ</label>
				<textarea id="newsText" name="newsText">{{$myNews->newsText}}</textarea>
			<div class="buttons">
				<button type="reset" class="btn btn-dark">Отмена</button>
				<button type="submit" class="btn btn-primary">Сохранить</button>
			</div>
		</form>
	@endforeach
</div>

<script>
    CKEDITOR.replace('newsText');
</script>

@endsection