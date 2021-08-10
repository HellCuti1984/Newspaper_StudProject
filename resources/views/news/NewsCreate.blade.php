@extends('template')

@section('content')

<div class="container emp-profile">
	<a href="{{route('home')}}">&#8592; Назад</a>
	<h1>Написать новость</h1>
	
	@if (session('status'))
		<div class="alert alert-danger">
			{{ session('status') }}
		</div>
	@endif
	
	<form method="POST" action="{{route('news.newscreate.save')}}" class="newsCreate" enctype="multipart/form-data">
	@csrf
		<div class="margin20">
			@if ($errors->any())
				<div class="alert alert-danger">
					Расширение файлов: jpeg,png,bmp,svg
				</div>
			@endif
            <label for="newsIcon" class="text-md-right" value="{{old('newsIcon')}}">ИКОНКА НОВОСТИ</label></br>
            <input type="file" name="newsIcon" required>
		</div>
		<div class="form-group row">
            <label for="name" class="text-md-right">ЗАГОЛОВОК НОВОСТИ</label>
            <input id="name" type="text" class="form-control" name="newsHeader" value="{{old('newsHeader')}}">
        </div>
            <label for="newsText" class="text-md-right">ТЕКСТ НОВОСТИ</label>
			<textarea id="newsText" name="newsText">{{old('newsText')}}</textarea>
		<div class="custom-control custom-checkbox buttons">
			<input name="publish" type="checkbox" value="false" class="custom-control-input" id="defaultUnchecked">
			<label class="custom-control-label" for="defaultUnchecked">Опубликовать</label>
		</div>
		<div class="buttons">
			<button type="submit" class="btn btn-primary">Сохранить</button>
		</div>
	</form>
</div>

<script>
    CKEDITOR.replace('newsText');
</script>

@endsection