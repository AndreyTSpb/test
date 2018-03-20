<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_mybills
 *
 * @author Андрей
 */
class Model_Mybills extends Model{
    public $id_user;
    public function get_data(){
        $balans = $this->balans_user($this->id_user);
        $mas['balans'] = $balans;
        $name_block = array("", "Январь", "Февраль", "Март", "Апрель", "Май", "Июль", "Июнь", "Август", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
        /*Ожидают оплату*/
        $q = array(
                        "where" => "id_user = '".$this->id_user."' AND status IN ('0')",
                        "order" => "dt_start DESC"
                    );
        $objBill = new Model_Bill($q);
        $masBill = $objBill->getAllRows();
        //print_r($masBill);exit;
        $true = array();
        $id_group = '';
        $code='';
        $dt ='';
        if(!empty($masBill)){
            foreach ($masBill as $val){
                $id_group = $val['id_group'];
                $q3 = array(
                    "where" => "id = '".$id_group."'"
                );
                $objGroup = new Model_Groups($q3);
                $code = $objGroup->name();
                $objDate = new Model_Dates;
                $mon = explode(" ", trim($val['month']));
                $months = '';
                $block ='';
                $blocks ='';
                if(!empty($mon)){
                    foreach ($mon as $item){
                        $month = trim($item ,'p');
                        $months .=trim($objDate->monthNameEduYear($month))." ";
                        switch ($month){
                            case '1':
                                $block .= "'9',";
                                break;
                            case '2':
                                $block .= "'10',";
                                break;
                            case '3':
                                $block .= "'11',";
                                break;
                            case '4':
                                $block .= "'12',";
                                break;
                            case '5':
                                $block .= "'1',";
                                break;
                            case '6':
                                $block .= "'2',";
                                break;
                            case '7':
                                $block .= "'3',";
                                break;
                            case '8':
                                $block .= "'4',";
                                break;
                            case '9':
                                $block .= "'5',";
                                break;
                        }
                        $blocks = trim($block, ",");
                    }
                    
                    $q1 = array(
                        "where" => "id_group = '".$id_group."' AND block IN (".$blocks.")",
                        "order" => "dt ASC"
                    );
                    $objLess = new Model_Groups_Lessons($q1);
                    $arr_dt_less = $objLess->dateLesson();
                    if(!empty($arr_dt_less)){
                        $months .="<br>";
                        foreach ($arr_dt_less as $dt){
                            $months .="<span style=\"color:green;\">" . date("d.m", $dt) . " </span>";
                        }
                    }
                    
                }
                $dt = date("d.m.Y",$val['dt_pay']);
                $wait_pay[] = array(
                    "id_bill" => $val['id'],
                    "code"    => $code,
                    "months"  => $months,
                    "price"   => $val['price'],
                    "dt"      => $dt,
                    "status"  => $val['status']
                );
            }
        }
        $mas['wait_pay'] = $wait_pay;
        /*Оплаченные*/
        $q4 = array(
                        "where" => "id_user = '".$this->id_user."' AND status IN ('1','5')",
                        "order" => "dt_start DESC"
                    );
        $objBillTrue = new Model_Bill($q4);
        $masBillTrue = $objBillTrue->getAllRows();
        //print_r($masBill);exit;
        $true = array();
        $id_group = '';
        $code='';
        $dt ='';
        if(!empty($masBillTrue)){
            foreach ($masBillTrue as $val){
                $id_group = $val['id_group'];
                $q3 = array(
                    "where" => "id = '".$id_group."'"
                );
                $objGroup = new Model_Groups($q3);
                $code = $objGroup->name();
                $objDate = new Model_Dates;
                $mon = explode(" ", trim($val['month']));
                $months = '';
                if(!empty($mon)){
                    foreach ($mon as $item){
                        $month = trim($item ,'p');
                        $months .=trim($objDate->monthNameEduYear($month))." ";
                        switch ($month){
                            case '1':
                                $block .= "'9',";
                                break;
                            case '2':
                                $block .= "'10',";
                                break;
                            case '3':
                                $block .= "'11',";
                                break;
                            case '4':
                                $block .= "'12',";
                                break;
                            case '5':
                                $block .= "'1',";
                                break;
                            case '6':
                                $block .= "'2',";
                                break;
                            case '7':
                                $block .= "'3',";
                                break;
                            case '8':
                                $block .= "'4',";
                                break;
                            case '9':
                                $block .= "'5',";
                                break;
                        }
                        $blocks = trim($block, ",");
                    }
                    
                    $q1 = array(
                        "where" => "id_group = '".$id_group."' AND block IN (".$blocks.")",
                        "order" => "dt ASC"
                    );
                    $objLess = new Model_Groups_Lessons($q1);
                    $arr_dt_less = $objLess->dateLesson();
                    if(!empty($arr_dt_less)){
                        $months .="<br>";
                        foreach ($arr_dt_less as $dt){
                            $months .="<span style=\"color:green;\">" . date("d.m", $dt) . " </span>";
                        }
                    }
                }
                if($val['status'] == 1){
                    $dt = "Бронь подтверждена<br>" .date("d.m.Y H:i",$val['dt_ext']);
                }elseif ($val['status'] == 5) {
                    $dt = date("d.m.Y H:i",$val['dt_ext']);
                }
                if($val['price'] == 0){
                    $status = "Моя группа<br>Подтверждено!!!";
                }else{
                    $status = "Моя группа<br>Оплачено!!!";
                }
                $dt = date("d.m.Y",$val['dt_pay']);
                $true[] = array(
                    "id_bill" => $val['id'],
                    "code"    => $code,
                    "months"  => $months,
                    "price"   => $val['price'],
                    "dt"      => $dt,
                    "status"  => $status
                );
            }
        }
        $mas['true'] = $true;
        /*******************************************/
        /*Тут просроченные счета*/
        $q1 = array(
                        "where" => "id_user = '".$this->id_user."' AND status IN ('2','3')",
                        "order" => "dt_start DESC"
                    );
        $objBillFalse = new Model_Bill($q1);
        $masBillFalse = $objBillFalse->getAllRows();
        $false = array();
        $id_group = '';
        $code='';
        $dt ='';
        $val ='';
        if(!empty($masBillFalse)){
            foreach ($masBillFalse as $val){
                $id_group = $val['id_group'];
                $q3 = array(
                    "where" => "id = '".$id_group."'"
                );
                $objGroup = new Model_Groups($q3);
                $code = $objGroup->name();
                $objDate = new Model_Dates;
                $mon = explode(" ", trim($val['month']));
                $months = '';
                if(!empty($mon)){
                    foreach ($mon as $item){
                        $month = trim($item ,'p');
                        $months .=trim($objDate->monthNameEduYear($month))." ";
                    }
                }
                if($val['status'] == 2){
                    $dt = "Был актуален до<br>" .date("d.m.Y H:i",$val['dt_ext']);
                    $status = "Счет просрочен!!!";
                }elseif ($val['status'] == 3) {
                    $dt = date("d.m.Y H:i",$val['dt_ext']);
                    $status = "Отказ от занятий в этой группе!!!";
                }
                
                $false[] = array(
                    "id_bill" => $val['id'],
                    "code"    => $code,
                    "months"  => $months,
                    "price"   => $val['price'],
                    "dt"      => $dt,
                    "status"  => $status
                );
            }
        }
        $mas['false'] = $false;
        return $mas;
    }
    
    /**
     * Выборка баланса пользователя 
     */
    private function balans_user($id_user) {
        $q = array(
            'where' => "id_user = '".$id_user."' ",
            'order' => "balance_users_date DESC",
            'limit' => "1"
        );
        $objBalans = new Model_Balances_Users($q);
        $objBalans->fetchOne();
        $balans = $objBalans->balances_users_sum;
        return $balans;
    }
}
