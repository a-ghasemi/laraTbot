<?php
return [
    'telegram_api_path' => env('TBOT_API_PATH', 'https://api.telegram.org') . '/bot',
    'token'             => env('TBOT_TOKEN', ''),
    'username'          => env('TBOT_USERNAME', ''),
    'debug'             => [
        'url_call' => env('TBOT_DEBUG_URL', false),
    ],
];
