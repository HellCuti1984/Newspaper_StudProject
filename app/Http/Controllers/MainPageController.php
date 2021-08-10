<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class MainPageController extends Controller
{
    public function template()
	{
		$newsList = News::newsJoinedUsers();
		$newsListAdmin = News::newsJoinedUsersIsAdmin(true);
		$newsListStud = News::newsJoinedUsersIsAdmin(false);
		
		return view('mainpage', compact('newsList', 'newsListAdmin', 'newsListStud'));
	}
}
