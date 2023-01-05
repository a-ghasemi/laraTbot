<?php

namespace App\Telegram\Commands;

use Telegram\TelegramBot;

abstract class ACommands
{
    protected TelegramBot $bot;

    public function __construct(TelegramBot $bot)
    {
        $this->bot = $bot;
    }
}
