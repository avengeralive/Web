<? 

require_once('../_settings/settings.php');
require_once(CLASSES_BASE.'class_ice_error_handler.php');
require_once(CLASSES_BASE.'class_ice_templates.php');
require_once(CLASSES_BASE.'class_ice_mysql.php');
require_once(CLASSES_BASE.'class_ice_cache.php');
require_once(CLASSES_BASE.'class_permission_manager.php');
require_once(CLASSES_BASE.'class_html_mime_mail.php');
require_once(CLASSES_BASE.'admin_icms.php');

$rights = array(
    'view'=>107,
    'edit'=>107
    );

$bgcolors = array(
/*
    "0" => "#ffffff",
    "1" => "#f0f0f0",
    "2" => "#ffdddd"
*/
    "0" => "",
    "1" => "",
    "2" => "error"
	);

$cpermissions = array(
	"view"=>"Просмотр раздела",
	"edit"=>"Редактирование раздела"
	);

	$interface_form['create']=
		array(
			'firm_id'=>array(
				'regexp'=>'^([0-9]+)$', 
				'message'=>'Поле <strong>FIRM_ID</strong> не определено!',
				),
			'login'=>array(
				'regexp'=>'^(.{3,255})$', 
				'message'=>'Поле <strong>Логин доступа</strong> заполнено неверно. Допустимая длина - от 3 до 255 символов.'
				),
			'password'=>array(
				'regexp'=>'^(.{5,255})$', 
				'message'=>'Поле <strong>Пароль</strong> заполнено неверно. Допустимая длина - от 5 до 255 символов.'
				),
			'email'=>array(
//				'regexp'=>'^(.{7,255})$', 
				'regexp'=>'^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'. '@'. '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.' . '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', 
				'message'=>'Поле <strong>E-mail</strong> заполнено неверно. Допустимая длина - от 7 до 255 символов, должен быть введен правильный e-mail адрес.'
				),
			);
	$interface_form['update']=
		array(
			'firm_id'=>array(
				'regexp'=>'^([0-9]+)$', 
				'message'=>'Поле <strong>FIRM_ID</strong> не определено!',
				),
			'email'=>array(
				'regexp'=>'^[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+'. '@'. '[-!#$%&\'*+\\/0-9=?A-Z^_`a-z{|}~]+\.' . '[-!#$%&\'*+\\./0-9=?A-Z^_`a-z{|}~]+$', 
				'message'=>'Поле <strong>E-mail</strong> заполнено неверно. Допустимая длина - от 5 до 255 символов, должен быть введен правильный e-mail адрес.'
				),
			'login'=>array(
				'regexp'=>'^(.{3,255})$', 
				'message'=>'Поле <strong>Логин доступа</strong> заполнено неверно. Допустимая длина - от 3 до 255 символов.'
				),
			'password'=>array(
				'regexp'=>'^(.{1,255})$', 
				'message'=>'Поле <strong>Пароль</strong> заполнено неверно. Допустимая длина - от 1 до 255 символов.'
				),
			);


$m = new ice_mysql();
$pm = new permission_manager($m);
if (!$pm->checkLogged()){
	// добавить в лог что кто то логинился...
	exit();
	};
$status_permission = $pm->check_rights($rights['view']);
if (!$status_permission['status']) {
	$pm->show_permission_denied();
	exit();
	};

if (isset($HTTP_POST_VARS['ID'])) {
	$ID = $HTTP_POST_VARS['ID'];
	$V = $HTTP_POST_VARS;
	}
elseif (isset($HTTP_GET_VARS['ID'])) {
	$ID = $HTTP_GET_VARS['ID'];
	$V = $HTTP_GET_VARS;
	}
else {
	$ID = 'index';
	$V = $HTTP_GET_VARS;
	};


$html = "";
if ( function_exists($ID) ) {
	$html = call_user_func($ID);
	}
else {
	$html = "Обработчик для $ID не существует.";
	};
