<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;
use App\NewsComments;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$userComments = NewsComments::newsCommentsJoinedNews();
		
        return view('home', compact('userComments'));
    }
	
	public function changeProfileData(Request $request, $idUser)
	{
		//Объявление перменных
		$data = $request->all();
		
		//Загрузил ли пользователь картинку
		if($request->file('avatar'))
		{
			$request->validate([
				'avatar' => 'mimes:jpeg,png,bmp,svg|max:5000'
			]);
		}
		else
		{
			$data['avatar'] = null;
		}
		
		//Существуют ли другие аватары
		if(!empty($data['avatar']))
		{
			$path = $request->file('avatar')->store('upload/users/'.$request->user()->id, 'public');
			File::deleteFileInStorageFolder(Auth::user()->avatar);
			User::find($idUser)->update(['avatar' => $path]);
		}
		
		//Проверка на пустоту group
		if(empty($data['group']))
			$data['group'] = null;
		
		//Обновление записи пользователя
		User::find($idUser)
			->update(['name' => $data['name'],
					  'group'=> $data['group']]);
		
		//Редирект в профиль с сообщением
		return back()->with('status', 'Профиль сохранен!');;
	}
	
}
