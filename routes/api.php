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
            'image' => 'https://www.nu.nl/static/img/atoms/images/logos/logosprite.svg?v=2'
        ]
    ]);
});
