<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_main
 *
 * @author Андрей
 */
class Model_Main extends Model{
    public function get_data() {
        $select = array(
                'limit' => '5',
            );
        $sql = new Model_Tbl_News($select);
        $m = $sql->getAllRows();
        $data['news_left'] = $m;
        return $data;
    }
}
