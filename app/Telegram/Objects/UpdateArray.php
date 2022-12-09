<?php

namespace Telegram\Objects;

use http\Exception\InvalidArgumentException;
use Telegram\Customs\CustomResponse;
use Telegram\Customs\CustomResponseArr;

class UpdateArray extends \ArrayObject
{
    public static function fromResponse(CustomResponse $response): self
    {
        $obj = new self;
        foreach($response->getResultArr() as $result){
            $obj->append(Update::fromArray($result));
        }
        return $obj;
    }

    public function toString()
    {
        $return = [];

        foreach($this as $item){
            dd($item);
            $return[] = $item->toString();
        }

        return implode("\n\n+++++++++++++++++++++++\n\n", $return);
    }
}
