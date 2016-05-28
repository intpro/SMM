<?php

namespace Interpro\SMM\Concept\Collection;

interface SMMFieldsCollectionFactory
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
    public function create($entity_name, $entity_id, $fields_arr);
}
