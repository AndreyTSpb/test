<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of controller_logoff
 *
 * @author Андрей
 */
class Controller_Logoff extends Controller{
    function action_index() {
        setcookie('id_user',"", time()+3536000, '/');
	setcookie('phone', "", time()+3536000, '/');
	setcookie('email', "", time()+3536000, '/');
	//setcookie('student', "", time()+3536000, '/');
	setcookie('password', "", time()+3536000, '/');
	header ("Location: ".urldecode($_SERVER[HTTP_REFERER]));
	return true;
    }
}
