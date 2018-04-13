<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Topic;
use App\Models\Source;
use App\Models\Article;
use App\Models\UserSource;


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

    public function orderUserSources()
    {
    	$userSource = $this->sources;

    	$interests = [];

    }

    public function getInterests() {
    	$userSources = $this->sources;
        if (!$userSources) return [];

        $interestSet = [
            'w_political',
            'w_progressive',
            'w_age',
            'ws_entertainment',
            'ws_foreign',
            'ws_political',
            'ws_sports',
            'ws_generic',
            'ws_culture',
            'ws_economics',
        ];

        $meansource = [];
        foreach ($userSources as $userSource) {
            $source = $userSource->source;
            foreach ($interestSet as $interestKey) {
                array_key_exists($interestKey, $meansource) ? $meansource[$interestKey] += $source->$interestKey : $meansource[$interestKey] = $source->$interestKey;
            }

        }
        foreach ($interestSet as $interestKey) {
            $meansource[$interestKey] /= count($userSources);
        }
        asort($meansource);
        return array_reverse($meansource);
    }

    public function getTopInterests() {
    	$meansource = $this->getInterests();
        
        return $meansource ? array_chunk($this->getInterests(), 3, true)[0] : [];
    }

    public function getNearestSources() {
    	$interests = $this->getInterests();

    	dd ($interests);


    }

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
    	return $this->hasMany(UserSource::class);
    }

    /**
     * Preferenced
     */
    public function articles()
    {
    	return $this->hasMany(Article::class);
    }
}
