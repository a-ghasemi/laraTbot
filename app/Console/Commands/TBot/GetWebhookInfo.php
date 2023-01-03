<?php

namespace App\Console\Commands\TBot;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Telegram\Commands\Command as TelegramCommand;
use Telegram\TelegramBot;

class GetWebhookInfo extends Command
{
    protected $signature = 'tbot:webhook:get';
    protected $description = 'get webhook info';

    public function handle(): int
    {
        $this->call("tbot:call", ['method' => ["getWebhookInfo"] ]);

        return Command::SUCCESS;
    }
}
