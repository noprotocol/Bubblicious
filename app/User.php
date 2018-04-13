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

    public $interestSet = [
        'w_political',
        'w_progressive',
        'ws_entertainment',
        'ws_foreign',
        'ws_political',
        'ws_sports',
        'ws_generic',
        'ws_culture',
        'ws_economics',
    ];

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

        

        $meansource = [];
        foreach ($userSources as $userSource) {
            $source = $userSource->source;
            foreach ($this->interestSet as $interestKey) {
                array_key_exists($interestKey, $meansource) ? $meansource[$interestKey] += $source->$interestKey : $meansource[$interestKey] = $source->$interestKey;
            }

        }
        foreach ($this->interestSet as $interestKey) {
            $meansource[$interestKey] /= count($userSources);
        }
        asort($meansource);
        return array_reverse($meansource);
    }

    public function getTopInterests() {
    	$meansource = $this->getInterests();
        return $meansource ? array_chunk($meansource, 2, true)[0] : [];
    }

    public function getNotYourSource() {
    	$sources = Source::get();
    	$userSources = $this->sources;


    	foreach ($userSources as $userSource) {
			foreach ($sources as $key => $source) {
				if ($source->id === $userSource->id) unset($sources[$key]);
			}
    	}

    	foreach ($sources as $key => $source) {
    		if (!$source->articles->where('topic_id', '!=', null)->count()) unset($sources[$key]);
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

    	return $pickedSources;
    }

    public function getNearestSources() {
    	// Interests needed for calculations later.
    	$interests = $ratioInterests = $this->getTopInterests();

    	$restSources = $this->getNotYourSource();
    	
    	$interestKeyed = [];
    	foreach ($interests as $key => $interest) {
    		$interestKeyed[] = ['value' => $interest, 'key' => $key];
    	}
    	$distances = [];
    	foreach ($restSources as $key => $source) {
    		$distances[$source->id] = (string)sqrt(
    			pow($source->{ $interestKeyed[0]['key'] } + $interestKeyed[0]['value'], 2) + 
    			pow($source->{ $interestKeyed[1]['key'] } + $interestKeyed[1]['value'], 2)
    		);
    	}

    	asort($distances);
    	$distances = array_flip($distances);
    	$nearest = Source::find(end($distances));
    	$distances = array_reverse($distances);
    	$furthest = Source::find(end($distances));

    	return ['nearest' => $nearest, 'furthest' => $furthest];
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
