<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#pollanswer
 */

use Telegram\Core\TelegramObject;

class PollAnswer extends TelegramObject
{
    protected string $poll_id;          # Unique poll identifier
    protected User $user;               # The user, who changed the answer to the poll
    protected array $option_ids;        # 0-based identifiers of answer options, chosen by the user. May be empty if the user retracted their vote.
}
