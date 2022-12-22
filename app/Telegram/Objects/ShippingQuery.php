<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#shippingquery
 */

use Telegram\Core\TelegramObject;

class ShippingQuery extends TelegramObject
{
    protected string $id;                                   # Unique query identifier
    protected User $from;                                   # User who sent the query
    protected string $invoice_payload;                      # Bot specified invoice payload
    protected ShippingAddress $shipping_address;            # User specified shipping address
}
