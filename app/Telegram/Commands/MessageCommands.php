<?php

namespace Telegram\Commands;

use Telegram\Customs\_Commands;
use Telegram\Customs\CustomResponse;

class MessageCommands extends _Commands
{
    public function sendMessage(string $chat_id, string $text): CustomResponse
    {
        return $this->bot->call('sendMessage',[
            'chat_id' => $chat_id,
            'text' => $text,
        ]);
    }

    public function sendReply(string $text): CustomResponse
    {
        return $this->sendMessage($this->bot->chat_id, $text);
    }
}
