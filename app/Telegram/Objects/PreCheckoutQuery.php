<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#precheckoutquery
 */

use Telegram\Core\TelegramObject;

class PreCheckoutQuery extends TelegramObject
{
    protected string $id;                       # Unique query identifier
    protected User $from;                       # User who sent the query
    protected string $currency;                 # Three-letter ISO 4217 currency code
    protected int $total_amount;            # Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
    protected string $invoice_payload;          # Bot specified invoice payload
    protected string $shipping_option_id;       # Optional. Identifier of the shipping option chosen by the user
    protected OrderInfo $order_info;            # Optional. Order information provided by the user
}
