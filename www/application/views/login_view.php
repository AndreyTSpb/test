<?php
    if(!isset($error_login)) $error_login='';
?>
<div class='content'>
<h1>Войти В ЛК</h1>
<div class='login_form'>
    <form method="post" action="">
        <ul>
            <li>
                <label>Login:</label>
                <div>
                    <input type='text' name="loginLogi" required>
                </div>
            </li>
            <li>
                <label>Password:</label>
                <div>
                    <input type="password" name="loginPass" required>
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
    <div style = 'background-color: red;'><?=$error_login;?></div>
</div>
<div calss='rememperRegistr'>
    <div>
        <a href='/rempass'>Забыли пароль?</a>
    </div>
    <hr>
    <div>
        <a href="/reg">Зарегистрироваться!!!</a>
    </div>
</div>
</div>
