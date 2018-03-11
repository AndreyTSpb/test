<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_id_class
 *
 * @author Андрей
 */
class Model_Id_Class extends Mysql{
    public $id;
    public $classes;
    public $about;
    public $prior;
    public $code;
    public $del;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'      => 'id',
            'classes' => 'classes',
            'about'   => 'about',
            'prior'   => 'prior',
            'code'    => 'code',
            'del'     => 'del'
        );
    }
}
