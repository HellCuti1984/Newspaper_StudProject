<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request)
	{
		$newsList = DB::table('news')
				->join('users', 'news.id_user', '=', 'users.id')
				->orderBy('news.id', 'desc')
				->where('newsName', $request->search)
				->where('isPublish', true)
				->select('news.id as news_id', 'newsName', 'newsIcon', 'newsText', 'newsLikes',
						'news.created_at as news_created_at', 'news.updated_at as news_updated_at',
						'name as userName')->paginate(10);
		$lastNews = News::lastNews();
		
		return view('news.AllNewsPage', compact('newsList', 'lastNews'));
	}
}
