<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_gen_code
 *
 * @author Андрей
 */
class Model_Gen_Code {
    public function generate_password()

        {

            $arr = array(
                    'a','b','c','d','e','f','g','h','i','j','k','l',
                    'm','n','o','p','r','s','t','u','v','x','y','z',

                    'A','B','C','D','E','F','G','H','I','J','K','L',
                    'M','N','O','P','R','S','T','U','V','X','Y','Z',

                    '1','2','3','4','5','6','7','8','9','0'
                );

            // Генерируем пароль
            $pass = "";

            for($i = 0; $i < 6; $i++)
            {
                // Вычисляем случайный индекс массива
                $index = rand(0, count($arr) - 1);
                $pass .= $arr[$index];
            }
            return $pass;
        }
}
