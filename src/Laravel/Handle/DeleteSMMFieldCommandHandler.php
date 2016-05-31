<?php namespace Interpro\SMM\Laravel\Handle;

use Interpro\SMM\Concept\Command\DeleteSMMFieldCommand;
use Interpro\SMM\Laravel\Model\Smmfield;

class DeleteSMMFieldCommandHandler {

    /**
     * @param  DeleteSMMFieldCommand  $command
     *
     * @return void
     */
    public function handle(DeleteSMMFieldCommand $command)
    {
        $collection = Smmfield::where('entity_name', $command->entity_name)->
                                where('entity_id', $command->entity_id)->
                                where('name', $command->field_name)->get();

        foreach($collection as $field){
            $field->delete();
        }
    }

}
