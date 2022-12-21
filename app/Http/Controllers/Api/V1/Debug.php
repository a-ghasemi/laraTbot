<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Telegram\TelegramBot;

class Debug extends Controller
{
    public function debug(Request $request, string $token)
    {
        abort_if(config('tbot.debug.token') != $token,404);

        $tbot = new TelegramBot();
        return $tbot->handleWebhook($request);
    }
}
