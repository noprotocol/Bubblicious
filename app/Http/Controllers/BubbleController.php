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
            $content = $this->api->query('energie');
            $data = json_decode($content);
            $articles = $data->articles;

            foreach ($articles as $article) {
                $source = Source::where('external_id', $article->source->name)->first();
                if (!$source) {
                   continue;
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

    public function normalize()
    {
        // $potentialTopics = [];

        $articles = Article::where('topic_id', null)->get();
        foreach ($articles as $article) {
            $normalized = $article->normalize();
            if (!$normalized) continue;

            asort($normalized);
            $normalized = array_flip($normalized);
            
            // Heighest weight, is on bottom for popping.
            $segment = array_pop($normalized);

            $topic = Topic::where('name', $segment)->first();
            if (!$topic) {
                $topic = new Topic;
                $topic->name = $segment;
                $topic->weight = 0;
            }
            $topic->weight++;
            $topic->save();

            $article->topic_id = $topic->id;
            $article->save();

        }


        // return $potentialTopics;
    }

    public function insertTopics()
    {
        $potentialTopics = $this->normalize();

        $articles = Article::where('topic_id', null)->get();

        foreach ($articles as $article) {

        }

    }

    public function getArticles(String $name, Request $request)
    {
        $topic = Topic::where('name', $name)->first();
        dd ($topic->articles()->select('title')->get()->toArray());
    }
}
