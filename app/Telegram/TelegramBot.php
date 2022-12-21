<?php

namespace Telegram;

use App\Events\ServerSentTelegramRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Telegram\Commands\Command;
use Telegram\Core\TelegramObject;
use Telegram\Customs\CustomResponse;
use Telegram\Customs\CustomResponseArr;
use Telegram\Handler\TelegramBotHandler;
use Telegram\Objects\Update;
use Telegram\Objects\UpdateArray;
use Telegram\Objects\User;

class TelegramBot
{
    protected $url;
    protected $debug_url;
    public Command $commands;
    public string $chat_id;


    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->url = $this->makeUrl();
        $this->debug_url = config('tbot.debug.url_call');
        $this->commands = new Command($this);
    }

    public function getMe(): TelegramObject
    {
        $response = $this->call('getMe');
        return User::fromResponse($response);
    }

    public function getUpdates(): UpdateArray
    {
        $response = $this->callArray('getUpdates');
        return UpdateArray::fromResponse($response);
    }

    public function handleWebhook(Request $request): Response
    {
        $request_arr = $request->all();
        $this->chat_id = $request_arr['message']['chat']['id'];

        if ($this->debug_url) {
            ServerSentTelegramRequest::dispatch('::WEBHOOK::', $request);
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
        $url = $this->url . $telegram_method_name;
        if ($this->debug_url) {
            $url = route('tbot.send.debug', [
                'method' => $telegram_method_name,
                'token'  => config('tbot.debug.token'),
            ]);
        }
        $response = Http::post($url, $params);
        return (new CustomResponse($response));
    }

    private function callArray($telegram_method_name, $params = [], $http_method = 'post'): CustomResponse
    {
        $url = $this->url . $telegram_method_name;
        if ($this->debug_url) {
            return dd($url);
        }
        $response = Http::send($http_method, $url, $params);
        return (new CustomResponse($response));
    }
}
