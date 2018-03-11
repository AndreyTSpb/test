<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_students
 *
 * @author Андрей
 */
class Model_Students extends Mysql{
    public $id;
    public $id_login;
    public $olimp;
    public $veteran;
    public $name;
    public $id_user;
    public $active;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'      => 'id',
            'id_login'=> 'id_login',
            'olimp'   => 'olimp',
            'veteran' => 'veteran',
            'name'    => 'name',
            'id_user' => 'id_user',
            'active'  => 'active'
        );
    }
}
