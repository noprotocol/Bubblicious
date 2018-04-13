<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'topic_id',
        'source_id',
        'title',
        'body',
        'image',
        'uri',
    ];

    protected $hidden = [
        'topic_id', 'source_id', 'created_at', 'updated_at'
    ];

    public function topic()
    {
        return $this->belongsTo('App\Models\Topic');
    }

    public function source()
    {
        return $this->belongsTo('App\Models\source');
    }

    public function normalize()
    {

        $name = $this->title;

        $nameArr = explode('-', str_slug($this->title));

        $normalized = [];
        foreach ($nameArr as $key => &$segment) {
            if (!is_numeric($segment) && !in_array($segment, $this->uselessWords())) {
                $weight = substr_count($this->body , $segment);

                if ($weight === 0) continue;
                $normalized[$segment] = $weight;
            }
        }
        
        // foreach ($normalized as $key => $weight) {
        //     $normalized[$key] = substr_count($article->body , $key );
        // }
        return $normalized;
    }

    

    public function uselessWords()
    {
        $voorzetsels = [
            'niet',
            'geen',
            'heeft',
            'heb',
            'had',
            'als',
            'hoe',
            't',
            'kan',
            'toe',
            'dat',
            'dan',
            'hij',
            'zei',
            'zij',
            'jullie',
            'of',
            'gaat',
            'wordt',
            'die',
            'zoals',
            'doe',
            'wat',
            'wanneer',
            'meer',
            'wil',
            'wit',
            'er',
            'ook',
            'jr',
            'anti',
            'en',
            'is',
            'je',
            'ik',
            'we',
            'zijn',
            'maar',
            'houdt',
            'twee',
            'drie',
            'vier',
            'vijf',
            'honderd',
            'duizend',
            'de',
            'het',
            'een',
            'aan',
            'aangaande',
            'achter',
            'ad',
            'af',
            'bachten',
            'behalve',
            'behoudens',
            'beneden',
            'benevens',
            'benoorden',
            'benoordoosten',
            'benoordwesten',
            'beoosten',
            'betreffende',
            'bewesten',
            'bezijden',
            'bezuiden',
            'bezuidoosten',
            'bezuidwesten',
            'bij',
            'binnen',
            'blijkens',
            'boven',
            'bovenaan',
            'buiten',
            'circa',
            'conform',
            'contra',
            'cum',
            'dankzij',
            'door',
            'doorheen',
            'gedurende',
            'gezien',
            'hangende',
            'in',
            'ingevolge',
            'inzake',
            'jegens',
            'krachtens',
            'langs',
            'langsheen',
            'luidens',
            'met',
            'middels',
            'midden',
            'na',
            'naar',
            'naast',
            'nabij',
            'namens',
            'nevens',
            'niettegenstaande',
            'nopens',
            'om',
            'omstreeks',
            'omtrent',
            'ondanks',
            'onder',
            'onderaan',
            'ongeacht',
            'onverminderd',
            'op',
            'over',
            'overeenkomstig',
            'per',
            'plus',
            'post',
            'richting',
            'rond',
            'rondom',
            'sedert',
            'sinds',
            'spijts',
            'staande',
            'te',
            'tegen',
            'tegenover',
            'ten',
            'ter',
            'tijdens',
            'tot',
            'trots',
            'tussen',
            'uit',
            'uitgezonderd',
            'van',
            'vanaf',
            'vanuit',
            'vanwege',
            'versus',
            'via',
            'vis-à-vis',
            'volgens',
            'voor',
            'voorbij',
            'wegens',
            'zijdens',
            'zonder',
            'al',
            'u',
            'wel',
            'beste',
            'nog',
            'ze',
            'sta',
            's',
            'f',
            'me',
            'haar',
            'open',
            'feit',
            'nieuwe',
            'der',
            'hol',
            'zo',
            'e',
            'ver',
            'zakt',
            'even',
            'terug',
            'zich',
            'komst',
            'psychische',
            'komst',
            'moet',
            'it',
            'den',
            'hoger',
            'lager',
            'dag',

        ];

        return $voorzetsels;

    }

}
