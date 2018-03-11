<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_lk
 *
 * @author Андрей
 */
class Model_Lk extends Model{
    public $id_user;
    public $id_stud;
    
    public function get_data(){
        
        /*Выборка по ученику*/
        $query1 = array(
            'where' => "id_user = '".$this->id_user."' AND active='1'"
        );
        //$stud_info = new Model_Students();
    }
    public function parent_info(){
        /*Выборка данных о родителе*/
        $query = array(
            'where' => "id_user = '".$this->id_user."'",
        );
        $parent_info = new Model_Parent($query);
        $parent_info->fetchOne(); // извлекаем данные<br>
        //print_r($parent_info);
        // получаем значения столбцов<br>
        $familia = $parent_info->familia;
        $name = $parent_info->name;
        $surname = $parent_info->surname;
        $par = array(
            'f'    =>$familia,
            'n'    =>$name,
            's'    =>$surname,
            'phone'=>$_COOKIE['phone'],
            'email'=>trim($_COOKIE['email']),
        );
        //print_r($par);
        return $par;
    }
    /*Информация об ученике*/
    public function studs_info() {
        //$this->id_user = 736;
        $query = array(
            'where' => "id_user = '".$this->id_user."' AND active='1'"
        );
        $studs_inf = new Model_Students($query);
        $m = $studs_inf->getAllRows();
        /* [0] => 3 [1] => 736 [2] => Крылов Иван [3] => 736 [4] => 1 [5] => 0 [6] => 0 )*/
        $studs = array();
        if(!empty($m)){
            foreach($m as $item){
                $q1 = array(
                    'where' => "id_student = '".$item[0]."' AND activ = '1'",
                    'limit' => '1'
                );
                $stud_inf = new Model_Student_Info($q1);
                $m = $stud_inf->getOneRow();
                //print_r($m);
                $studs[$item[0]] = array(
                    'name'    => $item[2],
                    'olimp'   => $item[5],
                    'veteran' => $item[6],
                    'school'  => $m['school'],
                    'year_sc' => $m['year_sc'],
                    'raion'   => $m['raion'],
                    'klass'   => $m['klass'],
                    'birthday'=> $m['birthday'],
                    'sex'     => $m['sex'],
                );
            }
        }
        return $studs;
    }
}
