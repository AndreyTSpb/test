<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($data);
if(!isset($error)) $error='';

if(!isset($mybill)) {
    $wait_pay = ''; $true = ''; $false = ''; $balans = 0; $view_balans = '';
}else{
    /**
    * Проверка есть ли что на балансе,
    * Вывести сумму на экран.
    */
    if(isset($mybill['balans']) AND !empty($mybill['balans'])){
        $balans = $mybill['balans'];
    }
    /**
     * Счета которые требуется оплатить
     */
    if(isset($mybill['wait_pay']) AND !empty($mybill['wait_pay'])){
        /**
         * Проверка естьли что на балансе
         */
        $true ='';
        foreach ($mybill['wait_pay'] as $bill){
            if($balans>0){
                $price_now = $bill['price'] - $balans; // сумма к оплате за вычетом баланса
                $balans = $balans - $bill['price']; // остаток по балансу за вычетом цены счета, вез учета баланса.
                if ($price_now < 0) { $price_now = 0;} // если сумма счета вышла меньше нуля, то приравниваем сумму заказа к нулю.
            }else{
                $price_now = $bill['price'];
            }
            if ($balans < 0) $balans = 0; // если баланс отрицателен. приравниваем его к нулю.
            
            $wait_pay .="<div class='bills_block'>"
                        ."<div>"
                            . "<div class=\"bills_number block\">#".$bill['id_bill']."</div>"
                            . "<div class=\"bills_about block\">" . $bill['code'] . " ".$bill['months']."</div>"
                            . "<div class=\"bills_cost block\">" . number_format($price_now, 0, '', ' ') . " <b class=\"rub\">c</b></div>"
                        . "</div>"
                        ."<div><div class=\"bill_link clear_booking\" data-id='".$bill['id_bill']."' id=\"clear_booking_".$bill['id_bill']."\">Снять счет</div></div>"
                    . "</div>";
        }
        $wait_pay .="<hr>";
    }else{
        $wait_pay ='';
    }
    /**
     * Оплаченые счета
     */
    if(isset($mybill['true']) AND !empty($mybill['true'])){
        $true ='';
        foreach ($mybill['true'] as $bill){
            $true .="<div class='bills_block'>"
                        ."<div>"
                            . "<div class=\"bills_number block\">#".$bill['id_bill']."</div>"
                            . "<div class=\"bills_about block\">" . $bill['code'] . " ".$bill['months']."</div>"
                            . "<div class=\"bills_cost block\">" . number_format($bill['price'], 0, '', ' ') . " <b class=\"rub\">c</b></div>"
                            . "<div class=\"bills_date block\">" . $bill['dt'] . "</div>"
                            . "<div class=\"block bills_comment\"><div class=\"block bills_price_ok\">" . $bill['status'] . "</div></div>"
                        . "</div>"
                    . "</div>";
        }
        $true .="<hr>";
    }else{
        $true ='';
    }
    /**
     * Просроченные или отмененные счета
     */
    if(isset($mybill['false']) AND !empty($mybill['false'])){
        $false ='';
        foreach ($mybill['false'] as $bill){
            $false .="<div class='bills_block'>"
                        ."<div>"
                            . "<div class=\"bills_number block\">#".$bill['id_bill']."</div>"
                            . "<div class=\"bills_about block\">" . $bill['code'] . " ".$bill['months']."</div>"
                            . "<div class=\"bills_cost block\">" . number_format($bill['price'], 0, '', ' ') . " <b class=\"rub\">c</b></div>"
                            . "<div class=\"bills_date block\">" . $bill['dt'] . "</div>"
                            . "<div class=\"bills_last block\">" . $bill['status'] . "</div>"
                        . "</div>"
                    . "</div>";
        }
        $false .="<hr>";
    }else{
        $false ='';
    }
    $view_balans = "<div class='balans'>Ваш баланс: ".$balans."</div>";
}
?>
<div class='content'>
    <h1>Мои Счета</h1>
    <div class = 'error'>
        <div style = 'background-color: red;'><?=$error;?></div>
        <?=$view_balans;?>
        <?=$wait_pay;?>
        <?=$true;?>
        <?=$false;?>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.clear_booking').click(function(){
            var id_bill = $(this).data('id');
            //alert(id_bill);
            $.ajax({
                type: 'POST', 
                url: '../application/ajax/cron_bill.php', 
                data: 'id='+id_bill,
                // data: 'id=".$id."',
                beforeSend: function(){ $('.cursor_wait').show(); }, 
                success: function(html){ $('.cursor_wait').hide(); location.pathname='/mybills';}
            });
        });
    });
</script>

