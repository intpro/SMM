<?php

namespace Interpro\SMM\Laravel\Collection;

use Interpro\SMM\Concept\Collection\SMMFieldsCollectionFactory as SMMFieldsCollectionFactoryInterface;

class SMMFieldsCollectionFactory implements SMMFieldsCollectionFactoryInterface
{
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
        return new SMMFieldsCollection($entity_name, $entity_id, $fields_arr);
    }
}
