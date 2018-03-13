<?php
/**
 * Переписка
 */
//print_r($data);
if(!isset($error_login)) $error_login='';
$messeg = '';
foreach ($messags as $item){
    $messeg .="<div class = 'messag_head'> <div>От кого</div><div>".$item['dt']."</div></div>
                <div class = 'body_message'>".$item['text']."</div><hr>";
}
?>
<div class='content'>
    <h1>Мои сообщения</h1>
    <div class='login_form'>
        <?=$messeg;?>
    </div>
</div>
