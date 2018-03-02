<?php
    /**
     * Создаем запрос на выборку
     */
    $select = array(
        'order' => 'id DESC'
    );
    $new = new Model_Tbl_News($select);
    $tabName = $new->getTableName();
    /*select all row*/
    $allRow = $new->getAllRows();
    $row_table = '';
    foreach ($allRow as $row){
        $str = implode(" ", $row);
        $row_table .= "<p>".$str."</p>";
    }
    /*select id */
    $arr = $new->getRowById('1');
    $str_arr = implode('_', $arr);
    
    $select = array(
        'where' => 'id = 11 AND is_active = 1',
    );
    $new1 = new Model_Tbl_News($select);
    // insert data
    echo "<pre>";
    print_r( $new1->fetchOne());
    echo "</pre>";
    /*new vall*/
    $new1->is_active = '0';
    /*update */
    $r = $new1->update();
    var_dump($r);
?>
<h1>404</h1>
<p>
<img src="/images/404.png">
<p> table name: <?=$tabName;?> </p>
<p> select row to id: <?=$str_arr;?> </p>
<p> all row to table: <?=$row_table;?> </p>
</p>
