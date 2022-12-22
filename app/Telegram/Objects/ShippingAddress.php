<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#shippingaddress
 */

use Telegram\Core\TelegramObject;

class ShippingAddress extends TelegramObject
{
    protected string $country_code;                 # Two-letter ISO 3166-1 alpha-2 country code
    protected string $state;                        # State, if applicable
    protected string $city;                         # City
    protected string $street_line1;                 # First line for the address
    protected string $street_line2;                 # Second line for the address
    protected string $post_code;                    # Address post code
}
