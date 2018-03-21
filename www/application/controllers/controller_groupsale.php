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
