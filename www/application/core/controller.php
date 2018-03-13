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
                                "where" => "phone ='".$login."' AND password = '".$password."'",
                            );
                $query = new Model_Logins($select);
                $row = $query->getOneRow();
                            
		if(empty($row)){
                        //$data['error_login'] =  "Логин или пароль неправельный!!!";
                        $data= "not";
                        return $data;
                }else{
                    if(empty($row['active'])){
                        //$data['error_login'] = "Акаунт не активирован!!!";
                        $data= "not_active";
                        return $data;
                    }
                    if($row['active'] == '1'){
                        setcookie('id_user', $row['id'], time()+864000, '/');
                        setcookie('phone', $row['phone'], time()+864000, '/');
                        setcookie('email', $row['email'], time()+864000, '/');
                        setcookie('password', $row['password'], time()+864000, '/');
                        $data= "active";
                        return $data;
                    }
                }		
	}
}