ice_cache::no_cache($html, CACHE_USE_HEADERS);
exit();


//========================================================================================================//


/*
function add_company(){
	global $m, $pm, $V,$bgcolors;
//	alid($V);
	
	// создадим контейнеры.
	$url = $V['url'];
	$adm = new admin_icms($m);
	// карточка компании
	$obj = $adm->add_document(ID_ENG_MEMBERS, 'folder_eng_company', $V['name_eng'], '', '', '','', 'active', 'active', $url, '');
	$id = $obj['id'];
	$eng_id = $obj['id'];
	// контейнер для новостей
	$obj = $adm->add_document($id, 'folder_eng', 'News '.$V['name_eng'], '', '', '','', 'active', 'active', 'news', '');
	// контейнер для новинок товаров
	$obj = $adm->add_document($id, 'folder_eng', 'New equipment from '.$V['name_eng'], '', '', '','', 'active', 'active', 'novelty', '');
	
	// карточка компании
	$obj = $adm->add_document(ID_MEMBERS, 'folder_company', $V['name_rus'], '', '', '','', 'active', 'active', $url, '');
	$id = $obj['id'];
	$rus_id = $obj['id'];
	// контейнер для новостей
	$obj = $adm->add_document($id, 'folder_eng', 'Новости '.$V['name_rus'], '', '', '','', 'active', 'active', 'news', '');
	// контейнер для новинок товаров
	$obj = $adm->add_document($id, 'folder_eng', 'Новинки оборудования от '.$V['name_rus'], '', '', '','', 'active', 'active', 'novelty', '');
	
	// узнаем новый FIRM_ID
	$o_next_id = $m->selectOneRow("select 1+max(0+pvalue) as next_firm_id  from params where pname='firm_id'  ", NULL,NULL,NULL);
	$firm_id = $o_next_id['next_firm_id'];
	$V['firm_id_rus'] = $firm_id;
	$V['firm_id_eng'] = $firm_id;
	
	// вставим параметры
	
	while (list($k, $v)=each($V)) {
		if (preg_match('/^(.*)_([a-z]{1,9})$/',$k,$mm)){
			$param=$mm[1];
			$sid=$mm[2];
			$id = ($sid=='rus')?$rus_id:$eng_id;
//			echo "sid=$sid id=$id param=$param pvalue=$v<br />";
			if ($param!='name'){
				_set_param($id,$param,$v);
				}
			else {
				};
		
		};
	};
	
	$V['firm_id'] = $firm_id;
	return view_user_card('Обновлено');	
	}
*/	
	

function update_company(){
	global $m, $pm, $V,$bgcolors;
	$rus_id = $V['rusid'];
	$eng_id = $V['engid'];
	while (list($k, $v)=each($V)) {
		if (preg_match('/^(.*)_([0-9]{1,9})$/',$k,$mm)){
			$param=$mm[1];
			$id=$mm[2];
		//	echo "id=$id param=$param pvalue=$v<br />";
			if ($param!='name'){
				_set_param($id,$param,$v);
				}
			else {
				$pp1 = $m->query("update ".MYSQL_DB.".tree set name='".$v."' where id={$id}",NULL,NULL,NULL);
				$pp1 = $m->query("update ".MYSQL_DB.".docs set fullname='".$v."' where id={$id}",NULL,NULL,NULL);
				};
		
		};
	};
	
	return view_user_card('Обновлено');	
	}

function set_company_active(){
	global $m, $pm, $V,$bgcolors;
	$rus_id = $V['rus_id'];
	$eng_id = $V['eng_id'];
	_set($rus_id,'active','');
	_set($eng_id,'active','');
	return view_user_card('Обновлено');	
	}

