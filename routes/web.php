<?php

use Illuminate\Support\Facades\Route;
use Telegram\TelegramBot;

Route::get('/',function (){
    return view('panel');
})->name('panel');

Route::get('panel/{method?}',function (\Illuminate\Http\Request $request, $method = null){
    $tbot = new TelegramBot();
    $params = $request->get('params',[]);
    $response = $tbot->commands->$method(...$params);
    return view('result',['result' => $response->toString()]);
})->name('bot_method');

Route::get('phpinf/124', function (){
    return phpinfo();
});
