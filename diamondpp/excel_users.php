<?php

$CONNECT = mysqli_connect('localhost','root','5JTLc75A5JTLc75A','cpa') or die('Не удалось подключиться к базе');
$data = '<table border="1"><thead><tr><td><b>ID</b></td><td><b>Email</b></td><td><b>Холд</b></td><td><b>Баланс</b></td><td><b>Итого</b></td><td><b>Клики</b></td><td><b>Лиды</b></td><td><b>Роль</b></td><td><b>Уровень</b></td><td><b>IP</b></td><td><b>Последний вход</b></td><td><b>Дата регистрации</b></td></tr></thead>';
$date = '123';
$cnt = 0;
$offers = mysqli_query($CONNECT,"SELECT u.*, (select count(distinct ip) from clients_log where user_id=u.id) as hosts, (select count(*) from zakaz where user_id=u.id) as orders FROM users u  WHERE 1");
while ($res = mysqli_fetch_assoc($offers)) {
    $cnt++;
    $sql_uroven = "SELECT title FROM users_roles_tpl WHERE `tip`='".$res['tip']."'";
	$result_uroven = mysqli_query($CONNECT,$sql_uroven);
	$res_uroven=mysqli_fetch_assoc($result_uroven);
                                                                        
    $arr_title_old = array("Вебмастер", "Рекламодатель", "Менеджер сети", "Администратор сети", "Колл-центр рекламодателя", "Менеджер рекламодателя", "Колл-центр сети", "Оператор тех.поддержки");
	$arr_title_new = array("Вебм","Рекл","Мен","Адм","Колл","Мен","Колл","ТП");
    $new_title_tip = str_replace($arr_title_old, $arr_title_new, $res_uroven['title']);
                                                                        
    $sql_ur_v = "SELECT tip_account, uroven_dostupa, opisanie FROM uroven_tpl WHERE `uroven_dostupa`='".$res['uroven_dostupa']."' AND `tip_account`='".$res['tip']."'";
    $result_ur_v = mysqli_query($CONNECT,$sql_ur_v);
    $res_ur_v=mysqli_fetch_assoc($result_ur_v);
    if ($res_ur_v['opisanie']!='')
    {
        $arr_level_old = array("Начальный", "Продвинутый");
        $arr_level_new = array("Нач","Продв");
        $new_level = str_replace($arr_level_old, $arr_level_new, $res_ur_v['opisanie']);
        $new_level;
    } else { 
        $new_level = '-';
    }
    $data .= "<tr>";
    $data .= "<td>".$res['id']."</td>";
    $data .= "<td>".$res['email']."</td>";
    $data .= "<td>".$res['hold']."</td>";
    $data .= "<td>".$res['balance']."</td>";
    $data .= "<td>".$res['balance_all']."</td>";
    $data .= "<td>".$res['hosts']."</td>";
    $data .= "<td>".$res['orders']."</td>";
    $data .= "<td>".$new_title_tip."</td>";
    $data .= "<td>".$new_level."</td>";
    $data .= "<td>".$res['ip']."</td>";
    $data .= "<td>".$res['date_activity']."</td>";
    $data .= "<td>".$res['date_registration']."</td>";
    $data .= "</tr>";
}
$data .= "</table>";
header( "Content-Type: application/vnd.ms-excel" );
header( "Content-disposition: attachment; filename=export.".$date.".xls" );
echo $data;
?>