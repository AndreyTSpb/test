<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_parent
 *
 * @author Андрей
 */
class Model_Parent extends Mysql{
    public $id;
    public $familia;
    public $name;
    public $surname;
    public $email;
    public $id_user;
    public $active;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'     => 'id',
            'familia'=> 'familia',
            'name'   => 'name',
            'surname'=> 'surname',
            'email'  => 'email',
            'id_user'=> 'id_user',
            'active' => 'active'
        );
    }
}
