<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class='content'>
<h1>Войти В ЛК</h1>
<div class='login_form'>
    <form method="post">
        <ul>
            <li>
                <label>Login:</label>
                <div>
                    <input type='text' name="loginLogi">
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
<div calss='rememperRegistr'>
    <div>
        <a href='/rempass'>Забыли пароль?</a>
    </div>
    <hr>
    <div>
        <a href="/regsite">Зарегистрироваться!!!</a>
    </div>
</div>
</div>
