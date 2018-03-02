<?php

/* 
 * Файл для хранения констант и строки подключения
 */

/*Константы*/
define('DS', DIRECTORY_SEPARATOR); /*Разделитель путей*/
$sitePath = realpath(dirname(__FILE__) . DS);
define('SITE_PATH', $sitePath);/*Путь ккорневой папке*/
/*Подключения к БД*/
define('DB_USER', 'root');/*Логин*/
define('DB_PASS', '');/*Пароль*/
define('DB_HOST', 'localhost');/*Сервер*/
define('DB_NAME', 'mvc');/*Имя БД*/
/*Строка подключения*/
$link = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if($link->connect_errno){
    echo'ERROR CONNECT TO DB' . $link->connect_error;
}else{
    echo 'Connect to DB!!!';
}
$link->query("SET NAMES utf8");
$r=$link->query("SELECT * FROM tbl_news WHERE id = '1'");
$m = $r->fetch_assoc();
$str_arr = implode('_', $m);
echo $str_arr;