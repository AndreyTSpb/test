<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $link;
/*функция выбора типа групп на площадке*/
    function location_type($id_location, $id_subject){
        global $link;
        $sql="select id_type from groups where active='1' and id_location='".$id_location."' and id_subject='".$id_subject."' group by id_type";
        $r=$link->query($sql);
        $type='<ul>';
        while ($m=$r->fetch_assoc()) {
            if ($m['id_type'] == '1') {
                $type .= "<li><span style=\"color: green; font-weight: bold;\">Олимпиадная группа</span></li>";
            }
            if ($m['id_type'] == '2') {
                $type .= "<li><a href=\" /groupsale/selectgroups?l=" . $id_location . "&s=".$id_subject."&t=2 \">Малая группа</a></li>";
            }
            if ($m['id_type'] == '3') {
                $type .= "<li><a href=\" /groupsale/selectgroups?l=" . $id_location . "&s=".$id_subject."&t=3 \">Интенсивная группа</a></li>";
            }
            if ($m['id_type'] == '4') {
                $type .= "<li><a href=\" /groupsale/selectgroups?l=" . $id_location . "&s=".$id_subject."&amp;t=4 \">Стартовая группа</a></li>";
            }
            if ($m['id_type'] == '5') {
                $type .= "<li><a href=\" /groupsale/selectgroups?l=" . $id_location . "&s=".$id_subject."&amp;t=5 \">Начальная группа</a></li>";
            }
            if ($m['id_type'] == '6') {
                $type .= "<li><a href=\" /groupsale/selectgroups?i=" . $id_location . "&s=".$id_subject."&amp;t=6 \"><span style=\"color: green; font-weight: bold;\">Курсы</span></a></li>";
            }
        }
        $type .='</ul>';
        return $type;
    }
/*функция выбора предметов на площадке*/
    function location_subject($id_location){
        global $link;
        $sql2="select id_subject from groups WHERE active='1' and id_location='".$id_location."'  group by id_subject";
        $r=$link->query($sql2);
        $pred = '<ul>';
        while($m=$r->fetch_assoc()) {
            if ($m['id_subject'] == '1') {
                $pred .= "<li><a href=\" /groupsale/selectgroups?l=" . $id_location . "&amp;s=1 \">Математика</a>" . location_type($id_location, '1') . "</li>";
            }
            if ($m['id_subject'] == '3') {
                $pred .= "<li><a href=\" /groupsale/selectgroups?l=" . $id_location . "&amp;s=3 \">Физика</a>" . location_type($id_location, '3') . "</li>";
            }
            if ($m['id_subject'] == '5') {
                $pred .= "<li><a href=\" /groupsale/selectgroups?l=" . $id_location . "&amp;s=5 \">Программирование</a>" . location_type($id_location, '5') . "</li>";
            }
        }
        $pred .='</ul>';
        return $pred;
    }
    
    $sql2="select * FROM id_location where del='0' ORDER BY name ASC";
    $r = $link->query($sql2);
    $collection='';
    $adres='';
    for ($i=0; $i<$r->num_rows; $i++)
    {
        $m = $r->fetch_assoc();
        $x[]=$m['x']; $y[]=$m['y'];
        $name=str_replace('"',' ',$m['name']);
        $name .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"/maps1/#location_".$m['id']."\">Как нас найти</a>";
        $adres ="<a href=\" /groupsale/selectgroups?l=".$m['id']." \">".$m['adress']."</a><br>".location_subject($m['id'])."<br>";

        $collection .="var myPlacemark = new YMaps.Placemark(new YMaps.GeoPoint(".$m['y'].", ".$m['x']."), {style: styleG }); 
                        myPlacemark.name = '".$name."'; 
                        myPlacemark.description = '".$adres."';
                        map.addOverlay(myPlacemark);
                        ";
    }

?>
<div id="YMapsID" style="width:100%; height:400px;"></div><div class="clearfix"></div>
           <script type="text/javascript">
                // Создает обработчик события window.onLoad
                YMaps.jQuery(function () {
                    // Создает экземпляр карты и привязывает его к созданному контейнеру
                    var map = new YMaps.Map(YMaps.jQuery("#YMapsID")[0]);
                    // Устанавливает начальные параметры отображения карты: центр карты и коэффициент масштабирования
                    map.setCenter(new YMaps.GeoPoint(30.19, 59.95), 10);
                    // Создает элемент масштабирования
                    map.addControl(new YMaps.Zoom());
                    //Набор меток
                    // Создает базовый стиль для значка
                    var baseStyle = new YMaps.Style();
                    baseStyle.iconStyle = new YMaps.IconStyle();
                    baseStyle.iconStyle.offset = new YMaps.Point(-13, -35);
                    baseStyle.iconStyle.size = new YMaps.Point(50, 50);
                    // Стиль значка  наследует признаки базового стиля
                    var styleG = new YMaps.Style(baseStyle);
                    styleG.iconStyle = new YMaps.IconStyle();
                    styleG.iconStyle.href = "../images/map-marker-red.png ";
                    <?=$collection;?>
                    })
            </script>
