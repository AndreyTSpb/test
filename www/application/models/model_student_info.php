<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_student_info
 *
 * @author Андрей
 */
class Model_Student_Info extends Mysql{
    public $id;
    public $school;
    public $year_sc;
    public $raion;
    public $klass;
    public $activ;
    public $id_student;
    public $study;
    public $want;
    public $type;
    public $birthday;
    public $sex;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'         => 'id',
            'school'     => 'school',
            'year_sc'    => 'year_sc',
            'raion'      => 'raion',
            'klass'      => 'klass',
            'activ'      => 'activ',
            'id_student' => 'id_student',
            'study'      => 'study',
            'want'       => 'want',
            'type'       => 'type',
            'birthday'   => 'birthday',
            'sex'        => 'sex',
        );
    }
}
