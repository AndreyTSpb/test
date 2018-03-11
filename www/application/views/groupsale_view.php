<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$day = array(
    '1'=>'Пн',
    "2"=>'Вт',
    '3'=>'Ср',
    '4'=>'Чт',
    '5'=>'Пт',
    '6'=>'Сб',
    '7'=>'Вс'
);
    $block_sale ='';
    if(!empty($data['content'])){
        foreach($data['content'] as $val){
            $id_group = $val[0];
            $code = $val[1];
            $id_subject = $val[2];
            $id_class = $val[3];
            $id_location = $val[4];
            $id_type = $val[5];
            $max_users = $val[7];
            $day_1 = $val[13];
            $day_2 = $val[14];
            $days = $day[$day_1];
            if(!empty($day_2)){
                $days = $day[$day_1] ." и ".$day[$day_1];
            }
            $block_sale .= "<div class='select_group'>
                                <div>$code</div>
                                <div>$id_subject</div>
                                <div>$days</div>
                                <div>Teach</div>
                                <div>$max_users</div>
                                <div class ='check_block'><input type = 'checkbox' name = 'block_id' value = '".$id_group."'></div>
                            </div>";
        }
    }
?>
<div class="sale">
    <div class="for_block_price"></div>
    <?=$block_sale;?>
</div>
<div class="map">
    <?php include 'application/views/maps_view.php';?>
</div>
<!-- Отключаем не отмеченные чекбоксы -->
<!-- Выводим блок с ценой и оплатой-->
<script>
    $(document).ready(function(){
        var $checkbox = $('input[type=checkbox]');
        $checkbox.click(function(){
            //alert($(this).val());
            //Удаляем галки у всех других чекбоксов кроме выбраного
            $checkbox.filter(':checked').not(this).removeAttr('checked');
            //$('input[name=id_group]').val($(this).val());
            $.ajax({
                type: 'POST',
                url: '../application/ajax/ajax_group.php',
                //data: 'id_group = ' + $(this).val(),
                data: 'id='+$(this).val(),
                success: function (rere){
                    $('.for_block_price').html(rere);
                }
            });
        });
    });
</script>

