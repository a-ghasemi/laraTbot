<?php

namespace Telegram\Commands;

use Telegram\Customs\_Commands;
use Telegram\Objects\UpdateArray;

class UpdatesCommands extends _Commands
{
    public function getUpdates(): UpdateArray
    {
        $response = $this->bot->call('getUpdates');
        return UpdateArray::fromResponse($response);
    }
}
