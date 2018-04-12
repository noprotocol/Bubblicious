<?php

use Illuminate\Http\Request;

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
            'name' => 'Nu.nl',
            'image' => 'https://bin.snmmd.nl/m/h25ykpju22mc_san_rectangle_xlarge.png/nu-nl-logo.png'
        ],
        [
            'name' => 'AD',
            'image' => 'https://simwave.nl/wp-content/uploads/2017/11/AD-logo-1.jpg'
        ]
    ]);
});
