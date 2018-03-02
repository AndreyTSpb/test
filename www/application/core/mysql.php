<?php

/*
 * Базовый класс для рабты с MYSQL 
 */

/**
 * Description of mysql
 *
 * @author qaz
 */
abstract class Mysql {
//    function test(){
//        echo 'test';
//    }
    /**
     * Константы
     */
    protected $db; //Сюда отправляем подключение объект к БД
    protected $table; //Таблица
    private $dataResult; // сюда результат выборки
    
    public function fieldsTable() {
        /**
         * массив с полями таблицы
         * перекроим дочерним классом
         */
    }
    
    public function __construct($select = false) {
        /**
         * глобальный подключение к БД
         */
        global $link;
        $this->db = $link;
        /**
         * Имя таблицы получаем из названия класса
         * Имеется введу класс наследник
         */
        $modelName = get_class($this);
        $arrExp = explode('_', $modelName);
        //print_r( $arrExp);
        unset($arrExp[0]);
        $name = implode('_', $arrExp);
        $tableName = strtolower($name); //получили название таблицы
        $this->table = $tableName;
        
        /**
         * обработка запроса
         * Отсылает к запросу ниже
         * если вернется строка, 
         * то запрос выполнять
         */
        if(!empty($select)){
            $sql = $this->_getSelect($select);
            if($sql){
                $this->_getResult("SELECT * FROM " .$this->table . $sql);
            } 
        }
    }
    
    /**
     * Получаем имя таблицы
     * (для отображния где нибуть)
     * возвращает в объект класса имя таблицы
     */
    public function getTableName(){
        return $this->table;
    }
    /**
     * Получить все записи
     * (Отображает в объекте)
     * Если в переменной результат есть данные то вернуть эту переменную.
     */
    public function getAllRow(){
        if(!isset($this->dataResult) OR empty($this->dataResult)) return FALSE;
        return $this->dataResult;
    }
    /*получить одну запись*/
    public function getOneRow() {
        if(!isset($this->dataResult) OR empty($this->dataResult)) return FALSE;
        return $this->dataResult[0];
    }
    /*Получить запись по ID*/
    public function getRowById($id) {
        try{
            $id = (int)$id;
            $db = $this->db;
            $r = $db->query("SELECT * FROM ". $this->table ." WHERE id = '" .$id. "'");
            $m = $r->fetch_assoc();
        } catch (Exception $e){
            echo $e->getMessage();
            exit;
        }
        return $m;
    }
    /**
     * Сохранение записи в Базу Данных
     */
    public function save() {
        /**
         * получаем масив с набором полей таблицы
         */
        $arrayAllFields = array_keys($this->fieldsTable()); //массив с ключами
        $arraySetFields = array();
        $arrayData = array();
        foreach ($arrayAllFields as $field) {
            if(!empty($this->$field)){
                $arraySetFields[] = $field;
                $arrayData[] = $this->field;
            }
        }
        $forQueryFields = implode(',', $arraySetFields);
        $rangePlace = array_fill(0 , count($arraySetFields), '?');
        $forQueryPlace = implode(', ', $rangePlace);
        
        try{
            /**
             * Делаем через подготовленый запрос
             */
            $db = $this->db;
            $smtp = $db->prepare("INSERT INTO '".$this->table."' (".$forQueryFields.") VALUES (".$forQueryPlace.")");
            $res = $smtp->execute($arrayData);
        } catch (Exception $e) {
             echo 'Error: '.$e->getMessage();
             echo '<b> Error sql: '. "INSERT INTO '".$this->table."' (".$forQueryFields.") VALUES (".$forQueryPlace.")";
             exit;
        }
        return $res;
    }
    /**
     * Модуль составления условия запроса к бд
     */
    private function _getSelect($select) {
        if(is_array($select)){
            $allQuery = array_keys($select);
            /**
             * Применяем свою функцию к каждому элемнту массива
             */
            array_walk($allQuery, function(&$val){
                $val = strtoupper($val); //Все к верхнему регистру
            });
            /**
             * начинаем поиск в моссиве ключевых слов
             * WHERE, ORDER, IN итд.
             * чтоб можно было построить условие к запросу
             */
            $querySql = '';
            if(in_array("WHERE", $allQuery)){
                foreach ($select as $key=> $val){
                    if(strtoupper($key) == "WHERE"){
                        $querySql .= " WHERE " . $val;
                    }
                }
            }
            if(in_array("GROUP", $allQuery)){
                foreach ($select as $key=> $val){
                    if(strtoupper($key) == "GROUP"){
                        $querySql .= " GROUP BY " . $val;
                    }
                }
            }
            if(in_array("ORDER", $allQuery)){
                foreach ($select as $key=> $val){
                    if(strtoupper($key) == "ORDER"){
                        $querySql .= " ORDER BY " . $val;
                    }
                }
            }
            if(in_array("LIMIT", $allQuery)){
                foreach ($select as $key=> $val){
                    if(strtoupper($key) == "LIMIT"){
                        $querySql .= " LIMIT " . $val;
                    }
                }
            }
            return $querySql;
        }
        return FALSE;
    }
    
}
