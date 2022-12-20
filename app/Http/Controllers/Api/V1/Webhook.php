<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Telegram\TelegramBot;

class Webhook extends Controller
{
    public function index(Request $request, string $token)
    {
        abort_if(config('tbot.webhook_check_token.main') != $token,404);

        $tbot = new TelegramBot();
        return $tbot->handleWebhook($request);
    }

    public function debug(Request $request, string $token)
    {
        abort_if(config('tbot.webhook_check_token.debug') != $token,404);

        $tbot = new TelegramBot();
        return $tbot->handleWebhook($request);
    }
}
