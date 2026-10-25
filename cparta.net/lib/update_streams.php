<?php

if(isset($_REQUEST['download'])){
    
    include './includes/Zip/index.php';
    
    $landings = Landings::getById($_REQUEST['land']);
    
    
    $landing = $landings->url;
    $arch_url = explode('/', $landing);  // cparta.net/AlfaMan/AlfaManV1
    $arch_url = array_filter($arch_url); 
    $arch_url = array_values($arch_url);
    /*
    $url = '';
    $url_path_1 = $arch_url[count($arch_url) - 1];
    foreach ($arch_url as $k => $v){
        if($k < 2){continue;}
        $url .= $v . '/';
    }
    */
    $url = $arch_url[count($arch_url) - 2] . '/' . $arch_url[count($arch_url) - 1];
    
    
    $p = dirname(__FILE__) . '/../offers/' . $url;

    if (file_exists('./tmp/dland/' . $landings->id . '.zip')) {
        $file = 'http://cparta.net/tmp/dland/' . $landings->id . '.zip';
        if (ob_get_level()) {
            ob_end_clean();
        }
        echo $file;
        exit;
    }else{
        zip($p, './tmp/dland/' . $landings->id . '.zip');
        $file = 'http://cparta.net/tmp/dland/' . $landings->id . '.zip';
        if (ob_get_level()) {
            ob_end_clean();
        }
        echo $file;
        exit;
    }
}

// Блок с обновлением в базе данных пользователя
// Block the update in the user database
$user = User::getById($user_id);
if (!$user) {
    if (!headers_sent()) {
        header('Location: ./streams.php?xtext=3');
    }
    exit;
}

