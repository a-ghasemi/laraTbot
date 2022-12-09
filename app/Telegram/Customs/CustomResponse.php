<?php

namespace Telegram\Customs;

use \Illuminate\Http\Client\Response;

class CustomResponse
{
    protected int $status;
    protected array $headers;
    protected bool $ok;
    protected array $result;

    public function __construct(Response $response)
    {
        $data = json_decode($response->body(), true);

        $this->status = $response->status();
        $this->headers = $response->headers();
        $this->ok = ($data['ok'] == 'true');
        $this->result = $data['result'];
    }

    public function get(string $field)
    {
        return $this->result[$field] ?? null;
    }

    public function getResultArr()
    {
        return $this->result;
    }

}
