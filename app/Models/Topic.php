<?php

namespace App\Models;

use Carbon\Carbon;
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
        'image', 'articles', 'read', 'date'
    ];

    /**
     * This topics articles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function articles()
    {
        return $this->hasMany('App\Models\Article');
    }

    /**
     * A random article image for topic
     * 
     * @return string
     */
    public function getImageAttribute() {
        foreach($this->articles()->inRandomOrder()->get() as $article) {
            if ($article->image !== 'http://via.placeholder.com/1600x1200') {
                return $article->image;
            }
        }
        return 'http://via.placeholder.com/1600x1200';
    }

    /**
     * The articles
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getArticlesAttribute() {
        return $this->articles()->get();
    }

    /**
     * TODO have I read this ??!!
     *
     * @return bool
     */
    public function getReadAttribute() {
        return true;
    }

    /**
     * @return mixed
     */
    public function getDateAttribute() {
        Carbon::setLocale('nl');
        return $this->articles()->orderBy('created_at', 'desc')->get()->last()->created_at->diffForHumans();
    }
}
