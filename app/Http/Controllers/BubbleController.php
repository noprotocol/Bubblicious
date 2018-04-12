<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Source;
use App\Models\Topic;
use App\Models\UserArticle;
use App\Models\UserTopic;

use Illuminate\Http\Request;

class BubbleController extends Controller
{
    

    public function index()
    {
        $source = Source::find(1);
        $article = $source->articles;

        dd ($article);
    }    

    public function import()
    {
        $url = 'http://newsapi.org/v2/everything?pageSize=100&language=nl&q=Bitcoin&from=2017-04-12&sortBy=popularity&apiKey=3f65049dac954588bd4a66fa9be7a83d';

        $defaultImg = 'http://via.placeholder.com/1600x1200';

        try {
            $content = file_get_contents($url);
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

    public function normalize()
    {
        $potentialTopics = [];

        $articles = Article::get();
        foreach ($articles as $article) {
            $normalized = $article->normalize();
            foreach($normalized as $segment => $weight) {
                array_key_exists($segment, $potentialTopics) ? $potentialTopics[$segment]++ : $potentialTopics[$segment] = 1;
            }
        }

        foreach ($potentialTopics as $segment => $weight) {
            if ($weight === 1) unset($potentialTopics[$segment]);
        }
asort($potentialTopics);
        dd ($potentialTopics);

        return $potentialTopics;
    }

}
