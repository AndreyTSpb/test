<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Model_Aboutbottom
 *
 * @author qaz
 */
class Model_Aboutbottom {
    public function get_data()
        {
            $select = array(
                'where' => "name = 'about_botom'",
            );
            $sql = new Model_Main_Site($select);
//            $sql->fetchOne();
//            $text = $sql->text;
//            var_dump($text);exit;
            $m = $sql->getOneRow();
            $arr[0] = $m[2];
            return $arr;
        }
}
