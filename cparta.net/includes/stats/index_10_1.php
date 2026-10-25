<?php

// Если указана дата, разбиваем строку
// If the date, split the string

if(isset($_GET['date']))
	{
    $dd = explode(' - ', $_GET['date']);
    $_GET['date1'] = $dd[0];
    $_GET['date2'] = $dd[1];
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

		

	// готовим строку для GET запроса с учетом перезаписываемых данных
	// Prepare the string for a GET request in view of rewritable data
	function prepare_get_query($get,$override=Array()) 
		{
		// используем перезаписывание параметра
		// Use the overwrite parameter
		if(sizeof($override)) 
			{
			foreach($override as $key => $value) 
				{
				$get[$key]=$value;
				}
			}
		$res='';
		foreach($get as $key => $value) 
			{
			// строим строку запросов с urlencode
			// Build query string with "urlencode"
			$res.=$key.'='.urlencode($value).'&';
			}
		// отрезаем последний &
		// Cut the last "&"
		$res=preg_replace('|\&$|','',$res);
		return $res;
		}
	
?>