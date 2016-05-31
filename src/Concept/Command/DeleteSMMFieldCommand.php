<?php namespace Interpro\SMM\Concept\Command;

class DeleteSMMFieldCommand {

    public $entity_name;
    public $entity_id;
    public $field_name;

    /**
     * @param string $entity_name
     *
     * @param string $entity_id
     *
     * @param string $field_name
     *
     * @return void
     */
    public function __construct($entity_name, $entity_id, $field_name)
    {
        $this->entity_name = $entity_name;
        $this->entity_id = $entity_id;
        $this->field_name = $field_name;
    }

}
