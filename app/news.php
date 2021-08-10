<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class news extends Model
{
    protected $fillable = [
        'id_user', 'newsIcon', 'newsName', 'newsText', 'newsLikes', 'isPublish'
    ];
	
	
	//News
	//Отображение новостей с проверкой на административность
	public static function newsJoinedUsersIsAdmin($isAdmin)
	{
		return DB::table('news')
				->join('users', 'news.id_user', '=', 'users.id')
				->orderBy('news.id', 'desc')
				->where('isAdmin', $isAdmin)
				->where('isPublish', true)
				->select('news.id as news_id', 'newsName', 'newsIcon', 'newsText', 'newsLikes',
						'news.created_at as news_created_at', 'news.updated_at as news_updated_at',
						'name as userName')->paginate(10);
	}
	
	public static function newsJoinedUsers()
	{
		return DB::table('news')
				->join('users', 'news.id_user', '=', 'users.id')
				->orderBy('news.id', 'desc')
				->where('isPublish', true)
				->select('news.id as news_id', 'newsName', 'newsIcon', 'newsText', 'newsLikes',
						'news.created_at as news_created_at', 'news.updated_at as news_updated_at',
						'name as userName')->paginate(10);
	}
	
	public static function lastNews()
	{
		return DB::table('news')->orderBy('id', 'desc')->limit(3)->get();
	}
}
