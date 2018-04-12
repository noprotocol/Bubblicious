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

    
}
