<?php

namespace Telegram\Customs;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Telegram\TelegramBot;

abstract class _Handler
{
    protected TelegramBot $bot;
    protected Request $request;
    private Response $response;

    public function __construct(TelegramBot $bot, Request $request)
    {
        $this->bot = $bot;
        $this->request = $request;
    }

    abstract public function run(): void;

    public function getResponse(): Response
    {
        return $this->response;
    }
}
