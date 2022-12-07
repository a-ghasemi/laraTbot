<?php

namespace Telegram\Objects;

class ChosenInlineResult
{
    protected string $result_id;            # The unique identifier for the result that was chosen
    protected User $from;                   # The user that chose the result
    protected Location $location;           # Optional. Sender location, only for bots that require user location
    protected string $inline_message_id;    # Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the message. Will be also received in callback queries and can be used to edit the message.
    protected string $query;                # The query that was used to obtain the result
}
