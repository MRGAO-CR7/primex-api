<?php

use App\Http\Middleware\AcceptsJsonApi;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;

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

Route::group([
    'middleware' => [
        AcceptsJsonApi::class,
    ],
    'namespace' => 'JsonApi',
], function () {
    JsonApi::register('v1')->routes(function ($api) {
        $api->resource('products')->except('delete');
        $api->resource('stocks')->only('create');
    });
});
