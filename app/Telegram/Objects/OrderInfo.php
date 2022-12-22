<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#orderinfo
 */

use Telegram\Core\TelegramObject;

class OrderInfo extends TelegramObject
{
    protected string $name;                             # Optional. User name
    protected string $phone_number;                     # Optional. User's phone number
    protected string $email;                            # Optional. User email
    protected ShippingAddress $shipping_address;        # Optional. User shipping address
}
