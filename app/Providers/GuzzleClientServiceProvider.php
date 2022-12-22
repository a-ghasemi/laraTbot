<?php

namespace App\Providers;

use App\Events\ServerSentTelegramRequest;
use Illuminate\Support\ServiceProvider;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class GuzzleClientServiceProvider extends ServiceProvider
{
    private $logger;

    public function register()
    {
        //
    }

    public function boot()
    {
        // Bind GuzzleClient
        $this->app->bind('GuzzleClient', function () {
            $messageFormats = [
                '== REQUEST ==',
                'METHOD: {method}',
                'URL: {uri}',
                'HTTP/{version}',
                'HEADERS: {req_headers}',
                'PAYLOAD: {req_body}',
                '== RESPONSE ==',
                'STATUS: {code}',
                'BODY: {res_body}',
                '=============',
            ];

            $stack = $this->setLoggingHandler($messageFormats);

            return function ($config) use ($stack) {
                return new Client(array_merge($config, ['handler' => $stack]));
            };
        });
    }

    private function get_logger()
    {
        if (!$this->logger) {
            $this->logger = with(new Logger('guzzle-log'))->pushHandler(
                new RotatingFileHandler(storage_path('logs/guzzle-log.log'))
            );
        }

        return $this->logger;
    }

    private function setGuzzleMiddleware(string $messageFormat)
    {
        return Middleware::log(
            $this->get_logger(),
            new MessageFormatter($messageFormat)
        );
    }

    private function setLoggingHandler(array $messageFormats)
    {
        $stack = HandlerStack::create();

        collect($messageFormats)->each(function ($messageFormat) use ($stack) {
            // We'll use unshift instead of push, to add the middleware to the bottom of the stack, not the top
            $stack->unshift(
                $this->setGuzzleMiddleware($messageFormat)
            );
        });

        return $stack;
    }
}
