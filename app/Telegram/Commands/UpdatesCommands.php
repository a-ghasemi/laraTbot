<?php

namespace Telegram\Commands;

use App\Telegram\Commands\Commands;
use Telegram\Objects\UpdateArray;

class UpdatesCommands extends Commands
{
    public function getUpdates(): UpdateArray
    {
        $response = $this->bot->call('getUpdates');
        return UpdateArray::fromResponse($response);
    }
}
