<?php
namespace Telegram\Handler;

use Telegram\Customs\_Handler;

class TelegramBotHandler extends _Handler
{
    public function run(): static
    {
        $this->bot->sendReply('Hello dear starter!');
        $this->response = response('done',200);
        return $this;
    }
}
