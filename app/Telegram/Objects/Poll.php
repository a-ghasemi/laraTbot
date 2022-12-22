<?php

namespace Telegram\Objects;

/*
 * based on: https://core.telegram.org/bots/api#poll
 */

use Telegram\Core\TelegramObject;

class Poll extends TelegramObject
{
    protected string $id;                   # Unique poll identifier
    protected string $question;                 # Poll question, 1-300 characters
    protected array $options;                   # of PollOption	List of poll options
    protected int $total_voter_count;                   # Total number of users that voted in the poll
    protected bool $is_closed;                   # True, if the poll is closed
    protected bool $is_anonymous;                    # True, if the poll is anonymous
    protected string $type;                 # Poll type, currently can be “regular” or “quiz”
    protected bool $allows_multiple_answers;                 # True, if the poll allows multiple answers
    protected int $correct_option_id;                   # Optional. 0-based identifier of the correct answer option. Available only for polls in the quiz mode, which are closed, or was sent (not forwarded) by the bot or to the private chat with the bot.
    protected string $explanation;                  # Optional. Text that is shown when a user chooses an incorrect answer or taps on the lamp icon in a quiz-style poll, 0-200 characters
    protected array $explanation_entities;                  # of MessageEntity	Optional. Special entities like usernames, URLs, bot commands, etc. that appear in the explanation
    protected int $open_period;                 # Optional. Amount of time in seconds the poll will be active after creation
    protected int $close_date;                  # Optional. Point in time (Unix timestamp) when the poll will be automatically closed
}












