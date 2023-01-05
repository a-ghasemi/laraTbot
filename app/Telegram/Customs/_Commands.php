<?php

namespace App\Telegram\Commands;

use Telegram\TelegramBot;

abstract class Commands
{
    protected TelegramBot $bot;

    public function __construct(TelegramBot $bot)
    {
        $this->bot = $bot;
    }
}
