<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'topic_id',
        'source_id',
        'title',
        'body',
        'image',
        'uri',
    ];
}
