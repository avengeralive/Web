<?php
$CONNECT = mysqli_connect('10.8.0.1','root','JHHUIYG&$yfjgf54765rJKHGkkijhg','crm') or die('Не удалось подключиться к базе');
$key_value = [];
$bd = [];
$status_name = [];
$data = '';
$list = '';
$first_date = (isset($_POST['first_date'])) ? strtotime($_POST['first_date']) : NULL;
$last_date = (isset($_POST['last_date'])) ? strtotime($_POST['last_date']) : NULL;
$date_list = $_POST['date_list'];
$goods_names_id = ($_POST['goods_names']) ? $_POST['goods_names'] : NULL;


if(isset($_POST['btn'])){

    if(isset($_POST['status_list'])){
        if($_POST['status_list'] == 'all') {$list = ['list14','list15','list16','list17','list18','list19','list20'];}
        elseif($_POST['status_list'] == 'no') {$list = 'list17';}
        else $list = $_POST['status_list'];
    }

    $QQ = "SELECT * FROM `list8` WHERE 1";
    $connect = mysqli_query($CONNECT,$QQ);

    for ($c=1; $c <= mysqli_num_rows($connect); $c++) { 
        $result = mysqli_fetch_assoc($connect);
        $status_name[$c] = $result['name'];
    }
    unset($QQ,$connect,$result);

    if(is_array($list)){
        if($goods_names_id != 'no'){
            for ($i=0; $i < count($list); $i++) {
                if($first_date != NULL && $last_date != NULL){
                    $QQ = "SELECT * FROM `$list[$i]` WHERE `$date_list` > $first_date AND `$date_list` < $last_date AND `goods_names` LIKE '%$goods_names_id%'";
                }else{
                    $QQ = "SELECT * FROM `$list[$i]` WHERE `goods_names` LIKE '%$goods_names_id%'";
                }

                $connect = mysqli_query($CONNECT,$QQ);
                saveExcel($connect);
            }
        }else{
            for ($i=0; $i < count($list); $i++) { 
                if($first_date != NULL && $last_date != NULL){
                    $QQ = "SELECT * FROM `$list[$i]` WHERE `$date_list` > $first_date AND `$date_list` < $last_date";
                }else{
                    $QQ = "SELECT * FROM `$list[$i]` WHERE 1";
                }

                $connect = mysqli_query($CONNECT,$QQ);
                saveExcel($connect);
            }
        }
    }else {
        if($goods_names_id != 'no'){
            if($first_date != NULL && $last_date != NULL){
                $QQ = "SELECT * FROM `$list` WHERE `$date_list` > $first_date AND `$date_list` < $last_date AND `goods_names` LIKE '%$goods_names_id%'";
            }else{
                $QQ = "SELECT * FROM `$list` WHERE `goods_names` LIKE '%$goods_names_id%'";
            }
        }else{
            if($first_date != NULL && $last_date != NULL){
                $QQ = "SELECT * FROM `$list` WHERE `$date_list` > $first_date AND `$date_list` < $last_date";
            }else{
                $QQ = "SELECT * FROM `$list` WHERE 1";
            }
        }
        $connect = mysqli_query($CONNECT,$QQ) or die("Не правильный запрос".$QQ);
        saveExcel($connect);
    }
}

function saveExcel($connect){
    GLOBAL $key_value,$bd,$data,$status_name;
    $date = date('d-m-Y');
    
    for ($i=0; $i < mysqli_num_rows($connect); $i++) { 
        $result = mysqli_fetch_assoc($connect);
        $bd[$i] = $result;
    }
    foreach ($result as $key => $value) {
        if(isset($_POST[$key]) == true){
            $key_value[$key] = true;
        }
    }
    // if(empty($key_value)) die('С такими параметрами нет данных в данной таблице, либо не были выбраны поля!!! <a href="https://1v1-crm.ru/configcrm">Вернуться</a>');

    $data .= '<table border="1"><tr>';
    foreach ($key_value as $key => $value) {
        $data .= '<td><span><b><h2>'.$key.'</h2></b></span></td>';
        // $data .= $key."\t";
    }

    $data .= '</tr>';
    foreach ($bd as $key => $value) {
        $data .= '<tr>';
        if(in_array('status', $key_value) && $value['status'] > 0)          $value['status'] = $status_name[$value['status']];
        if(in_array('time', $key_value) && $value['time'] > 0)              $value['time'] = date('d-m-Y',(int)$value['time']);
        if(in_array('timeupdate', $key_value) && $value['timeupdate'] > 0)  $value['timeupdate'] = date('d-m-Y',(int)$value['timeupdate']);
        if(in_array('lastUpdate', $key_value) && $value['lastUpdate'] > 0)  $value['lastUpdate'] = date('d-m-Y',(int)$value['lastUpdate']);
        if(in_array('approvedAt', $key_value) && $value['approvedAt'] > 0)  $value['approvedAt'] = date('d-m-Y',(int)$value['approvedAt']);
        if(in_array('shippedAt', $key_value) && $value['shippedAt'] > 0)    $value['shippedAt'] = date('d-m-Y',(int)$value['shippedAt']);
        if(in_array('canceledAt', $key_value) && $value['canceledAt'] > 0)  $value['canceledAt'] = date('d-m-Y',(int)$value['canceledAt']);
        if(in_array('buyoutAt', $key_value) && $value['buyoutAt'] > 0)      $value['buyoutAt'] = date('d-m-Y',(int)$value['buyoutAt']);
        if(in_array('refundedAt', $key_value) && $value['refundedAt'] > 0)  $value['refundedAt'] = date('d-m-Y',(int)$value['refundedAt']);
        if(in_array('time_call', $key_value) && $value['time_call'] > 0)    $value['time_call'] = date('d-m-Y',(int)$value['time_call']);
        if(in_array('statustime', $key_value) && $value['statustime'] > 0)  $value['statustime'] = date('d-m-Y',(int)$value['statustime']);
        foreach ($key_value as $k => $v) {
            $data .= '<td><font size="4">'.$value[$k].'</font></td>';
        }

        $data .= '</tr>';
    }
    $data .= '</table>';
    header( "Content-Type: application/vnd.ms-excel" );
    header( "Content-disposition: attachment; filename=export.".$date.".xls" );
    echo $data;
}
function telegram($text){
    // if(is_array($text)) $text = implode(",",$text);
    $token = "696735574:AAEpKD9CaGW8Op45ezmFkslDSd9VIhT3WGc";
    $chat_id = "-323189907";

    $sendToTelegram = fopen("https://api.telegram.org/bot{$token}/sendMessage?chat_id={$chat_id}&parse_mode=html&text={$text}","r");
}
?>