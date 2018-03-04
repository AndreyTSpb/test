<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<div class='content'>
<h1>Завершение регистрации на Сайте</h1>
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
                    <label>Код Подтверждения:</label>
                    <div>
                        <input type='text' name='code' required>
                    </div>
                </li>
                <li>
                    <label></label>
                    <div class="button">
                        <input type="submit" name="regFinish">
                    </div>
                </li>
            </ul>
        </form>
    </div>
    <div class = 'error'>
        <div style = 'background-color: red;'><?=$error_reg;?></div>
    </div>
</div>
