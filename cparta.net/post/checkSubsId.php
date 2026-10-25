<?php
include '../includes/config.php';
include '../includes/antiinject/index.php';	 

@session_start();
$user_id = $_SESSION['id'];	
$keyword = htmlentities($_POST['keyword']);
switch ($_POST['mode']) {
    case '1': // ���������� ���� ������ ��� �������� ������
		$sql = "SELECT `subid1` FROM clients_log WHERE `user_id` = '".$user_id."' AND `subid1` LIKE '".$keyword."%' GROUP BY `subid1`";
		$result=$mysqli->query($sql);
		//var_dump($sql);
		while($res=mysqli_fetch_assoc($result)){				
			$subid1 = str_replace_once(strtolower($keyword), '<b>'.$keyword.'</b>', strtolower($res['subid1']));
			echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['subid1']).'\','.$_POST['mode'].')">'.$subid1.'</li>';
		}
        break;
    case '2': // ���������� ���� ������ ��� �������� ������
		$sql = "SELECT `subid2` FROM clients_log WHERE `user_id` = '".$user_id."' AND `subid2` LIKE '".$keyword."%' GROUP BY `subid2`";
		$result=$mysqli->query($sql);
		//var_dump($sql);
		while($res=mysqli_fetch_assoc($result)){			
			$subid2 = str_replace_once(strtolower($keyword), '<b>'.$keyword.'</b>', strtolower($res['subid2']));
			echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['subid2']).'\','.$_POST['mode'].')">'.$subid2.'</li>';
		}
        break;        
    case '3': // ���������� ���� ������ ��� �������� ������
		$sql = "SELECT `subid3` FROM clients_log WHERE `user_id` = '".$user_id."' AND `subid3` LIKE '".$keyword."%' GROUP BY `subid3`";
		$result=$mysqli->query($sql);
		//var_dump($sql);
		while($res=mysqli_fetch_assoc($result)){			
			$subid3 = str_replace_once(strtolower($keyword), '<b>'.$keyword.'</b>', strtolower($res['subid3']));
			echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['subid3']).'\','.$_POST['mode'].')">'.$subid3.'</li>';
		}       
        break;	
    case '4': // ���������� ���� ������ ��� �������� ������
		$sql = "SELECT `subid4` FROM clients_log WHERE `user_id` = '".$user_id."' AND `subid4` LIKE '".$keyword."%' GROUP BY `subid4`";
		$result=$mysqli->query($sql);
		//var_dump($sql);
		while($res=mysqli_fetch_assoc($result)){			
			$subid4 = str_replace_once(strtolower($keyword), '<b>'.$keyword.'</b>', strtolower($res['subid4']));
			echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['subid4']).'\','.$_POST['mode'].')">'.$subid4.'</li>';
		}       
        break;
    case '5': // ���������� ���� ������ ��� �������� ������
		$sql = "SELECT `subid5` FROM clients_log WHERE `user_id` = '".$user_id."' AND `subid5` LIKE '".$keyword."%' GROUP BY `subid5`";
		$result=$mysqli->query($sql);
		//var_dump($sql);
		while($res=mysqli_fetch_assoc($result)){			
			$subid5 = str_replace_once(strtolower($keyword), '<b>'.$keyword.'</b>', strtolower($res['subid5']));
			echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['subid5']).'\','.$_POST['mode'].')">'.$subid5.'</li>';
		}       
        break;       
    case '6': // ���������� ���� ������ ��� �������� ������
		$sql = "SELECT id,name FROM offers WHERE `active` = '1' and name LIKE '%".$keyword."%'";
		$result=$mysqli->query($sql);
		//var_dump($sql);
		while($res=mysqli_fetch_assoc($result)){
                        $name = html_entity_decode(strtolower($res['name']));
                        $name = str_replace("'", "", $name);
                        $name = str_replace("\"", "", $name);
			$subid5 = str_replace_once(strtolower($keyword), '<b>'.$keyword.'</b>', $name);                        
			echo '<li onclick="set_offer(\''.$res['id'].'\',\''.$name.'\');">'.$subid5.'</li>';
		}       
        break;   
        
    case '7': // ���������� ���� ������ ��� �������� ������
		$sql = "SELECT name_ru,iso FROM sxgeo_country WHERE name_ru LIKE '".$keyword."%'";
		$result=$mysqli->query($sql);
		//var_dump($sql);
		while($res=mysqli_fetch_assoc($result)){
                        $name = html_entity_decode($res['name_ru']);
			$name_ru = str_replace_once(strtolower($keyword), $keyword, $name);                        
			echo '<li style="padding-left: 25px;" class="setcountrys" data-iso="'.$res['iso'].'" data-name="'.$name_ru.'"><img src=./modules/detectclient/SxGeo/img/' . strtolower($res['iso']) . '.png> &nbsp&nbsp '.$name_ru.'</li>';
		}       
        break;         
}

function str_replace_once($search, $replace, $text) 
{ 
   $pos = strpos($text, $search); 
   return $pos!==false ? substr_replace($text, $replace, $pos, strlen($search)) : $text; 
} 