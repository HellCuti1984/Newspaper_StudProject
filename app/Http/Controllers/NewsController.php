<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\NewsComments;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use File;

class NewsController extends Controller
{	
	//Управление новостями из профиля
    public function index()
	{
		return view('News.NewsCreate');
	}
	public function newsCreate(Request $request)
	{
		//Объявление переменных
		$news = $request->all();
		
		//Валидация картинки новости
		$request->validate([
			'newsIcon' => 'mimes:jpg,jpeg,png,bmp,svg|max:5000'
		]);
		
		//Запись новости в базу
		if(News::where('newsName', $news['newsHeader'])->count() == 0)
		{
			//Сохранение пути картинки новости
			$path = $request->file('newsIcon')->store('news/'.Auth::user()->id.'/'.$request->newsHeader, 'public');
			//Проверка публикации
			if($request->has('publish'))
			{
				News::create([
					'id_user' => Auth::id(),
					'newsIcon' => $path,
					'newsName' => $news['newsHeader'],
					'newsText' => $news['newsText'],
					'isPublish' => true
				]);
				
				return redirect('home')->with('status', 'Новость "'.$news['newsHeader'].'" создана. Опубликовано!');
			}
			else
			{
				News::create([
					'id_user' => Auth::id(),
					'newsIcon' => $path,
					'newsName' => $news['newsHeader'],
					'newsText' => $news['newsText'],
					'isPublish' => false
				]);
				
				return redirect('home')->with('status', 'Новость "'.$news['newsHeader'].'" создана. Не опубликовано!');
			}
			
		}
		else
			return redirect('home/newscreate')->with('status', 'Новость с названием "'.$news['newsHeader'].'" уже существует!')->withInput();
	}
	
	public function newsEdit($id)
	{
		//Поиск новости по ID
		$news = News::where('id', $id)->get();
		return view('news.newsedit', compact('news'));
	}
	
	public function newsEditSave(Request $request, $id)
	{
		//Объявление переменных
		$news = $request->all();
		$newsIcon = $request->file('newsIcon');
		
		//Валидация картинки новости
		$request->validate([
			'newsIcon' => 'mimes:jpeg,png,bmp,svg|max:5000'
		]);
		
		//Запись новости в базу
		if(News::where('newsName', $news['newsHeader'])->count() <= 1)
		{
			//Сохранение пути картинки новости
			if($newsIcon!=null)
			{
				//Путь к файлу в переменную
				$path = $request->file('newsIcon')->store('news/'.Auth::user()->id.'/'.$request->newsHeader, 'public');
				//Удаление файла, если оно имеется
				File::deleteFileInStorageFolder(News::where('id', $id)->value('newsIcon'));
				//Запись пути в базу
				News::where('id', $id)->update(['newsIcon' => $path]);
			}
			
			News::where('id', $id)->
				update([
					'newsName' => $news['newsHeader'],
					'newsText' => $news['newsText']
				]);
			
			return redirect(route('news.mynews'))->with('status','Новость успешно изменена!');
		}
		else
		{
			return back()->with('status', 'Новость с названием "'.$news['newsHeader'].'" уже существует!');
		}
	}
	
	public function myNews()
	{
		//Получение из базы новости пользователя
		//$news = News::all()->where('id_user', Auth::id());
		$news = DB::table('news')
			->where('id_user', Auth::id())
			->orderBy('id', 'desc')
			->get();
		//Отправка данных на представление
		return view('news.mynews', compact('news'));
	}
	
	public function newsPublish($id)
	{
		//Найти запись
		News::find($id)->update(['isPublish' => true]);
		//Опубликовать запись
		return back()->with('status','Новость успешно опубликована!');
	}
	
	public function newsNonPublish($id)
	{
		//Найти запись
		News::find($id)->update(['isPublish' => false]);
		//Закрыть доступ запись
		return back()->with('status','Новость успешно закрыта!');
	}
	
	public function newsDelete($id)
	{
		//Найти запись
		News::find($id)->delete();
		//Удалить запись
		return back()->with('status','Новость успешно удалена!');
	}
	
	//Методы отвечающие за отображение новостей на /news
	public function allNewsList()
	{
		$newsList = News::newsJoinedUsers();
		$lastNews = News::lastNews();
		
		return view('news.AllNewsPage', compact('newsList', 'lastNews'));
	}
	
	public function adminNewsList()
	{
		$newsList = News::newsJoinedUsersIsAdmin(true);
		$lastNews = News::lastNews();
		
		return view('news.AllNewsPage', compact('newsList', 'lastNews'));
	}
	
	public function studNewsList()
	{
		$newsList = News::newsJoinedUsersIsAdmin(false);
		$lastNews = News::lastNews();
		
		return view('news.AllNewsPage', compact('newsList', 'lastNews'));
	}
	
	//Детальная новость
	public function detailNews($id)
	{
		//Поиск новости по ID с условием
		$newsDetail = $news = DB::table('news')
			->join('users', 'news.id_user', '=', 'users.id')
			->where('news.id', $id)
			->select('news.id as news_id', 'newsIcon', 'newsName', 'newsIcon', 'newsText', 'newsLikes',
					 'news.created_at as news_created_at', 'news.updated_at as news_updated_at',
					 'name as userName')->get();
		
		$userComments = NewsComments::newsCommentsJoinedUsers($id);
		$lastNews = News::lastNews();
		
		return view('news.NewsInDetail', compact('newsDetail', 'userComments', 'lastNews'));
	}
	
	public function makeComment(Request $request, $id)
	{
		$request->validate([
			'userComment' => 'max:255'
		]);
		
		DB::table('news_comments')->insert(
			['id_news' => $id, 'id_user' => Auth::id(), 'userComment' => $request->userComment]
		);
		
		return back()->with('status', 'Спасибо за комментарий!');
	}
}
