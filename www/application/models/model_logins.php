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
    public $phone;
    public $password;
    public $active;
    public $email;
    
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'         => 'id',
            'phone'      => 'phone',
            'password'   => 'password',
            'active'     => 'active',
            'email'      => 'email',
        );
    }
}
