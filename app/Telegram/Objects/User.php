<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#user
 */

use Telegram\Core\TelegramObject;

class User extends TelegramObject
{
    protected int $id;                                              # Unique identifier for this user or bot. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a 64-bit integer or double-precision float type are safe for storing this identifier.
    protected bool $is_bot;                                         # True, if this user is a bot
    protected string $first_name;                                   # User's or bot's first name
    protected string|null $last_name;                                    # Optional. User's or bot's last name
    protected string|null $username;                                     # Optional. User's or bot's username
    protected string|null $language_code;                                # Optional. IETF language tag of the user's language
    protected bool|null $is_premium;                                     # Optional. True, if this user is a Telegram Premium user
    protected bool|null $added_to_attachment_menu;                       # Optional. True, if this user added the bot to the attachment menu
    protected bool|null $can_join_groups;                                # Optional. True, if the bot can be invited to groups. Returned only in getMe.
    protected bool|null $can_read_all_group_messages;                    # Optional. True, if privacy mode is disabled for the bot. Returned only in getMe.
    protected bool|null $supports_inline_queries;                        # Optional. True, if the bot supports inline queries. Returned only in getMe.
}
