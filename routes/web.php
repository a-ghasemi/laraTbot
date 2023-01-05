<?php

use Illuminate\Support\Facades\Route;
use Telegram\TelegramBot;

Route::get('/',function (){
    $url = route('v1.tbot.webhook', [
        'token' => config('tbot.webhook.token'),
    ]);

    return view('panel')->with([
        'webhook_url' => $url,
    ]);
})->name('panel');

Route::post('panel/{method?}',function (\Illuminate\Http\Request $request, $method = null){
    $tbot = new TelegramBot();
    $params = $request->get('params',[]);
    $response = $tbot->commands->$method(...$params);
    return view('result',['result' => $response->toString()]);
})->name('bot_method');

Route::get('phpinf/124', function (){
    return phpinfo();
});
