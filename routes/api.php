<?php

use Illuminate\Http\Request;
use App\Models\Article;
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
    return response()->json([
        [
            'id' => 1,
            'name' => 'Nu.nl',
            'image' => 'https://bin.snmmd.nl/m/h25ykpju22mc_san_rectangle_xlarge.png/nu-nl-logo.png'
        ],
        [
            'id' => 2,
            'name' => 'AD',
            'image' => 'https://simwave.nl/wp-content/uploads/2017/11/AD-logo-1.jpg'
        ]
    ]);
});

Route::post('sources', function () {
    // [age, ids:[]]
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
    // [age, ids:[]]
    return response()->json(['success' => true]);
});