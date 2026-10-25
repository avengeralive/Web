<?php

class Frod_Checker {
    
    const WARNING_PASTE = 1;
    const WARNING_ONLINE = 2;    
    const WARNING_WEBIP = 4;
    const WARNING_SAMEIP = 8;
    const WARNING_NOREFERER = 16;
    const WARNING_PHONENUMBER = 32;
    const WARNING_PHONEGEO = 64; 
    const WARNING_WEBMONEYBL = 128;
    const WARNING_BLACKLIST = 256;
    
    
    public function check_PastedOrOnline ( Zakaz $zakaz, $weight) {

        if($zakaz->warning == 1){               
            $warning = 0;
            $warning_level = $zakaz->warning_level;
            $paste_warning = strripos($zakaz->warning_type, self::WARNING_PASTE);
            if($type_warning !== false){
                $warning_level += $weight;
                $warning += self::WARNING_PASTE;
            }
            $online_warning = strripos($zakaz->warning_type, self::WARNING_ONLINE);
            if($type_warning !== false){
                $warning_level += $weight;
                $warning += self::WARNING_ONLINE;
            }  
            $zakaz->update([
                'warning' => $warning,
                'warning_level' => $warning_level,
            ]);           
            return true;
        }
        
    }
    
    public function check_WebIP ( Zakaz $zakaz, $weight) {
        
        $warning = $zakaz->warning;
        $warning_level = $zakaz->warning_level;
        $webmaster = $zakaz->user_id;
        $user = User::getById($webmaster);
        $user_ip = $user->ip;

        if($zakaz->ip == $user_ip){
            $warning_level += $weight;
            $warning += self::WARNING_WEBIP;

            $zakaz->update([
                'warning' => $warning,
                'warning_level' => $warning_level,
            ]);
            return $warning;
        }              
        return true;    
    } 
    
    public function check_SameIP ( Zakaz $zakaz, $weight) {
        
        $z = new Zakaz_Manager(DB::getInstance());
        $z->where('ip', $zakaz->ip);
        $z->where('id', $zakaz->id, '!=');
        $z->get();
        if (0 && $z->getTotal() > 0) {
            $warning = $zakaz->warning;
            $warning_level = $zakaz->warning_level;
            
            $warning_level += $weight;
            $warning += self::WARNING_SAMEIP;

            $zakaz->update([
                'warning' => $warning,
                'warning_level' => $warning_level,
            ]);  
            return $warning;  
        }
        return true;                             
    }    
    
    public function check_NoRerrer ( Zakaz $zakaz, $weight) {
        
        $warning = $zakaz->warning;
        $warning_level = $zakaz->warning_level;
        if($zakaz->referer == ''){
            $warning_level += $weight;
            $warning += self::WARNING_NOREFERER;
            
            $zakaz->update([
                'warning' => $warning,
                'warning_level' => $warning_level,
            ]);   
            return $warning;   
        }
        return true;   
    }   
    
    public function check_HR ( Zakaz $zakaz, $weight) {

        $webmaster = $zakaz->user_id;
        $user = User::getById($webmaster);
        if($user->hr_check == 0 || $zakaz->phone == '' || in_array(strtolower($zakaz->name), ['test', 'test2', 'тест', 'тест2'])){return true;}
        
        $warning = $zakaz->warning;
        $warning_level = $zakaz->warning_level;

        $warning_level += $weight;
        $warning += self::WARNING_PHONENUMBER;        
        
        $url = 'https://smsc.ru/sys/send.php?login=awdev&psw=222222&phones='. $zakaz->phone .'&hlr=1&fmt=3';
        $send = file_get_contents($url);
        $send = json_decode($send);   
        
        if(isset($send->error_code)){
            if($send->error_code == 7 || $send->error_code == 8){
                $zakaz->update([
                    'warning' => $warning,
                    'warning_level' => $warning_level,
                ]);  
                return $warning; 
            }
        }else{
            $url = 'https://smsc.ru/sys/status.php?login=awdev&psw=222222&phone='. $zakaz->phone .'&id='. $send->id .'&fmt=3';
            $send = file_get_contents($url);
            $send = json_decode($send);       
            if(in_array($send->status, [20, 22, 25])){
                $zakaz->update([
                    'warning' => $warning,
                    'warning_level' => $warning_level,
                ]);
                return $warning; 
            }
        }
        return true; 
    }  
    
