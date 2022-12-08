<?php

namespace Telegram\Core;

use Telegram\Customs\CustomResponse;

abstract class TelegramObject
{
    static public function fromResponse(CustomResponse $response): self
    {
        $class_name = static::class;

        $obj = new $class_name();
        foreach (get_class_vars(static::class) as $property => $value) {
            $obj->$property = $response->get($property);
        }

        return $obj;
    }

    public function toString(): string
    {
        $return = [];

        $properties = array_keys(get_class_vars(static::class));
        $maxlen = max(array_map('strlen', $properties));

        $classname = last(explode('\\', static::class));
        $return[] = $this->centerString($classname, $maxlen);
        $return[] = $this->centerString(str_repeat('-',20), $maxlen);

        foreach ($properties as $property) {
            $return[] = sprintf("%{$maxlen}s: %s", $property, $this->$property);
        }
        return implode("\n", $return);
    }

    private function centerString(string $str, int $len): string
    {
        return str_repeat(' ', max(0, $len - intdiv(strlen($str), 2))) . $str;
    }
}
