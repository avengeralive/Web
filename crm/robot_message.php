<?php

error_reporting(E_ALL);

require './vendor/autoload.php';

use Google\Cloud\TextToSpeech\V1\AudioConfig;
use Google\Cloud\TextToSpeech\V1\AudioEncoding;
use Google\Cloud\TextToSpeech\V1\SsmlVoiceGender;
use Google\Cloud\TextToSpeech\V1\SynthesisInput;
use Google\Cloud\TextToSpeech\V1\TextToSpeechClient;
use Google\Cloud\TextToSpeech\V1\VoiceSelectionParams;

putenv('GOOGLE_APPLICATION_CREDENTIALS=/var/www/crm/cred.json');


$inputText = 'Здравствуйте, {{ fullname }}! Ваш заказ номер {{ order_id }} доставлен по адресу самовывоза {{ address }}. Срок хранения на складе составляет 3 дня';

$inputTextArr = explode('{{', $inputText);

$template_id = 1;

foreach ($inputTextArr as $part => $value) {
	if ($part == 0) continue;
	else {
		$text = trim(explode('}}', $value)[0]);
	}
	generateMP3($part, $text);
}

file_put_contents('./robot/tmp.mp3', file_get_contents('./robot/'.$template_id.'_0.mp3'));
foreach ($inputTextArr as $part => $value) {
	if ($part == 0) continue;
	else {
		file_put_contents('./robot/tmp.mp3', file_get_contents('./robot/tmp.mp3').file_get_contents('./robot/'.$part.'.mp3'));
		file_put_contents('./robot/tmp.mp3', file_get_contents('./robot/tmp.mp3').file_get_contents('./robot/'.$template_id.'_'.$part.'.mp3'));
	}
}


function generateMP3($part, $text) {
	$client = new TextToSpeechClient();
	$synthesisInputText = (new SynthesisInput())->setText($text);
	$voice = (new VoiceSelectionParams())->setLanguageCode('ru-RU')->setSsmlGender(SsmlVoiceGender::FEMALE);
	$effectsProfileId = "telephony-class-application";
	$audioConfig = (new AudioConfig())->setAudioEncoding(AudioEncoding::MP3)->setEffectsProfileId(array($effectsProfileId));
	$response = $client->synthesizeSpeech($synthesisInputText, $voice, $audioConfig);
	$audioContent = $response->getAudioContent();
	file_put_contents('./robot/'.$part.'.mp3', $audioContent);
}
