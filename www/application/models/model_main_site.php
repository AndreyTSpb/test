<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_main_site
 *
 * @author qaz
 */
class Model_Main_Site extends Mysql{
    public $id;
    public $name;
    public $text;
    public $type;
    public $del;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'   => 'id',
            'name' => 'name',
            'text' => 'text',
            'type' => 'type',
            'del'  => 'del'
        );
    }
}
