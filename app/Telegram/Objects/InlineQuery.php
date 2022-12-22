<?php

namespace Telegram\Objects;

use Telegram\Core\TelegramObject;

class InlineQuery extends TelegramObject
{
    protected string $id;               # Unique identifier for this query
    protected User $from;               # Sender
    protected string $query;            # Text of the query (up to 256 characters)
    protected string $offset;           # Offset of the results to be returned, can be controlled by the bot
    protected string $chat_type;        # Optional. Type of the chat from which the inline query was sent. Can be either “sender” for a private chat with the inline query sender, “private”, “group”, “supergroup”, or “channel”. The chat type should be always known for requests sent from official clients and most third-party clients, unless the request was sent from a secret chat
    protected Location $location;       # Optional. Sender location, only for bots that request user location
}
