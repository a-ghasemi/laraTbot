<?php

namespace Telegram\Customs;

use \Illuminate\Http\Client\Response;

class CustomResponse
{
    protected int $status;
    protected array $headers;
    protected \stdClass $body;

    public function __construct(Response $response)
    {
        $data = json_decode($response->body(), true);

        $this->status = $response->status();
        $this->headers = $response->headers();
        $this->ok = $data['ok'];
        $this->result = $data['result'];
    }

    public function get(string $field)
    {
        return $this->result[$field] ?? null;
    }

}
