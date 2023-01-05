<?php

namespace Telegram\Customs;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Telegram\TelegramBot;

abstract class _Handler
{
    protected TelegramBot $bot;
    protected Request $request;
    protected Response $response;

    public function __construct(TelegramBot $bot, Request $request)
    {
        $this->bot = $bot;
        $this->request = $request;
    }

    abstract public function run(): static;

    public function getResponse(): Response
    {
        return $this->response;
    }
}
