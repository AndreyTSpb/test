<?php
require_once '../core/config.php';
global $link;
/* 
 * проверка на свободные места и вывод цены
 * 1) проверить на свободные места.
 * 2) если есть посчитать стоимость и выдать сообщение с ценой
 * 3) если нет свободных мест сказать об этом
 */
/**
 * переменные переданные пост запросом.
 */
$id_group = (int)$_POST['id'];
$id_stud = (int)$_POST['id_stud'];
$id_user = (int)$_POST['id_user'];
/*Получаем макс кол учеников*/
$sql = "SELECT max_users, id_subject FROM groups WHERE id = '".$id_group."'";
$r = $link->query($sql);
$m = $r->fetch_assoc();
$max_users  = $m['max_users'];
$id_subject = $m['id_subject'];
/*получаем текущию цену группы*/
$sql1 = "SELECT * FROM group_prices WHERE id_group = '".$id_group."' ORDER BY dt DESC LIMIT 1";
$r1 = $link->query($sql1);
$m1 = $r1->fetch_assoc();
$price = 0;
for($i=1; $i<10; $i++){
    $a = "p".$i;
    if($m1[$a]>0){
        $price +=$m1[$a];
    }
}
/*Считаем кол-во купленых и забронированых*/
if(isset($id_group)){
    if(empty($id_group)){
        $rez = "<div class='error'>NOt this group</div>";
    }else{
        if(empty($max_users)){
            $rez = "<div class='error'>Свободных мест нет!!!</div>";
        }elseif($max_users>0){
            $rez = '<div>Price</div>
            <div>
                <div class="price_hold">
                    <p>'.$price.'</p>
                </div>
                <form method = "post" active="">
                    <input type="hidden" name = "subject"   value = "'.$id_subject.'">
                    <input type="hidden" name = "id_stud"   value = "'.$id_stud.'">
                    <input type="hidden" name = "id_user"   value = "'.$id_user.'">
                    <input type="hidden" name = "id_group"  value = "'.$id_group.'">
                    <input type="submit" name = "bay_group" value = "Купить">
                </form>
            </div>';
        }
    }
}else{
    $rez = "<div class='error'>Ничего не выбрано!!!</div>";
}
$rez1 ='<div class="block_price">'.$rez.'</div>';
echo $rez1;