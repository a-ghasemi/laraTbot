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
            $obj->$property = $response->get($property, self::getPropertyType(static::class, $property));
        }

        return $obj;
    }

    static private function getPropertyType($class_name, $property_name): string
    {
        $rp = new \ReflectionProperty($class_name, $property_name);
        return $rp->getType()->getName();
    }

    /*
     * Creates Array of Object from Telegram response
     * e.g. response of getUpdates
     * TODO: should be checked and maybe removed
     */
    static public function fromArray(array $response): self
    {
        $class_name = static::class;

        $obj = new $class_name();
        foreach (get_class_vars(static::class) as $property => $value) {

            $data = null;
            if ($obj->$property instanceof TelegramObject) {
                $class = gettype($obj->$property);
                $data = $class::fromResponse($response);
            } else {
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
        $return[] = $this->centerString(str_repeat('-', 20), $maxlen);

        foreach ($properties as $property) {
            $return[] = sprintf("%{$maxlen}s: %s", $property, $this->getPropertyValue($property));
        }
        return implode("\n", $return);
    }

    private function getPropertyValue(string $property): string
    {
        switch (self::getPropertyType(static::class, $property)) {
            case 'bool':
                $out = $this->$property ? 'true' : 'false';
                break;
            case 'string':
                $out = $this->$property !== '' ? $this->$property : '<empty>';
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
                    $out[] = $this->getPropertyValue($item);
                }
                $out = $out? implode('|', $out): '[]';
                break;

            default:
                $out = $this->$property->toString();

        }

        return $out;
    }

    /*
     * Uses to prettify string view
     */
    private function centerString(string $str, int $len): string
    {
        return str_repeat(' ', max(0, $len - intdiv(strlen($str), 2))) . $str;
    }

}
