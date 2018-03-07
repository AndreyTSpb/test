<?php

/* 
 * проверка на свободные места и вывод цены
 * 1) проверить на свободные места.
 * 2) если есть посчитать стоимость и выдать сообщение с ценой
 * 3) если нет свободных мест сказать об этом
 */


/*тестовый массив с местами*/
$groups = array(
    '0' => array(
        'place' => '0',
        'price'=> '100'
    ),
    '1' => array(
        'place' => '1',
        'price'=> '110'
    ),
    '2' => array(
        'place' => '2',
        'price'=> '120'
    ),
    '3' => array(
        'place' => '20',
        'price'=> '10'
    ),
    '4' => array(
        'place' => '10',
        'price'=> '20'
    ),
    '5' => array(
        'place' => '0',
        'price'=> '200'
    ),
);

/**
 * переменные переданные пост запросом.
 */
$id_group = $_POST['id'];

if(isset($_POST['id'])){
    if(!array_key_exists($id_group, $groups)){
        $rez = "<div class='error'>NOt this group</div>";
    }else{
            $price = $groups[$id_group]['price'];
            $place = $groups[$id_group]['place'];
        if(empty($place)){
            $rez = "<div class='error'>Свободных мест нет!!!</div>";
        }elseif($place>0){
            $rez = '<div>Price</div>
            <div>
                <div class="price_hold">
                    <p>'.$price.'</p>
                </div>
                <form>
                    <input type="hidden" name = "id_group" value="'.$id_group.'">
                    <input type="submit" name ="bey_group" value="Купить">
                </form>
            </div>';
        }
    }
}else{
    $rez = "<div class='error'>Ничего не выбрано!!!</div>";
}
echo $rez;