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

class CronRobot {

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

	function getCronHistory() {
		$Result = JBase::Query('SELECT a.object, a.list, c.name as order_status, a.calltime, b.name as template, a.status_sms FROM cron_robot a, list1 b, list8 c WHERE b.id = a.template AND c.id = a.order_status AND a.status != 0');
		$Data = [];
		while ($Queue = $Result->fetch_assoc()) $Data[] = $Queue;
		return $Data;
	}

	function generate() {
		$Result = JBase::Query("SELECT * FROM cron_robot WHERE calltime BETWEEN '".date('Y-m-d H:i:s', time()-60)."' AND '".date('Y-m-d H:i:s', time())."'");
		while ($Queue = $Result->fetch_assoc()) {
			$Vm = JBase::Get_Data('list1', '*', array("id" => $Queue['template']));
			$Tpl = $Vm->fetch_assoc();

			$Order = JBase::Get_Data('list'.$Queue['list'], '*', array("id" => $Queue['object']));
			$Data = $Order->fetch_assoc();
			$Data = Mustage::getData($Data);
					
			mkdir('./robot/call_'.$Queue['id'], 0777);

			$inputText = $Tpl['f1557930441n'];
			$inputTextArr = explode('{{', $inputText);
			foreach ($inputTextArr as $part => $value) {
				if ($part == 0) continue;
				else {
					$key = trim(explode('}}', $value)[0]);
					if (stristr($key, 'audio=')) {
						$mp3 = explode('"', explode('audio="', $key)[1])[0];
						file_put_contents('./robot/call_'.$Queue['id'].'/'.$part.'.mp3', file_get_contents($mp3));
					}
					else {
						$text = $Data[$key];
						self::generateMP3Parts($part, $text, $Queue['id']);
					}
				}
			}
			$template_id = $Queue['template'];

			file_put_contents('./robot/call_'.$Queue['id'].'/tmp.mp3', file_get_contents('./robot/'.$template_id.'_0.mp3'));

			foreach ($inputTextArr as $part => $value) {
				if ($part == 0) continue;
				else {
					file_put_contents('./robot/call_'.$Queue['id'].'/tmp.mp3', file_get_contents('./robot/call_'.$Queue['id'].'/tmp.mp3').file_get_contents('./robot/call_'.$Queue['id'].'/'.$part.'.mp3'));
					file_put_contents('./robot/call_'.$Queue['id'].'/tmp.mp3', file_get_contents('./robot/call_'.$Queue['id'].'/tmp.mp3').file_get_contents('./robot/'.$template_id.'_'.$part.'.mp3'));
				}
			}
			$Names = [];
			$Values = [];
			$Names[] = 'status';
			$Values[] = 1;
			JBase::Update_Data('cron_robot', array_combine($Names, $Values), ['id' => $Queue['id']]);
			self::call($Data['phone'], 'https://1v1-crm.ru/robot/call_'.$Queue['id'].'/tmp.mp3');
		}
	}

	function call($number, $mp3, $data = []) {
		echo $mp3;
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

	function success() {
		$id = $_GET['id'];
		$status_sms = $_GET['status'];

		$Names = [];
		$Values = [];
		$Names[] = 'status_sms';
		$Values[] = $status_sms;
		JBase::Update_Data('cron_robot', array_combine($Names, $Values), ['id' => $id]);

		$Result = JBase::Query("SELECT * FROM list2");
		while ($Rules = $Result->fetch_assoc()) {
			$goods = explode(',', $Rules['goods']);
			if ($Rules['goods'] == '') $goods = [];
			$Result2 = JBase::Query("SELECT * FROM cron_robot WHERE id = ".$id);
			$Order = $Result2->fetch_assoc();
			$Result3 = JBase::Query("SELECT * FROM list".$Order['list']." WHERE id = ".$Order['object']);
			$Data = $Result3->fetch_assoc();
			if ($Rules['orderField'] != 'all') {
				if ($Rules['orderSignCompare'] == -1) $inst = $Data[$Rules['orderField']] < $Rules['orderValue'];
				if ($Rules['orderSignCompare'] == 0) $inst = $Data[$Rules['orderField']] == $Rules['orderValue'];
				if ($Rules['orderSignCompare'] == 1) $inst = $Data[$Rules['orderField']] > $Rules['orderValue'];
			}
			else $inst = true;
			$ordergoodsArr = json_decode($Data['goods_names'], true);
			$ordergoods = [];
			foreach ($ordergoodsArr as $key => $value) {
				$ordergoods[] = $value['goodID'];
			}
			$kt = count($goods);
			foreach ($ordergoods as $key => $value) {
				if (in_array($value, $goods)) $kt--;
			}
			if ($kt == 0) $inst2 = true;
			else $inst2 = false;

			if ($inst && $inst2) {
				if ($Rules['changeStatusCheck']) {
					$Result4 = JBase::Query("SELECT statusgroup FROM list8 WHERE id = ".$Rules['changeStatusSelect']);
					$Status = $Result4->fetch_assoc();
					JBase::statusChange($Order['list'], $Order['order'], $Status['statusgroup'], $Rules['changeStatusSelect']);
					$newlist = $Status['statusgroup'];
					$newstatus = $Rules['changeStatusSelect'];
				}
				else {
					$newlist = $Order['list'];
					$newstatus = $Order['order_status'];
				}
				if ($Rules['sendTextSmsCheck']) {
					//SMS::sendSMS($Order['order'], $Rules['sendTextSmsSelect']);
				}
				if ($Rules['recall']) {
					if ($Rules['limitTime']) {
						$calltime = date('H', strtotime($Order['calltime']) + $Rules['recallTime'] * 60);
						if ($calltime >= $Rules['limitTimeOn'] && $calltime <= $Rules['limitTimeOff']) {
							$calltime = date('Y-m-d H:i:s', strtotime($Order['calltime']) + $Rules['recallTime'] * 60);
						}
						else {
							$calldate = date('Y-m-d', strtotime($Order['calltime']));
							$calltime = date('Y-m-d', strtotime($calldate. ' + 1 days')).' '.$Rules['limitTimeOn'].':00';
						}
					}
					else $calltime = date('Y-m-d H:i:s', strtotime($Order['calltime']) + $Rules['recallTime'] * 60);
					$Result5 = JBase::Query("SELECT COUNT(*) as cnt FROM cron_robot WHERE status_sms = ".$Rules['voiceSmsStatus']);
					$StatusCnt = $Result5->fetch_assoc();
					if ($StatusCnt['cnt'] == $Rules['limitRecallCount']) {
						$Result6 = JBase::Query("SELECT statusgroup FROM list8 WHERE id = ".$Rules['limitRecallStatus']);
						$Status2 = $Result6->fetch_assoc();
						JBase::statusChange($Order['list'], $Order['order'], $Status2['statusgroup'], $Rules['limitRecallStatus']);
					}
					else{
						$Names = [];
						$Values = [];
						$Names[] = 'object';
						$Names[] = 'list';
						$Names[] = 'order_status';
						$Names[] = 'template';
						$Names[] = 'status';
						$Names[] = 'calltime';

						$Values[] = $Order['object'];
						$Values[] = $newlist;
						$Values[] = $newstatus;
						$Values[] = $Rules['recallTemplateID'];
						$Values[] = 0;
						$Values[] = $calltime;

						JBase::Set_Data('cron_robot', $Names, $Values);
					}
				}
			}
		}
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
}