<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller_mygroups
 *
 * @author qaz
 */
class controller_mygroups extends Controller{
    function __construct()
	{
		$this->model = new Model_MyGroups();
                $this->view = new View();
	}
    function action_index()
	{
            /**
             * Проверка куки, если есть и совпадают с БД то автологин.
             */
            $data["login_status"] = "";
            $this->model->id_user = (int)$_COOKIE['id_user'];
            /**
             * Обработка ответа от формы 
             */
            if(isset($_POST['create_bill'])){
                
                $kol_month = (int)$_POST['for_bill'];
                $cost = $_POST['cost_bill'];
                $id_abon = (int)$_POST['id_abon'];
                
                $objCeateBill = new Model_CreateBill();
                
                $objCeateBill->id_abon = $id_abon;
                $objCeateBill->kol_month = $kol_month;
                $objCeateBill->cost = $cost;
                $objCeateBill->id_user = (int)$_COOKIE['id_user'];
                
                $bill = $objCeateBill->createBillStandart();
                if($bill){
                    header("Location: /mybills");
                    exit;
                }else{
                    $data['error'] = "Что-то пошло не так!!!";
                }
            }
            $data['mygroups'] = $this->model->get_data();
            /*создания страницы*/
            $this->view->generate('mygroups_view.php', 'template_view.php', $data);
        }
}
