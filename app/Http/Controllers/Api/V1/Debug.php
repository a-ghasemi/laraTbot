<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\ServerSentTelegramRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Pusher\Pusher;
use Telegram\TelegramBot;

class Debug extends Controller
{
    public function debug(Request $request, string $token)
    {
        abort_if(config('tbot.debug.token') != $token,404);

        ServerSentTelegramRequest::dispatch($request);
    }
}
