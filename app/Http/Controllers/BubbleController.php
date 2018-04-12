<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Source;
use App\Models\Topic;
use App\Models\UserArticle;
use App\Models\UserTopic;

use App\Services\NewsApi;
use Illuminate\Http\Request;

class BubbleController extends Controller
{
    private $api;

    /**
     * APIController constructor.
     */
    public function __construct()
    {
        $this->api = new NewsApi;
    }

    public function index()
    {
        $source = Source::find(1);
        $article = $source->articles;

        dd ($article);
    }    

    public function import()
    {
        $defaultImg = 'http://via.placeholder.com/1600x1200';

        try {
            $content = $this->api->query('bitcoin');
            $data = json_decode($content);
            $articles = $data->articles;

            foreach ($articles as $article) {
                $source = Source::where('external_id', $article->source->name)->first();

                if (!$source) {
                    $source = Source::create([
                        'external_id'   => $article->source->name,
                        'name'          => '',
                    ]);
                }

                $source->articles()->save(new Article([
                    'title' => $article->title,
                    'body' => $article->description,
                    'image' => $article->urlToImage ?: $defaultImg,
                    'uri' => $article->url, 
                ]));
            }



        } catch (\Exception $e) {
            throw $e;

        }
    }
    
}
