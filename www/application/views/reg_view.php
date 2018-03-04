<?php
/* 
 * Регистрация на сайте
 */
?>

<div class='content'>
<h1>Регистраци На Сайте</h1>
    <div class="reg_form">
        <form method="post" action="">
            <ul>
                <li>
                    <label>E-Mail:</label>
                    <div>
                        <input type="text" name = 'email' required>
                    </div>
                </li>
                <li>
                    <label>Пароль:</label>
                    <div>
                        <input type='password' name='pas1' required>
                    </div>
                </li>
                <li>
                    <label>Подтвердите Пароль:</label>
                    <div>
                        <input type='password' name='pas2' required>
                    </div>
                </li>
                <li>
                    <label></label>
                    <div class="button">
                        <input type="submit" name="regSub">
                    </div>
                </li>
            </ul>
        </form>
    </div>
    <div class = 'error'>
        <div style = 'background-color: red;'><?=$error_reg;?></div>
    </div>
</div>