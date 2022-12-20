<?php

namespace Telegram\Customs;

use \Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class CustomResponse
{
    protected int $status;
    protected array $headers;
    protected bool $ok;
    protected array $result;

    # telegram error
    protected string $description;
    protected int $error_code;

    public function __construct(Response $response)
    {
        $data = $response->json(true);

        Log::info('response',$data ?? []);
        $this->status = $response->status();
        $this->headers = $response->headers();
        $this->ok = ($data['ok'] == 'true');

        if($this->status == 200){ // success request to telegram
            if(!$this->ok){ // telegram error feedback
                $this->description = $data['description'];
                $this->error_code = $data['error_code'];
            }

        }
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
