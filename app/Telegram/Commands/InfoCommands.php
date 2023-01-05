<?php

namespace Telegram\Commands;

use App\Telegram\Commands\Commands;
use Telegram\Core\TelegramObject;
use Telegram\Objects\User;

class InfoCommands extends Commands
{
    public function getMe(): TelegramObject
    {
        $response = $this->bot->call('getMe');
        return User::fromResponse($response);
    }
}
