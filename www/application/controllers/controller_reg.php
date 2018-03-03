<?php

/*
 * бработка для регистрации на сайте
 */

/**
 * Description of controller_reg
 *
 * @author Андрей
 */
class Controller_Reg extends Controller{
    function action_index() {
        if(isset($_POST['regSub'])){
            if(isset($_POST['email']) AND isset($_POST['pas1'])){
                $login = htmlspecialchars(trim($_POST['email']));
                $password = htmlspecialchars(trim($_POST['pas1']));
                $pas_con = htmlspecialchars(trim($_POST['pas2']));
                if($password != $pas_con){
                    $data['error_reg'] = "Пароли не совпадают!!!";
                }else{
                    $data['error_reg'] = $login." ".$password;
                    $query = new Model_Logins();
                    $query->login = $login;
                    $query->pass = $password;
                    $r = $query->save();
                    var_dump($r);
                }
            }
        }
        /*создания страницы*/
        $this->view->generate('reg_view.php', 'template_view.php', $data);
    }
}
