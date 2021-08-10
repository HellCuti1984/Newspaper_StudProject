<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;
use Validator;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    //Открыть страницу
	public function indexCreateEvent()
	{
		return view('events.EventsCreate');
	}
	
	public function createEvent(Request $request)
	{
		//Объявление переменных
		$news = $request->all();
		
		//Валидация картинки новости
		$request->validate([
			'newsIcon' => 'mimes:jpeg,png,bmp,svg|max:5000'
		]);
		
		//Запись новости в базу
		if(Events::where('eventHeader', $news['newsHeader'])->count() == 0)
		{
			//Сохранение пути картинки новости
			$path = $request->file('newsIcon')->store('events/'.Auth::user()->id.'/'.$request->newsHeader, 'public');
			
			if($request->has('publish'))
			{
				Events::create([
					'id_user' => Auth::user()->id,
					'icon' => $path,
					'eventHeader' => $news['newsHeader'],
					'eventText' => $news['newsText'],
					'isPublish' => true
				]);
				
				return redirect()->route('home')->with('status', 'Мероприятие "'.$news['newsHeader'].'" создано. Опубликовано!');
			}
			else
			{
				Events::create([
					'id_user' => Auth::user()->id,
					'icon' => $path,
					'eventHeader' => $news['newsHeader'],
					'eventText' => $news['newsText'],
					'isPublish' => false
				]);
				
				return redirect()->route('home')->with('status', 'Мероприятие "'.$news['newsHeader'].'" создано. Не опубликовано!');
			}
			
		}
		else
			return redirect()->route('home')->with('status', 'Мероприятие с названием "'.$news['newsHeader'].'" уже существует!')->withInput();
	}
}
