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
class controller_mygroups {
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
            $data['mygroups'] = $this->model->get_data();
            /*создания страницы*/
            $this->view->generate('mygroups_view.php', 'template_view.php', $data);
        }
}
