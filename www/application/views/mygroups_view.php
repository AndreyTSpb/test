<?php

//print_r($data);
if(!isset($error)) $error='';
$mygroup = '';
foreach ($mygroups as $id_stud => $vals){
    $abons ='';
    $name ='';
    if(!empty($vals) AND is_array($vals)){
        $name = $vals['name'];
        if(is_array($vals['groups'])){
             $code = '';
             $id_abon = '';
             $id_group = '';
             foreach ($vals['groups'] as $arr_group){
                 $id_abon = $arr_group['id_abon'];
                 $id_group = $arr_group['id_group'];
                 $code = $arr_group['code'];
                 /*общая стоимость*/
                 $cost = $arr_group['cost']; 
                 /*Стоимость по месяцам*/
                 $price_to_group = $arr_group['price'];
                 $pay_month ='';
                 if(!empty($price_to_group) AND is_array($price_to_group)){
                     for($i=1; $i<10; $i++){
                         $objMonth = new Model_Dates();
                         $month = $objMonth->monthNameEduYear($i);
                         $a = "p".$i;
                         $pr = $price_to_group[$a];
                         $p = $arr_group[$a];
                         $style = '';
                         if($p == 0){$style = '';}
                         if($p == 1){$style = "style ='background-color:#00CC00;'"; $pr = $month; $month ='';}
                         if($p == 2){$style = "style ='background-color:#FE2701;'"; $pr = $month; $month ='';}
                         if($p == 5){$style = "style ='background-color:#FFFF66;'"; $pr = $month; $month ='';}
                         $pay_month .= "<div class='block_pay_month_head'>".$month."<div class='block_pay_month' ".$style." id='p".$i."_".$id_abon."'>".$pr."</div></div>";
                     }
                 }
                 $abons .= "<div class='abon'>
                                <div class = 'head_abon'>
                                    <span>№".
                                        $id_abon
                                    ."</span> 
                                    <span>".
                                        $code
                                    ."</span>
                                    <span>Цена за год: ".$cost."</span>
                                </div><hr>
                                <div class='abon_info'>
                                    44545
                                    <div calass = 'block_price_month'>".
                                            $pay_month
                                        ."<div class = 'bay_mont'>
                                            <form method='post'>
                                                <label>Кол-во месяцев к оплате: <input type='text' name = 'for_bill' data-id='".$id_abon."' id='amount-".$id_abon."' value='1'></label>
                                                <label>К оплате: <input type='text' name='cost_bill' id='cost_".$id_abon."' value=''></label>
                                                <input type='submit' name='create_bill' value='Купить'>
                                            </form>
                                          </div>
                                    </div>
                                </div>
                            </div>";
             }
        }
    }
    $mygroup .="<div class = 'stud_group'>
                    <div class='head_stud_groups'>".
                        $name
                    . "</div>
                        <div class='list_abon'>".
                        $abons
                    . "</div>"
            . "</div><hr>";
}
?>
<div class='content'>
    <h1>Мои Группы</h1>
    <div class = 'error'>
        <div style = 'background-color: red;'><?=$error;?></div>
    </div>
    <div class='login_form'>
        <?=$mygroup;?>
    </div>
</div>
<script>
    $( "input[name=for_bill]" ).keyup(function() {
        var kol_month = $(this).val();
        var id_abon = $(this).data('id');
        var p1 = Number($("#p1_"+id_abon).text());
        var p2 = Number($("#p2_"+id_abon).text());
        var p3 = Number($("#p3_"+id_abon).text());
        var p4 = Number($("#p4_"+id_abon).text());
        var p5 = Number($("#p5_"+id_abon).text());
        var p6 = Number($("#p6_"+id_abon).text());
        var p7 = Number($("#p7_"+id_abon).text());
        var p8 = Number($("#p8_"+id_abon).text());
        var p9 = Number($("#p9_"+id_abon).text());
        $("#cost_"+id_abon).val(kol_month);
        alert(kol_month +'='+ id_abon+'='+p1+'='+p2+'='+p3+'='+p4+'='+p5+'='+p6+'='+p7+'='+p8+'='+p9);
       });
</script>

