<?php

namespace App\Models;
use App\User;

use Illuminate\Database\Eloquent\Model;

class UserSource extends Model
{
    protected $fillable = [
        'user_id',
        'source_id',
    ];

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
