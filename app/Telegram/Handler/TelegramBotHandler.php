<?php
namespace Telegram\Handler;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Telegram\TelegramBot;

class TelegramBotHandler
{
    private TelegramBot $bot;
    private Request $request;
    private Response $response;

    public function __construct(TelegramBot $bot, Request $request)
    {
        $this->bot = $bot;
        $this->request = $request;
    }

    public function run(): void
    {
        $this->bot->commands->sendReply('Hello!');
        $this->response = response('done',200);
    }

    public function getResponse(): Response
    {
        return $this->response;
    }

}
