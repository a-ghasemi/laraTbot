<?php

namespace Telegram;

use Illuminate\Support\Facades\Http;
use Telegram\Core\TelegramObject;
use Telegram\Customs\CustomResponse;
use Telegram\Customs\CustomResponseArr;
use Telegram\Objects\Update;
use Telegram\Objects\UpdateArray;
use Telegram\Objects\User;

class TelegramBot
{
    protected $url;
    protected $debug_url;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->url = $this->makeUrl();
        $this->debug_url = config('tbot.debug.url_call');
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

    private function makeUrl(): string
    {
        if(config('tbot.telegram_api_path','') == ''){
            throw new \Exception('<telegram API path> does not exists');
        }

        if(config('tbot.token','') == ''){
            throw new \Exception('<telegram bot token> does not exists');
        }

        return config('tbot.telegram_api_path') . config('tbot.token') . '/';
    }

    private function call($telegram_method_name, $params = [], $http_method = 'post'): CustomResponse
    {
        $url = $this->url . $telegram_method_name;
        if($this->debug_url) {
            return dd($url);
        }
        $response = Http::send($http_method, $url, $params);
        return (new CustomResponse($response));
    }

    private function callArray($telegram_method_name, $params = [], $http_method = 'post'): CustomResponse
    {
        $url = $this->url . $telegram_method_name;
        if($this->debug_url) {
            return dd($url);
        }
        $response = Http::send($http_method, $url, $params);
        return (new CustomResponse($response));
    }
}
