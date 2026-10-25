<?php

namespace lib;

require './vendor/autoload.php';

use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/crm/cred.json');

//10.0.0.4 - robot
//10.0.0.3 - mp3

class CronRobot {

 	private static $login;
 	private static $password;
 
 	private static function start() {
 		self::$login = '550210011';
 		self::$password = '63429845237345';
 	}

 	function cronCurrentQueue() {
 		echo self::getCronCurrentQueue();
 	}

 	function getTemplate() {
 		$Vm = JBase::Get_Data('list1', '*', array("id" => $_GET['template']));
 		$Tpl = $Vm->fetch_assoc();
 		echo json_encode($Tpl);
 	}

 	function getOrder() {
 		$Order = JBase::Get_Data('list'.$_GET['list'], '*', array("id" => $_GET['object']));
 		$Data = $Order->fetch_assoc();
 		$Data = Mustage::getData($Data);
 		echo json_encode($Data);
 	}

 	function changeStaus() {
 		$Names = [];
 		$Values = [];
 		$Names[] = 'status';
 		$Values[] = 1;
 		JBase::Update_Data('cron_robot', array_combine($Names, $Values), ['id' => $_GET['id']]);
 	}

 	function setTask() {
 		$Names = array('media_id', 'call_id', 'status');
 		$Values = array($_GET['fileid'], $_GET['tm_task_id'], 2);
 		JBase::Update_Data('cron_robot', array_combine($Names, $Values), ['id' => $_GET['id']]);
 	}
 
 	function generateParts($template_id) {
 		$Vm = JBase::Get_Data('list1', '*', array("id" => $template_id));
 		$Tpl = $Vm->fetch_assoc();
 		$inputText = $Tpl['f1557930441n'];
 		$inputTextArr = explode('{{', $inputText);
 		foreach ($inputTextArr as $part => $value) {
 			if ($part == 0) {
 				$text = $value;
 			}
 			else {
 				$text = explode('}}', $value)[1];
 			}
 			self::generateMP3($template_id, $part, $text);
 		}
 	}
 
 	function getCronQueue() {
 		$Result = JBase::Query('SELECT a.object, a.list, c.name as order_status, a.calltime, b.name as template FROM cron_robot a, list1 b, list8 c WHERE b.id = a.template AND c.id = a.order_status AND a.status = 0');
 		$Data = [];
 		while ($Queue = $Result->fetch_assoc()) $Data[] = $Queue;
 		return $Data;
 	}

 	function getCronCurrentQueue() {
 		$Result = JBase::Query("SELECT * FROM cron_robot WHERE status = 0 AND calltime BETWEEN '".date('Y-m-d H:i:s', time()-3600)."' AND '".date('Y-m-d H:i:s', time())."' LIMIT 0, 60");
 		//$Result = JBase::Query("SELECT * FROM cron_robot WHERE id = 970");
 		$Data = []; $ids = [];
 		while ($Queue = $Result->fetch_assoc()) { $Data[] = $Queue; $ids[] = $Queue['id']; }
 		JBase::Query("UPDATE cron_robot SET status = -1 WHERE id IN (".implode(',', $ids).")");
 		return json_encode($Data);
 	}

 	function getCompleted() {
 		$Result = JBase::Query("SELECT * FROM cron_robot WHERE status = 2 LIMIT 30");
 		//$Result = JBase::Query("SELECT * FROM cron_robot WHERE id = 970");
 		$Data = [];
 		while ($Queue = $Result->fetch_assoc()) $Data[] = $Queue;
 		return json_encode($Data);
 	}

 	function getLogRobot() {
 		$Result = JBase::Get_Data('list'.$_GET['list'], array('log_robot'), array('id' => $_GET['object']));
 		$Data = [];
 		while ($Queue = $Result->fetch_assoc()) $Data[] = $Queue;
 		return json_encode($Data);
 	}

 	function selectlist2() {
 		$Result = JBase::Query("SELECT * FROM list2");
		$Data = [];
 		while ($Queue = $Result->fetch_assoc()) $Data[] = $Queue;
 		return json_encode($Data);
 	}

 	function updlog() {
 		$x = JBase::Update_Field_Value_From_Id('list'.$_GET['list'], $_GET['object'], "log_robot = '".$_GET['json']."'");
 	}

 	function updsmsstatus() {
 		$Names = array('status', 'status_sms');
 		$Values = array(3, $_GET['sms_status']);
 		JBase::Update_Data('cron_robot', array_combine($Names, $Values), ['id' => $_GET['id']]);
 	}
 
 	function getCronHistory() {
 		$Result = JBase::Query('SELECT a.id, a.object, a.list, c.name as order_status, a.calltime, b.name as template, a.status_sms FROM cron_robot a, list1 b, list8 c WHERE b.id = a.template AND c.id = a.order_status AND a.status != 0');
 		$Data = [];
 		while ($Queue = $Result->fetch_assoc()) $Data[] = $Queue;
 		return json_encode($Data);
 	}

 	function getRule() {
 		$Result = JBase::Query("SELECT * FROM list".$_GET['list']." WHERE id = ".$_GET['object']);
 		$Data = $Result->fetch_assoc();
 		return json_encode($Data);
 	}

 	function getstatusgroup() {
 		$Result = JBase::Query("SELECT statusgroup FROM list8 WHERE id = ".$_GET['changeStatusSelect']);
 		$Data = $Result->fetch_assoc();
 		return json_encode($Data);
 	}

 	function changeOrdStatus() {
 		JBase::statusChange($_GET['list'], [$_GET['object']], $_GET['changeStatusSelect']);
 	}

