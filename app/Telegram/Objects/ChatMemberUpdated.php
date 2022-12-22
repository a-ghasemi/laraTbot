<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#chatmemberupdated
 */

use Telegram\Core\TelegramObject;

class ChatMemberUpdated extends TelegramObject
{
    protected Chat $chat;                           # Chat the user belongs to
    protected User $from;                           # Performer of the action, which resulted in the change
    protected int $date;                            # Date the change was done in Unix time
    protected ChatMember $old_chat_member;          # Previous information about the chat member
    protected ChatMember $new_chat_member;          # New information about the chat member
    protected ChatInviteLink $invite_link;          # Optional. Chat invite link, which was used by the user to join the chat; for joining by invite link events only.
}
