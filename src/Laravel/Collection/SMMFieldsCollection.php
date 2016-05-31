<?php

namespace Interpro\SMM\Laravel\Collection;

use Interpro\SMM\Concept\Collection\SMMFieldsCollection as SMMFieldsCollectionInterface;
use Interpro\SMM\Laravel\Item\SMMFieldItem;

class SMMFieldsCollection implements SMMFieldsCollectionInterface
{
    private $entity_name;
    private $entity_id;
    private $items = [];
    private $object_items = [];
    private $position = 0;

    public function __construct(
        $entity_name,
        $entity_id,
        $fields_arr
    ){
        $this->entity_name = $entity_name;
        $this->entity_id   = $entity_id;
        $this->position    = 0;
        $this->items       = $fields_arr;
    }

    private function createItem($position)
    {
        $pos_key = 'pos_'.$position;

        if(array_key_exists($pos_key, $this->object_items))
        {
            $item = $this->object_items[$pos_key];
        }else{

            $item = new SMMFieldItem(
                $this->items[$position]['name'],
                $this->items[$position]['value'],
                $this->items[$position]['isempty']);

            $this->object_items[$pos_key] = $item;
        }

        return $item;
    }

    function rewind()
    {
        $this->position = 0;
    }

    function current()
    {
        return $this->createItem($this->position);
    }

    function key()
    {
        return $this->position;
    }

    function next()
    {
        ++$this->position;
    }

    function valid()
    {
        return isset($this->items[$this->position]);
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }
}
