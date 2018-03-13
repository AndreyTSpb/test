<?php

/* 
 * Востановление пороля
 */
if(!isset($error_reg)) $error_reg='';
?>
<div class='content'>
<h1>Восстановление Пороля</h1>
<div class='login_form'>
    <form method="post" action="">
        <ul>
            <li>
                <label>Телефон:</label>
                <div>
                    <input type='text' name="loginLogi" required>
                </div>
            </li>
            <li>
                <label>E-Mail:</label>
                <div>
                    <input type="text" name="loginEmail" required>
                </div>
            </li>
            <li>
                <div>
                    <input type="submit" name="loginSub" value="Войти">
                </div>
            </li>
        </ul>
    </form>
</div>
<div class = 'error'>
    <div style = 'background-color: red;'><?=$error_reg;?></div>
</div>
<div calss='rememperRegistr'>
    <div>
        <a href="/reg">Зарегистрироваться!!!</a>
    </div>
</div>
</div>