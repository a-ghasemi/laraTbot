<?php

namespace Telegram\Core;

use Telegram\Customs\CustomResponse;
use Telegram\Objects\UpdateArray;

abstract class TelegramObject
{
    /*
     * Creates Object from Telegram response
     */
    static public function fromResponse(CustomResponse $response): self
    {
        $class_name = static::class;

        $obj = new $class_name();
        foreach (get_class_vars(static::class) as $property => $value) {
            $obj->$property = $response->get($property);
        }

        return $obj;
    }

    /*
     * Creates Array of Object from Telegram response
     * e.g. response of getUpdates
     */
    static public function fromArray(array $response): self
    {
        $class_name = static::class;

        $obj = new $class_name();
        foreach (get_class_vars(static::class) as $property => $value) {

            $data = null;
            if($obj->$property instanceof TelegramObject){
                $class = gettype($obj->$property);
                $data = $class::fromResponse($response);
            }
            else{
                $data = $response[$property];
            }
            $obj->$property = $data;
        }

        return $obj;
    }

    /*
     * Makes a pretty view of Object in the response of string request
     * e.g. in the logs
     */
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

    /*
     * Uses to prettify string view
     */
    private function centerString(string $str, int $len): string
    {
        return str_repeat(' ', max(0, $len - intdiv(strlen($str), 2))) . $str;
    }
}
