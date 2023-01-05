<?php

namespace App\Telegram\Core;

use Illuminate\Support\Str;
use Telegram\Commands\InfoCommands;
use Telegram\Commands\MessageCommands;
use Telegram\Commands\UpdatesCommands;
use Telegram\Commands\WebhookCommands;

use Telegram\TelegramBot;

class Command
{
    private TelegramBot $bot;

    private array $commandClasses = [
        InfoCommands::class,
        UpdatesCommands::class,
        WebhookCommands::class,
        MessageCommands::class,
    ];
    private array $commands;

    public function __construct(TelegramBot $bot)
    {
        $this->bot = $bot;

        foreach($this->commandClasses as $class){
            $this->commands[$class] = get_class_methods($class);
        }
    }

    public function __call(string $name, array $arguments)
    {
        foreach ($this->commands as $class => $commands){
            if(in_array($name, $commands)){
                return (new $class($this->bot))->$name(...$arguments);
            }
        }
    }

    public static function callResponse(string $method, array $params = []):string
    {
        $tbot = new TelegramBot();

        $response = $tbot->$method(...$params);
        if(empty($response)) {
            throw new \Exception("Err: Method \"{$method}\" not found!");
        }
        $response = $response->toString();

        return $response;
    }

}
