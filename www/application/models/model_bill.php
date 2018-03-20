<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_bill
 *
 * @author qaz
 */
class Model_Bill extends Mysql{
    public $id;
    public $id_user;
    public $id_group;
    public $aboniment;
    public $dt_start;
    public $dt_ext;
    public $dt_pay;
    public $status;
    public $month;
    public $price;
    public $block;
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'         => 'id',
            'id_user'    => 'id_user',
            'id_group'   => 'id_group',
            'aboniment'  => 'aboniment',
            'dt_start'   => 'dt_start',
            'dt_ext'     => 'dt_ext',
            'dt_pay'     => 'dt_pay',
            'status'     => 'status',
            'month'      => 'month',
            'price'      => 'price',
            'block'      => 'block',
        );
    }
}
