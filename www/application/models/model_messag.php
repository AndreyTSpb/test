<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_messag
 *
 * @author Андрей
 */
class Model_Messag extends Model{
    public $id_user;
    
    public function get_data()
        {
            $q = array(
                'where' => "id_user='".$this->id_user."' and type<='2' and blag<>'1'",
                'order' => 'dt DESC'
            );
            $r = new Model_Messages($q);
            $m = $r->getAllRows();
            $massag = array();
            foreach ($m as $val){
                if(!empty($val['text'])){
                    $massag[] = [
                        "text"=>$val['text'],
                        "dt"  =>date("d.m.Y", $val['dt'])
                    ];
                }
            }
            return $massag;
        }
}
