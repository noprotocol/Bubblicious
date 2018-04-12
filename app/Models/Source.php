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

    protected $hidden = [
        'created_at', 'updated_at', 'external_id',
        'w_political', 'w_progressive', 'w_age',
        'ws_entertainment', 'ws_foreign', 'ws_political',
        'ws_sports', 'ws_generic', 'ws_culture', 'ws_economics'
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }
}
