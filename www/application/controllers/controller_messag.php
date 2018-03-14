<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller_massag
 *
 * @author Андрей
 */
class Controller_Messag extends Controller{
    
    function __construct()
	{
		$this->model = new Model_Messag();
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
            if(isset($_POST['sendMess'])){
                if(!empty($_POST['messag'])){
                    // создаем объект<br>
                        $r = new Model_Messages();
                        // задаем значения для полей таблицы
                        $r->id_user = $this->model->id_user; //он уже есть в модели, такчто берем от туда.
                        $r->type = 2;
                        $r->dt = time();
                        $r->text = htmlspecialchars($_POST['messag']);
                        $result = $r->save(); // создаем запись
                        if($result){
                            header("Location: /messag");
                            exit;
                        }else{
                            $data['error'] = "Сообщение не отправленно";
                        }
                }
            }
            $data['messags'] = $this->model->get_data();
            /*создания страницы*/
            $this->view->generate('messag_view.php', 'template_view.php', $data);
        }
}
