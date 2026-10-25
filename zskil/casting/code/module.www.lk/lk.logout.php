<?php
########################################################
# 	lk.logout.php
#
#	Выход из личного кабинета
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.03 - файл создан
#
########################################################
class MODULE_logout {

	function _init() {}

	function _start() {

		$this->engine->user->logoff();
		redirect( URI );

	}

}
?>
