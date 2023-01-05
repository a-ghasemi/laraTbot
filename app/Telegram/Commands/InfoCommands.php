<?php

namespace Telegram\Commands;

use App\Telegram\Commands\ACommands;
use Telegram\Core\TelegramObject;
use Telegram\Objects\User;

class InfoCommands extends ACommands
{
    public function getMe(): TelegramObject
    {
        $response = $this->bot->call('getMe');
        return User::fromResponse($response);
    }
}
