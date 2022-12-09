<?php

namespace Telegram\Customs;

use \Illuminate\Http\Client\Response;

class CustomResponseArr
{
    protected int $status;
    protected array $headers;
    protected bool $ok;
    protected array $results;

    public function __construct(Response $response)
    {
        $data = json_decode($response->body(), true);

        $this->status = $response->status();
        $this->headers = $response->headers();
        $this->ok = ($data['ok'] == 'true');
        $this->results = $data['result'];
    }

    public function getResultsArr()
    {
        return $this->results;
    }

}
