<?php

/*
 * Создания счета
 */

/**
 * Description of model_createbill
 *
 * @author qaz
 */
class Model_CreateBill {
    //put your code here
    public $id_user;
    public $id_abon;
    public $kol_month;
    public $price;
    
    /**
     * Создаем обычный счет
     * Оплата по месяцам
     */
    public function createBillStandart(){
        $q = array(
            "where" => "id = '".$this->id_abon."' AND id_user = '".$this->id_user."'"
        );
        $objAbon = new Model_Aboniments($q);
        $mAbon = $objAbon->getOneRow();
        //echo "<pre>";
        //print_r($mAbon);
        //echo "</pre>";
        $id_group = (int)$mAbon['id_group'];
        $arr_no_pay_month = array();
        $kol = 0;
        $a =0;
        for($i=1; $i<10; $i++){
            $a = "p".$i;
            if($mAbon[$a] == 0){
                $arr_no_pay_month[++$kol] = $a; 
            }
        }
        //print_r($arr_no_pay_month);
        $wait_pay_month = array();
        $block = '';
        for($k=1; $k<=$this->kol_month; $k++){
            $wait_pay_month[$k] = $arr_no_pay_month[$k];
            if($arr_no_pay_month[$k] === 'p1') {$block.= "9 ";  $dt_ext_abon = strtotime(date("t.09.".STR_YEAR));}
            if($arr_no_pay_month[$k] === 'p2') {$block.= "10 "; $dt_ext_abon = strtotime(date("t.10.".STR_YEAR));}
            if($arr_no_pay_month[$k] === 'p3') {$block.= "11 "; $dt_ext_abon = strtotime(date("t.11.".STR_YEAR));}
            if($arr_no_pay_month[$k] === 'p4') {$block.= "12 "; $dt_ext_abon = strtotime(date("t.12.".STR_YEAR));}
            if($arr_no_pay_month[$k] === 'p5') {$block.= "1 ";  $dt_ext_abon = strtotime(date("t.01.".END_YEAR));}
            if($arr_no_pay_month[$k] === 'p6') {$block.= "2 ";  $dt_ext_abon = strtotime(date("t.02.".END_YEAR));}
            if($arr_no_pay_month[$k] === 'p7') {$block.= "3 ";  $dt_ext_abon = strtotime(date("t.03.".END_YEAR));}
            if($arr_no_pay_month[$k] === 'p8') {$block.= "4 ";  $dt_ext_abon = strtotime(date("t.04.".END_YEAR));}
            if($arr_no_pay_month[$k] === 'p9') {$block.= "5 ";  $dt_ext_abon = strtotime(date("t.05.".END_YEAR));}
        }
        //print_r($wait_pay_month);
        $months = implode(' ', $wait_pay_month);
        $dt_start = time();
        $dt_ext = $dt_start+60*60+2;
        if($this->kol_month === 9){
            $block = "9 10 11 12 1 2 3 4 5";
        }
        //echo $sql = "INSERT INTO bill (id_user, id_group, dt_ext, month, pice, block, dt_start, aboniment)
        //                   VALUES('$this->id_user', '$id_group', '$dt_ext', '$months', '$this->cost', '".trim($block)."', '$dt_start', '$this->id_abon')";

        $objBill = new Model_Bill();
        // задаем значения для полей таблицы<br>
        $objBill->id_user = $this->id_user;
        $objBill->id_group = $id_group;
        $objBill->aboniment = $this->id_abon.'/abon';
        $objBill->dt_ext = $dt_ext;
        $objBill->dt_pay = $dt_start;
        $objBill->price = $this->price;
        $objBill->month = $months;
        $objBill->block = $block;
        $result = $objBill->save(); // создаем запись
        if($result){
            for($v=1; $v<= $this->kol_month; $v++){
                $select = array(
                        'where' => "id ='".$this->id_abon."'"
                            );
                // модель
                $model = new Model_Aboniments($select);
                // извлекаем данные
                $model->fetchOne();
                // задаем новые значения
                $model->{$wait_pay_month[$v]} = '5';
                $model->dt_ext = $dt_ext_abon;
                // обновляем запись
                $result1 = $model->update();
            }
            if($result1){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    /**
     * Создаем счет для курса
     * Оплата сразу за весь курс
     */
    public function creteBillKurs(){
        return true;
    }
}
