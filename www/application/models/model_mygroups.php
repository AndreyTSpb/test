<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of model_group
 *
 * @author qaz
 */
class Model_MyGroups extends Model {
    public $id_user;
    public $id_stud;


    public function get_data()
        {
            $this->students();
            $studs_in_groups = $this->id_stud;
            //print_r($studs_in_groups);
                foreach ($studs_in_groups as $id_stud => $name){
                    $q = array(
                        "where" => "id_user = '".$this->id_user."' AND id_stud = '".$id_stud."' AND status IN('0','1','5','6') ",
                        "order" => "id ASC"
                    );
                    $objAbon = new Model_Aboniments($q);
                    $masAbon = $objAbon->getAllRows();
                    //print_r($masAbon);
                    $groups = array();
                    $id_group ='';
                    $id_abon = '';
                    $code = '';
                    $cost = '';
                    $status = '';
                    if(!empty($masAbon)){
                        foreach($masAbon as $item){
                            $id_group = $item['id_group'];
                            $id_abon  = $item['id'];
                            $status = $item['status'];
                            $q1 = array(
                                "where" => "id = '".$id_group."'",
                            );
                            $objGroup = new Model_Groups($q1);
                            $code = $objGroup->name();
                            $type = $objGroup->id_type;
                            /**
                             * Получайм прайс для этого абонемента
                             */
                            $q2 = array(
                                "where" => "id_aboniment = '".$id_abon."'",
                                "order" => "dt DESC",
                                "limit" => "1"
                            );
                            $opjPrice = new Model_Aboniment_Price($q2);
                            $masPrice = $opjPrice->getOneRow();
                            
                            if(!empty($masPrice)){
                                $price = array(
                                    "p1" => $masPrice['p1'],
                                    "p2" => $masPrice['p2'],
                                    "p3" => $masPrice['p3'],
                                    "p4" => $masPrice['p4'],
                                    "p5" => $masPrice['p5'],
                                    "p6" => $masPrice['p6'],
                                    "p7" => $masPrice['p7'],
                                    "p8" => $masPrice['p8'],
                                    "p9" => $masPrice['p9'],
                                );
                                $cost = $masPrice['cost'];
                            }else{
                                $price = '';
                            }
                            /**
                             * Выясняем естьли не оплаченные счета
                             */
                            $q3 = array(
                                "where" => "aboniment ='".$id_abon."/abon' AND status = '0' "
                            );
                            $objBill = new Model_Bill($q3);
                            $no_pay = $objBill->num_row;
                            
                            $groups[] = array(
                                'id_abon'  => $id_abon,
                                'id_group' => $id_group,
                                'code'     => $code,
                                'cost'     => $cost,
                                'status'   => $status,
                                "p1"       => $item['p1'],
                                "p2"       => $item['p2'],
                                "p3"       => $item['p3'],
                                "p4"       => $item['p4'],
                                "p5"       => $item['p5'],
                                "p6"       => $item['p6'],
                                "p7"       => $item['p7'],
                                "p8"       => $item['p8'],
                                "p9"       => $item['p9'],
                                'price'    => $price,
                                'no_pay'   => $no_pay,
                                'type'     => $type
                            );
                        }
                    }
                    $studs_in_groups[$id_stud]= array(
                                'name'   => $name,
                                'groups' => $groups 
                            );
                }
            
            //print_r($studs_in_groups);
            return $studs_in_groups;
        }
    /**
     * Разделение по ученикам
     */
    private function students(){
        $q = array(
            "where" => "id_user = '".$this->id_user."' AND active = '1'",
            "order" => "id ASC"
        );
        $objStuds = new Model_Students($q);
        $masStuds = $objStuds->getAllRows();
        //print_r($masStuds);
        $studs = array();
        foreach ($masStuds as $mas){
            $studs[$mas['id']] = $mas['name'];
        }
        $this->id_stud = $studs;
    }
}