function _set($id,$status,$pvalue){
	global $m, $pm, $V,$bgcolors;
	$pp1 = $m->query("update ".MYSQL_DB.".tree set status='".$status."' where id={$id}",NULL,NULL,NULL);
	$pp1 = $m->query("update ".MYSQL_DB.".tree set status='".$status."' where parent_id={$id}",NULL,NULL,NULL);
	_set_param($id,'expo2017',$pvalue);
	_set_param($id,'expo2017',$pvalue);
	}

function _set_param($id,$pname,$pvalue){
	global $m, $pm, $V,$bgcolors;
	$pp = $m->selectOneRow("select * from ".MYSQL_DB.".params where pname='".$pname."' and doc_id={$id}",NULL,NULL,NULL);
	if (isset($pp['uid'])){
		$pp1 = $m->query("update ".MYSQL_DB.".params set pname='".$pname."', pvalue='".$pvalue."' where uid={$pp['uid']}",NULL,NULL,NULL);
		}
	else {
		$pp1 = $m->query("insert ".MYSQL_DB.".params set pname='".$pname."', pvalue='".$pvalue."',doc_id='{$id}' ",NULL,NULL,NULL);
		};
	}


	
function set_company_hidden(){
	global $m, $pm, $V,$bgcolors;
	$rus_id = $V['rus_id'];
	$eng_id = $V['eng_id'];
	_set($rus_id,'active','1');
	_set($eng_id,'active','1');
	return view_user_card('Обновлено');		
	}


function set_company_disabled(){
	global $m, $pm, $V,$bgcolors;
	$rus_id = $V['rus_id'];
	$eng_id = $V['eng_id'];
	_set($rus_id,'disabled','1');
	_set($eng_id,'disabled','1');
	return view_user_card('Обновлено');		
	}


	
	
	
	
	
	
	
function index($error = ''){
		global $m, $pm, $V,$bgcolors;
		
$t = new ice_templates();
$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."member_users/index.html" );

$t->set_var('ADMINISTRATOR_NAME',  ADMINISTRATOR_NAME);
$t->set_var('ADMINISTRATOR_EMAIL',  ADMINISTRATOR_EMAIL);

$t->set_var('HTTP_BASE',  HTTP_BASE);
$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
$t->set_var('CMS_ADMIN_IMAGES_BASE',  CMS_ADMIN_IMAGES_BASE);
	
	

