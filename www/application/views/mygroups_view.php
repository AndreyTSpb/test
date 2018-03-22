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
             $type = '';
             foreach ($vals['groups'] as $arr_group){
                 $id_abon = $arr_group['id_abon'];
                 $id_group = $arr_group['id_group'];
                 $code = $arr_group['code'];
                 $status = $arr_group['status'];
                 /*общая стоимость*/
                 $cost = $arr_group['cost'];
                 $no_pay = $arr_group['no_pay'];
                 $type = $arr_group['type'];
                 /*Стоимость по месяцам*/
                 $price_to_group = $arr_group['price'];
                 $pay_month ='';
                 if($type<4){
                    if(!empty($price_to_group) AND is_array($price_to_group)){
                        $kol=0;
                        for($i=1; $i<10; $i++){
                            $objMonth = new Model_Dates();
                            $month = $objMonth->monthNameEduYear($i);
                            $a = "p".$i;
                            $pr = $price_to_group[$a];
                            $p = $arr_group[$a];
                            $style = '';
                            $id_input = '';

                            if($p == 0){$style = ''; $id_input = "id='p".++$kol."_".$id_abon."'";} /*Тут считаем сколько не оплаченных месяцев*/
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
                        if(!empty($b) && empty($no_pay)){
                            $first_pay_sum = $price_to_group[$z];
                        }
                    }
                    /**
                     * Кнопка создания счета
                     */
                    $bay = '';
                    if(empty($no_pay) && ($status == '1' OR $status == '5' OR $status == '0')){
                        $bay = "<form method='post'>
                                       <label>Кол-во месяцев к оплате: <input type='text' name = 'for_bill' data-id='".$id_abon."' id='amount-".$id_abon."' value='1'></label>
                                       <label>К оплате: <input type='text' name='cost_bill' id='cost_".$id_abon."' value='".$first_pay_sum."' readonly></label>
                                       <input type='hidden' name = 'id_abon' value='".$id_abon."'>
                                       <input type='submit' name='create_bill' value='Купить'>
                                   </form>";
                    }elseif (!empty($no_pay) && ($status == '1' OR $status == '5' OR $status == '0')) {
                       $bay = "<br><div class = 'bill_pay'><a href='/mybills'>Перейти на оплату!!!</a>";
                    }elseif($status == '6'){
                        $bay = "<div style='color: red;' class='bills_balance'>У вас не оплачен месяц !!! Теперь вы не можете пользоваться сервисами для ребенка!!! Обратитесь к администратору!!!</div>";
                    }elseif(empty ($cost)){
                        $bay = "<div class='bills_balance'>Оплата по этой группе будет возможна в позже!!!</div>";
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
                                            ".$bay."
                                          </div>
                                    </div>
                                </div>
                                <div>
                                    <div class='bill_link clear_booking' data-id='".$id_abon."'> Отказаться от занятий в этой группе!!!</div>
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
    $(document).ready(function() {
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
           
        $('.clear_booking').click(function(){
                var id_abon = $(this).data('id');
                alert(id_abon);
                $.ajax({
                    type: 'POST', 
                    url: '../application/ajax/cron_abon.php', 
                    data: 'id='+id_abon,
                    // data: 'id=".$id."',
                    beforeSend: function(){ $('.cursor_wait').show(); }, 
                    success: function(html){ $('.cursor_wait').hide(); location.pathname='/mygroups';}
                });
            });
    });
</script>

