<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#callbackquery
 */

use Telegram\Core\TelegramObject;

class CallbackQuery extends TelegramObject
{
    protected string $id;                       # Unique identifier for this query
    protected User $from;                       # Sender
    protected Message $message;                 # Optional. Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old
    protected string $inline_message_id;        # Optional. Identifier of the message sent via the bot in inline mode, that originated the query.
    protected string $chat_instance;            # Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games.
    protected string $data;                     # Optional. Data associated with the callback button. Be aware that the message originated the query can contain no callback buttons with this data.
    protected string $game_short_name;          # Optional. Short name of a Game to be returned, serves as the unique identifier for the game
}
