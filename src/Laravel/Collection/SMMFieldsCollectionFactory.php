<?php

namespace Interpro\SMM\Laravel\Collection;

use Interpro\SMM\Concept\Collection\SMMFieldsCollectionFactory as SMMFieldsCollectionFactoryInterface;

class SMMFieldsCollectionFactory implements SMMFieldsCollectionFactoryInterface
{
    private $fields;

    public function __construct(){
        $this->fields = config('smm.fields');
    }

    /**
     * @param string $entity_name
     *
     * @param int $entity_id
     *
     * @param array $fields_arr
     *
     * @return \Interpro\SMM\Concept\Collection\SMMFieldsCollection
     */
    public function create($entity_name, $entity_id, $fields_arr)
    {
        $items = [];

        foreach($fields_arr as $name => $value){
            $items[] = ['name' => $name, 'value' => $value, 'isempty' => false];
        }

        foreach($this->fields as $name => $templ){
            if(!array_key_exists($name, $fields_arr)){
                $items[] = ['name' => $name, 'value' => '', 'isempty' => true];
            }
        }

        return new SMMFieldsCollection($entity_name, $entity_id, $items);
    }
}
