<?php
/**
 * Переписка
 */
//print_r($data);
if(!isset($error)) $error='';
$messeg = '';
foreach ($messags as $item){
    $messeg .="<div class = 'messag_head'> <div>От кого</div><div>".$item['dt']."</div></div>
                <div class = 'body_message'>".$item['text']."</div><hr>";
}
?>
<div class='content'>
    <h1>Мои сообщения</h1>
    <div class = 'error'>
        <div style = 'background-color: red;'><?=$error;?></div>
    </div>
    <div class = 'new_mess_open'>
        <button id = 'show_new_mess'><img src="../images/file_add.png" width="20px" height="20px">Новое Сообщение</button>
    </div>
    <div class='new_mess' id='new_mess_box' style='display: none;'>
        <form method="post">
            <ul>
                <li>
                <label>Сообщение:</label>
                <div>
                    <textarea name='messag'rows='7'></textarea>
                </div>
                </li>
                <li>
                    <div>
                        <input type="submit" name="sendMess" value="Отправить">
                    </div>
                </li>
            </ul>
        </form>
    </div>
    <div class='login_form'>
        <?=$messeg;?>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('#show_new_mess').click(function(){
            if($("#new_mess_box").is(":hidden")){
                $("#new_mess_box").show("slow");
            }else{
                $("#new_mess_box").hide("slow");
            }
        });
    });
</script>