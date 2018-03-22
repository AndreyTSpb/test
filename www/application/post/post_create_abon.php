<?php
/**
 * 1) Проверка естьли уже запись в этой группе, если есть не создавать
 * 2) Определяем время существования не оплаченного.
 * 3) Разделение по типам : если до 4-го тоодин тип прайса, если с 4-го другой.
 */
require_once '../core/config.php';
require_once 'post_autoload.php';
/**
 * Создание абонемента и прайса
 */
                if(isset($_POST['bay_group'])){
                    global $link;
                    $id_stud    = (int)$_POST['id_stud'];
                    $id_user    = (int)$_POST['id_user'];
                    $id_group   = (int)$_POST['id_group'];
                    $id_subject = (int)$_POST['id_subject'];
                    $id_type    = (int)$_POST['id_type'];
                    /**
                     * Проверка естли уже запись этого пользователя в даной группе,
                     * Если нет создаем абонемент
                     */
                    $qTestAbon = array(
                        "where" => "id_user = '".$id_user."' AND id_stud = '".$id_stud."' AND id_group = '".$id_group."' AND status IN ('0','1','4','5','6')"
                    );
                    $objTestAbon = new Model_Aboniments($qTestAbon);
                    $m = $objTestAbon->getAllRows();
                    if(empty($m)){
                        /*Время действия*/
                        $dt_term = date("21.m.Y", time()); //Граница когда нельзя покупать тек месяц
                        $dt_ext = time() + 86400; //Стандартный время действия +1 сутки от текущего
                        $dt_ext_4 = date("20.m.Y", time());
                        $dt_ext_5 = date("25.m.Y", time());
                        $dt_ext_6 = date("16.m.Y", time());
                        /*получаем текущию цену группы*/
                        $qPrice = array(
                            "where" => "id_group = '".$id_group."'",
                            "order" => "dt DESC",
                            "limit" => "1"
                        );
                        $objPrice = new Model_Group_Prices($qPrice);
                        $masPrice = $objPrice->getOneRow();
                        /**
                         * Разделение по типам групп
                         */
                        /*Формируем за какие месяцы платить*/
                        $price = 0;
                        $p = array();
                        $pm = array();
                        for($i = 1; $i<10; $i++) $p[$i]=0;
                        if($id_type < 4){
                            for($j=1; $j<10; $j++){
                                $a = "p".$j;
                                if($masPrice[$a]>0){
                                    $price +=$masPrice[$a];
                                }
                                $pm[$j] = $masPrice[$a];
                            }
                            if(time() > strtotime($dt_term)){
                                switch (date("n", strtotime($dt_term))){
                                        case 9:
                                            for($i = 1; $i<2; $i++)  $p[$i]=2;
                                            break;
                                        case 10:
                                            for($i = 1; $i<3; $i++)  $p[$i]=2;
                                            break;
                                        case 11:
                                            for($i = 1; $i<4; $i++)  $p[$i]=2;
                                            break;
                                        case 12:
                                            for($i = 1; $i<5; $i++)  $p[$i]=2;
                                            break;
                                        case 1:
                                            for($i = 1; $i<6; $i++)  $p[$i]=2;
                                            break;
                                        case 2:
                                            for($i = 1; $i<7; $i++)  $p[$i]=2;
                                            break;
                                        case 3:
                                            for($i = 1; $i<8; $i++)  $p[$i]=2;
                                            break;
                                        case 4:
                                            for($i = 1; $i<9; $i++)  $p[$i]=2;
                                            break;
                                        case 5:
                                            for($i = 1; $i<10; $i++) $p[$i]=2;
                                            break;
                                    }
                            }else{
                                switch (date("n", strtotime($dt_term))){
                                        case 9:
                                            for($i = 1; $i<2; $i++)  $p[$i]=2;
                                            break;
                                        case 10:
                                            for($i = 1; $i<2; $i++)  $p[$i]=2;
                                            break;
                                        case 11:
                                            for($i = 1; $i<3; $i++)  $p[$i]=2;
                                            break;
                                        case 12:
                                            for($i = 1; $i<4; $i++)  $p[$i]=2;
                                            break;
                                        case 1:
                                            for($i = 1; $i<5; $i++)  $p[$i]=2;
                                            break;
                                        case 2:
                                            for($i = 1; $i<6; $i++)  $p[$i]=2;
                                            break;
                                        case 3:
                                            for($i = 1; $i<7; $i++)  $p[$i]=2;
                                            break;
                                        case 4:
                                            for($i = 1; $i<8; $i++)  $p[$i]=2;
                                            break;
                                        case 5:
                                            for($i = 1; $i<9; $i++)  $p[$i]=2;
                                            break;
                                    }
                            }
                        }elseif ($id_type == 4) {
                            $dt_ext = strtotime($dt_ext_4);
                            $price =  0;
                            $note = 'Стартовая группа';
                            for($z=1; $z<10; $z++) $pm[$z] == 0;
                        }elseif ($id_type == 5) {
                            $dt_ext = strtotime($dt_ext_5);
                            $price =  0;
                            $note = 'Начальная группа';
                            for($z=1; $z<10; $z++) $pm[$z] == 0;
                        }elseif ($id_type == 6) {
                            $dt_ext = strtotime($dt_ext_6);
                            $note = 'Курс!!!';
                            for($z=1; $z<10; $z++) $pm[$z] == 0;
                            $dt_ext = strtotime("30.05.".END_YEAR);
                            $price =  0;
                            for($z=1; $z<10; $z++) $pm[$z] == 0;
                            $note = '?????';
                        }
                        
                        // Создаем abon -сохраним
                        $objAbon = new Model_Aboniments();

                        // задаем значения для полей таблицы<br>
                        $objAbon->id_user    = $id_user;
                        $objAbon->id_stud    = $id_stud;
                        $objAbon->id_group   = $id_group;
                        $objAbon->status     = 0;
                        $objAbon->dt         = time();
                        $objAbon->cost       = $price;
                        $objAbon->discount   = '';
                        $objAbon->dt_ext     = $dt_ext;
                        $objAbon->id_subject = $id_subject;
                        for($k=1; $k<10; $k++){
                            $a ="p".$k;
                            $objAbon->{$a} = $p[$k]; 
                        }
                        $id_abon = $objAbon->save();
                        
                        // Создаем прайс -Сохранение
                        $model = new Model_Aboniment_Price();
                        // задаем значения для полей таблицы<br>
                        $model->id_user = $id_user;
                        $model->id_aboniment = $id_abon.'/abon';
                        $model->dt = time();
                        for($g=1; $g<10; $g++){
                            $a = "p".$g;
                            $model->{$a} = $pm[$g];
                        }
                        $model->cost = $price;
                        $model->note = $note;
                        $result = $model->save(); // создаем запись<br>

                        if(!empty($result)) {    header("Location: /mygroups"); exit; } else {$date['error'] = "error!!!"; header("Location: /mygroups"); exit;}
                    }else{
                        $date['error'] = "error!!!";
                        header("Location: /mygroups"); exit;
                    }
                }

