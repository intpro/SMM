<?php namespace Interpro\QuickStorage\Concept\Command;

class SaveGlobalSMMCommand extends Command {

    public $name;
    public $value;

    /**
     * @param string $name
     *
     * @param string $value
     *
     * @return void
     */
    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

}