if (isset($_POST['streams_submit'])) {

    $sql = "SELECT id FROM users WHERE `id` = '$user_id'";
    $res = $mysqli->query($sql);
    $result = $res->fetch_assoc();
    if ((int) $result['id']) {

        if (isset($_POST['offer'])) {
            $offer = htmlentities($_POST['offer']);
        } else {
            Header('Location: ./streams.php?xtext=1');
        }
        if (isset($_POST['name'])) {
            $name_stream = htmlentities($_POST['name']);
        } else {
            $name_stream = '';
           // Header('Location: ./streams.php?xtext=2');
        }
        if (isset($_POST['comeback']) && $_POST['comeback'] == 'on') {
            $comeback = 1;
        } else {
            $comeback = 0;
        }
        if (isset($_POST['pl_in_head']) && $_POST['pl_in_head'] == 'on') {
            $pl_in_head = 1;
        } else {
            $pl_in_head = 0;
        }
        if (isset($_POST['pl_order']) && $_POST['pl_order'] == 'on') {
            $pl_order = 1;
        } else {
            $pl_order = 0;
        }
        if (isset($_POST['pl_dost']) && $_POST['pl_dost'] == 'on') {
            $pl_dost = 1;
        } else {
            $pl_dost = 0;
        }
        if (isset($_POST['pl_us_online']) && $_POST['pl_us_online'] == 'on') {
            $pl_us_online = 1;
        } else {
            $pl_us_online = 0;
        }
        if (isset($_POST['pl_freez_price']) && $_POST['pl_freez_price'] == 'on') {
            $pl_freez_price = 1;
        } else {
            $pl_freez_price = 0;
        }

        $subtourl = '';

        if (isset($_POST['subid1'])) {
            $subid1 = htmlentities($_POST['subid1']);
            $subtourl .= '&subid1=' . $subid1;
        } else {
            $subid1 = '';
        }
        if (isset($_POST['subid2'])) {
            $subid2 = htmlentities($_POST['subid2']);
            $subtourl .= '&subid2=' . $subid2;
        } else {
            $subid2 = '';
        }
        if (isset($_POST['subid3'])) {
            $subid3 = htmlentities($_POST['subid3']);
            $subtourl .= '&subid3=' . $subid3;
        } else {
            $subid3 = '';
        }
        if (isset($_POST['subid4'])) {
            $subid4 = htmlentities($_POST['subid4']);
            $subtourl .= '&subid4=' . $subid4;
        } else {
            $subid3 = '';
        }
        if (isset($_POST['subid5'])) {
            $subid5 = htmlentities($_POST['subid5']);
            $subtourl .= '&subid5=' . $subid5;
        } else {
            $subid3 = '';
        }
        if (isset($_POST['GoogleAnalytics'])) {
            $GoogleAnalytics = htmlentities(trim($_POST['GoogleAnalytics']));
        } else {
            $GoogleAnalytics = '';
        }
        if (isset($_POST['metrika'])) {
            $metrika = htmlentities(trim($_POST['metrika']));
        } else {
            $metrika = '';
        }
        if (isset($_POST['vk'])) {
            $vk = htmlentities($_POST['vk']);
        } else {
            $vk = '';
        }
        if (isset($_POST['facebook'])) {
            $facebook = htmlentities($_POST['facebook']);
        } else {
            $facebook = '';
        }
        if (isset($_POST['mail'])) {
            $mail = htmlentities($_POST['mail']);
        } else {
            $mail = '';
        }
        if (isset($_POST['directadvert'])) {
            $directadvert = htmlentities($_POST['directadvert']);
        } else {
            $directadvert = '';
        }
        if (isset($_POST['postback_add']) && $_POST['postback_add'] == 'on') {
            $postback_add = 1;
        } else {
            $postback_add = 0;
        }
        if (isset($_POST['postback_success']) && $_POST['postback_success'] == 'on') {
            $postback_success = 1;
        } else {
            $postback_success = 0;
        }
        if (isset($_POST['postback_cancel']) && $_POST['postback_cancel'] == 'on') {
            $postback_cancel = 1;
        } else {
            $postback_cancel = 0;
        }
        if (isset($_POST['postback_url'])) {
            $postback_url = htmlentities($_POST['postback_url']);
        } else {
            $postback_url = '';
        }
        if (isset($_POST['land'])) {
            $landings = htmlentities(implode(',', isset($_POST['land']) ? $_POST['land'] : []));
        } else {
            $landings = '';
        }
        if (isset($_POST['pre'])) {
            $pre = htmlentities(implode(',', isset($_POST['pre']) ? $_POST['pre'] : []));
        } else {
            $pre = '';
        }
        

        if (isset($_POST['domain'])) {
            $domain = htmlentities($_POST['domain']);
        } else {
            $domain = 1;
        }
        $post = new Request($_POST);
        $trafback_countrys = $post->countries;
        $trafback_urls = $post->url_trafback;
        $trafback = '';
        if (count($trafback_countrys) == count($trafback_urls)) {
            $count = count($trafback_countrys);
            for ($i = 0; $count > $i; $i++) {
                if ($trafback_countrys[$i] == '0' || $trafback_urls[$i] == '' || $trafback_urls[$i] == 'http://') {
                    continue;
                }
                $trafback .= $trafback_countrys[$i] . '|' . $trafback_urls[$i] . ';';
            }
        } else {
            Header('Location: ./streams.php?xtext=6');
            exit;
        }

        $code = partnerstroka_encode($user_id . '-' . $offer);

        $sql_domain = "SELECT * FROM domains WHERE ((`user_id`='$user_id' AND `active` = '5') OR `active` IN (1,4)) AND `id` = '$domain'";
        $result_domain = $mysqli->query($sql_domain);
        if (mysqli_num_rows($result_domain) == 0) {
            Header('Location: ./streams.php?xtext=6');
            exit;
        }
        $res_domain = mysqli_fetch_array($result_domain);
        $domen = $res_domain['domain'];

        $sql = "SELECT MAX(`id`) FROM streams";
        $result = $mysqli->query($sql);
        $res = mysqli_fetch_array($result);
        $id = $res['MAX(`id`)'];
        $url = 'http://' . $domen . '/?code=' . $code . '&s=' . ($id + 1) . $subtourl;

        $smartAB = isset($post->smartAB) ? 1 : 0;
        $auto_mobile = isset($post->auto_mobile) ? 1 : 0;
        
        $stream = new Stream();
        $stream->auto_mobile = $auto_mobile;
        $stream->smartAB = $smartAB;
        $stream->user_id = $user_id;
        $stream->name = $name_stream;
        $stream->url = $url;
        $stream->offer_id = $offer;
        $stream->prelanding_id = $pre;
        $stream->landing_id = $landings;
        $stream->domain_id = $domain;
        $stream->comeback = $comeback;
        $stream->pl_in_head = $pl_in_head;
        $stream->pl_order = $pl_order;
        $stream->pl_dost = $pl_dost;
        $stream->pl_us_online = $pl_us_online;
        $stream->pl_freez_price = $pl_freez_price;
        $stream->subid1 = $subid1;
        $stream->subid2 = $subid2;
        $stream->subid3 = $subid3;
        $stream->subid4 = $subid4;
        $stream->subid5 = $subid5;
        $stream->metrika = $metrika;
        $stream->vk = $vk;
        $stream->facebook = $facebook;
        $stream->mail = $mail;
        $stream->directadvert = $directadvert;
        $stream->GoogleAnalytics = $GoogleAnalytics;
        $stream->trafback = $trafback;
        $stream->create();
        $id_stream = $stream->id;

    
        if($postback_add == 1 || $postback_success == 1 || $postback_cancel == 1){
            $p = new Postback;
            $p->user_id = $user_id;
            $p->url = $postback_url;
            $p->send_add = $postback_add;
            $p->send_approve = $postback_success;
            $p->send_cancel = $postback_cancel;
            $p->type_send = 1;
            $p->stream = $id_stream;
            $p->create();
        }

        Header('Location: ./streams.php?xtext=3');
        exit;
    } else {
        Header('Location: ./logout.php');
        exit;
    }
}

