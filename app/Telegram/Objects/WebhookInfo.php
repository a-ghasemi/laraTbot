<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#webhookinfo
 */

use Telegram\Core\TelegramObject;

class WebhookInfo extends TelegramObject
{
    protected string $url;                                  # Webhook URL, may be empty if webhook is not set up
    protected bool $has_custom_certificate;                 # True, if a custom certificate was provided for webhook certificate checks
    protected int $pending_update_count;                    # Number of updates awaiting delivery
    protected string $ip_address;                           # Optional. Currently used webhook IP address
    protected int $last_error_date;                         # Optional. Unix time for the most recent error that happened when trying to deliver an update via webhook
    protected string $last_error_message;                   # Optional. Error message in human-readable format for the most recent error that happened when trying to deliver an update via webhook
    protected int $last_synchronization_error_date;         # Optional. Unix time of the most recent error that happened when trying to synchronize available updates with Telegram datacenters
    protected int $max_connections;                         # Optional. The maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery
    protected array $allowed_updates;                       # of String	Optional. A list of update types the bot is subscribed to. Defaults to all update types except chat_member
}
