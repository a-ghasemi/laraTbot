<?php

namespace App\Console\Commands\TBot;

use Telegram\TelegramBot;
use Illuminate\Console\Command;

abstract class _TBotCommand extends Command
{
    protected $tbot;

    protected function fetchBot(): void
    {
        $this->tbot = new TelegramBot();
    }
}
