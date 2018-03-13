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
                                'where' => "phone = '".$login."'",
                                'limit' => '1'
                            );
                            // print_r($select);
                            $user_inf = new Model_Logins($select);
                            $user_inf->fetchOne();
                            $id_user = $user_inf->id;
                            $pas = $user_inf->password;
                            $active = $user_inf->active;
                            
                            $select = array(); /*Зачистка масива на всяк случай*/
                            
                            /*Получаем проверочный код из таблицы Active_Code*/
                            $select = array(
                                'where'=>"id_user ='".$id_user."'",
                                'order'=>'dt DESC',
                                'limit'=>'1'
                            );
                            //print_r($select);
                            $code_cont = new Model_Active_Code($select);
                            $codeCon = $code_cont->getOneRow();
                            //print_r($codeCon); exit;
                            /**
                             * Если пользователь был уже активирован значит сейчас восстановление пороля, 
                             * если нет то просто активация
                             * Если введеный код и код из бд совпали переходим на авторизацию
                             * 
                             */
                            if($code === $codeCon[1] AND $active == 0 ){
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
                                $data['enter'] = $this->check($login, md5($password));
//                            print_r($data['enter']); exit;
                            
                                if($data['enter'] === 'not_active'){
                                    header ("Location: /regfinish");
                                    exit;
                                }elseif($data['enter'] === 'active'){
                                    header ("Location: /");
                                    exit;
                                }
                            }elseif($code === $codeCon[1] AND $active == 1){
                                $data['id_user'] = $id_user;
                                $this->view->generate('rempassfinish_view.php', 'template_view.php', $data);
                                exit;
                            }else{
                                $data['error_reg'] =  "Неверный Код!!!";
                            }
                    }
             }
             /**
              * Сохранение нового пароля.
              */
             if(isset($_POST['regFinish1'])){
                 $password = htmlspecialchars(trim($_POST['pass1']));
                 $pas_con = htmlspecialchars(trim($_POST['pass2']));
                 $id_user = (int)$_POST['id_user'];
                if($password != $pas_con){
                    $data['error_reg'] = "Пароли не совпадают!!!";
                }else{
                    $up = array(
                                    "where"=>"id = '".$id_user."'"
                                );
                    $user_update = new Model_Logins($up);
                    // извлекаем данные
                    $user_update->fetchOne();
                    // задаем новые значения
                    $user_update->password = md5($password);
                    $login = $user_update->phone;
                    // обновляем запись
                    $user_update->update();
                    if(empty($id_user)){
                        $data['error_reg'] = "Запись не добавленна!!!";
                    }else{
                        $data['enter'] = $this->check($login, md5($password));
//                            print_r($data['enter']); exit;
                            
                        if($data['enter'] === 'not_active'){
                            header ("Location: /regfinish");
                            exit;
                        }elseif($data['enter'] === 'active'){
                            header ("Location: /");
                            exit;
                        }
                    }
                }
             }
             /*создания страницы*/
            $this->view->generate('regfinish_view.php', 'template_view.php', $data);
    }
}
