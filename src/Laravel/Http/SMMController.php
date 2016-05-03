<?php

namespace Interpro\SMM\Laravel\Http;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use Interpro\QuickStorage\Concept\Command\SaveGlobalSMMCommand;

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

}