//	$o_firms = $m->gets('tree', array('parent_id'=>ID_MEMBERS,'status'=>'active'), 'name');
 	$o_firms = $m->gets('tree', array('parent_id'=>ID_MEMBERS), 'name');
	//alid($o_firms);
	$o_eng_firms = $m->gets('tree', array('parent_id'=>ID_ENG_MEMBERS), 'name');
	$off = array();
	while (list($k, $v)=each($o_firms)) {
		$o_firm_id = $m->get('params', array('pname'=>'firm_id','doc_id'=>$v['id']));
		if (isset(		$off[	$o_firm_id['pvalue']	]['rus']	)){
	//		alid('конфликт первичных ключей firm_id='.$o_firm_id['pvalue'].' уже используется');
	//		alid('СТАРЫЙ');
	//		alid(	$off[	$o_firm_id['pvalue']	]['rus']	);
	//		alid('НОВЫЙ');
	//		alid($v);
			};
		$off[	$o_firm_id['pvalue']	]['rus'] = $v;
		};
		
	while (list($k, $v)=each($o_eng_firms)) {
		$o_firm_id = $m->get('params', array('pname'=>'firm_id','doc_id'=>$v['id']));
		$off[	$o_firm_id['pvalue']	]['eng'] = $v;
		};
		
		
	//alid($off);
	//alid($o_firms);
	
	$t->set_block('page', 'BLOCK.MEMBER', 'BLOCK_MEMBER');
	$t->set_var('BLOCK_MEMBER', '');
	while (list($firm_id, $v)=each($off)) {
	//	alid($v);
		$o_expo2017= $m->get('params', array('pname'=>'expo2017','doc_id'=>$v['rus']['id']));
		$o_eng_expo2017= $m->get('params', array('pname'=>'expo2017','doc_id'=>$v['eng']['id']));
		
/*
		if ($o_expo2017['pvalue']!= $o_eng_expo2017['pvalue'])	{
//		echo "<h1>несовпадение параметров видимости в русской и английской у {$v['rus']['name']}</h1>";
			//alid($v);
			//alid($o_expo2017);
			//alid($o_eng_expo2017);
			if (!isset($o_eng_expo2017['pvalue'])){
				echo "<h1>нет английского параметра у {$v['rus']['name']}</h1>";
				};
			set_assoc($v['eng']['id'], '', 'expo2017', $o_expo2017['pvalue']);
			};
*/
		
		//alid($o_expo2017);
//		if ( ($v['rus']['status']=='active') && ( isset($o_expo2017['pvalue']) && ($o_expo2017['pvalue']=='') )) {		
		if (
			(($v['rus']['status']=='active') && ( isset($o_expo2017['pvalue']) && ($o_expo2017['pvalue']=='') ))
			&& 
			(($v['eng']['status']=='active') && ( isset($o_eng_expo2017['pvalue']) && ($o_eng_expo2017['pvalue']=='') ))
			) {		
			$o_new =   $m->get('tree', array('url'=>$v['rus']['url'].'news/','status'=>'active'));
			$o_novelty = $m->get('tree', array('url'=>$v['rus']['url'].'novelty/','status'=>'active'));

			$o_logins = $m->gets('apic2016_member.user_card', array('firm_id'=>$firm_id));
		//	alid($o_logins);
			$o_logins_txt = '';
				while (list($kk, $vv)=each($o_logins)) {
					$o_logins_txt .= $vv['login'].'<br />';
					};
			$t->set_var('MEMBER.logins', $o_logins_txt);
			$t->set_var('MEMBER.name', $v['rus']['name']);

			
	//	echo "{$v['rus']['id']} => 	{$o_stand['pvalue']} && {$v['eng']['id']} => {$o_eng_stand['pvalue']}<br />";
			
		$o_stand= $m->get('params', array('pname'=>'stand','doc_id'=>$v['rus']['id']));
		$o_eng_stand= $m->get('params', array('pname'=>'stand','doc_id'=>$v['eng']['id']));
					
			$t->set_var('MEMBER.stand', $o_stand['pvalue']);
			$t->set_var('MEMBER.eng.stand', $o_eng_stand['pvalue']);

			
			$t->set_var('MEMBER.eng.name', $v['eng']['name']);
			$t->set_var('MEMBER.id', $v['rus']['id']);
			$t->set_var('MEMBER.eng.id', $v['eng']['id']);
			$t->set_var('MEMBER.url', $v['rus']['url']);
			$t->set_var('MEMBER.eng.url', $v['eng']['url']);
			$t->set_var('MEMBER.expo2017', ( isset($o_expo2017['pvalue']) && ($o_expo2017['pvalue']!='') )?'спрятан':'активный');

			if ($v['rus']['status']!='active') {
	//			alid($v);
				$t->set_var('MEMBER.expo2017', 'выключен');
				};

			$t->set_var('MEMBER.firm_id', $firm_id);
			$t->set_var('MEMBER.news_id', isset($o_new['id'])?$o_new['id']:'');
			$t->set_var('MEMBER.news_name', isset($o_new['id'])?'добавить новость':'');
			$t->set_var('MEMBER.novelty_id', isset($o_novelty['id'])?$o_novelty['id']:'');
			$t->set_var('MEMBER.novelty_name', isset($o_novelty['id'])?'добавить новинку':'');		
			$t->parse('BLOCK_MEMBER', 'BLOCK.MEMBER', true);
			};
		};


		
		
		
	$t->set_block('page', 'BLOCK.AMEMBER', 'BLOCK_AMEMBER');
	$t->set_var('BLOCK_AMEMBER', '');
	reset(($off));
	while (list($firm_id, $v)=each($off)) {
		$o_expo2017= $m->get('params', array('pname'=>'expo2017','doc_id'=>$v['rus']['id']));
		if ( 
			(($v['rus']['status']!='active') || ( isset($o_expo2017['pvalue']) && ($o_expo2017['pvalue']!='') ))
			||
			(!( isset($o_expo2017['pvalue'])))
			)
			{		
			$o_new =   $m->get('tree', array('url'=>$v['rus']['url'].'news/','status'=>'active'));
			$o_novelty = $m->get('tree', array('url'=>$v['rus']['url'].'novelty/','status'=>'active'));

			$o_logins = $m->gets('apic2016_member.user_card', array('firm_id'=>$firm_id));
		//	alid($o_logins);
			$o_logins_txt = '';
				while (list($kk, $vv)=each($o_logins)) {
					$o_logins_txt .= $vv['login'].'<br />';
					};
			$t->set_var('AMEMBER.logins', $o_logins_txt);
			$t->set_var('AMEMBER.name', $v['rus']['name']);
			$t->set_var('AMEMBER.eng.name', $v['eng']['name']);
			$t->set_var('AMEMBER.id', $v['rus']['id']);
			$t->set_var('AMEMBER.eng.id', $v['eng']['id']);
			$t->set_var('AMEMBER.url', $v['rus']['url']);
			$t->set_var('AMEMBER.eng.url', $v['eng']['url']);
			$t->set_var('AMEMBER.expo2017', ( isset($o_expo2017['pvalue']) && ($o_expo2017['pvalue']!='') )?'спрятан':'активный');

			if ($v['rus']['status']!='active') {
	//			alid($v);
				$t->set_var('AMEMBER.expo2017', '<font color=red>выключен</font>');
				};

			$t->set_var('AMEMBER.firm_id', $firm_id);
			$t->set_var('AMEMBER.news_id', isset($o_new['id'])?$o_new['id']:'');
			$t->set_var('AMEMBER.news_name', isset($o_new['id'])?'добавить новость':'');
			$t->set_var('AMEMBER.novelty_id', isset($o_novelty['id'])?$o_novelty['id']:'');
			$t->set_var('AMEMBER.novelty_name', isset($o_novelty['id'])?'добавить новинку':'');		
			$t->parse('BLOCK_AMEMBER', 'BLOCK.AMEMBER', true);
			};
		};		

		
