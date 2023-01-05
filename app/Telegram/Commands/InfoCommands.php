<?php

namespace Telegram\Commands;

use Telegram\Customs\_Commands;
use Telegram\Core\TelegramObject;
use Telegram\Objects\User;

class InfoCommands extends _Commands
{
    public function getMe(): TelegramObject
    {
        $response = $this->bot->call('getMe');
        return User::fromResponse($response);
    }
}
