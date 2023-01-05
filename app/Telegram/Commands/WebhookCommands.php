<?php

namespace Telegram\Commands;

use App\Telegram\Commands\Commands;
use Telegram\Core\TelegramObject;
use Telegram\Customs\CustomResponse;
use Telegram\Objects\WebhookInfo;

class WebhookCommands extends Commands
{
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
}