$t->parse("page","page");
$html = $t->get("page");
echo ($html);		
		}

		
		
		
function set_assoc($news_id, $cat_id, $param='t_n_a_', $pvalue='1'){
	global $m;
	//if($cat_id>0){
		$n = $param.$cat_id;
			$pp = $m->selectOneRow("select * from ".MYSQL_DB.".params where pname='{$n}' and doc_id={$news_id}",NULL,NULL,NULL);
			if (isset($pp['uid'])){
				echo "UPDATE\r\n";
				$pp1 = $m->query("update ".MYSQL_DB.".params set pname='{$n}', pvalue='{$pvalue}' where uid={$pp['uid']}",NULL,NULL,NULL);
				}
			else {
				echo "NEW $news_id $param $pvalue<br/>";
				$pp1 = $m->query("insert ".MYSQL_DB.".params set pname='{$n}', pvalue='{$pvalue}',doc_id='{$news_id}' ",NULL,NULL,NULL);
				};
	//	};
	}
		
		
function  update_logins(){
	global $m, $pm, $V, $model_user_admin, $bgcolors, $interface_form, $cpermissions;
	$firm_id=$V['firm_id'];
	//alid($V);
	$errors = '';
	$o_user_form = array();
	while (list($k, $v) = each($V)) {
		if (preg_match('/^email_(.*)$/',$k,$mm)){
			$id=$mm[1];
			//alid($k);
			//alid($v);
			if 	(preg_match("<".$interface_form['update']['email']['regexp'].">", $V['email_'.$id]) ){
				$o_user_form[$id]['email'] = $v;
				}
			else {
				$errors .= "<li>".$interface_form['update']['email']['message'];
				$o_user_form[$id]['email'] = '';
				};
				
			if 	(preg_match("<".$interface_form['update']['login']['regexp'].">", $V['login_'.$id]) ){
				$o_user_form[$id]['login'] =  $V['login_'.$id];
				}
			else {
				$errors .= "<li>".$interface_form['update']['login']['message'];
				$o_user_form[$id]['login'] = '';
				};

			if 	(preg_match("<".$interface_form['update']['password']['regexp'].">", $V['password_'.$id]) ){
				$o_user_form[$id]['password'] = $V['password_'.$id];
				}
			else {
				$errors .= "<li>".$interface_form['update']['password']['message'];
				$o_user_form[$id]['password'] = '';
				};				
			};
		};
//	alid($o_user_form);
//	alid($errors);
	if (strlen($errors)>0) {
		// есть ошибки. нельзя обновлять.
		return view_user_card($errors);
		};	
		
	// поменяем все данные.
	while (list($k, $v) = each($o_user_form)) {
		$m->update('apic2016_member.user_card', array('id'=>$k), array(
			'login'=>$v['login'],
			'password'=>$v['password'],
			'email'=>$v['email'],
			'user_name'=>$v['login']
			)
			);
		};
	$message = '<li>Обновлено!';	
		
		
	reset($V);
	while (list($k, $v) = each($V)) {
		if (preg_match('/^send_(.*)$/',$k,$mm)){
			$id=$mm[1];
			$card = $m->get("apic2016_member.user_card", array('id'=>$id));
//			alid($card);
	
		$email = $card['email'];
		$login = $card['login'];
		$password = $card['password'];
		$message .= "<li>Отправили логин и пароль (почта=$email логин=$login пароль=$password);";

$emailtext = "
Уважаемый член &laquo;АПИК&raquo;! 

Добро пожаловать в личный кабинет.
http://member.apic.ru/

Ваш логин  $login
Ваш пароль $password

================================


----
C уважением, служба поддержки &laquo;АПИК&raquo;
";




$htmltext = "
<!DOCTYPE html>
	<head>
		<meta http-equiv='content-type' content='text/html; charset=UTF-8' />
	</head>
<html>
	<body>
<br>
<br>
<b>Уважаемый член &laquo;АПИК&raquo;!</b><br>
<br>
Добро пожаловать в личный кабинет.<br>
<br>
<a href=http://member.apic.ru/>http://member.apic.ru/</a><br>
<br>
Ваш логин  $login<br>
Ваш пароль $password<br>
<br>


----<br>
C уважением, служба поддержки &laquo;АПИК&raquo;<br>
<br>
</body>
</html>
";


$html_mime_mail = new html_mime_mail();

$html_mime_mail->sendHTMLMail('wser@ya.ru', 'Логин и пароль личного кабинета АПИК',  '', $htmltext, 'climatexpo@apic.ru', 'АПИК','climatexpo@apic.ru');

$html_mime_mail->sendHTMLMail($email, 'Логин и пароль личного кабинета АПИК',  '', $htmltext, 'climatexpo@apic.ru', 'АПИК','climatexpo@apic.ru');

$html_mime_mail->sendHTMLMail('climatexpo@apic.ru', 'Логин и пароль личного кабинета АПИК',  '', $htmltext, 'climatexpo@apic.ru', 'АПИК','climatexpo@apic.ru');


	};
	};
		
	return view_user_card($message);
	}
		
		
		


