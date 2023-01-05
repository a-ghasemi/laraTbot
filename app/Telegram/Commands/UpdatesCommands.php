<?php

namespace Telegram\Commands;

use App\Telegram\Commands\ACommands;
use Telegram\Objects\UpdateArray;

class UpdatesCommands extends ACommands
{
    public function getUpdates(): UpdateArray
    {
        $response = $this->bot->call('getUpdates');
        return UpdateArray::fromResponse($response);
    }
}
