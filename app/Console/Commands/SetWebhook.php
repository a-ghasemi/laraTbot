<?php

namespace App\Console\Commands;

use App\Events\PusherPingTest;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class SetWebhook extends Command
{
    protected $signature = 'tbot:set_webhook';
    protected $description = 'set webhook';

    public function handle(): int
    {
        $this->comment('Token: '.config('tbot.webhook.token'));

        $url = route('v1.tbot.webhook', [
            'token' => config('tbot.webhook.token'),
        ]);
        $this->comment('Webhook URL: ' . $url);

        Artisan::call("tbot:call setWebhook {$url}");

        return Command::SUCCESS;
    }
}
