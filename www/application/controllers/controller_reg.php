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
        $data['error_reg'] ='';
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
                    $id_user = $query->save();
                    if(empty($id_user)){
                        $data['error_reg'] = "Запись не добавленна!!!";
                    }else{
                        /**
                         * Генерируем код подтверждения
                         */
                        $code = new Model_Gen_Code;
                        /**
                         * Сохраняем сгенерированый пароль.
                         */
                        $query1 = new Model_Active_Code();
                        $query1->code = $code->generate_password();
                        $query1->id_user = (int)$id_user;
                        $id = $query1->save();
                        if(empty($id)){
                            $data['error_reg'] = "Запись не добавленна!!!";
                        }else{
                            header("Location: /regfinish");
                            exit;
                        }
                    }
                }
            }
        }
        /*создания страницы*/
        $this->view->generate('reg_view.php', 'template_view.php', $data);
    }
}
