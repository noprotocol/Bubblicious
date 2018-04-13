<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'name', 'weight',
    ];

    protected $hidden = [
        'weight', 'created_at', 'updated_at'
    ];

    protected $appends = [
        'image', 'articles'
    ];

    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    public function getImageAttribute() {
        foreach($this->articles()->inRandomOrder()->get() as $article) {
            if ($article->image !== 'http://via.placeholder.com/1600x1200') {
                return $article->image;
            }
        }
        return 'http://via.placeholder.com/1600x1200';
    }

    public function getArticlesAttribute() {
        return $this->articles()->get();
    }
}
