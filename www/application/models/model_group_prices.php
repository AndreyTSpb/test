<?php

class Model_Group_Prices extends Mysql{
    public $id;
    public $id_group;
    public $dt;
    public $price;
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
            'id_group'       => 'id_group',
            'dt'             => 'dt',
            'price'          => 'price',
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
