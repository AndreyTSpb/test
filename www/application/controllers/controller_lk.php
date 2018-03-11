<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller_lk
 *
 * @author Андрей
 */
class Controller_Lk extends Controller{
    function __construct()
	{
		$this->model = new Model_Lk();
		$this->view = new View();
	}
    function action_index()
	{
                $id_user = (int)$_COOKIE['id_user'];
                
                if(!empty($id_user)){
                    /*Изменение данных о пользователе*/
                    if (isset($_POST['save'])) 
			{
                                $email=trim(strip_tags(strtolower(strtolower($_POST['email']))));
                                $phone=clear_phone($_POST['phone']);
                                $parent_f=trim(strip_tags($_POST['parent_f']));
				$parent_n=trim(strip_tags($_POST['parent_n']));
				$parent_s=trim(strip_tags($_POST['parent_s']));
                                
				$r = mysqli_query($link2, "select * FROM  logins WHERE (phone='".$phone."' and id_user<>'".$id_user."')");
				if (mysqli_num_rows($r))  $error="Пользователь с таким адресом электронной почты уже зарегистрирован<br>";
				if (!$email) $error.="Электронная почта не указана<br>";
				if (!$parent_f or !$parent_n or !$parent_s) $error.="Имя не указано<br>";
				if (!$phone) $error.="Телефон не указан<br>";
				if (!$error){
                                    mysqli_query($link2, "update parent set  familia='".$parent_f."', name = '".$parent_n."', surname ='".$parent_s."' where id_user='".$id_user."'");
                                    mysqli_query($link2, "update logins set  phone='".$phone."', email='".$email."' where id_user='".$id_user."'");
                                    $r = mysqli_query($link2, "select * FROM  logins WHERE id_user='".$id_user."'");
                                    $m = mysqli_fetch_array($r, MYSQLI_ASSOC);
                                    if (check($m['phone'], $m['password'])) header ("Location: /my");
                                }else $rez.="<div class=\"error\">".$error."</div>";
                        }
                    /*Добавление ученика*/
                    /*Изменение данных об ученике*/
                    /*Удаления ученика*/
                    $this->model->id_user = $id_user;
                    $data['stud_info'] = $this->model->studs_info();
                    $data['parent_info'] = $this->model->parent_info();
                    //print_r($data); exit;
                    $this->view->generate('lk_view.php', 'template_view.php', $data);
                }else{
                    header("Location: /");
                }
	}
}
