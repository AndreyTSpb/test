<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $block_sale ='';
    for($i=0; $i<6; $i++){
        $block_sale .= "<div>
                            <div>Name</div>
                            <div>Subject</div>
                            <div>Day</div>
                            <div>Teach</div>
                            <div>FreePlace</div>
                            <div class ='check_block'><input type = 'checkbox' name = 'block_id' value = '".$i."'></div>
                        </div>";
    }
?>
<div class="sale">
    <div class="block_price">
        
    </div>
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
                url: 'application/ajax/ajax_group.php',
                //data: 'id_group = ' + $(this).val(),
                data: 'id='+$(this).val(),
                success: function (rere){
                    $('.block_price').html(rere);
                }
            });
        });
    });
</script>

