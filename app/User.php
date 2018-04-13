<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Topic;
use App\Models\Source;
use App\Models\Article;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * 
     */
    public function topics() 
    {
    	return $this->hasMany(Topic::class);
    }

    /**
     * Preferenced
     */
    public function sources()
    {
    	return $this->hasMany(Source::class);
    }

    /**
     * Preferenced
     */
    public function articles()
    {
    	return $this->hasMany(Article::class);
    }
}
