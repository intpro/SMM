<?php

namespace Interpro\SMM\Laravel\Http;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Interpro\SMM\Concept\Command\DeleteSMMFieldCommand;
use Interpro\SMM\Concept\Command\SaveGlobalSMMCommand;

class SMMController extends Controller
{

    public function updateGlobals()
    {
        if(Request::has('smm_globals'))
        {
            $smm_globals = Request::get('smm_globals');

            try {

                foreach($smm_globals as $global){
                    $this->dispatch(new SaveGlobalSMMCommand($global['name'], $global['value']));
                }

                return ['status' => 'OK'];

            } catch(\Exception $exception) {

                return ['status' => ('Что-то пошло не так. '.$exception->getMessage())];
            }
        } else {

            return ['status' => 'Не хватает параметров для сохранения (smm_globals).'];
        }
    }

    public function deleteField()
    {
        if(Request::has('smm_fields'))
        {
            $smm_fields = Request::get('smm_fields');

            try {

                foreach($smm_fields as $field){
                    $this->dispatch(new DeleteSMMFieldCommand($field['entity_name'], $field['entity_id'], $field['field_name']));
                }

                return ['status' => 'OK'];

            } catch(\Exception $exception) {

                return ['status' => ('Что-то пошло не так. '.$exception->getMessage())];
            }
        } else {

            return ['status' => 'Не хватает параметров для сохранения (smm_fields).'];
        }
    }

}
