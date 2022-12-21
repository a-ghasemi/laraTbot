<?php

namespace App\Console\Commands;

use App\Events\PusherPingTest;
use Illuminate\Console\Command;

class TestPusher extends Command
{
    protected $signature = 'pusher:ping';
    protected $description = 'pings pusher';

    public function handle(): int
    {
        $this->comment('Sending PING to pusher');

        PusherPingTest::dispatch();

        return Command::SUCCESS;
    }
}
