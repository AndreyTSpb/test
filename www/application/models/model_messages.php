<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_messages
 *
 * @author Андрей
 */
class Model_Messages extends Mysql{
    /**
     * Переменные
     */
    public $id;
    public $id_user;
    public $text;
    public $status;
    public $to_user;
    public $type;
    public $dt;
    public $cost;
    public $transaction;
    public $blag;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'         => 'id',
            'id_user'      => 'id_user',
            'text'   => 'text',
            'status'     => 'status',
            'to_user'      => 'to_user',
            'type'         => 'type',
            'dt'      => 'dt',
            'cost'   => 'cost',
            'transaction'     => 'transaction',
            'blag'      => 'blag',
        );
    }
}
