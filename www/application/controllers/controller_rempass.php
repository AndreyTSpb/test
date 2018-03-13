<?php

/*
 * Востановления пароля
 */

/**
 * Description of rempass_controller
 *
 * @author qaz
 */
class Controller_Rempass extends Controller{
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
                 if(isset($_POST['loginLogi']) && isset($_POST['loginEmail'])){
                     $login = htmlspecialchars(trim($_POST['loginLogi']));
                     $email = strtolower(htmlspecialchars(trim($_POST['loginEmail'])));
                     $q = array(
                                'where' => "phone = '".$login."'",
                                'limit' => '1'
                            );
                    $r = new Model_Logins($q);
//                    $m = $r->getOneRow();
//                    print_r($m);exit;
                    $r->fetchOne(); // извлекаем данные<br>
                        // получаем значения столбцов<br>
                    $id_user = $r->id;
                    if(!empty($id_user)){
                        //echo $id_user = $m[1];
                        /**
                         * Генерируем код подтверждения
                         */
                        $code = new Model_Gen_Code;
                        /**
                         * Сохраняем сгенерированый код.
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
                    }else{
                        $data['error_reg'] =  "Неверный Номер телефона!!!";
                    }
                 }else{
                     $data['error_reg'] =  "Неверные данные!!!";
                 }
             }
             /*создания страницы*/
            $this->view->generate('rempass_view.php', 'template_view.php', $data);
        }
}
