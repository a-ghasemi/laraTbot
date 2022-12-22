<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#chatjoinrequest
 */

use Telegram\Core\TelegramObject;

class ChatJoinRequest extends TelegramObject
{
    protected Chat $chat;                               # Chat to which the request was sent
    protected User $from;                               # User that sent the join request
    protected int $date;                                # Date the request was sent in Unix time
    protected string $bio;                              # Optional. Bio of the user.
    protected ChatInviteLink $invite_link;              # Optional. Chat invite link that was used by the user to send the join request
}
