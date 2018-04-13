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


    public function getOrderedInterests() {
        $interests = [];
        $interests['w_political'] = $this->w_political;
        $interests['w_progressive'] = $this->w_progressive;
        $interests['w_age'] = $this->w_age;
        $interests['ws_entertainment'] = $this->ws_entertainment;
        $interests['ws_foreign'] = $this->ws_foreign;
        $interests['ws_political'] = $this->ws_political;
        $interests['ws_sports'] = $this->ws_sports;
        $interests['ws_generic'] = $this->ws_generic;
        $interests['ws_culture'] = $this->ws_culture;
        $interests['ws_economics'] = $this->ws_economics;

        asort($interests);
        return array_reverse($interests);
    }
}
