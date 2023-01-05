<?php

namespace Telegram\Customs;

use App\Events\ServerCommunicatedWithTelegram;
use \Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\throwException;

class CustomResponse
{
    protected int $status;
    protected array $headers;
    protected bool $ok;
    protected array|bool|null $result;
    protected string|null $description;

    # telegram error
    protected int|null $error_code;

    public function __construct(Response $response)
    {
        $data = $response->json();

        if(config('tbot.debug.log.response')){
            Log::info('response', $data ?? []);
            ServerCommunicatedWithTelegram::dispatch('::RESPONSE::', $data ?? []);
        }

        $this->status = $response->status();
        $this->headers = $response->headers();
        $this->ok = (($data['ok'] ?? 'false') == 'true');
        $this->description = isset($data) && isset($data['description']) ? $data['description'] : null;

        if ($this->status == 200) { // success request to telegram
            if (!$this->ok) { // telegram error feedback
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

    public function toString(array $skips = ['headers']): string
    {
        $return = [];

        $properties = array_keys(get_class_vars(static::class));
        $maxlen = max(array_map('strlen', $properties));

        $classname = last(explode('\\', static::class));
        $return[] = $this->centerString($classname, $maxlen);
        $return[] = $this->centerString(str_repeat('-', 20), $maxlen);

        try {
            foreach ($properties as $property) {
                if(in_array($property, $skips))continue;
                $value = $this->getPropertyValue($property);
                if($value == '<empty>')continue;
                $return[] = sprintf("%{$maxlen}s: %s", $property, $value);
            }
        } catch (\Exception $e) {
            dd($e->getMessage(), $return, $property, $this->$property);
        }

        return implode("\n", $return);
    }

    private function getPropertyType($class_name, $property_name): string
    {
        $rp = new \ReflectionProperty($class_name, $property_name);
        $type = $rp->getType();

        if(in_array('getName',get_class_methods(get_class($type)))){
            return $type->getName();
        }

        return gettype($this->$property_name);
    }

    private function getPropertyValue(string $property): string
    {
        $out = '<empty>';

        if(!isset($this->$property)){
            return $out;
        }

        switch ($this->getPropertyType(static::class, $property)) {
            case 'bool':
            case 'boolean':
                $out = $this->$property ? 'true' : 'false';
                break;
            case 'string':
                $out = $this->$property !== '' ?
                    $this->$property : '<empty>';
                break;
            case 'int':
            case 'double':
            case 'float':
            case 'number':
                $out = doubleval($this->$property);
                break;
            case 'array':
                $out = [];
                foreach ($this->$property as $item) {
                    $out[] = var_export($item,true);
                }
                $out = $out? implode('|', $out): '[]';
                break;

            default:
                $out = $this->$property->toString();

        }

        return $out;
    }

    private function centerString(string $str, int $len): string
    {
        return str_repeat(' ', max(0, $len - intdiv(strlen($str), 2))) . $str;
    }

}
