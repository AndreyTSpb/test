<?php

// подключаем файлы ядра
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/config.php';

spl_autoload_register(function ($className) {
    //echo "IWant Load ". $className; echo '<p>';
    /**
     * Создаем имя файла
     */
    $fileName = strtolower($className).'.php';
    /**
     * Узнаем в какой папке лежит файл
     */
    $expArr = explode('_', $className);
    //print_r($expArr);
    if(empty($expArr[1]) or empty($expArr)){
        $folder = 'application' . DS . 'core';
    }else{
        $filePath = strtolower($expArr[0]);
        switch ($filePath){
            case 'controller':
                $folder = 'application' . DS . 'controllers';
                break;
            case 'model':
                $folder = 'application' . DS . 'models';
                break;
            case 'views':
                $folder = 'application' . DS . 'views';
                break;
        }
    }
    /**
     * Полный путь до файла на сайте
     */
    $file = $folder . DS . $fileName;
    /**
     * проверяем естьли такой файл
     */
    if(!file_exists($file)){
        echo "Not File!!! ". $file;
        exit;
    }
    /**
     * Подключаем файл
     */
    include $file;
    //throw new Exception("Dont load method". $file);
});
/*
Здесь обычно подключаются дополнительные модули, реализующие различный функционал:
	> аутентификацию
	> кеширование
	> работу с формами
	> абстракции для доступа к данным
	> ORM
	> Unit тестирование
	> Benchmarking
	> Работу с изображениями
	> Backup
	> и др.
*/

require_once 'core/route.php';
Route::start(); // запускаем маршрутизатор
