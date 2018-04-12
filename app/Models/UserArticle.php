<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class UserArticle extends Model
{
    protected $fillable = [
        'user_id',
        'article_id',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

