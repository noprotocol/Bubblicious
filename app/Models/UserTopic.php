<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTopic extends Model
{
    protected $fillable = [
        'user_id',
        'topic_id',
    ];

    
}
