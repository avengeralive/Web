<?php
	
	$utm_source = '';$utm_medium = '';$utm_campaign = '';$utm_term = '';$utm_content = '';
    if(isset($_GET["utm_source"]) && $_GET["utm_source"] != ''){
		$utm_source = htmlentities($_GET["utm_source"]);
        setcookie("utm_source",$utm_source,time()+(60*60*24*30));
    }
    if(isset($_GET["utm_medium"]) && $_GET["utm_medium"] != ''){
		$utm_medium = htmlentities($_GET["utm_medium"]);
        setcookie("utm_medium",$utm_medium,time()+(60*60*24*30));
    }
    if(isset($_GET["utm_campaign"]) && $_GET["utm_campaign"] != ''){
		$utm_campaign = htmlentities($_GET["utm_campaign"]);
        setcookie("utm_campaign",$utm_campaign,time()+(60*60*24*30));
    }
    if(isset($_GET["utm_term"]) && $_GET["utm_term"] != ''){
		$utm_term = htmlentities($_GET["utm_term"]);
        setcookie("utm_term",$utm_term,time()+(60*60*24*30));
    }
    if(isset($_GET["utm_content"]) && $_GET["utm_content"] != ''){
		$utm_content = htmlentities($_GET["utm_content"]);
        setcookie("utm_content",$utm_content,time()+(60*60*24*30));
    }

	// Пишем в базу данные о визите посетителя
	// Write to the data on the visit of the visitor database
	if (!isset($user_id)) {$user_id = '0';}
	if (!isset($user_session)) {$user_session = '';}
	if (!isset($deystvie)) {$deystvie='1';}
        
        
        $page = site_url(). $_SERVER['REQUEST_URI'];
        $cl = new Users_Log;
        $cl->id_user=$user_id;
        $cl->page=$page;
        $cl->country=$country;
        $cl->short_country=$short_country;
        $cl->region=$region;
        $cl->town=$town;
        $cl->ip=$ip;
        $cl->browser_name=$browser_name;
        $cl->browser_version=$browser_version;
        $cl->referer=$referer;
        $cl->useragent=$useragent;
        $cl->platform=$platform;
        $cl->mobile=$mobile;
        $cl->subid1=$subid1;
        $cl->subid2=$subid2;
        $cl->subid3=$subid3;
        $cl->subid4=$subid4;
        $cl->subid5=$subid5;
        $cl->user_session=$user_session;
        $cl->deystvie=$deystvie;
        $cl->utm_source=$utm_source;
        $cl->utm_medium=$utm_medium;
        $cl->utm_campaign=$utm_campaign;
        $cl->utm_term=$utm_term;
        $cl->utm_content=$utm_content;        
        $cl->create();        
	
	if (isset($user_id) && isset($user_session) && $user_id != 0){
            // Записываем сессию в таблицу users
            // Нужно для последующего определения аккаунтов-дублей
            $users = User::getById($user_id);
            $users->update([
                'user_session' => $user_session,
                'ip' => $ip,
                'date_activity' => date('Y-m-d H:i:s')
            ]);
	}	
?>
