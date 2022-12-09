<?php

use Illuminate\Support\Facades\Route;
use Telegram\TelegramBot;

Route::get('/',function (){
    return view('panel');
})->name('panel');

Route::post('panel/{method?}',function (\Illuminate\Http\Request $request, $method = null){
    $this->tbot = new TelegramBot();
    $params = $request->get('params',[]);
    $response = $this->tbot->$method(...$params);
    return view('result',['result' => $response->toString()]);
})->name('bot_method');

Route::get('phpinf/124', function (){
    return phpinfo();
});
