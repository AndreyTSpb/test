<?php

/*
 * Модель для подключения к таблице логинов.
 * Сделаю тут дополнительные специфические выборки для логинов
 */

/**
 * Description of model_logins
 *
 * @author Андрей
 */
class Model_Logins extends Mysql{
    /**
     * Переменные
     */
    public $id;
    public $login;
    public $pass;
    public $active;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'     => 'id',
            'login'  => 'login',
            'pass'    => 'pass',
            'active' => 'active'
        );
    }
}
