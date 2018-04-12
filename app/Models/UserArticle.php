<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserArticle extends Model
{
    protected $fillable = [
        'user_id',
        'article_id',
    ];

    public function article()
    {
        return $this->belongsTo('App\Models\Article');
    }
}

