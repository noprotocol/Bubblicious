<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserArticle extends Model
{
    protected $fillable = [
        'user_id',
        'article_id',
    ];

    
}

