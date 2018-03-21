<?php
    // отказ от занятий.
    require_once '../core/config.php';
    global $link;
        $id_bill = (int)$_POST['id'];
        //$id_bill=9227;
        $q = "SELECT id_user, aboniment, month FROM bill WHERE id = '".$id_bill."'";
        $r = $link->query($q);
        $m = $r ->fetch_assoc();
        if(!empty($m)){
            $id_user = (int)$m['id_user'];
            $id_abon = trim($m['aboniment'], "/abon");
            $month = explode(" ", trim($m['month']));
            $sql_log = " insert into log_users (id_user, id_stud, dt, type, info, cost, log_type) VALUES ('".$id_user."', '0','".time()."', '0', 'Отказ от счета".$id_bill."', '0', '0')";
            $sql_bill = "update bill set status='3' where id = '".$id_bill."' AND status='0' and id_user='".$id_user."' and aboniment='".$id_abon."/abon'";
            $r1 = $link->query($sql_bill);
            if($r1){
                 if(!empty($month) AND is_array($month)){
                    $months = '';
                    foreach ($month as $val){
                        $months .= $val."='0', ";
                    }
                    $months1 = trim($months, ', ');
                    $sql_abon = "update aboniments set ".$months1." where  id_user='".$id_user."' and id='".$id_abon."'";
                    $r2 = $link->query($sql_abon);
                }
                if($r2){
                    $link->query($sql_log);
                }
            }
        }
        