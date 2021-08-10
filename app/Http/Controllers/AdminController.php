<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	//Открыть страницу
    public function indexCreateAdmin()
	{
		return view('admin.CreateAdmin');
	}
	
	//Действия администратора
	public function createAdmin(Request $request)
	{
		User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);
		
		return redirect()->route('home')->with('status', 'Администратор успешно создан!');
	}
}
