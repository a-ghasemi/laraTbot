<?php

namespace App\Console\Commands\TBot;

use Illuminate\Console\Command;

class CallBotCommand extends _TBotCommand
{
    protected $signature = 'tbot:call {method*}';
    protected $description = 'calls bot methods';

    public function handle(): int
    {
        $this->fetchBot();

        $params = (array) ($this->argument('method'));
        $method = array_shift($params);

        $response = $this->tbot->$method(...$params);

        $this->comment($response->toString());

        return Command::SUCCESS;
    }
}
