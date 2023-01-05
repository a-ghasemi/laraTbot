<?php

namespace App\Console\Commands\TBot;

use App\Telegram\Core\Command as TelegramCommand;
use Illuminate\Console\Command;

class CallBotCommand extends Command
{
    protected $signature = 'tbot:call {method*}';
    protected $description = 'calls bot methods';

    public function handle(): int
    {
        $params = (array) ($this->argument('method'));
        $method = array_shift($params);

        $response = TelegramCommand::callResponse($method, $params);
        $this->comment($response);

        return Command::SUCCESS;
    }
}
