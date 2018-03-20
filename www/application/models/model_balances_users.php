<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_balans_users
 *
 * @author qaz
 */
class Model_Balances_Users extends Mysql{
    public $id;
    public $balance_users_date;
    public $id_user;
    public $balances_users_type;
    public $osnovanie_balance;
    public $balances_users_sum_inv; // Сумма движения ( приход или расход)
    public $balances_users_sum; // Общаяя сумма по итогу.
    public $balances_note;
    /**
     * Отправляем поля таблицы для выборки в родительский класс
     */
    public function fieldsTable() {
        return array(
            'id'                    => 'id',
            'balance_users_date'    => 'balance_users_date',
            'id_user'               => 'id_user',
            'balances_users_type'   => 'balances_users_type',
            'osnovanie_balance'     => 'osnovanie_balance',
            'osnovanie_balance'     => 'osnovanie_balance',
            'balances_users_sum_inv'=> 'balances_users_sum_inv',
            'balances_users_sum'    => 'balances_users_sum',
            'balances_note'         => 'balances_note',
        );
    }
    
}
