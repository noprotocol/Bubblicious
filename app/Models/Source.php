<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Source extends Model
{
    protected $fillable = [
        'external_id',
        'name',
        'image'
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
}
