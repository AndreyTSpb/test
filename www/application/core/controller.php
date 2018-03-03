<?php

class Controller {
	
	public $model;
	public $view;
	
	function __construct()
	{
		$this->view = new View();
	}
	
	// действие (action), вызываемое по умолчанию
	function action_index()
	{
		// todo	
	}
        /**
         * Проверка куки,
         * отнес сюда т.к. часто использоваться будет
         */
        function check($login, $password)
	{
		/*Для доступа к ЛК пользователей, через админку.
                 * if ($password==md5()) $where=""; else $where="and (password='".$password."')";
                 */ 
                $select = array(
                                "where" => "login ='".$login."' AND pass = '".$password."'",
                            );
                $query = new Model_Logins($select);
                $row = $query->getOneRow();
                            
		if(empty($row)){
                        $data['error_login'] =  "В базе ничего не найдено!!!";
                        $data['enter'] = "not";
                        return $data;
                }else{
                    if(empty($row[3])){
                        $data['error_login'] = "Акаунт не активирован!!!";
                        $data['enter'] = "not";
                        return $data;
                    }
                    if($row[3] == '1'){
                        setcookie('id_user', $row[0], time()+864000, '/');
                        setcookie('phone', $row[1], time()+864000, '/');
                        //setcookie('email', $m['email'], time()+864000, '/');
                        setcookie('password', $row[2], time()+864000, '/');
                        $data['enter'] = "active";
                        return $data;
                    }
                }		
	}
}
