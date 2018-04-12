<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'name', 'weight',
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
}
