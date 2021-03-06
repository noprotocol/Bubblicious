<?php

use Illuminate\Http\Request;
use App\Models\Source;
use App\Models\Topic;
use App\User;
use App\Models\UserSource;
use App\Models\UserTopic;
use App\Models\UserArticle;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * Sources all 13 of them
 */
Route::get('sources', function () {
    return response()->json(Source::all());
});

/**
 * Post sources and age
 */
Route::post('sources', function (Request $request) {
    $user = User::firstOrNew(['app_id' => $request->header('X-Bubble')]);

    foreach($user->sources as $source) {
        $source->delete();
    }

    $user->age = $request->age;
    $user->save();

    foreach ($request->ids as $id) {
        $source = Source::findOrFail($id);
        UserSource::create(['user_id' => $user->id, 'source_id' => $source->id]);
    }

    return response()->json(['success' => true]);
});

/**
 * Show topics (something something personalised)
 */
Route::get('topics', function () {
    return response()->json(Topic::where('items', '>', 2)->inRandomOrder()->limit(5)->get());
});

/**
 * Topic is read
 */
Route::post('topic', function (Request $request) {
    $user = User::firstOrCreate(['app_id' => $request->header('X-Bubble')]);
    UserTopic::create(['user_id' => $user->id, 'topic_id' => $request->id]);
    return response()->json(['success' => true]);
});

/**
 * Article is read
 */
Route::post('article', function (Request $request) {
    $user = User::firstOrCreate(['app_id' => $request->header('X-Bubble')]);
    UserArticle::create(['user_id' => $user->id, 'article_id' => $request->id]);
    return response()->json(['success' => true]);
});

/**
 * Show top 3 bubbles for user
 */
Route::get('bubble', function (Request $request) {
    $user = User::firstOrCreate(['app_id' => $request->header('X-Bubble')]);
    $interests = $user->getInterests();

    if (empty($interests)) {
        return response()->json([]);
    }

    $right = $interests['w_political'];
    unset($interests['w_political']);
    $interests['Rechts'] = $right;
    $interests['Links'] = 100-$right;

    $right = $interests['w_progressive'];
    unset($interests['w_progressive']);
    $interests['Progressief'] = $right;
    $interests['Conservatief'] = 100-$right;

    $names = [
//        "w_political" => 'Kleur',
        "ws_generic" => 'Algemeen',
//        "w_progressive" => 'Progressief',
        "ws_entertainment" => 'Entertainment',
        "ws_economics" => 'Economie',
        "ws_sports" => 'Sport',
//        "w_age" => 'Leeftijd',
        "ws_political" => 'Politiek',
        "ws_foreign" => 'Buitenland',
        "ws_culture" => 'Cultuur',
    ];

    foreach ($names as $key => $name) {
        $value = $interests[$key];
        unset($interests[$key]);
        $interests[$name] = $value;
    }

    unset($interests['w_age']); // hack to remove age

    asort($interests);
    $interests = array_reverse($interests);
    $interests = array_chunk($interests, 3, true)[0];

    $colors = [
        'Links' => '#ff3300',
        'Rechts' => '#0033cc',
        'Progressief' => '#6666ff',
        'Conservatief' => '#003366',
        'Algemeen' => '#ff6600',
        'Entertainment' => '#cc3399',
        'Economie' => '#6600cc',
        'Sport' => '#009933',
        'Politiek' => '#3399ff',
        'Buitenland' => '#00ccff',
        'Cultuur' => '#753a10',
    ];

    $bubble = [];
    $multi = 0;
    foreach ($interests as $name => $value) {
        $bubble[] = [
            'name' => $name,
            'value' => (int)($value - 10 * $multi),
            'color' => $colors[$name]
        ];
        $multi++;
    }

    return response()->json($bubble);
});


/**
 *          Test Endponts
 */

Route::post('test', function (Request $request) {
    return response()->json(['post', $request->header('X-Bubble'), $request->toArray()]);
});


Route::get('test', function (Request $request) {
    return response()->json(['get', $request->header('X-Bubble'), $request->toArray()]);
});