<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTopic extends Model
{
    protected $fillable = [
        'user_id',
        'topic_id',
    ];

    public function article()
    {
        return $this->belongsTo('App\Models\Topic');
    }
}
