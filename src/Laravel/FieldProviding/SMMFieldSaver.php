<?php

namespace Interpro\SMM\Laravel\FieldProviding;

use Interpro\QuickStorage\Concept\FieldProviding\FieldSaver as FieldSaverInterface;
use Interpro\SMM\Concept\Exception\SMMException;
use Interpro\SMM\Laravel\Model\Smmfield;

class SMMFieldSaver implements FieldSaverInterface
{
    /**
     * @param array $smm_save_array
     * @return void
     */
    public function save($smm_save_array)
    {
        $fields_config = config('smm.fields');
        $globals_config = config('smm.globals');

        if(!$fields_config){
            throw new SMMException('Отсутствует настройка полей (fields) в SMM');
        }

        if(!$globals_config){
            throw new SMMException('Отсутствует настройка общих полей (globals) в SMM');
        }

        foreach($smm_save_array as $val_array){

            $entity_name = '';
            $entity_id = 0;
            $name = '';
            $value = '';

            if(array_key_exists('entity_name', $val_array)){

                $entity_name = $val_array['entity_name'];
            }else{

                throw new SMMException('Отсутствует обязательное поле (entity_name) в сохраняемых значениях SMM');
            }

            if(array_key_exists('entity_id', $val_array)){

                $entity_id = $val_array['entity_id'];
            }
            if(array_key_exists('name', $val_array)){

                $name = $val_array['name'];
            }else{
                throw new SMMException('Не передано имя идентификатора SMM поля.');
            }
            if(array_key_exists('value', $val_array)){

                $value = $val_array['value'];
            }else{
                $value = '';
            }

            if(!array_key_exists($name ,$fields_config))
            {
                throw new SMMException('Идентификатор SMM '.$name.' не существует.');
            }

            $item = Smmfield::firstOrNew(['entity_name'=>$entity_name, 'entity_id'=>$entity_id, 'name'=>$name]);
            $item->value = $value;
            $item->save();
        }

    }

}
