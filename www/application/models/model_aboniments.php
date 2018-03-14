<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_aboniments
 *
 * @author qaz
 */
class Model_Aboniments extends Mysql{
    public $id;
    public $id_user;
    public $id_group;
    public $status;
    public $dt;
    public $dt_start;
    public $dt_ext;
    public $dt_pay;
    public $cost;
    public $discount;
    public $id_stud;
    public $id_subject;
    public $del;
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
            'id'         => 'id',
            'id_user'    => 'id_user',
            'id_group'   => 'id_group',
            'status'     => 'status',
            'dt'         => 'dt',
            'dt_start'   => 'dt_start',
            'dt_ext'     => 'dt_ext',
            'dt_pay'     => 'dt_pay',
            'cost'       => 'cost',
            'discount'   => 'discount',
            'id_stud'    => 'id_stud',
            'id_subject' => 'id_subject',
            'del'        => 'del',
            'p1'         => 'p1',
            'p2'         => 'p2',
            'p3'         => 'p3',
            'p4'         => 'p4',
            'p5'         => 'p5',
            'p6'         => 'p6',
            'p7'         => 'p7',
            'p8'         => 'p8',
            'p9'         => 'p9',
        );
    }
}
