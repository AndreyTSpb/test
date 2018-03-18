<?php
function selectRaion($select=NULL){
	/**
        * выборка с районами
        */
        $q2 = array(
            'order' => 'name DESC'
        );
        $r_raions = new Model_Raions($q2);
        $raions = $r_raions->getAllRows();
        //print_r($raions);
	$rez="<select name=\"raion\" value=\"\">";
	$rez.="<option value='0'></option>";
        if(!empty($raions)){
            foreach ($raions as $value)
            {
                    if ($select==$value['id'])  {$selected="selected"; }else{ $selected="";}
                    $rez.="<option ".$selected." value='".$value['id']."'>".$value['name']."</option>";
            }
        }
	$rez.="</select>";
    return $rez;
}
//var_dump($data); exit;
/**
 * Выборка информации по родителям
 */
$fam   = $parent_info['f'];
$name  = $parent_info['n'];
$surn  = $parent_info['s'];
$phone = $parent_info['phone'];
$email = $parent_info['email'];
/**
 * Выборка учеников
 */
//print_r($stud_info);
$kol_stud = count($stud_info);
$students ='';
$vet = '';
foreach ($stud_info as $id_stud=>$inf){
    list($stud_fam, $stud_name) = explode(" ", $inf['name']);
    if($inf['veteran']>0) {$vet = 1;}
    if($inf['sex']==='М'){$select = '<option selected value="М">M</option>
                                     <option value="Ж">Ж</option>';} 
    elseif ($inf['sex']==='Ж') {$select = '<option value="М">M</option>
                                           <option selected value="Ж">Ж</option>';}
    else{$select = '<option selected value="М">M</option>
                    <option value="Ж">Ж</option>';}
    $dt_birth = date('d.m.Y', $inf['birthday']);
    $school = $inf['school'];
    $raion = $inf['raion'];
    $students .='<form action="" method="post">
                    <div class="input_title">Фамилия Ребенка</div><input type="input" name="familia_student" value="'.$stud_fam.'" required><br>
                    <div class="input_title">Имя Ребенка</div><input type="input" name="name_student" value="'.$stud_name.'" required><br>
                    <div class="input_title" >Пол ребенка:</div>
                    <select name="sex">
                        '.$select.'
                    </select><br>
                    <div class="input_title">День рождения</div><input type="input" name="birthday" value="'.$dt_birth.'" class="dateJS" required><br>
                    <div class="input_title">Район</div>
                    '.selectRaion($raion).'
                    <div class="input_title">Школа</div><input type="input" name="school" value="'.$school.'"><br>	
                    <div class="input_title">Год поступления в школу</div><input type="input" name="year" value="'.$year.'" required><br>
                    <input type="hidden" name="id_student" value="'.$id_stud.'">
                    <input type="submit" name="save_student" value="Изменить">
                    <input type="submit" name="del_student" value="Удалить">
                </form>';
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$id_user = (int)$_COOKIE["id_user"];
?>

<div>
<div class="shapka">
    <nav class="cl-effect-100"><h1>Основные данные родителя (попечителя)</h1></nav>
    <div class="bills_balance" style='width: 90%'>
        <p style=" text-align: right; ">
            <strong>Статус ветерана - $vet  .</strong>
        </p>
    </div>
</div>
<div class="div_left">
    <form action="" method="post">
            <div class="input_title">Фамилия Имя Отчество</div>
            <input type='hidden' name='login' id='id_user' value='<?=$id_user;?>'>
            <input type="input" name="parent_f" value="<?=$fam;?>" placeholder="Фамилия">
            <input type="input" name="parent_n" value="<?=$name;?>" placeholder="Имя">
            <input type="input" name="parent_s" value="<?=$surn;?>" placeholder="Отчество"><br>
        </div>
        <div class="input_title">Телефон для связи*</div><input type="text" name="phone" id ="phone" size="20"  value="<?=$phone;?>" readonly>
        <div class="input_sub"></div>
        <br>
        <div id="errorBlock"></div>
        <div class="input_title">Эл.почта *</div><input type="text" name="email" value="<?=$email;?>"><br>
        <input type="submit" name="save" value="Сохранить" id='save_but'>
    </form>
</div>
<hr  size="3" noshade color="#ccc">
<?php if($kol_stud>0){?>
<div class="shapka"><nav class="cl-effect-100"><h1>Данные о ребенке</h1></nav></div>
<?= $students; ?>
<hr>
<input type="button" id="addStud" name="add_student" value="Добавить Еще Ребенка">
<div class="add_stud" style="display: none;">
    <div class="shapka"><nav class="cl-effect-100"><h1>Добавить Ребенка</h1></nav></div>
    <form action="" method="post">
        <div class="input_title">Фамилия Ребенка</div><input type="input" name="familia_student" value="" required><br>
	<div class="input_title">Имя Ребенка</div><input type="input" name="name_student" value="" required><br>
        <div class="input_title">Район</div>
        <br>
        <div class="input_title">Школа</div><input type="input" name="school" value=""><br>	
	<div class="input_title">Год поступления в школу</div><input type="input" name="year" value=""><br>
	<input type="submit" name="new_student" value="Добавить Ребенка">
        <input type="button" id="outStud" name="out_student" value="Отмена">
    </form>
</div>
<?php }else{ ?>
    <div class="shapka"><nav class="cl-effect-100"><h1>Добавить Ребенка</h1></nav></div>
	<form action="" method="post">
            <div class="input_title">Фамилия Ребенка</div><input type="input" name="familia_student" value="" required><br>
            <div class="input_title">Имя Ребенка</div><input type="input" name="name_student" value="" required><br>
            <div class="input_title">Район</div>
            <br>	
            <div class="input_title">Школа</div><input type="input" name="school" value="" required><br>	
	    <div class="input_title">Год поступления в школу</div><input type="input" name="year" value="" required><br>
	    <input type="submit" name="new_student" value="Добавить Ребенка">
	</form>
<?php }?>
<hr  size="3" noshade color="#ccc">
<div class="shapka"><nav class="cl-effect-100"><h1>Изменить пароль</h1></nav></div>
    <form action="" method="post">
	<div class="input_title">Новый пароль *</div><input type="password" name="password1"><br>
	<div class="input_title">Новый пароль еще раз *</div><input type="password" name="password2"><br>	
	<input type="submit" name="new_pass" value="Изменить пароль">
    </form>
<script>
    $(document).ready(function(){
            /*Маска для ввода*/
            $('#dr').mask('99.99.9999');
            $('input[name="phone"]').mask("+7 (999) 999-99-99");
            
            /*Проверка данных*/
            $(document).on('blur', '#phone', function(){
		var phone = $(this).val();
		var id_user = $('#id_user').val();
		$.ajax({type: 'POST',
			url: '/ajax/ajax_check.phone.php',
			data: { phone: phone,
                                id_user: id_user },
			success: function(data){
                            if(data===0){
				$('#errorBlock').html('');
				document.getElementById('save_but').disabled = false;
                            }else{
				$('#errorBlock').html('Такой телефон уже есть в базе');
				document.getElementById('save_but').disabled = true;
                            }
			} 
		});
            });
            
            /*Скрыть показать менюху с добавлением ребенка*/
            $("#addStud").click(function(){
		$("#addStud").hide();
		$(".add_stud").show();
            });
            $("#outStud").click(function(){
                    $("#addStud").show();
                    $(".add_stud").hide();
            });
	});
    /**/
</script>
        