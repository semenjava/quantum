<?php

use Illuminate\Http\Request;
use Modules\GraphQL\Http\Controllers\GraphQLController;

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

Route::group(['prefix' => 'v1', 'as' => 'api.'], function () {
    Route::get('graphql/typeDefs', [GraphQLController::class, 'getTypeDefs']);
});

