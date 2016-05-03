<?php

namespace Interpro\SMM\Concept;

interface SMMRepository
{
    /**
     * @param string $entity_name
     *
     * @param string $field_name
     *
     * @param int $entity_id
     *
     * @return string
     */
    public function getFieldValue($entity_name, $field_name, $entity_id);
}
