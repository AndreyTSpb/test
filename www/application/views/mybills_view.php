<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
print_r($data);
if(!isset($error)) $error='';
if(!isset($mybill)) {
    $wait_pay = ''; $true = ''; $false = '';
}else{
    /**
     * Счета которые требуется оплатить
     */
    if(isset($mybill['wait_pay']) AND !empty($mybill['wait_pay'])){
        $true ='';
        foreach ($mybill['wait_pay'] as $bill){
            $wait_pay .="<div class='bills_block'>"
                        ."<div>"
                            . "<div class=\"bills_number block\">#".$bill['id_bill']."</div>"
                            . "<div class=\"bills_about block\">" . $bill['code'] . " ".$bill['months']."</div>"
                            . "<div class=\"bills_cost block\">" . number_format($bill['price'], 0, '', ' ') . " <b class=\"rub\">c</b></div>"
                        . "</div>"
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
}
?>
<div class='content'>
    <h1>Мои Счета</h1>
    <div class = 'error'>
        <div style = 'background-color: red;'><?=$error;?></div>
        <?=$wait_pay;?>
        <?=$true;?>
        <?=$false;?>
    </div>
</div>

