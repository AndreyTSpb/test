<?php
    /**
     * Создаем запрос на выборку
     */
    
    $select = array(
        'where' => 'is_active = 0',
    );
    $new1 = new Model_Tbl_News();
    // insert data
    /*new vall*/
    $new1->is_active = '2';
    /*update */
    $r = $new1->updateQuery($select);
    var_dump($r);
?>
<h1>404</h1>
<p>
<img src="/images/404.png">
</p>
