<?php

namespace App\Console\Commands\TBot;

use Illuminate\Console\Command;

class GetMe extends _TBotCommand
{
    protected $signature = 'tbot:getMe';
    protected $description = 'runs getme function';

    public function handle(): int
    {
        $this->fetchBot();

        $user = $this->tbot->getMe();
        $this->comment($user->toString());

        return Command::SUCCESS;
    }
}
