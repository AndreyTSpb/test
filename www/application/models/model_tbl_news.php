<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_tbl_news
 *
 * @author qaz
 */
class Model_Tbl_News extends Mysql{
    public $id;
    public $title;
    public $small_text;
    public $big_text;
    public $date_create;
    public $is_active;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'          => 'id',
            'title'       => 'title',
            'small_text'  => 'small_text',
            'big_text'    => 'big_text',
            'date_create' => 'date_create',
            'is_active'   => 'is_active'
        );
    }
    
}