if (isset($_POST['streams_edit'])) {

    $post = new Request($_POST);
    $stream = Stream::getById($post->stream_id);
    if (!$stream || $stream->user_id != $user->id) {
        Header('Location: ./streams.php?xtext=7');
        exit;
    }

    $offer = $stream->offer_id;
    $code = partnerstroka_encode($user_id . '-' . $offer);
    $domain = Domain::getById($post->domain);
    if (!$domain || !(($domain->user_id == $user->id && $domain->active == 5 ) || $domain->active == 1 || $domain->active == 4 )) {
        Header('Location: ./streams.php?xtext=6');
        exit;
    }
  
    $trafback_countrys = $post->countries;
    $trafback_urls = $post->url_trafback;
    $trafback = '';



    if (count($trafback_countrys) == count($trafback_urls)) {
        $count = count($trafback_countrys);
        for ($i = 0; $count > $i; $i++) {
            if ($trafback_countrys[$i] == '0' || $trafback_urls[$i] == '' || $trafback_urls[$i] == 'http://') {
                continue;
            }
            $trafback .= $trafback_countrys[$i] . '|' . $trafback_urls[$i] . ';';
        }
    } else {
        Header('Location: ./streams.php?xtext=6');
        exit;
    }


    $subtourl = '';

    if ($stream->subid1 != '') {
        $subtourl .= '&subid1=' . $stream->subid1;
    }
    if ($stream->subid2 != '') {
        $subtourl .= '&subid2=' . $stream->subid2;
    }
    if ($stream->subid3 != '') {
        $subtourl .= '&subid3=' . $stream->subid3;
    }
    if ($stream->subid4 != '') {
        $subtourl .= '&subid4=' . $stream->subid4;
    }
    if ($stream->subid5 != '') {
        $subtourl .= '&subid5=' . $stream->subid5;
    }

    $url = 'http://' . $domain->domain . '/?code=' . $code . '&s=' . $stream->id . $subtourl;
    
    $postback_add = isset($post->postback_add) ? 1 : 0;
    $postback_success = isset($post->postback_success) ? 1 : 0;
    $postback_cancel = isset($post->postback_cancel) ? 1 : 0;
    
    $up = [
        'name' => $post->name,
        'landing_id' => implode(',', isset($post->land) ? $post->land : []),
        'prelanding_id' => implode(',', isset($post->pre) ? $post->pre : []),
        'url' => $url,
        'domain_id' => $domain->id,
        'comeback' => isset($post->comeback) ? 1 : 0,
        'pl_in_head' => isset($post->pl_in_head) ? 1 : 0,
        'pl_order' => isset($post->pl_order) ? 1 : 0,
        'pl_dost' => isset($post->pl_dost) ? 1 : 0,
        'pl_us_online' => isset($post->pl_us_online) ? 1 : 0,
        'pl_freez_price' => isset($post->pl_freez_price) ? 1 : 0,
        'subid1' => $post->subid1,
        'subid2' => $post->subid2,
        'subid3' => $post->subid3,
        'subid4' => $post->subid4,
        'subid5' => $post->subid5,        
        'metrika' => $post->metrika,
        'vk' => $post->vk,
        'facebook' => $post->facebook,
        'mail' => $post->mail,
        'directadvert' => $post->directadvert,
        'GoogleAnalytics' => $post->GoogleAnalytics,
        'postback_add' => $postback_add,
        'postback_success' => $postback_success,
        'postback_cancel' => $postback_cancel,
        'postback_url' => $post->postback_url,
        'smartAB' => isset($post->smartAB) ? 1 : 0,
        'auto_mobile' => isset($post->auto_mobile) ? 1 : 0,
        'trafback' => $trafback,
    ];

    $stream->update($up);
    
    if(isset($post->postback_add) || isset($post->postback_success) || isset($post->postback_cancel)){
        $p = Postback::getByStream($stream->id);
        if($p){
            $p->update([
                'url' => $post->postback_url,
                'send_add' => $postback_add,
                'send_approve' => $postback_success,
                'send_cancel' => $postback_cancel,
            ]);
        }else{
            $p = new Postback;
            $p->user_id = $user_id;
            $p->url = $post->postback_url;
            $p->send_add = $postback_add;
            $p->send_approve = $postback_success;
            $p->send_cancel = $postback_cancel;
            $p->type_send = 1;
            $p->stream = $stream->id;
            $p->create();
        }
    }
    
    Header('Location: ./streams.php?xtext=5');
    exit;
}



if (isset($_GET['delete']) && $_GET['delete'] != 0 && $_GET['delete'] != '') {
    $stream = Stream::getById($_GET['delete']);
    if ($stream->user_id != $user->id || !$stream->delete()) {
        Header('Location: ./logout.php');
        exit;
    } else {
        Header('Location: ./streams.php?xtext=4');
        exit;
    }
}
?>
