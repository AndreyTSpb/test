<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller_aboutbottom
 *
 * @author qaz
 */
class Controller_Aboutbottom extends Controller{
    function __construct()
	{
		$this->model = new Model_Aboutbottom();
	}
    function action_index()
	{
                $data = $this->model->get_data();
		$this->view->generate('contacts_view.php', 'template_view.php', $data);
	}
}
