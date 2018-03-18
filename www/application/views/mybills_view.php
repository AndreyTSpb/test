<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_r($data);
if(!isset($error)) $error='';
if(!isset($mybill)) {
    $true = ''; $false = '';
}else{
    if(isset($mybill['true'])){
        print_r($mybill['true']);
        foreach ($mybill['true'] as $bill){
            $true .="<div>"
                        ."<div>"
                            . "<div class=\"bills_number block\">#".$bill['id_bill']."</div>"
                            . "<div class=\"bills_about block\">" . $bill['code'] . " ".$bill['months']."</div>"
                            . "<div class=\"bills_cost block\">" . number_format($bill['price'], 0, '', ' ') . " <b class=\"rub\">c</b></div>"
                        . "</div>"
                    . "</div>";
        }
        $true .="<hr>";
    }
}
?>
<div class='content'>
    <h1>Мои Счета</h1>
    <div class = 'error'>
        <div style = 'background-color: red;'><?=$error;?></div>
        <?=$true;?>
    </div>
</div>

