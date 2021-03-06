<?php namespace Interpro\SMM\Laravel\Handle;

use Interpro\SMM\Concept\Command\SaveGlobalSMMCommand;
use Interpro\SMM\Laravel\Model\Smmglobal;

class SaveGlobalsCommandHandler {

    /**
     * @param  SaveGlobalSMMCommand  $command
     *
     * @return void
     */
    public function handle(SaveGlobalSMMCommand $command)
    {
        $item = Smmglobal::firstOrNew(['name'=>$command->name]);
        $item->name = $command->name;
        $item->value = $command->value;
        $item->save();
    }

}
