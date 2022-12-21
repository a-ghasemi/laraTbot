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
        $this->ok = (($data['ok'] ?? 'false') == 'true');

        if($this->status == 200){ // success request to telegram
            if(!$this->ok){ // telegram error feedback
                $this->description = $data['description'];
                $this->error_code = $data['error_code'];
            }
        }
        else
        {
            dd($data,$this->headers);
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
        $return[] = $this->centerString(str_repeat('-',20), $maxlen);

        try{
            foreach ($properties as $property) {
                $return[] = sprintf("%{$maxlen}s: %s", $property, $this->$property);
            }
        }
        catch (\Exception $e){
            dd($e->getMessage(), $return, $property, $this->$property);
        }

        return implode("\n", $return);
    }

    private function centerString(string $str, int $len): string
    {
        return str_repeat(' ', max(0, $len - intdiv(strlen($str), 2))) . $str;
    }

}
