<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = [
        'icon', 'id_user', 'eventHeader', 'eventText', 'isPublish'
    ];
}