    public function check_PhoneGeo ( Zakaz $zakaz, $weight) {

        if($zakaz->phone == '' || in_array(strtolower($zakaz->name), ['test', 'test2', 'тест', 'тест2'])){return true;}
        
        $warning = $zakaz->warning;
        $warning_level = $zakaz->warning_level;

        $warning_level += $weight;
        $warning += self::WARNING_PHONEGEO;        
        if($zakaz->region_iso_phone == ''){
            $url = 'http://htmlweb.ru/geo/api.php?html&telcod='. $zakaz->phone .'&api_key=41d4798fbc9567c771c1a4d0b82f1d2c&json&fields=iso&charset=utf-8';
            $send = file_get_contents($url);
            $send = json_decode($send, true);  
            $region = (isset($send['region']['iso']) && $send['region']['iso'] != '') ? $send['region']['iso'] : '';
            $zakaz->update([
                'region_iso_phone' => $region,
            ]);            
        }else{
            $region = $zakaz->region_iso_phone;
        } 
               
        if(isset($region) && $region != ''){
            if($region != $zakaz->region_iso){
                $zakaz->update([
                    'warning' => $warning,
                    'warning_level' => $warning_level,
                ]);
                return $warning; 
            }
        }
        return true; 
    }

    public function check_Blacklist ( Zakaz $zakaz, $weight) {

        if($zakaz->phone == '' || in_array(strtolower($zakaz->name), ['test', 'test2', 'тест', 'тест2'])){return true;}
        
        $warning = $zakaz->warning;
        $warning_level = $zakaz->warning_level;

        $warning_level += $weight;
        $warning += self::WARNING_BLACKLIST;        
       
        $sql = "Select * from frod_blacklist where ip='{$zakaz->ip}' or phone='{$zakaz->phone}'";
        $stmt = DB::getInstance()->query($sql);
        echo $stmt->rowCount();
        if ($stmt->rowCount() > 0) {
            $zakaz->update([
                'warning' => $warning,
                'warning_level' => $warning_level,
            ]);
            return $warning;
        }
        return true;
       
    } 

    public function check_Payments ($user) {

        $z = new Zakaz_Manager(DB::getInstance());
        $z->where('user_id', $user->id);
        $z->where('addstatus', [1,5,6,9], Entity_Manager::WHERE_IN);
        $z->limit(-1);
        $z->get();
        $count = $z->getTotal();
        
        return $count;
        
    }  

    public function check_FrodUser ($user, $count_no_payment) {

        $settings = Settings::getById(1);
        $limit_warning = $settings->limit_warning;
        $percent_frod = 100 - $settings->percent_frod; ///5
        $min_zakaz = 10;
        
        $z = new Zakaz_Manager(DB::getInstance());
        $z->where('user_id', $user->id);
        $z->where('warning_level', $limit_warning,'>');
        $z->where('addstatus', [1,5,6,9], Entity_Manager::WHERE_NOT_IN);
        $z->limit(-1);
        $z->get();
        $count_warning = $z->getTotal();        
        $count_warning += $count_no_payment;
        
        $z = new Zakaz_Manager(DB::getInstance());
        $z->where('user_id', $user->id); 
        $z->where('status', [1,2,3], Entity_Manager::WHERE_IN); 
        $z->limit(-1);
        $z->get();
        $all_zakaz = $z->getTotal();
        if($all_zakaz > 0){
            $percent_good = 100 - round((($count_warning*100)/$all_zakaz),1);
        }else{
            $percent_good = 100;    
        }
        $u = User::getById($user->id);
        /*
        if($percent_good >= $percent_frod && $all_zakaz > $min_zakaz){           
            $u->update([
                'frod_check' => 1,
            ]);            
        }else{
            $u->update([
                'frod_check' => 0,
            ]); 
        }
        */
        $f = new Frod_Log();
        $log_user = $f->getById($user->id);
        if(count($log_user)>0){
            $log_user->update([
                'checkdate' => date('Y-m-d H:i:s'),
                'leads_checked' => $all_zakaz,
                'leads_warning' => $count_warning,
                'rating' => $percent_good,
            ]);
        }else{
            $f->userid = $user->id;
            $f->leads_checked = $all_zakaz;
            $f->leads_warning = $count_warning;
            $f->rating = $percent_good;
            $f->create();     
        }
        
        $u->update([
            'rating' => $percent_good,
        ]);
    }
}
