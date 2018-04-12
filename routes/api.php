<?php

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Source;
use App\User;

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

Route::get('sources', function () {
    return response()->json(Source::all());
});

Route::post('sources', function (Request $request) {
    // [age, ids:[]]
    $user = User::firstOrNew(['app_id' => 'iets']);
    $user->age = $request->age;
    $user->save();

    foreach ($request->ids as $id) {
        $source = Source::findOrFail($id);
        // TODO
    }

    return response()->json(['success' => true]);
});

Route::get('topics', function () {
    return response()->json([
        [
            'id' => 1,
            'name' => 'trump',
            'read' => false,
            'articles' => Article::inRandomOrder()->limit(3)->get()
        ],
        [
            'id' => 2,
            'name' => 'Meer Trump',
            'read' => true,
            'articles' => Article::inRandomOrder()->limit(3)->get()
        ]
    ]);
});

Route::post('topic', function () {
    // [id]
    return response()->json(['success' => true]);
});


Route::post('article', function () {
    // [id]
    return response()->json(['success' => true]);
});