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
    return response()->json(Topic::where('weight', '>', 3)->orderBy('weight')->limit(5)->get());
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
    // ordered
    // Links / Rechts split op politieke kleur !!
    return response()->json([
        ['name' => 'Politiek', 'color' => '#24cafe', 'value' => 68],
        ['name' => 'Sport', 'color' => '#cafe24', 'value' => 45],
        ['name' => 'Cultuur', 'color' => '#ff0000', 'value' => 54],
    ]);
});