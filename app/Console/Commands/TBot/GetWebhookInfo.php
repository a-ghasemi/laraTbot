<?php

namespace App\Console\Commands\TBot;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class GetWebhookInfo extends Command
{
    protected $signature = 'tbot:webhook:get_info';
    protected $description = 'get webhook info';

    public function handle(): int
    {
        Artisan::call("tbot:call getWebhookInfo");

        return Command::SUCCESS;
    }
}
