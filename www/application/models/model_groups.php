<?php

class Model_Groups extends Mysql{
    public $id; //0
    public $code; //1
    public $id_subject; //2
    public $id_class;//3
    public $id_location;//4
    public $id_type;//5
    public $id_teacher;//6
    public $max_users;//7
    public $dt_str;//8
    public $dt_ext;//9
    public $active;//10
    public $day;//13
    public $day_2;//14
    public $time_start;//15
    public $time_start_2;//16
    public $price;//17
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'           => 'id',
            'code'         => 'code',
            'id_subject'   => 'id_subject',
            'id_class'     => 'id_class',
            'id_location'  => 'id_location',
            'id_type'      => 'id_type',
            'id_teacher'   => 'id_teacher',
            'max_users'    => 'max_users',
            'dt_str'       => 'dt_str',
            'dt_ext'       => 'dt_ext',
            'active'       => 'active',
            'day'          => 'day',
            'day_2'        => 'day_2',
            'time_start'   => 'time_start',
            'time_start_2' => 'time_start_2',
            'price'        => 'price',
        );
    }
    /**
     * Определяем имя
     */
    public function name(){
        $this->fetchOne();
        return $this->code;
    }
    /**
     * Макс кол юзеров
     */
    public function max_users(){
        $this->fetchOne();
        return $this->max_users;
    }
}

