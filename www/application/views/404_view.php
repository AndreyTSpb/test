<?php
    $new = new Model_Tbl_News();
    $tabName = $new->getTableName();
    $arr = $new->getRowById('1');
    $str_arr = implode('_', $arr);
    $allRow = $new->getAllRow();
    foreach ($allRow as $row){
        $str = implode(" ", $row);
        $row_table = "<p>".$str."</p>";
    }
?>
<h1>404</h1>
<p>
<img src="/images/404.png">
<p> table name: <?=$tabName;?> </p>
<p> select row to id: <?=$str_arr;?> </p>
<p> all row to table: <?=$row_table;?> </p>
</p>
