<?php

namespace Telegram;

use App\Events\ServerCommunicatedWithTelegram;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Telegram\Commands\Command;
use Telegram\Core\TelegramObject;
use Telegram\Customs\CustomResponse;
use Telegram\Handler\TelegramBotHandler;
use Telegram\Objects\Update;
use Telegram\Objects\UpdateArray;
use Telegram\Objects\User;

class TelegramBot
{
    protected $url;
    public Command $commands;
    public string $chat_id;

    public function __construct()
    {
        $this->url = $this->makeUrl();
        $this->commands = new Command($this);
    }

    public function handleWebhook(Request $request): Response
    {
        $request_arr = $request->all();
        $this->chat_id = $request_arr['message']['chat']['id'];

        if (config('tbot.debug.log.webhook')) {
            Log::info('webhook', $request->all() ?? []);
            ServerCommunicatedWithTelegram::dispatch('::WEBHOOK::', $request->all());
        }

        $handler = new TelegramBotHandler($this, $request);
        $handler->run();
        return $handler->getResponse();
    }

    private function makeUrl(): string
    {
        if (config('tbot.telegram_api_path', '') == '') {
            throw new \Exception('<telegram API path> does not exists');
        }

        if (config('tbot.token', '') == '') {
            throw new \Exception('<telegram bot token> does not exists');
        }

        return config('tbot.telegram_api_path') . config('tbot.token') . '/';
    }

    public function call($telegram_method_name, $params = [], $http_method = 'post'): CustomResponse
    {
        abort_if(!in_array($http_method, ['get', 'post']), 503);

        $url = $this->url . $telegram_method_name;

        if (config('tbot.debug.url')) {
            dd($url);
        }

        $response = Http::beforeSending(function ($req) use ($telegram_method_name) {
            if (!config('tbot.debug.log.request')) return;
            Log::debug('request', [
                'method'  => $req->method(),
                'url'     => $req->url(),
                'headers' => $req->headers(),
                'data'    => $req->data(),
            ]);
            ServerCommunicatedWithTelegram::dispatch('::REQUEST::', [
                'http method'     => $req->method(),
                'telegram method' => $telegram_method_name,
                'data'            => $req->data(),
            ]);
        })->$http_method($url, $params);

        return (new CustomResponse($response));
    }

}
