<?php

/*
 * Завершение регистрации
 * обработка проверки кода активации
 */

/**
*  Сначала выбираем айди и пароль пользователя из БД
*  Потом выбираем и сравниваем код подтверждения
*  Если все верно отмечаем что активирован пользователь.
 * проводим авторизацию и пребрасываем на главную 
*/

/**
 * Description of controller_reg-finish
 *
 * @author Андрей
 */
class Controller_RegFinish extends Controller{
    function action_index() {
        $data['error_reg'] = '';
        if(isset($_POST['regFinish'])){
                 if(isset($_POST['email']) && isset($_POST['code']))
                    {
                            $login = htmlspecialchars(trim($_POST['email']));
                            $code = htmlspecialchars(trim($_POST['code']));
                            /*Получаем инфу о пользоватили из таблицы Logins*/
                            $select = array(
                                'where' => "login = '".$login."'",
                                'limit' => '1'
                            );
                            $user_inf = new Model_Logins($select);
                            $user = $user_inf->getOneRow();
                            $id_user = $user[0];
                            $pas = $user[2];
                            
                            $select = array(); /*Зачистка масива на всяк случай*/
                            
                            /*Получаем проверочный код из таблицы Active_Code*/
                            $select = array(
                                'where'=>"id_user ='".$id_user."'",
                                'order'=>'dt DESC',
                                'limit'=>'1'
                            );
                            $code_cont = new Model_Active_Code($select);
                            $codeCon = $code_cont->getOneRow();
//                            print_r($codeCon); exit;
                            /**
                             * Если введеный код и код из бд совпали переходим на авторизацию
                             */
                            if($code === $codeCon[1]){
                                $up = array(
                                    "where"=>"id = '".$id_user."'"
                                );
                                $user_update = new Model_Logins($up);
                                // извлекаем данные
                                $user_update->fetchOne();
                                // задаем новые значения
                                $user_update->active = 1;
                                // обновляем запись
                                $user_update->update();
                                $data = $this->check($login, $pas);
                                header ("Location: /");
                                exit;
                            }else{
                                $data['error_reg'] =  "Неверный Код!!!";
                            }
                    }
             }
             /*создания страницы*/
            $this->view->generate('regfinish_view.php', 'template_view.php', $data);
    }
}
