<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1',
    'as' => 'v1.',
], function () {
    Route::any('ping', function (){
        return "PONG!";
    })->name('test.ping');

    Route::post('testP', function (Request $request){
        return response(implode('|',$request->all()),201);
    })->name('test.post');

    Route::post('webhook/{token}', "\App\Http\Controllers\Api\V1\Webhook@index")->name('tbot.webhook');
});

