<?php

namespace App\Console\Commands\TBot;

use Illuminate\Console\Command;

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
