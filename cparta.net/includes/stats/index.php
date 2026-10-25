<?php

// Если указана дата, разбиваем строку
// If the date, split the string
if(isset($_POST['date1']))
	{
    $dd = explode(' - ', $_POST['date1']);
    $_POST['date1'] = $dd[0];
    $_POST['date2'] = $dd[1];
	}

function mydat($vid, $nachkon)
{
    if ($vid == 1) {
        $now4 = (date("Y"));
        $now5 = (date("m"));
        $now6 = (date("d"));
        $dat = $now4 . '-' . $now5 . '-' . $now6;
    }
    if ($vid == 2) {
        $now4 = (date("Y"));
        $now5 = (date("m"));
        $now6 = (date("d"));
        $dat = date("Y-m-d", mktime(0, 0, 0, $now5, $now6 - 1, $now4));
    }
    if ($vid == 3) {
        if ($nachkon == 1) {
            $now4 = (date("Y"));
            $now5 = (date("m"));
            $now6 = (date("d"));
            $dat = date("Y-m-d", mktime(0, 0, 0, $now5, $now6 - 7, $now4));
        }
        if ($nachkon == 2) {
            $dat = $now5 = date("Y-m-d");
        }
    }
    if ($vid == 4) {
        if ($nachkon == 1) {
            $now4 = (date("Y"));
            $now5 = (date("m"));
            $now6 = (date("d"));
            $dat = date("Y-m-d", mktime(0, 0, 0, $now5, $now6 - 30, $now4));
        }
        if ($nachkon == 2) {
            $dat = $now5 = date("Y-m-d");
        }
    }
    return $dat;
}

// Получаем список офферов по которым был какой-либо трафик
// Get the list offerov which was some traffic
function get_offers($user_id)
	{
    global $mysqli;
    $sql6 = "SELECT DISTINCT offer_id FROM clients_log WHERE `user_id` = '$user_id'";
    $result6 = $mysqli->query($sql6);
    if (mysqli_num_rows($result6) > 0)
		{
        $array = array();
        while($res6 = mysqli_fetch_object($result6))
			{
            $sql7 = "SELECT id,name FROM offers WHERE `id`='$res6->offer_id'";
            $result7 = $mysqli->query($sql7);
            $res7 = mysqli_fetch_object($result7);
            if (isset($res7->name) && $res7->name != '')
				{
                $array[] = array(
                    'id' => $res7->id,
                    'name' => $res7->name
                );
            }
        }
		return $array;
		} 
	else 
		return false;
	}


// Получаем список офферов рекламодателя по которым был хотя бы один заказ
// Get the list of advertiser offerov which was at least one order
function get_offers_rekl($user_id)
	{
    global $mysqli;
    $sql6 = "SELECT DISTINCT offer_id FROM clients_log WHERE `owner_id` = '$user_id'";
    $result6 = $mysqli->query($sql6);
    if (mysqli_num_rows($result6) > 0)
		{
        $array = array();
        while($res6 = mysqli_fetch_object($result6))
			{
            $sql7 = "SELECT id,name FROM offers WHERE `id`='$res6->offer_id'";
            $result7 = $mysqli->query($sql7);
            $res7 = mysqli_fetch_object($result7);
            if (isset($res7->name) && $res7->name != '')
				{
                $array[] = array(
                    'id' => $res7->id,
                    'name' => $res7->name
                );
            }
        }
		return $array;
		} 
	else 
		return false;
	}


// Получаем список офферов рекламодателя по которым был хотя бы один заказ
// Get the list of advertiser offerov which was at least one order
function get_offers_admin()
	{
    global $mysqli;
    $sql6 = "SELECT DISTINCT offer_id FROM clients_log";
    $result6 = $mysqli->query($sql6);
    if (mysqli_num_rows($result6) > 0)
		{
        $array = array();
        while($res6 = mysqli_fetch_object($result6))
			{
            $sql7 = "SELECT id,name FROM offers WHERE `id`='$res6->offer_id'";
            $result7 = $mysqli->query($sql7);
            $res7 = mysqli_fetch_object($result7);
            if (isset($res7->name) && $res7->name != '')
				{
                $array[] = array(
                    'id' => $res7->id,
                    'name' => $res7->name
                );
            }
        }
		return $array;
		} 
	else 
		return false;
	}
	
// Получаем список вебов у которых был хотя бы один переход
// Get the list of advertiser offerov which was at least one order
function get_users_admin(){
    global $mysqli;
    $sql6 = "SELECT DISTINCT user_id FROM clients_log";
    $result6 = $mysqli->query($sql6);
    if (mysqli_num_rows($result6) > 0){
        $array = array();
        while($res6 = mysqli_fetch_object($result6))
	{
            $array[] = array(
                'user_id' => $res6->user_id
            );
            
        }
	return $array;
        
    }else return false;
}
		
// Обработка SubId
// Processing SubId
function get_subid($user_id, $n)
{
    global $mysqli;
    $sql11 = "SELECT DISTINCT `subid".$n."` as subid FROM clients_log WHERE `user_id` = '$user_id' AND subid".$n." !='' ORDER BY `id` DESC";
    $result11 = $mysqli->query($sql11);
    if (mysqli_num_rows($result11) > 0)
    {
        $array = array();
        while($res11 = mysqli_fetch_object($result11))
        {
            $array[] = $res11->subid;
        }

        return $array;
    } else return false;
}

	
$dat1 = date( "Y-m-d", strtotime( '-6 days' ) );
$dat2 = date( "Y-m-d" );
if ( isset( $_POST['date1'] ) && isset( $_POST['date2'] ) ) {
	$dat1 = date( 'Y-m-d', strtotime( $_POST['date1'] ) );
	$dat2 = date( 'Y-m-d', strtotime( $_POST['date2'] ) );
	$tdat1 = date( 'Ymd', strtotime( $_POST['date1'] ) );
	$tdat2 = date( 'Ymd', strtotime( $_POST['date2'] ) );
}
else
{
	$tdat1 = date( 'Ymd', strtotime( $dat1 ) );
	$tdat2 = date( 'Ymd', strtotime( $dat2 ) );
}	
	
?>