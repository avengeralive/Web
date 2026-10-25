<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

include_once $_SERVER['DOCUMENT_ROOT'].'/includes/config.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/includes/antiinject/index.php';

if (isset($_POST['check_login'])){
    
    if (isset($_POST['login_email']) && $_POST['login_email']!=''){
 
        if (preg_match("~^([a-z0-9_\-\.])+@([a-z0-9_\-\.])+\.([a-z0-9])+$~i", $_POST['login_email'])){
 
            if (isset($_POST['login_password']) && $_POST['login_password']!=''){

                $email = $mysqli -> real_escape_string(htmlspecialchars($_POST['login_email']));
                $password = $mysqli -> real_escape_string(htmlspecialchars(md5(md5($_POST['login_password']))));
                $sql = "SELECT id FROM users WHERE `email` = '$email'";
                $res = $mysqli -> query($sql);
                $result = $res -> fetch_assoc();
                if ((int)$result['id']){
                    $array = array(
                      "status" => 0,
                      "message" => ''
                    );echo json_encode( $array );exit;                    
                }else{
                    $array = array(
                      "status" => 1,
                      "message" => 'Неверные e-mail или пароль'
                    );echo json_encode( $array );exit;                    
                }				                
                
            }else{
                $array = array(
                  "status" => 1,
                  "message" => 'Вы не ввели пароль'
                );echo json_encode( $array );exit;                      
            }

        }else{
            $array = array(
              "status" => 1,
              "message" => 'Вы ввели не верный e-mail'
            );echo json_encode( $array ); exit;                     
        }       

    }else{
        $array = array(
          "status" => 1,
          "message" => 'Вы не ввели e-mail'
        );echo json_encode( $array ); exit;                     
    }       

}    

if (isset($_POST['check_access'])){
    
    $recover_email = htmlentities($_POST['recover_email']);
    
	if(!empty($recover_email)) {    
            // Проверяем, есть ли данный емайл в базе данных
            // Check if the email database
            $sql_recover = "SELECT email FROM users WHERE `email` = '$recover_email'";
            $res_recover = $mysqli -> query($sql_recover);
            $result_recover = $res_recover -> fetch_assoc();
		if($result_recover['email']){
		          $array = array(
                            "status" => 0,
                            "message" => ''
                          );echo json_encode( $array );exit;   
                }else{
                    $array = array(
                      "status" => 1,
                      "message" => 'Укажите E-mail!'
                    );echo json_encode( $array );exit;                      
                }           
            
        }else{
            $array = array(
              "status" => 1,
              "message" => 'Укажите E-mail!'
            );echo json_encode( $array );exit;                      
        }

} 

if (isset($_POST['check_signup'])){

    $email = $mysqli -> real_escape_string(htmlspecialchars($_POST['registration_email']));
	if(!empty($email)) {    
            // Проверяем наличие в базе пользователя с таким e-mail
            // Check the existence of the database user with this e-mail
            $sql = "SELECT email FROM users WHERE `email`='$email'";
            $result = $mysqli->query($sql);
            if (mysqli_num_rows($result)==0){
                 $array = array(
                  "status" => 0,
                  "message" => ''
                );echo json_encode( $array );exit;                    
            }else{
                $array = array(
                  "status" => 1,
                  "message" => 'E-mail уже используется.'
                );echo json_encode( $array );exit;                      
            }
            
        }else{
            $array = array(
              "status" => 1,
              "message" => 'Укажите E-mail!'
            );echo json_encode( $array );exit;                      
        }

} 
}else exit();