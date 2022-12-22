<?php

namespace Telegram;

use App\Events\ServerSentTelegramRequest;
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
    protected $debug_requests;
    protected $debug_responses;
    public Command $commands;
    public string $chat_id;


    public function __construct()
    {
        $this->debug_requests = config('tbot.debug.request');
        $this->debug_responses = config('tbot.debug.response');
        $this->url = $this->makeUrl();
        $this->commands = new Command($this);
    }

    public function getMe(): TelegramObject
    {
        $response = $this->call('getMe');
        return User::fromResponse($response);
    }

    public function setWebhook(string $url): CustomResponse
    {
        return $this->call('setWebhook', ['url' => $url]);
    }

    public function getUpdates(): UpdateArray
    {
        $response = $this->call('getUpdates');
        return UpdateArray::fromResponse($response);
    }

    public function handleWebhook(Request $request): Response
    {
        $request_arr = $request->all();
        $this->chat_id = $request_arr['message']['chat']['id'];

        if ($this->debug_responses) {
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

    public function call($telegram_method_name, $params = [], $http_method = 'post'): CustomResponse|RedirectResponse
    {
        $url = $this->url . $telegram_method_name;

        if(config('tbot.debug.url')){
            dd($url);
        }

        $client = app('GuzzleClient')([
                'base_uri'  => $url,
                'timeout'   => 10,
                'verify'    => true,
            ]);

        $response = ($this->debug_requests)?
            $client->post($url, $params)
            : Http::send($http_method, $url, $params);

        if($this->debug_responses) dd($response->json());

        return (new CustomResponse($response));
    }

}
