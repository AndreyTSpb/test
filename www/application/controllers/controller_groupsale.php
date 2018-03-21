<?php

class Controller_GroupSale extends Controller
{
	function __construct()
	{
		$this->model = new Model_Groupsale();
		$this->view = new View();
	}
        
	function action_index()
	{
                $data['content'] = $this->model->get_data();
		$this->view->generate('groupsale_view.php', 'template_view.php', $data);
	}
        function action_selectgroups($params = false){
            if($_COOKIE['id_user']){
                /**
                 * Создание абонемента и прайса
                 */
                if(isset($_POST['bay_group'])){
                    global $link;
                    $id_stud    = (int)$_POST['id_stud'];
                    $id_user    = (int)$_POST['id_user'];
                    $id_group   = (int)$_POST['id_group'];
                    $id_subject = (int)$_POST['id_subject'];
                    /*получаем текущию цену группы*/
                    $sql1 = "SELECT * FROM group_prices WHERE id_group = '".$id_group."' ORDER BY dt DESC LIMIT 1";
                    $r1 = $link->query($sql1);
                    $m1 = $r1->fetch_assoc();
                    $price = 0;
                    $str = '';
                    // Создаем abon
                    $objAbon = new Model_Aboniments();
                    
                    for($i=1; $i<10; $i++){
                        $a = "p".$i;
                        if($m1[$a]>0){
                            $price +=$m1[$a];
                            $objAbon->{$a} = 0;
                        }else{
                            $objAbon->{$a} = 2;
                        }
                        $str .="'".$m1[$a]."',"; 
                    }
                    $dt_ext = time() + 60*60*24;
                    
                    // задаем значения для полей таблицы<br>
                    $objAbon->id_user    = $id_user;
                    $objAbon->id_stud    = $id_stud;
                    $objAbon->id_group   = $id_group;
                    $objAbon->status     = 0;
                    $objAbon->dt         = time();
                    $objAbon->cost       = $price;
                    $objAbon->discount   = '';
                    $objAbon->dt_ext     = $dt_ext;
                    $objAbon->id_subject = $id_subject;
                    $id_abon = $objAbon->save();
                    
                    // Создаем прайс
                    $model = new Model_Aboniment_Price();
                    // задаем значения для полей таблицы<br>
                    $model->id_user = $id_user;
                    $model->id_aboniment = $id_abon;
                    $model->dt = time();
                    $model->p1 = $m1['p1'];
                    $model->p2 = $m1['p2'];
                    $model->p3 = $m1['p3'];
                    $model->p4 = $m1['p4'];
                    $model->p5 = $m1['p5'];
                    $model->p6 = $m1['p6'];
                    $model->p7 = $m1['p7'];
                    $model->p8 = $m1['p8'];
                    $model->p9 = $m1['p9'];
                    $model->note = 'Скидки нет';
                    $result = $model->save(); // создаем запись<br>
                }
                /**
                 * Если произошел выбор на карте и появились параметры.
                 * Переход к выбору группы
                 */
                if(!empty($params)){
                foreach ($params as $key => $val){
                        switch ($key){
                            case 'i':
                                $this->model->id_group = (int)$val;
                                break;
                            case 's':
                                $this->model->id_subject = (int)$val;
                                break;
                            case 't':
                                $this->model->id_type = (int)$val;
                                break;
                            case 'l':
                                $this->model->id_location = (int)$val;
                                break;
                        }
                    }
                }
                $id_user = (int)$_COOKIE['id_user'];
                $q = array(
                    'where' => "id_user = '".$id_user."'",
                );
                $objStud = new Model_Students($q);
                $objStud->fetchOne();
                $id_stud = $objStud->id;
                $data['user'] = $id_user;
                $data['stud'] = $id_stud;
                $data['content'] = $this->model->select_groups();
                $this->view->generate('groupsale_view.php', 'template_view.php', $data);
            }else{
                header("location: /");
            }
        }
}
