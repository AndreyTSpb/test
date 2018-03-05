<?php
if(!empty($data)){
    extract($data);
}
if(!isset($enter)){
    $enter = '';
}
/* 
 * Меню входа на сайт
 */
?>
<div class='enter'>
    <?php if($enter === 'active'){?>
    <div>
        <a href="/logoff">Выход</a>
    </div>
    <?php }else{?>
    <div>
        <a href="/login">Вход</a> / <a href="/reg">Регистрация</a>
    </div>
    <?php }?>
</div>

