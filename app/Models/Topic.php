<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use App\User;

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
            if ($article->image !== 'https://bubblicious.herokuapp.com/img/bubble.jpg') {
                return $article->image;
            }
        }
        return 'https://bubblicious.herokuapp.com/img/bubble.jpg';
    }

    /**
     * The articles
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getArticlesAttribute() {
        // TODO intelligent
        return $this->articles()->limit(3)->get();
    }

    /**
     * @return bool
     */
    public function getReadAttribute() {
        $user = User::firstOrCreate(['app_id' => Request::header('X-Bubble')]);
        $read = $user->topics()->where('topic_id', $this->id)->get();
        return !$read->isEmpty();
    }

    /**
     * @return string
     */
    public function getDateAttribute() {
        Carbon::setLocale('nl');
        return $this->articles()->orderBy('created_at', 'desc')->get()->last()->created_at->diffForHumans();
    }

    /**
     * @param string $value
     * @return string
     */
    public function getNameAttribute(string $value) {
        return ucfirst($value);
    }
}
