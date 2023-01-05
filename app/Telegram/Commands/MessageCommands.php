<?php

namespace Telegram\Commands;

use App\Telegram\Commands\ACommands;
use Telegram\Customs\CustomResponse;

class MessageCommands extends ACommands
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
