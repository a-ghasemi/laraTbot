<?php
return [
    'telegram_api_path'   => env('TBOT_API_PATH', 'https://api.telegram.org') . '/bot',
    'token'               => env('TBOT_TOKEN', ''),
    'username'            => env('TBOT_USERNAME', ''),
    'webhook_check_token' => [
        'main' => env('TBOT_WEBHOOK_TOKEN', ''),
        'debug' => env('TBOT_WEBHOOK_TOKEN_DEBUG', ''),
    ],
    'debug'               => [
        'url_call' => env('TBOT_DEBUG_URL', false),
    ],
];
