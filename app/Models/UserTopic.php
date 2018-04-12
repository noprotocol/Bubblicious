<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserTopic extends Model
{
    protected $fillable = [
        'user_id',
        'topic_id',
    ];

    public function article()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
