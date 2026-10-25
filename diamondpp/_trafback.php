<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
	
	@session_start();
	if (isset($_SESSION['id']) && (int)$_SESSION['id']){

		$user_id = $_SESSION['id'];
		$url = htmlentities($_POST['url']);
		$offer = htmlentities($_POST['offer']);
        $type = htmlentities($_POST['type']);
		
		include $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
		include $_SERVER['DOCUMENT_ROOT'].'/includes/antiinject/index.php';
		
        if($type == 'add'){
            
            $checkUrl = open_url($url);
            
            if($checkUrl === true){

                $sql = "SELECT * FROM traficbacks WHERE `offer_id`='$offer' AND `user_id` = '$user_id'";
                $result=$mysqli->query($sql);
                $res=mysqli_num_rows($result);

                if($res == 0){

                    $sql = "INSERT INTO traficbacks (`user_id`, `offer_id`, `url`) VALUES ('$user_id', '$offer', '$url')";
                    $mysqli->query($sql);

                }else{

                    $sql2 = "UPDATE traficbacks SET `url` = '$url' WHERE `offer_id` = '$offer' AND `user_id` = '$user_id'";
                    $mysqli->query($sql2);

                }
                $array = array(
                  "status" => 'success',
                  "message" => ''
                );echo json_encode( $array );exit;	 
                
            }else{
                global $errors;
                $array = array(
                  "status" => 'error',
                  "message" => $errors
                );echo json_encode( $array );exit;	                  

            }
            
        }elseif($type == 'del'){
            
            $sql2 = "DELETE FROM traficbacks WHERE `offer_id` = '$offer' AND `user_id` = '$user_id'";
            $mysqli->query($sql2);            
            
        }
        
	}else exit();
	
}else exit();


 // Существование ссылки (URL)
function open_url($url)
{
    $url_c=parse_url($url);
    global $errors;
    if (!empty($url_c['scheme']))
    {
        
        if (!empty($url_c['host']))
        {
            
            if ($otvet=@get_headers($url)){
                return true;
            }else{
                $errors = 'Не верно указана ссылка!';
                return false; 
            }

        }else{
            $errors = 'Не верно указан домен!';
            return false; 
        }
    }else{
        $errors = 'Не указан тип соединения (http:// или https://)!';
        return false; 
    }    
        
}