<?php
namespace lib;
header("Content-Type:application/json");
	
// function get_res($db) {
// 	$database = 'region-';	
// 	$items = [
// 		'bans' => get_table('bans'),
// 		'samples' => get_table('samples'),
// 		'expertises' => get_table('expertises'),
// 		'researches' => get_table('researches'),
// 		'distributions' => get_table('distributions'),
// 		'registrations' => get_table('registrations'),
// 		'registrationsups' => get_table('registrationsups'),
// 		'expertises_detections' => get_table('expertises_detections'),
// 		'samples_sample_purposes' => get_table('samples_sample_purposes')
// 	];
// 	return $items;
// }
// 
// function get_table($table) {
// 	$link = getDb('crm');
// 	//$query = 'SELECT * FROM $table WHERE `date` >= DATE_SUB(CURDATE(), INTERVAL 24 HOUR)';
// 	$query = 'SELECT * FROM $table';
// 	$result = mysqli_query($link, $query);
// 	mysqli_close($link);
// 	$items = [];
// 	if ($result) {
// 		while ($item = $result->fetch_assoc()) {
// 			$items['order'] = $item;
// 		}
// 	}
// 	return $items; 
// }
// 
// function getDb($db) {
// 	$servername = "localhost";
// 	$username = "root";
// 	$pass = "AprWOW17n6WD6r6Se9n";
// 	$link = mysqli_connect($servername, $username, $pass, $db);
// 	mysqli_set_charset( $link, 'utf8');
// 	if ($link) return $link;
// }

function get_fields() {
	return array(
		'domain'						=> '1v1-crm.ru',//varchar
		'id_user'					=> '1',//int
		'status'						=> '1',//int
		'time'						=> time(),//int
		'timeupdate'				=> time(),//int
		'lastUpdate'				=> $_POST('lastUpdate'),//int
		'price'						=> $_POST('price'),//int
		'total'						=> $_POST('total'),//int
		'agree_terms'				=> $_POST('agree_terms'),//int
		'agree_personal'			=> $_POST('agree_personal'),//int
		'geo'							=> $_POST('geo'),//varchar
		'name'						=> $_POST('name'),//varchar
		'goods_names'				=> $_POST('goods_names'),//varchar
		'domain2'					=> $_POST('domain'),//varchar
		'approvedAt'				=> $_POST('approvedAt'),//varchar
		'shippedAt'					=> $_POST('shippedAt'),//varchar
		'canceledAt'				=> $_POST('canceledAt'),//varchar
		'buyoutAt'					=> $_POST('buyoutAt'),//varchar
		'refundedAt'				=> $_POST('refundedAt'),//varchar
		'comment'					=> $_POST('comment'),//varchar
		'log_robot'					=> $_POST('log_robot'),//text
		'all'							=> $_POST('all'),//varchar
		'time_call'					=> $_POST('time_call'),//varchar
		'attempts'					=> $_POST('attempts'),//varchar
		'group_time_call'			=> $_POST('group_time_call'),//varchar
		'russianpostTrack'		=> $_POST('russianpostTrack'),//varchar
		'russianpostStatus'		=> $_POST('russianpostStatus'),//varchar
		'count'						=> $_POST('count'),//varchar
		'postIndex'					=> $_POST('postIndex'),//varchar
		'region'						=> $_POST('region'),//varchar
		'city'						=> $_POST('city'),//varchar
		'address'					=> $_POST('address'),//varchar
		'house'						=> $_POST('house'),//varchar
		'flat'						=> $_POST('flat'),//varchar
		'phone'						=> $_POST('phone'),//varchar
		'email'						=> $_POST('email'),//varchar
		'category'					=> $_POST('category'),//varchar
		'lastSms'					=> $_POST('lastSms'),//varchar
		'smsStatus'					=> $_POST('smsStatus'),//varchar
		'lastVoiceSms'				=> $_POST('lastVoiceSms'),//varchar
		'lastVoiceStatus'			=> $_POST('lastVoiceStatus'),//varchar
		'liveinformId'				=> $_POST('liveinformId'),//varchar
		'size'						=> $_POST('size'),//varchar
		'completely'				=> $_POST('completely'),//varchar
		'weight'						=> $_POST('weight'),//varchar
		'tag'							=> $_POST('tag'),//varchar
		'source'						=> $_POST('source'),//varchar
		'ip'							=> $_POST('ip'),//varchar
		'referrer'					=> $_POST('referrer'),//varchar
		'expend'						=> $_POST('expend'),//varchar
		'externalId'				=> $_POST('externalId'),//varchar
		'webmasterId'				=> $_POST('webmasterId'),//varchar
		'dop1'						=> $_POST('dop1'),//varchar
		'dop2'						=> $_POST('dop2'),//varchar
		'dop3'						=> $_POST('dop3'),//varchar
		'dop4'						=> $_POST('dop4'),//varchar
		'dop5'						=> $_POST('dop5'),//varchar
		'dop6'						=> $_POST('dop6'),//varchar
		'dop7'						=> $_POST('dop7'),//varchar
		'dop8'						=> $_POST('dop8'),//varchar
		'dop9'						=> $_POST('dop9'),//varchar
		'dop10'						=> $_POST('dop10'),//varchar
		'timezone'					=> $_POST('timezone'),//varchar
		'allBuyPrice'				=> $_POST('allBuyPrice'),//varchar
		'developerPrice'			=> $_POST('developerPrice'),//varchar
		'utm_source'				=> $_POST('utm_source'),//varchar
		'utm_medium'				=> $_POST('utm_medium'),//varchar
		'utm_campaign'				=> $_POST('utm_campaign'),//varchar
		'utm_term'					=> $_POST('utm_term'),//varchar
		'utm_content'				=> $_POST('utm_content'),//varchar
		'operator'					=> $_POST('operator'),//int
		'sms_template'				=> $_POST('sms_template') //int				
	);
}

if(!empty($_GET['guid'])) {
	$guid = $_GET['guid'];
	
// 	$db = get_guid($guid);
// 	$res = get_res($db);
	
	if(empty($res)) {
		response(200, "Subject Not Found", NULL);
	} else {
		response(200, "Subject Found", $res);
	}
} else {
	response(400, "Invalid Request", NULL);
}

function response($status, $status_message, $data) {
	header("HTTP/1.1 ". $status);
	
	$response['status'] = $status;
	$response['status_message'] = $status_message;
	$response['data'] = $data;
	
	$json_response = json_encode($response);
	echo $json_response;
}
