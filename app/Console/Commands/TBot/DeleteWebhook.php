<?php

namespace App\Console\Commands\TBot;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class DeleteWebhook extends Command
{
    protected $signature = 'tbot:webhook:delete';
    protected $description = 'delete webhook';

    public function handle(): int
    {
        $this->comment('Token: '.config('tbot.webhook.token'));

        $url = route('v1.tbot.webhook', [
            'token' => config('tbot.webhook.token'),
        ]);
        $this->comment('Webhook URL: ' . $url);

        Artisan::call("tbot:call deleteWebhook");

        Artisan::call("tbot:call getWebhookInfo");

        return Command::SUCCESS;
    }
}
