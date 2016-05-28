<?php

namespace Interpro\SMM\Laravel;

use Illuminate\Support\Facades\App;
use Interpro\SMM\Concept\Exception\SMMException;
use Interpro\SMM\Concept\SMMRepository as SMMRepositoryInterface;

class SMMRepository implements SMMRepositoryInterface
{
    private $fields;
    private $model;
    private $field_conf;
    private $global_conf;
    private $global_vals;
    private $collectionFactory;

    public function __construct()
    {
        $this->fields = [];
        $this->field_conf = config('smm.fields');
        $this->global_conf = config('smm.globals');

        $this->model             = App::make('Interpro\SMM\Laravel\Model\Smmfield');
        $this->collectionFactory = App::make('Interpro\SMM\Laravel\Collection\SMMFieldsCollectionFactory');
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
    private function composeField($field_name, $field_val)
    {
        if(!$this->global_vals){
            $global_model = App::make('Interpro\SMM\Laravel\Model\Smmglobal');

            $this->global_vals = [];
            $global_coll = $global_model::all();
            foreach($global_coll as $item){
                $this->global_vals[$item->name] = $item->value;
            }
        }


        if(!array_key_exists($field_name, $this->field_conf))
        {
            throw new SMMException('Идентификатор SMM '.$field_name.' не существует.');
        }

        $temlate = $this->field_conf[$field_name];

        foreach($this->global_conf as $global){
            $temlate = str_replace('{'.$global.'}', $this->global_vals[$global], $temlate);
        }

        $temlate = str_replace('{self}', $field_val, $temlate);

        return $temlate;
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
    public function getFieldValue($entity_name, $field_name, $entity_id)
    {
        $raw = (substr($field_name, 0, 3) === 'raw');

        if($raw){ //Если значение поля запрашивают без обработки шаблоном конфига
            $field_name = substr($field_name, 3);
        }

        $rkey = $entity_name.'_'.$entity_id;

        $this->queryFields($entity_name, $entity_id);

        //Если запросили всю коллекцию полей
        if($field_name === 'fieldscoll'){
            return $this->collectionFactory->create($this->fields[$rkey]);
        }

        if(array_key_exists($field_name, $this->fields[$rkey]))
        {
            if($raw){
                return $this->fields[$rkey][$field_name];
            }else{
                return $this->composeField($field_name, $this->fields[$rkey][$field_name]);
            }
        }else{

            //Просто возвращаем пустую строку, отсутствие smm описания это не ошибка
            return '';
        }
    }

    private function queryFields($entity_name, $entity_id)
    {
        $rkey = $entity_name.'_'.$entity_id;

        if(!array_key_exists($rkey, $this->fields))
        {
            $this->fields[$rkey] = [];

            $model_q = $this->model->query();

            $model_q->where('entity_name', '=', $entity_name);
            $model_q->where('entity_id', '=', $entity_id);

            $this->fields[$rkey] = [];
            $coll = $model_q->get();

            foreach($coll as $item){
                $this->fields[$rkey][$item->name] = $item->value;
            }
        }
    }

}
