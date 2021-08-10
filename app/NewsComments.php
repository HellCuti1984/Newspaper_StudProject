<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NewsComments extends Model
{
     protected $fillable = [
        'userComment'
    ];
	
	//Home
	public static function newsCommentsJoinedNews()
	{	
		return DB::table('news_comments')
				->join('users', 'news_comments.id_user', '=', 'users.id')
				->join('news', 'news_comments.id_news', '=', 'news.id')
				->orderBy('news_comments.id', 'desc')
				->where('users.id', Auth::id())
				->paginate(5);
	}
	
	//News
	public static function newsCommentsJoinedUsers($id)
	{
		return DB::table('news_comments')
				->join('users', 'news_comments.id_user', '=', 'users.id')
				->orderBy('news_comments.id', 'desc')
				->where('id_news', $id)
				->paginate(10);
	}
	
	public static function countComments($idNews)
	{
		return DB::table('news_comments')
				->join('news', 'news_comments.id_news', '=', 'news.id')
				->where('news.id', $idNews)
				->count('news_comments.id');
	}
}
