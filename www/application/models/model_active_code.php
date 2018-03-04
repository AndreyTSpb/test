<?php

/*
 * Соединение с таблицей active_code
 * В ней хранятся коды активации учетных записей
 */

/**
 * Description of model_active_code
 *
 * @author Андрей
 */
class Model_Active_Code extends Mysql{
    public $id;
    public $code;
    public $id_user;
    public $dt;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'      => 'id',
            'code'    => 'code',
            'id_user' => 'id_user',
            'dt'      => 'dt'
        );
    }
}
