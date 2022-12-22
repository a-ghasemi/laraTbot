<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#location
 */

use Telegram\Core\TelegramObject;

class Location extends TelegramObject
{
    protected float $longitude;                         # Longitude as defined by sender
    protected float $latitude;                          # Latitude as defined by sender
    protected float $horizontal_accuracy;               # Optional. The radius of uncertainty for the location, measured in meters; 0-1500
    protected int $live_period;                         # Optional. Time relative to the message sending date, during which the location can be updated; in seconds. For active live locations only.
    protected int $heading;                             # Optional. The direction in which user is moving, in degrees; 1-360. For active live locations only.
    protected int $proximity_alert_radius;              # Optional. The maximum distance for proximity alerts about approaching another chat member, in meters. For sent live locations only.
}
