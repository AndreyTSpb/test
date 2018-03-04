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
        //print_r($select); 
        if(!empty($select)){
            $sql = $this->_getSelect($select);
            if($sql){
                $this->dataResult = $this->_getResult("SELECT * FROM " .$this->table . $sql);
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
    public function getAllRows(){
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
     * Извлеч из выборки dateResult одну запись
     */
    public function fetchOne() {
        if(!isset($this->dataResult) OR empty($this->dataResult)) return FALSE;
        foreach ($this->dataResult[0] as $key => $val) {
            $this->$key = $val;
        }
        return $this->dataResult[0];
    }
    /**
     * Сохранение записи в Базу Данных
     */
    // запись в базу данных
    public function save() {
        global $dbObject;
        $arrayAllFields = array_keys($this->fieldsTable());
        $arraySetFields = array();
        $arrayData = array();
        foreach($arrayAllFields as $field){
            if(!empty($this->$field)){
                $arraySetFields[] = $field;
                $arrayData[] = $this->$field;
            }
        }
        $forQueryFields =  implode(', ', $arraySetFields);
        $rangePlace = array_fill(0, count($arraySetFields), '?');
        $forQueryPlace = implode(', ', $rangePlace);
         
        try {
            $stmt = $dbObject->prepare("INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)");  
            $stmt->execute($arrayData);
            $id = $dbObject->lastInsertId();
        }catch(PDOException $e){
            echo 'Error : '.$e->getMessage();
            echo '<br/>Error sql : ' . "'INSERT INTO $this->table ($forQueryFields) values ($forQueryPlace)'"; 
            exit();
        }
         
        return $id;
    }
    public function save1() {
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
        echo $forQueryFields = trim(implode(', ', $arraySetFields));
        echo $rangePlace = array_fill(0 , count($arraySetFields), '?');
        echo $forQueryPlace = trim(implode(', ', $rangePlace));
        
        try{
            /**
             * Делаем через подготовленый запрос
             */
            echo $sql = "INSERT INTO ".$this->table."(".$forQueryFields.") VALUES (".$forQueryPlace.");";
            $db = $this->db;
            $smtp = $db->stmt_init();
            if ($smtp->errno) { 
                throw new \Exception('Ошибка1 в SQL-запросе!'); 
            } 
            $smtp->prepare($sql);
            if ($smtp->errno) { 
                throw new \Exception('Ошибка2 в SQL-запросе!'); 
            }
            $test = " test, tesr";
            $smtp->bind_param('ss',$test );
            $res = $smtp->execute();
            if ($smtp->errno) { 
                throw new \Exception('Ошибка3 в SQL-запросе!'); 
            }
            $smtp->close();
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
            //print_r($allQuery);
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
    /*
     * Выполнение запроса к БД,
     * Метод закрытый
     */
    private function _getResult($sql) {
        try{
            $db = $this->db;
            $r = $db->query($sql);
            $m = $r->fetch_all();
        } catch (Exception $e) {
            echo 'Error: '.$e->getMessage();
            exit;
        }
        return $m;
    }
    /**
     * удаление из БД по условию
     */
    public function deleteBySelect($select) {
        $sql = $this->_getSelect($select);
        try{
            $db = $this->db;
            $r = $db->query("DELETE FROM " . $this->table ." ".$sql);
        } catch (Exception $e) {
            echo 'Error: '. $e->getMessage();
            echo '<b> Error sql: '. "DELETE FROM " . $this->table ." ".$sql;
            exit;
        }
    }
    /**
     * удаление строки по ее id
     */
    public function deleteRow($id){
        /**
         * Проверка есть ли в данной таблице поле ID 
         */
        $arrayAllField = array_keys($this->fieldsTable());
        array_walk($arrayAllField, function(&$val){ 
            $val = strtoupper($val);
        });
        if(in_array('ID', $arrayAllField)){
            /*Если есть ID удаляем*/
            try{
                $db = $this->db;
                $r = $db->query("DELETE FROM ".$this->table." WHERE id = '".$id."'");
            } catch (Exception $e) {
                echo 'Error: '. $e->getMessage();
                echo '<b> Error sql: '. "DELETE FROM ".$this->table." WHERE id = '".$id."'";
                exit;
            }
        }else{
            echo "ID table ".$this->table." not found!!!";
            exit;
        }
        return $r;
    }
    /**
     * обновление записи по ID
     */
    public function update() {
        /**
         * Проверка есть ли в данной таблице поле ID 
         */
        $arrayAllField = array_keys($this->fieldsTable()); // масив с полями таблицы
        $arrayForSet = array(); //массив для параметров которые меняем
        foreach ($arrayAllField as $field){
            if(isset($this->$field)){
                if(strtoupper($field) != 'ID'){
                    $arrayForSet[] = $field . " = '" . $this->$field . "'";
                }  
                $whereId = $this->dataResult[0][0];
            }
        }
        /**
         * Проверка заполнениых массивов с полями и значениями таблицы
         */
        if(!isset($arrayForSet) OR empty($arrayForSet)){
            echo " Array data table " .$this->table. " not found";
            exit;
        }
        if(!isset($whereId) OR empty($whereId)){
            echo "ID table ".$this->table." not found";
            exit;
        }
        /**
         * в строку превращаем массив с параметрами
         */
        $strForSet = implode(', ', $arrayForSet);
        
        try{
            $sql = "UPDATE ".$this->table." SET ".$strForSet." WHERE id = '".$whereId."'";
            $db = $this->db;
            $r = $db->query($sql);
        } catch (Exception $e) {
            echo 'Error: '. $e->getMessage();
            echo '<b> Error sql: '. "UPDATE ".$this->table." SET ".$strForSet." WHERE id = '".$whereId."'";
            exit;
        }
        return $r;
    }
    /**
     * Надо сделать UPDATE через условие.
     *
     */
    public function updateQuery($select) {
        $strQuery = $this->_getSelect($select);
        /**
         * Проверка есть ли в данной таблице поле ID 
         */
        $arrayAllField = array_keys($this->fieldsTable()); // масив с полями таблицы
        $arrayForSet = array(); //массив для параметров которые меняем
        foreach ($arrayAllField as $field){
            if(isset($this->$field)){
                if(strtoupper($field) != 'ID'){
                    $arrayForSet[] = $field . " = '" . $this->$field . "'";
                }
            }
        }
        /**
         * Проверка заполнениых массивов с полями и значениями таблицы
         */
        if(!isset($arrayForSet) OR empty($arrayForSet)){
            echo " Array data table " .$this->table. " not found";
            exit;
        }
        /**
         * в строку превращаем массив с параметрами
         */
        $strForSet = implode(', ', $arrayForSet);
        try{
            $sql = "UPDATE ".$this->table." SET ".$strForSet." ".$strQuery."";
            $db = $this->db;
            $r = $db->query($sql);
        } catch (Exception $e) {
            echo 'Error: '. $e->getMessage();
            echo '<b> Error sql: '. "UPDATE ".$this->table." SET ".$strForSet." ".$strQuery."'";
            exit;
        }
        return $r;
    }
}
