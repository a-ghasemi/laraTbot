<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#update
 */

use Telegram\Core\TelegramObject;

class Update extends TelegramObject
{
    protected int|null $update_id;                                           # The update's unique identifier. Update identifiers start from a certain positive number and increase sequentially. This ID becomes especially handy if you're using webhooks, since it allows you to ignore repeated updates or to restore the correct update sequence, should they get out of order. If there are no new updates for at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
    protected Message|null $message;                                         # Optional. New incoming message of any kind - text, photo, sticker, etc.
    protected Message|null $edited_message;                                  # Optional. New version of a message that is known to the bot and was edited
    protected Message|null $channel_post;                                    # Optional. New incoming channel post of any kind - text, photo, sticker, etc.
    protected Message|null $edited_channel_post;                             # Optional. New version of a channel post that is known to the bot and was edited
    protected InlineQuery|null $inline_query;                                # Optional. New incoming inline query
    protected ChosenInlineResult|null $chosen_inline_result;                 # Optional. The result of an inline query that was chosen by a user and sent to their chat partner. Please see our documentation on the feedback collecting for details on how to enable these updates for your bot.
    protected CallbackQuery|null $callback_query;                            # Optional. New incoming callback query
    protected ShippingQuery|null $shipping_query;                            # Optional. New incoming shipping query. Only for invoices with flexible price
    protected PreCheckoutQuery|null $pre_checkout_query;                     # Optional. New incoming pre-checkout query. Contains full information about checkout
    protected Poll|null $poll;                                               # Optional. New poll state. Bots receive only updates about stopped polls and polls, which are sent by the bot
    protected PollAnswer|null $poll_answer;                                  # Optional. A user changed their answer in a non-anonymous poll. Bots receive new votes only in polls that were sent by the bot itself.
    protected ChatMemberUpdated|null $my_chat_member;                        # Optional. The bot's chat member status was updated in a chat. For private chats, this update is received only when the bot is blocked or unblocked by the user.
    protected ChatMemberUpdated|null $chat_member;                           # Optional. A chat member's status was updated in a chat. The bot must be an administrator in the chat and must explicitly specify “chat_member” in the list of allowed_updates to receive these updates.
    protected ChatJoinRequest|null $chat_join_request;                       # Optional. A request to join the chat has been sent. The bot must have the can_invite_users administrator right in the chat to receive these updates.
}
