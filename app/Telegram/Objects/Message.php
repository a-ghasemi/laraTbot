<?php

namespace Telegram\Objects;

class Message
{
    protected int $message_id;                      # Unique message identifier inside this chat
    protected int $message_thread_id;               # Optional. Unique identifier of a message thread to which the message belongs; for supergroups only
    protected User $from;                               # Optional. Sender of the message; empty for messages sent to channels. For backward compatibility, the field contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
    protected Chat $sender_chat;                        # Optional. Sender of the message, sent on behalf of a chat. For example, the channel itself for channel posts, the supergroup itself for messages from anonymous group administrators, the linked channel for messages automatically forwarded to the discussion group. For backward compatibility, the field from contains a fake sender user in non-channel chats, if the message was sent on behalf of a chat.
    protected int $date;                            # Date the message was sent in Unix time
    protected Chat $chat;                               # Conversation the message belongs to
    protected User $forward_from;                       # Optional. For forwarded messages, sender of the original message
    protected Chat $forward_from_chat;                  # Optional. For messages forwarded from channels or from anonymous administrators, information about the original sender chat
    protected int $forward_from_message_id;         # Optional. For messages forwarded from channels, identifier of the original message in the channel
    protected string $forward_signature;                # Optional. For forwarded messages that were originally sent in channels or by an anonymous chat administrator, signature of the message sender if present
    protected string $forward_sender_name;              # Optional. Sender's name for messages forwarded from users who disallow adding a link to their account in forwarded messages
    protected int $forward_date;                    # Optional. For forwarded messages, date the original message was sent in Unix time
    protected bool $is_topic_message;                   # Optional. True, if the message is sent to a forum topic
    protected bool $is_automatic_forward;               # Optional. True, if the message is a channel post that was automatically forwarded to the connected discussion group
    protected self $reply_to_message;                # Optional. For replies, the original message. Note that the Message object in this field will not contain further reply_to_message fields even if it itself is a reply.
    protected User $via_bot;                            # Optional. Bot through which the message was sent
    protected int $edit_date;                       # Optional. Date the message was last edited in Unix time
    protected bool $has_protected_content;              # Optional. True, if the message can't be forwarded
    protected string $media_group_id;                   # Optional. The unique identifier of a media message group this message belongs to
    protected string $author_signature;                 # Optional. Signature of the post author for messages in channels, or the custom title of an anonymous group administrator
    protected string $text;        # Optional. For text messages, the actual UTF-8 text of the message
    protected array $entities;     # of MessageEntity	Optional. For text messages, special entities like usernames, URLs, bot commands, etc. that appear in the text
    protected Animation $animation;        # Optional. Message is an animation, information about the animation. For backward compatibility, when this field is set, the document field will also be set
    protected Audio $audio;        # Optional. Message is an audio file, information about the file
    protected Document $document;        # Optional. Message is a general file, information about the file
    protected array $photo;     # of PhotoSize	Optional. Message is a photo, available sizes of the photo
    protected Sticker $sticker;        # Optional. Message is a sticker, information about the sticker
    protected Video $video;        # Optional. Message is a video, information about the video
    protected VideoNote $video_note;        # Optional. Message is a video note, information about the video message
    protected Voice $voice;        # Optional. Message is a voice message, information about the file
    protected string $caption;        # Optional. Caption for the animation, audio, document, photo, video or voice
    protected array $caption_entities;     # of MessageEntity	Optional. For messages with a caption, special entities like usernames, URLs, bot commands, etc. that appear in the caption
    protected Contact $contact;        # Optional. Message is a shared contact, information about the contact
    protected Dice $dice;        # Optional. Message is a dice with random value
    protected Game $game;        # Optional. Message is a game, information about the game. More about games »
    protected Poll $poll;        # Optional. Message is a native poll, information about the poll
    protected Venue $venue;        # Optional. Message is a venue, information about the venue. For backward compatibility, when this field is set, the location field will also be set
    protected Location $location;        # Optional. Message is a shared location, information about the location
    protected array $new_chat_members;     # of User	Optional. New members that were added to the group or supergroup and information about them (the bot itself may be one of these members)
    protected User $left_chat_member;        # Optional. A member was removed from the group, information about them (this member may be the bot itself)
    protected string $new_chat_title;        # Optional. A chat title was changed to this value
    protected array $new_chat_photo;     # of PhotoSize	Optional. A chat photo was change to this value
    protected bool $delete_chat_photo;        # Optional. Service message: the chat photo was deleted
    protected bool $group_chat_created;        # Optional. Service message: the group has been created
    protected bool $supergroup_chat_created;        # Optional. Service message: the supergroup has been created. This field can't be received in a message coming through updates, because bot can't be a member of a supergroup when it is created. It can only be found in reply_to_message if someone replies to a very first message in a directly created supergroup.
    protected bool $channel_chat_created;        # Optional. Service message: the channel has been created. This field can't be received in a message coming through updates, because bot can't be a member of a channel when it is created. It can only be found in reply_to_message if someone replies to a very first message in a channel.
    protected MessageAutoDeleteTimerChanged $message_auto_delete_timer_changed;        # Optional. Service message: auto-delete timer settings changed in the chat
    protected int $migrate_to_chat_id;        # Optional. The group has been migrated to a supergroup with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit int or double-precision float type are safe for storing this identifier.
    protected int $migrate_from_chat_id;        # Optional. The supergroup has been migrated from a group with the specified identifier. This number may have more than 32 significant bits and some programming languages may have difficulty/silent defects in interpreting it. But it has at most 52 significant bits, so a signed 64-bit int or double-precision float type are safe for storing this identifier.
    protected self $pinned_message;        # Optional. Specified message was pinned. Note that the Message object in this field will not contain further reply_to_message fields even if it is itself a reply.
    protected Invoice $invoice;        # Optional. Message is an invoice for a payment, information about the invoice. More about payments »
    protected SuccessfulPayment $successful_payment;        # Optional. Message is a service message about a successful payment, information about the payment. More about payments »
    protected string $connected_website;        # Optional. The domain name of the website on which the user has logged in. More about Telegram Login »
    protected PassportData $passport_data;        # Optional. Telegram Passport data
    protected ProximityAlertTriggered $proximity_alert_triggered;        # Optional. Service message. A user in the chat triggered another user's proximity alert while sharing Live Location.
    protected ForumTopicCreated $forum_topic_created;        # Optional. Service message: forum topic created
    protected ForumTopicClosed $forum_topic_closed;        # Optional. Service message: forum topic closed
    protected ForumTopicReopened $forum_topic_reopened;        # Optional. Service message: forum topic reopened
    protected VideoChatScheduled $video_chat_scheduled;        # Optional. Service message: video chat scheduled
    protected VideoChatStarted $video_chat_started;        # Optional. Service message: video chat started
    protected VideoChatEnded $video_chat_ended;        # Optional. Service message: video chat ended
    protected VideoChatParticipantsInvited $video_chat_participants_invited;        # Optional. Service message: new participants invited to a video chat
    protected WebAppData $web_app_data;        # Optional. Service message: data sent by a Web App
    protected InlineKeyboardMarkup $reply_markup;        # Optional. Inline keyboard attached to the message. login_url buttons are represented as ordinary url buttons.
}
