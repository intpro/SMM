<?php

namespace Interpro\SMM\Laravel\Item;

use Interpro\SMM\Concept\Item\SMMFieldItem as SMMFieldItemInterface;

class SMMFieldItem implements SMMFieldItemInterface
{
    private $name;
    private $value;

    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    public function __get($req_name)
    {
        if($req_name === 'name'){

            return $this->name;

        }elseif($req_name === 'value'){

            return $this->value;

        }else{

            return 'В поле SMM значения по идентификатору '.$req_name.' не найдено!';
        }
    }
}