<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    @session_start();
    include '../includes/config.php';
    $user_id = $_SESSION['id'];
    $user = User::getById($user_id);
    if($user->tip == 70 || $user->tip == 80){
        $post = new Request($_POST);
        if(isset($post->user)){
            
            $user = User::getById($post->user);
            
            $offer = Offer::getById($post->offer);
            
            $offer_comission = explode('|', trim($offer->comission)); 
            $offer_tip_comission = explode('|', trim($offer->tip_comission));
            $offer_geo = explode('|', trim($offer->geo));
            $offer_country_iso_arr = explode(':', $offer_geo[0]); 
            
            
            if($user->offers_reward != ''){   
                $personal_bonus = explode('|', trim($user->offers_reward));
                $offer_bonus = array();
                foreach ($personal_bonus as $key => $bonus) {
                    if($bonus == ''){continue;}
                    $offer_bonus[] = explode(':', trim($bonus));
                }  
                if($offer_bonus && is_array($offer_bonus)){
                    foreach ($offer_bonus as $key => $bonus) {
                        if ($bonus[0] == $offer->id){
                        $bonuses[] = explode(',', trim($bonus[1]));
                        foreach($bonuses as $bonus){
                            foreach($bonus as $k=>$v){
                                $dop_bonus[] = explode('-', trim($v));
                            }
                        }
                        break;    
                        }
                    }                
                }

            }            
            
            $content = '<form name="edit_user" method="post" action="./users.php?edit='.$user->id.'">';
            $content .= '<table class="stats_table offers_list" style="margin-top:50px;width:1000px;">';

            $content .= '<tr height="60" class="tableHead">';
            $content .= '<td colspan="2">';
            $content .= '<b>Оффер:</b>';
            $content .= '</td>';
            $content .= '<td width="150px">';
            $content .= '<b>Отчисления:</b>';
            $content .= '</td>';
            $content .= '<td width="150px">';
            $content .= '<b>Дополнительно:</b>';
            $content .= '</td>';
            $content .= '</tr>';
            
            $content .= '<tr>';
            $content .= '<td style="width: 120px;">';
            $content .= '<a style="border: 0; text-decoration: none;" href="./offers.php?offer='.$offer->id.'"><img style="width:120px;margin: 10px;" src="./tmp/offer'.$offer->id.'.jpg"></a>';
            $content .= '</td>';

            $content .= '<td>';
            $content .= '<a href="./offers.php?offer='.$offer->id.'" target="_blank"><b>'.$offer->name.'</b></a>';
            $content .= '</td>';

            $content .= '<td colspan="2">';
            $content .= '<table style="width:95%;text-align:center;margin: 0 auto;">';
            
                if (isset($offer_comission)) {

                    if (count($offer_tip_comission) > 0 && count($offer_tip_comission) == count($offer_comission)) {
                        $i = 0;
                        foreach ($offer_country_iso_arr as $key => $val) {
                            $content .= '<tr height="25px">';
                            $sql_geo = "SELECT name_ru FROM sxgeo_country WHERE `iso`='$val'";
                            $result_geo = $mysqli->query($sql_geo);
                            if (mysqli_num_rows($result_geo) > 0) {
                                $res_geo = mysqli_fetch_array($result_geo);
                                $geo_country_name = htmlentities($res_geo['name_ru']);
                            } else {
                                $geo_country_name = 'Без ограничений';
                            }
                                    $input_comission = 0;
                                    if(isset($dop_bonus) && is_array($dop_bonus)){
                                        foreach ($dop_bonus as $k=>$v){
                                            if($v[0] == $val){
                                                $input_comission = $v[1];  
                                                break;
                                            }   
                                        }
                                    }
                            if (!empty($val)) {
                                $content .= '<td style="height: 20px;border:none;vertical-align:middle;padding:0;"><center><img style="display:block;" title="' . $geo_country_name . '" src=./modules/detectclient/SxGeo/img/' . strtolower($val) . '.png></center></td>';
                                if ($offer_tip_comission[$i] == 1) {
                                    $content .= '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . ($offer_comission[$i]) . ' руб.';                                    
                                    $content .= '</td>';
                                    $content .= '<td style="height: auto;border:none;vertical-align:middle;padding:0;">'; 
                                    
                                    $content .= '<input type="hidden" name="bonus_country[]" value="'.$val.'">';
                                    $content .= '<input style="width: 65px;text-align:center;" type="text" name="comission[]" value="'.$input_comission.'">';
                                    $content .= '</td>';
                                } elseif ($offer_tip_comission[$i] == 2) {
                                    $content .= '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . ($offer_comission[$i]) . ' % </td>';
                                }
                            } else {
                                if ($offer_tip_comission[$i] == 1) {
                                    $content .= '<td style="height: auto;border:none;vertical-align:middle;padding:0;">' . ($offer_comission[$i]) . ' руб.</td>';
                                    $content .= '<td style="height: auto;border:none;vertical-align:middle;padding:0;">';                                    
                                    $content .= '<input type="hidden" name="bonus_country[]" value="'.$val.'">';
                                    $content .= '<input style="width: 65px;text-align:center;" type="text" name="comission[]" value="'.$input_comission.'">';
                                    $content .= '</td>';                                   
                                } elseif ($offer_tip_comission[$i] == 2) {
                                    $content .= '<td style="height: auto;border:none;vertical-align:middle;padding:0;">';
                                    $content .= ($offer_comission[$i]) . ' %</td>';
                                }
                            }

                            $content .= '</tr>';
                            $i++;
                        }
                    }
                } else {
                    $content .= '<td style="height: auto;border:none;vertical-align:middle;padding:0;">-</td>';
                }       
                
            $content .= '</table>';
            $content .= '</td>';
            $content .= '</tr>';   
            
            $content .= '<tr height="100px">';
            $content .= '<td colspan="4">';
            $content .= '<input type="hidden" name="user_id" value="'.$user->id.'">';
            $content .= '<input type="hidden" name="offer" value="'.$offer->id.'">';
            $content .= '<input class="others_button_sohranit" type="submit" name="comission_bonus_change" value="Сохранить">';
            $content .= '</td>';
            $content .= '</tr>';                          
                            
            $content .= '</table>';
            $content .= '</form>';
       
            
            $array = array(
              "status" => 'success',
              "message" => $content
            );echo json_encode( $array );exit;	     
            
        }else{   
            $array = array(
              "status" => 'error',
              "message" => 'Ошибка!'
            );echo json_encode( $array );exit;            
        }

    }else exit();
        
}else exit();