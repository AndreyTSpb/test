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
                     $kol=1;
                     for($i=1; $i<10; $i++){
                         $objMonth = new Model_Dates();
                         $month = $objMonth->monthNameEduYear($i);
                         $a = "p".$i;
                         $pr = $price_to_group[$a];
                         $p = $arr_group[$a];
                         $style = '';
                         $id_input = '';
                         
                         if($p == 0){$style = ''; $id_input = "id='p".$kol++."_".$id_abon."'";}
                         if($p == 1){$style = "style ='background-color:#00CC00;'"; $pr = $month; $month ='';}
                         if($p == 2){$style = "style ='background-color:#FE2701;'"; $pr = $month; $month ='';}
                         if($p == 5){$style = "style ='background-color:#FFFF66;'"; $pr = $month; $month ='';}
                         $pay_month .= "<div class='block_pay_month_head'>".$month.""
                                            . "<div class='block_pay_month' ".$style." ".$id_input.">".$pr."</div>"
                                     . "</div>";
                     }
                     $first_pay_sum = '';
                     $b = 9 - $kol +2;
                     $z = "p".$b;
                     if(!empty($b)){
                         $first_pay_sum = $price_to_group[$z];
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
                                                <label>К оплате: <input type='text' name='cost_bill' id='cost_".$id_abon."' value='".$first_pay_sum."' readonly></label>
                                                <input type='hidden' name = 'id_abon' value='".$id_abon."'>
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
        var t = new Number(0);
        var pay = new Number(0);
        for($i=1; $i<=kol_month; $i++){
            t = Number($("#p"+$i+"_"+id_abon).text());
            pay = +pay + +t;
        }
        $("#cost_"+id_abon).val(pay);
       });
</script>

