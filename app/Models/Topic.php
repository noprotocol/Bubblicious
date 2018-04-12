<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'name',
    ];

    public function article()
    {
        return $this->hasMany('App\Models\Article');
    }
}
