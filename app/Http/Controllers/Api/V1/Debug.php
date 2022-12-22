<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\ServerSentTelegramRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Pusher\Pusher;
use Telegram\TelegramBot;

class Debug extends Controller
{
    #TODO: response something that CustomResponse expected, but says this is debug mode
    public function index(Request $request, string $token, string $method = '--! NoMethod --')
    {
        abort_if(config('tbot.debug.token') != $token, 404);

        Log::debug($method, $request->all());
        ServerSentTelegramRequest::dispatch($method, $request->all());

        return response('debug trigger', 201);
    }
}
