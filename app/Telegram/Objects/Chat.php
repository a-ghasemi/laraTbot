<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#chat
 */

class Chat
{
    protected int $id;        # Unique identifier for this chat. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit int or double-precision float type are safe for storing this identifier.
    protected string $type;        # Type of chat, can be either “private”, “group”, “supergroup” or “channel”
    protected string $title;        # Optional. Title, for supergroups, channels and group chats
    protected string $username;        # Optional. Username, for private chats, supergroups and channels if available
    protected string $first_name;        # Optional. First name of the other party in a private chat
    protected string $last_name;        # Optional. Last name of the other party in a private chat
    protected bool $is_forum;        # Optional. True, if the supergroup chat is a forum (has topics enabled)
    protected ChatPhoto $photo;        # Optional. Chat photo. Returned only in getChat.
    protected array $active_usernames;     # string[]	Optional. If non-empty, the list of all active chat usernames; for private chats, supergroups and channels. Returned only in getChat.
    protected string $emoji_status_custom_emoji_id;        # Optional. Custom emoji identifier of emoji status of the other party in a private chat. Returned only in getChat.
    protected string $bio;        # Optional. Bio of the other party in a private chat. Returned only in getChat.
    protected bool $has_private_forwards;        # Optional. True, if privacy settings of the other party in the private chat allows to use tg://user?id=<user_id> links only in chats with the user. Returned only in getChat.
    protected bool $has_restricted_voice_and_video_messages;        # Optional. True, if the privacy settings of the other party restrict sending voice and video note messages in the private chat. Returned only in getChat.
    protected bool $join_to_send_messages;        # Optional. True, if users need to join the supergroup before they can send messages. Returned only in getChat.
    protected bool $join_by_request;        # Optional. True, if all users directly joining the supergroup need to be approved by supergroup administrators. Returned only in getChat.
    protected string $description;        # Optional. Description, for groups, supergroups and channel chats. Returned only in getChat.
    protected string $invite_link;        # Optional. Primary invite link, for groups, supergroups and channel chats. Returned only in getChat.
    protected Message $pinned_message;        # Optional. The most recent pinned message (by sending date). Returned only in getChat.
    protected ChatPermissions $permissions;        # Optional. Default chat member permissions, for groups and supergroups. Returned only in getChat.
    protected int $slow_mode_delay;        # Optional. For supergroups, the minimum allowed delay between consecutive messages sent by each unpriviledged user; in seconds. Returned only in getChat.
    protected int $message_auto_delete_time;        # Optional. The time after which all messages sent to the chat will be automatically deleted; in seconds. Returned only in getChat.
    protected bool $has_protected_content;        # Optional. True, if messages from the chat can't be forwarded to other chats. Returned only in getChat.
    protected string $sticker_set_name;        # Optional. For supergroups, name of group sticker set. Returned only in getChat.
    protected bool $can_set_sticker_set;        # Optional. True, if the bot can change the group sticker set. Returned only in getChat.
    protected int $linked_chat_id;        # Optional. Unique identifier for the linked chat, i.e. the discussion group identifier for a channel and vice versa; for supergroups and channel chats. This identifier may be greater than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit int or double-precision float type are safe for storing this identifier. Returned only in getChat.
    protected ChatLocation $location;        # Optional. For supergroups, the location to which the supergroup is connected. Returned only in getChat.
}