function view_user_card($error = ''){
	global $m, $pm, $V, $model_user_admin, $bgcolors, $interface_form, $cpermissions;
	$firm_id=$V['firm_id'];
	//alid($firm_id);

	$t = new ice_templates();
	$t->set_file("page", DOCUMENT_TEMPLATES_ADMIN_INDEX."member_users/view_user_card.html" );
	$t->set_var('ADMINISTRATOR_NAME',  ADMINISTRATOR_NAME);
	$t->set_var('ADMINISTRATOR_EMAIL',  ADMINISTRATOR_EMAIL);
	$t->set_var('HTTP_BASE',  HTTP_BASE);
	$t->set_var('HTTPS_BASE_ADMIN',  HTTPS_BASE_ADMIN);
	$t->set_var('HTTPS_BASE_ADMIN_IMAGES',  HTTPS_BASE_ADMIN_IMAGES);
	$t->set_var('CMS_ADMIN_IMAGES_BASE',  CMS_ADMIN_IMAGES_BASE);	
	$t->set_var('PAGE.error', $error);	
	
	$t->set_var('new.password', substr(md5(rand()),0,7));
	
	
	$t->set_block('page', 'BLOCK.AMEMBER', 'BLOCK_AMEMBER');
	$t->set_var('BLOCK_AMEMBER', '');	
 	$o_logins = $m->gets('apic2016_member.user_card', array('firm_id'=>$V['firm_id']), 'id');
	//alid($o_logins);
	reset(($o_logins));
	while (list($k, $v)=each($o_logins)) {
			$t->set_var('login.id', $v['id']);
			$t->set_var('login.user_name', $v['user_name']);
			$t->set_var('login.login', $v['login']);
			$t->set_var('login.email', $v['email']);
			$t->set_var('login.status', 'активный');
			$t->set_var('login.password', $v['password']);
			$t->parse('BLOCK_AMEMBER', 'BLOCK.AMEMBER', true);
			};	
	
//	$o_firm_id = $m->gets('params', array('pname'=>'firm_id','pvalue'=>$V['firm_id']));
	$o_firm = $m->selectOneRow("select tree.* from tree left join params on params.doc_id=tree.id and params.pname='firm_id' where 
		tree.parent_id=".ID_MEMBERS." and 
		params.pvalue='".$firm_id."'",NULL,NULL, NULL);
	$o_eng_firm = $m->selectOneRow("select tree.* from tree left join params on params.doc_id=tree.id and params.pname='firm_id' where 
		tree.parent_id=".ID_ENG_MEMBERS." and 
		params.pvalue='".$firm_id."'",NULL,NULL, NULL);
	
	$o_firm_p = $m->gets('params',array('doc_id'=>$o_firm['id']));
	$o_eng_firm_p = $m->gets('params',array('doc_id'=>$o_eng_firm['id']));
	
//	alid($o_firm);
//	alid($o_firm_p);
//	alid($o_eng_firm);
//	alid($o_eng_firm_p);
	
	$t->set_var('rus.name', $o_firm['name']);
	$t->set_var('eng.name', $o_eng_firm['name']);
	$t->set_var('rus.url', $o_firm['url']);
	$t->set_var('eng.url', $o_eng_firm['url']);

	$t->set_var('rus.id', $o_firm['id']);
	$t->set_var('eng.id', $o_eng_firm['id']);
	
	$expo2017='?';
	$expo_e_2017='?';
	while (list($k, $v)=each($o_firm_p)) {
		
		if ($v['pname']=='expo2017'){$expo2017=$v['pvalue'];};
		
		$t->set_var('rus.'.$v['pname'], htmlspecialchars($v['pvalue']));		
		};
	while (list($k, $v)=each($o_eng_firm_p)) {
		if ($v['pname']=='expo2017'){$expo_e_2017=$v['pvalue'];};
		$t->set_var('eng.'.$v['pname'], htmlspecialchars($v['pvalue']));		
		};

		
	$status_firm = "?";
	if (!(isset($o_firm['status']) && isset($o_eng_firm['status']))){
		// ошибка
		$status_firm = "Ошибка";
		}
	elseif ((  $o_firm['status']=='active') && ($o_eng_firm['status']=='active') && ($expo2017=='') && ($expo_e_2017=='') ) {
		$status_firm = "Активный участник выставки";
		}
	elseif ((  $o_firm['status']=='active') && ($o_eng_firm['status']=='active') && ($expo2017!='') && ($expo_e_2017!='') ) {
		$status_firm = "Спрятанный участник выставки";
		}
	elseif ((  $o_firm['status']=='disabled') && ($o_eng_firm['status']=='disabled')  ){
		$status_firm = "Выключенные страницы участника";
		}
	else {
		$status_firm = "?";
		//alid($o_firm['status']);
		//alid($o_eng_firm['status']);
		//alid($expo2017);
		//alid($expo_e_2017);
		};
	$t->set_var('firm.status', $status_firm);
	$t->parse("page","page");
	return $t->get("page");
	}



function update_user_card(){
	global $m, $pm, $V, $model_user_admin, $bgcolors, $interface_form;
	$pm->_check_edit_rights();

	$errors = '';
	$o_user_form = array();
	while (list($k, $v) = each($interface_form['update'])) {
		if (
			isset($V[$k]) &&
			preg_match("<".$v['regexp'].">", $V[$k]) 
			) {
			$o_user_form[$k] = $V[$k];
			}
		else {
			$errors .= "<li>".$v['message'];
			$o_user_form[$k] = '';
			};
		};

	if (strlen($errors)>0) {
		// есть ошибки. нельзя обновлять.
		return view_user_card($errors);
		};

	$status = $model_user_admin->updateUserAccount(
		$o_user_form['userID'], 
		$o_user_form['login'], 
		$o_user_form['name'], 
		$o_user_form['email'], 
		$o_user_form['phone'], 
		$o_user_form['status'],
		$o_user_form['righttype']
		);
	if (!$status['status']){
		trigger_error('$model_user_admin->updateUserAccount=> false');
		};

	return view_user_card('Карточка пользователя обновлена');
	}







function add_new_login (){
	global $m, $pm, $V, $model_user_admin, $bgcolors, $interface_form;
	$pm->_check_edit_rights();

	$errors = '';
	$o_user_form = array();
	while (list($k, $v) = each($interface_form['create'])) {
		if (
			isset($V[$k]) &&
			preg_match("<".$v['regexp'].">", $V[$k]) 
			) {
			$o_user_form[$k] = $V[$k];
			}
		else {
			$errors .= "<li>".$v['message'];
			$o_user_form[$k] = '';
			};
		};

	if (strlen($errors)>0) {
		// есть ошибки. нельзя обновлять.
		return view_user_card($errors);
		};

	$m->insert('apic2016_member.user_card', 
			array(
			'firm_id'=>$V['firm_id'],
			'login'=>$V['login'],
			'password'=>$V['password'],
			'email'=>$V['email'],
			'user_name'=>$V['login']
			)
			);

	return view_user_card('Пользователь добавлен');
	}



function update_user_index(){
	global $m, $pm, $V, $model_user_admin, $bgcolors, $interface_form;
	$pm->_check_edit_rights();

	$errors = '';
	while (list($k, $v) = each($V)) {
		if (
			preg_match("/^status(.*)$/", $k, $match) &&
			isset($V['login'.$match[1]])
			) {
			$status = $model_user_admin->changeUserStatus($V['login'.$match[1]], $v);
			if (!$status['status']) {
				trigger_error('$model_user_admin->changeUserStatus => false');
				};
			};
		};
	return index('Изменено');
	}


function mysqltimestamp_to_date($d){
	preg_match("/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})/", $d, $m);
	$year=$m[1];
	$month=$m[2];
	$day=$m[3];
	$h=$m[4];
	$min=$m[5];
	$sec=$m[6];
	$ts = mktime ($h, $min, $sec, $month, $day, $year);
	return date("j F Y H:i:s ", $ts);
	}

?>