<?php
// отказ от занятий.
    require_once '../core/config.php';
    global $link;
        $id_abon = (int)$_POST['id'];
        $id_user = (int)$_COOKIE['id_user'];
        $sql_abon = "update aboniments set status = '3' where  id_user='".$id_user."' and id='".$id_abon."'";
        $sql_log = " insert into log_users (id_user, id_stud, dt, type, info, cost, log_type) VALUES ('".$id_user."', '0','".time()."', '0', 'Отказ от абонемента".$id_abon."', '0', '0')";
        $r = $link->query($sql_abon);
        if($r){ $link->query($sql_log);}
            
