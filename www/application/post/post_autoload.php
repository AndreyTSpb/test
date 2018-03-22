<?php
spl_autoload_register(function ($class_name) {
    $fileName = strtolower($class_name).'.php';
    /**
     * Узнаем в какой папке лежит файл
     */
    $expArr = explode('_', $class_name);
    //print_r($expArr);
    if(empty($expArr[1]) or empty($expArr)){
        $folder = '../core/';
    }else{
        $folder = '../models/';
    }
    if(!empty($class_name)) include $folder.$fileName;
});

