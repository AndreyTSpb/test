<?php

/* 
 * Завершение восстановления пароля
 */
print_r($data);
if(!isset($error_reg)) $error_reg='';
if(!isset($id_user)) $id_user = '';
?>
<div class='content'>
<h1>Создание нового пароля</h1>
    <div class="reg_form">
        <form method="post" action="">
            <ul>
                <li>
                    <div>
                        <input type="hidden" name = "id_user" value = "<?=$id_user;?>">
                    </div>
                </li>
                <li>
                    <label>Новай пароль:</label>
                    <div>
                        <input type="password" name = 'pass1' required>
                    </div>
                </li>
                <li>
                    <label>Пароль еще раз:</label>
                    <div>
                        <input type='password' name='pass2' required>
                    </div>
                </li>
                <li>
                    <label></label>
                    <div class="button">
                        <input type="submit" name="regFinish1">
                    </div>
                </li>
            </ul>
        </form>
    </div>
    <div class = 'error'>
        <div style = 'background-color: red;'><?=$error_reg;?></div>
    </div>
</div>
