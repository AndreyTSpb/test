<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_groups_lessons
 *
 * @author qaz
 */
class Model_Groups_Lessons extends Mysql{
    public $id;
    public $id_group;
    public $dt;
    public $block;
    public $status;
    public $text;
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'           => 'id',
            'id_group'     => 'id_group',
            'dt'           => 'dt',
            'block'        => 'block',
            'status'       => 'status',
            'text'         => 'text',
        );
    }
    /**
     * Массив дат занятий
     */
    public function dateLesson() {
        if(!empty($this->show_result())){
            $date = array();
            foreach ($this->show_result() as $val){
                $date[] = $val['dt'];
            }
            return $date;
        }
    }
}
