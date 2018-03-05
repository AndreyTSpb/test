<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller_login
 *
 * @author Андрей
 */
class Controller_Login extends Controller{
    function action_index()
	{
            /**
             * Проверка куки, если есть и совпадают с БД то автологин.
             */
            $data["login_status"] = "";
            /**
             * Обработка ответа от формы 
             */    
             if(isset($_POST['loginSub'])){
                 if(isset($_POST['loginLogi']) && isset($_POST['loginPass']))
                    {
                            $login = htmlspecialchars(trim($_POST['loginLogi']));
                            $password = htmlspecialchars(trim($_POST['loginPass']));
                            /*
                                Производим аутентификацию, сравнивая полученные значения со значениями прописанными в коде.
                                Такое решение не верно с точки зрения безопсаности и сделано для упрощения примера.
                                Логин и пароль должны храниться в БД, причем пароль должен быть захеширован.
                            */
                            $data = $this->check($login, $password);
                            //print_r($data); exit;
                            if($data['enter'] === 'not_active'){
                                header ("Location: /regfinish");
                                exit;
                            }elseif($data['enter'] === 'active'){
                                header ("Location: /");
                                exit;
                            }
                    }
             }
             /*создания страницы*/
            $this->view->generate('login_view.php', 'template_view.php', $data);
	}
}
