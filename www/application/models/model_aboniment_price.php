<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_aboniment_price
 *
 * @author qaz
 */
class Model_Aboniment_Price extends Mysql{
    public $id;
    public $id_user;
    public $id_aboniment;
    public $note;
    public $dt;
    public $cost;
    public $p1;
    public $p2;
    public $p3;
    public $p4;
    public $p5;
    public $p6;
    public $p7;
    public $p8;
    public $p9;
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'             => 'id',
            'id_user'        => 'id_user',
            'id_aboniment'   => 'id_aboniment',
            'note'           => 'note',
            'dt'             => 'dt',
            'cost'           => 'cost',
            'p1'             => 'p1',
            'p2'             => 'p2',
            'p3'             => 'p3',
            'p4'             => 'p4',
            'p5'             => 'p5',
            'p6'             => 'p6',
            'p7'             => 'p7',
            'p8'             => 'p8',
            'p9'             => 'p9',
        );
    }
}
