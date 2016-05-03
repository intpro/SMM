<?php

namespace Interpro\SMM\Laravel\FieldProviding;

use Illuminate\Support\Facades\App;
use Interpro\QuickStorage\Concept\FieldProviding\FieldExtractor as FieldExtractorInterface;
use Interpro\SMM\Concept\SMMRepository;

class SMMFieldExtractor implements FieldExtractorInterface
{
    private $repository;

    public function __construct()
    {
        $this->repository = App::make('Interpro\SMM\Laravel\SMMRepository');
    }

    /**
     * @param string $entity_name
     *
     * @param string $field_name
     *
     * @param int $entity_id
     *
     * @return string
     */
    public function getField($entity_name, $field_name, $entity_id=0)
    {
        return $this->repository->getFieldValue($entity_name, $field_name, $entity_id);
    }

}
