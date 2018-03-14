<?php

//print_r($data);
if(!isset($error)) $error='';
$groups = '';
foreach ($arr_group as $item){
    $groups .="<div class = 'messag_head'> <div>От кого</div><div>".$item['dt']."</div></div>
                <div class = 'body_message'>".$item['text']."</div><hr>";
}
?>
<div class='content'>
    <h1>Мои Группы</h1>
    <div class = 'error'>
        <div style = 'background-color: red;'><?=$error;?></div>
    </div>
    <div class='login_form'>
        <?=$groups;?>
    </div>
</div>

