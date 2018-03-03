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
}
$link->query("SET NAMES utf8");

// Соединяемся с БД
$dbObject = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);