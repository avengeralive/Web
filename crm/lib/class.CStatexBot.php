<?php
namespace lib;
// define("_STATEX_BOT_TOKEN", "942550807:AAHp-TIZscXnFlH_UDnmXVS848dRL9-OU6s");
// require_once "vendor/autoload.php";
define('TG_TOKEN', '942550807:AAHp-TIZscXnFlH_UDnmXVS848dRL9-OU6s');
// define('TG_CHAT', '50372987');

use GPBMetadata\Google\Iam\V1\Options;
//hook URL:
//https://api.telegram.org/bot942550807:AAHp-TIZscXnFlH_UDnmXVS848dRL9-OU6s/setWebhook?url=https://seekingdancer.ru/json/?domain=seekingdancer.ru&func=CStatEx&action=botHook
trait CStatexBot
{
	use CStatexUtils;
	var $token;
	var $bot;

	public function __construct(string $token = TG_TOKEN) {
		// $this->token = $token;
		// $this->bot = new \TelegramBot\Api\Client($token);
		// $this->bot->sendMessage($message->getChat()->getId(), $answer."\n\n".$b);
	}



	function botHook() {
		$data = file_get_contents('php://input');
		$data = json_decode($data, true);
		ob_start();
		print_r($data);
		$out = ob_get_clean();
		file_put_contents(__DIR__ . '../bot/message.txt', $out);

		echo('Hi bot!'.__DIR__);
	}
}