 	function sendCheckSMS() {
 		SMS::sendSMS($_GET['list'], $_GET['object'], $_GET['sendTextSmsSelect']);
 	}

 	function countstatus() {
 		$Result = JBase::Query("SELECT COUNT(*) as cnt FROM cron_robot WHERE object = ".$_GET['object']);
 		$Data = $Result->fetch_assoc();
 		return json_encode($Data);
 	}

 	function statuschangeafter() {
 		$Result = JBase::Query("SELECT statusgroup FROM list8 WHERE id = ".$_GET['limitRecallStatus']);
 		$Status2 = $Result->fetch_assoc();
 		JBase::statusChange($_GET['list'], [$_GET['object']], $_GET['limitRecallStatus']);
 	}

 	function setcronfinal() {
 		$Names = [];
 		$Values = [];
 		$Names[] = 'object';
 		$Names[] = 'list';
 		$Names[] = 'order_status';
 		$Names[] = 'template';
 		$Names[] = 'status';
 		$Names[] = 'calltime';
 		$Values[] = $_GET['object'];
 		$Values[] = $_GET['newlist'];
 		$Values[] = $_GET['newstatus'];
 		$Values[] = $_GET['recallTemplateID'];
 		$Values[] = 0;
 		$Values[] = $_GET['calltime'];
 		JBase::Set_Data('cron_robot', $Names, $Values);
 	}

 	function setnewsmsstatus() {
 		$Names = [];
 		$Values = [];
 		$Names[] = 'status_sms';
 		$Values[] = $_GET['sms_status'];
 		JBase::Update_Data('cron_robot', array_combine($Names, $Values), ['id' => $_GET['object']]);
 	}

 	function addNew($id, $list, $template) {
 		$Names = [];
 		$Values = [];
 		$Names[] = 'object';
 		$Names[] = 'list';
 		$Names[] = 'order_status';
 		$Names[] = 'template';
 		$Names[] = 'status';
 		$Names[] = 'calltime';

 		$Values[] = $id;
 		$Values[] = $list;
 		$Values[] = 1;
 		$Values[] = $template;
 		$Values[] = 0;
 		$Values[] = date('Y-m-d H:i:s', time() + 120);

 		JBase::Set_Data('cron_robot', $Names, $Values);
 	}

 	function generateMP3($template_id, $template_part, $text) {
 		$client = new TextToSpeechClient();
 		$synthesisInputText = (new SynthesisInput())->setText($text);
 		$voice = (new VoiceSelectionParams())->setLanguageCode('ru-RU')->setSsmlGender(SsmlVoiceGender::FEMALE);
 		$effectsProfileId = "telephony-class-application";
 		$audioConfig = (new AudioConfig())->setAudioEncoding(AudioEncoding::MP3)->setEffectsProfileId(array($effectsProfileId));
 		$response = $client->synthesizeSpeech($synthesisInputText, $voice, $audioConfig);
 		$audioContent = $response->getAudioContent();
 		file_put_contents('./robot/'.$template_id.'_'.$template_part.'.mp3', $audioContent);
 	}

 	function generateMP3Partscurl() {
 		self::generateMP3Parts($_GET['part'], $_GET['text'], $_GET['id']);
 	}

 	function mkdirhere() {
 		mkdir('./robot/call_'.$_GET['id'], 0777);
 	}

 	function generateparts2() {
 		$mp3 = explode('"', explode('audio="', $_GET['key'])[1])[0];
 		file_put_contents('./robot/call_'.$_GET['id'].'/'.$_GET['part'].'.mp3', file_get_contents($mp3));
 	}

 	function generateMP3Parts($part, $text, $object) {
 		$client = new TextToSpeechClient();
 		$synthesisInputText = (new SynthesisInput())->setText($text);
 		$voice = (new VoiceSelectionParams())->setLanguageCode('ru-RU')->setSsmlGender(SsmlVoiceGender::FEMALE);
 		$effectsProfileId = "telephony-class-application";
 		$audioConfig = (new AudioConfig())->setAudioEncoding(AudioEncoding::MP3)->setEffectsProfileId(array($effectsProfileId));
 		$response = $client->synthesizeSpeech($synthesisInputText, $voice, $audioConfig);
 		$audioContent = $response->getAudioContent();
 		file_put_contents('./robot/call_'.$object.'/'.$part.'.mp3', $audioContent);
 	}
 
 	function saveWav() {
 		file_put_contents('./rec/'.$_POST['id'].'.wav', base64_decode($_POST['data']));
 		shell_exec("lame -b 128 -m j -h -V 1 -B 256 -F /var/www/crm/rec/".$_POST['id'].".wav /var/www/crm/rec/".$_POST['id'].".mp3");
 		//$x = json_decode(file_get_contents('https://1v1-crm.ru/mp3/mp3.php?data=https://1v1-crm.ru/rec/'.$_POST['id'].'.wav'), true);
 		$detail = (object) array('mp3' => (object) array(
 			"time" => time(),
 			"id" => $_POST['id'],
 			"user" => 'robot',
 			"lvproject" => 0,
 			"new" => "",
 			"old" => "",
 			"timeedit" => time(),
 			"field" => "mp3",
 			"src" => 'rec/'.$_POST['id'].'.mp3'
 		));
 		$Names = [];
 		$Values = [];
 		$Names[] = 'domain';
 		$Names[] = 'item_id';
 		$Names[] = 'time';
 		$Names[] = 'detail';
 
 		$Values[] = '1v1-crm.ru	';
 		$Values[] = $_POST['id'];
 		$Values[] = time();
 		$Values[] = json_encode($detail);

 		JBase::Set_Data('change_card', $Names, $Values);
 		
 		return true;
 	}
}
