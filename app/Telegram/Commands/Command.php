<?php

namespace Telegram\Commands;

use Telegram\Core\TelegramObject;
use Telegram\Objects\UpdateArray;
use Telegram\Objects\User;
use Telegram\Objects\WebhookInfo;
use Telegram\TelegramBot;
use Telegram\Customs\CustomResponse;

class Command
{
    private TelegramBot $bot;

    public function __construct(TelegramBot $bot)
    {
        $this->bot = $bot;
    }

    public function getMe(): TelegramObject
    {
        $response = $this->bot->call('getMe');
        return User::fromResponse($response);
    }

    public function setWebhook(string $url): CustomResponse
    {
        return $this->bot->call('setWebhook', ['url' => $url]);
    }

    public function deleteWebhook(bool $drop_pending_updates = true): CustomResponse
    {
        return $this->bot->call('deleteWebhook', ['drop_pending_updates' => $drop_pending_updates]);
    }

    public function getWebhookInfo(): TelegramObject
    {
        $response = $this->bot->call('getWebhookInfo');
        return WebhookInfo::fromResponse($response);
    }

    public function getUpdates(): UpdateArray
    {
        $response = $this->bot->call('getUpdates');
        return UpdateArray::fromResponse($response);
    }


    public function sendMessage(string $chat_id, string $text): CustomResponse
    {
        return $this->bot->call('sendMessage',[
            'chat_id' => $chat_id,
            'text' => $text,
        ]);
    }


    public function sendReply(string $text): CustomResponse
    {
        return $this->sendMessage($this->bot->chat_id, $text);
    }

    public static function callResponse(string $method, array $params = []):string
    {
        $tbot = new TelegramBot();

        $response = $tbot->commands->$method(...$params);
        $response = $response->toString();

        return $response;
    }

}
