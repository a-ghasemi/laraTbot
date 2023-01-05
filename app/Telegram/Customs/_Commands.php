<?php

namespace Telegram\Customs;

use Telegram\TelegramBot;

abstract class _Commands
{
    protected TelegramBot $bot;

    public function __construct(TelegramBot $bot)
    {
        $this->bot = $bot;
    }
}
