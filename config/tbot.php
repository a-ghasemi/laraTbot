<?php
return [
    'telegram_api_path' => env('TBOT_API_PATH', 'https://api.telegram.org') . '/bot',
    'token'             => env('TBOT_TOKEN', ''),
    'username'          => env('TBOT_USERNAME', ''),
    'webhook'           => [
        'token' => env('TBOT_WEBHOOK_TOKEN', ''),
    ],
    'debug'             => [
        'log' => [
            'request'  => env('TBOT_LOG_REQUEST', false),
            'webhook'  => env('TBOT_LOG_WEBHOOK', false),
        ],
        'url'      => env('TBOT_DEBUG_URL', false),
        'token'    => env('TBOT_WEBHOOK_TOKEN_DEBUG', ''),
    ],
];
