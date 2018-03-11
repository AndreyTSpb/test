<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_id_location
 *
 * @author Андрей
 */
class Model_Id_Subject extends Mysql{
    public $id;
    public $subject;
    public $code;
    public $del;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'      => 'id',
            'name'    => 'subject',
            'code'    => 'code',
            'del'     => 'del'
        );
    }
}
