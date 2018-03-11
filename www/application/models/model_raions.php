<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_raions
 *
 * @author Андрей
 */
class Model_Raions extends Mysql{
    public $id;
    public $name;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'   => 'id',
            'name' => 'name',
        );
    }
}
