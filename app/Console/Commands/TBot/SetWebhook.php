<?php

namespace App\Console\Commands\TBot;

use Illuminate\Console\Command;

class SetWebhook extends Command
{
    protected $signature = 'tbot:webhook:set';
    protected $description = 'set webhook';

    public function handle(): int
    {
        $this->comment('Token: '.config('tbot.webhook.token'));

        $url = route('v1.tbot.webhook', [
            'token' => config('tbot.webhook.token'),
        ]);
        $this->comment('Webhook URL: ' . $url);

        $this->call("tbot:call", ['method' => ["setWebhook", "$url"] ]);

        return Command::SUCCESS;
    }
}
