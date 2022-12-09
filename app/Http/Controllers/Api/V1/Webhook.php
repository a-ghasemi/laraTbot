<?php

namespace App\Http\Controllers\Api\V1;

use App\Bot\General\BotConfig;
use App\Bot\MigrantionRobot;
use App\Http\Controllers\Controller;
use App\Models\BotConnection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Telegram\TelegramBot;

class Webhook extends Controller
{
    public function index(Request $request, string $token)
    {
        abort_if(config('tbot.webhook_check_token'),404);

        $tbot = new TelegramBot();
        $tbot->handleWebhook($request);

        return response('done', 200);
    }
}
