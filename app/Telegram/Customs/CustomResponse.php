<?php

namespace Telegram\Customs;

use App\Events\ServerSentTelegramRequest;
use \Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

class CustomResponse
{
    protected int $status;
    protected array $headers;
    protected bool $ok;
    protected array|bool|null $result;

    # telegram error
    protected string|null $description;
    protected int|null $error_code;

    public function __construct(Response $response)
    {
        $data = $response->json();

        if(config('tbot.debug.log.response')){
            Log::info('response', $data ?? []);
            ServerSentTelegramRequest::dispatch('::RESPONSE::', $data ?? []);
        }

        $this->status = $response->status();
        $this->headers = $response->headers();
        $this->ok = (($data['ok'] ?? 'false') == 'true');

        if ($this->status == 200) { // success request to telegram
            if (!$this->ok) { // telegram error feedback
                $this->description = isset($data) && isset($data['description']) ? $data['description'] : null;
                $this->error_code = isset($data) && isset($data['error_code']) ? $data['error_code'] : null;
            } else {
                $this->result = $data['result'] ?: null;
            }
        } else {
            dd($data, $this->headers);
        }
    }

    public function get(string $field = null, string $type = 'string'): mixed
    {
        if(!is_array($this->result)) return $this->result;

        $out = $this->result[$field] ?? null;
        settype($out, $type);
        return $out;
    }

    public function getResultArr()
    {
        return $this->result;
    }

    public function toString(): string
    {
        $return = [];

//        $properties = array_keys(get_class_vars(static::class));
        $properties = [
            'status',
            'ok',
        ];
        $maxlen = max(array_map('strlen', $properties));

        $classname = last(explode('\\', static::class));
        $return[] = $this->centerString($classname, $maxlen);
        $return[] = $this->centerString(str_repeat('-', 20), $maxlen);

        try {
            foreach ($properties as $property) {
                $return[] = sprintf("%{$maxlen}s: %s", $property, $this->$property);
            }
        } catch (\Exception $e) {
            dd($e->getMessage(), $return, $property, $this->$property);
        }

        return implode("\n", $return);
    }

    private function centerString(string $str, int $len): string
    {
        return str_repeat(' ', max(0, $len - intdiv(strlen($str), 2))) . $str;
    }

}
