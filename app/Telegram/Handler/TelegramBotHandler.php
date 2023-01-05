<?php
namespace Telegram\Handler;

use Telegram\Customs\_Handler;

class TelegramBotHandler extends _Handler
{
    public function run(): void
    {
        $this->bot->commands->sendReply('Hello dear starter!');
        $this->response = response('done',200);
    }
}
