<?php

namespace App;

use App\Models\UserTopic;
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
        'app_id', 'age'
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
        return $meansource ? array_chunk($meansource, 3, true)[0] : [];
    }

    public function getNotYourSource() {
    	$interests = $ratioInterests = $this->getInterests();

    	$sources = Source::get();
    	$userSources = $this->sources;
    	foreach ($userSources as $userSource) {
			foreach ($sources as $key => $source) {
				if ($source->id === $userSource->id) unset($sources[$key]);
			}
    	}
    	foreach ($sources as $key => $source) {
    		if (!$source->articles->count()) unset($sources[$key]);
    	}

    	return $sources;
    }

   	/**
   	 * Retrieves sources which are not in its set and random
   	 * 
   	 * @return Source
   	 */
    public function getRandSource() {
    	$sources = $this->getNotYourSource();

    	$pickedSources = $sources->random(3);
    }

    public function getNearestSources() {
    	// Interests needed for calculations later.
    	$interests = $ratioInterests = $this->getInterests();

    	$sources = Source::get();
    	$userSources = $this->sources;
    	foreach ($userSources as $userSource) {
			foreach ($sources as $key => $source) {
				if ($source->id === $userSource->id) unset($sources[$key]);
			}    		
    	}

    	dd($sources);
    	// Need source set without the current selection
    	


    	dd ($interests);

    	$sourceCount = Source::count();
    	foreach ($interests as $key => $value) {
    		$ratioInterests[$key] = 100 / (Source::sum($key) / Source::count()) * 100;
    	}
    	asort($ratioInterests);
    	$ratioInterests = array_reverse($ratioInterests);



    	dd($ratioInterests, $interests);



    	dd ($interests);
    }

    /**
     * 
     */
    public function topics() 
    {
    	return $this->hasMany(UserTopic::class);
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
    	return $this->hasMany(UserArticle::class);
    }
}
