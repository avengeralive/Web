<?php

if (isset($_POST['act'])) {
	if ($_POST['act'] == 'cfg') {
		echo '{"configs":{"form-1":{"cfg":{"antispam":"email77","antispamjs":"address77","notify":"color-modal-textbox"}},"akciya":{"cfg":{"antispam":"email77","antispamjs":"address77","notify":"color-modal-textbox"}},"tovar-1":{"cfg":{"antispam":"email77","antispamjs":"address77","notify":"color-modal-textbox"}},"tovar-2":{"cfg":{"antispam":"email77","antispamjs":"address77","notify":"color-modal-textbox"}},"tovar-3":{"cfg":{"antispam":"email77","antispamjs":"address77","notify":"color-modal-textbox"}},"tovar-4":{"cfg":{"antispam":"email77","antispamjs":"address77","notify":"color-modal-textbox"}},"tovar-5":{"cfg":{"antispam":"email77","antispamjs":"address77","notify":"color-modal-textbox"}},"tovar-6":{"cfg":{"antispam":"email77","antispamjs":"address77","notify":"color-modal-textbox"}},"opt_1":{"cfg":{"antispam":"email77","antispamjs":"address77","notify":"color-modal-textbox"}},"opt_2":{"cfg":{"antispam":"email77","antispamjs":"address77","notify":"color-modal-textbox"}},"opt_3":{"cfg":{"antispam":"email77","antispamjs":"address77","notify":"color-modal-textbox"}}}}';
	} else if ($_POST['act'] == 'form-1') {
		$msg = 'Имя: '.$_POST['name'] ."\n".'Адрес: '.$_POST['address77'] ."\n".'Телефон: ' .$_POST['tell'] ."\n".'Мейл: '.$_POST['mail'];
		mail('info@xn----etbglkxdiddinfh.xn--p1ai', 'Mail from site', $msg);
		mail('giroskyteropt@gmail.com', 'Mail from site', $msg);
		$json = '{"ok":1,"infos":["\u041c\u0435\u043d\u0435\u0434\u0436\u0435\u0440 \u0441\u0432\u044f\u0436\u0435\u0442\u0441\u044f \u0441 \u0412\u0430\u043c\u0438 \u0432 \u0431\u043b\u0438\u0436\u0430\u0439\u0448\u0435\u0435 \u0432\u0440\u0435\u043c\u044f"]}';
		echo $json;
	} else if ($_POST['act'] == 'akciya') {
		$msg = 'Имя: '.$_POST['name']."\n".'Адрес: '.$_POST['address77']."\n".'Телефон: ' .$_POST['tell'];	
		mail('info@xn----etbglkxdiddinfh.xn--p1ai', 'Mail from site', $msg);
		mail('giroskyteropt@gmail.com', 'Mail from site', $msg);
		$json = '{"ok":1,"infos":["\u041c\u0435\u043d\u0435\u0434\u0436\u0435\u0440 \u0441\u0432\u044f\u0436\u0435\u0442\u0441\u044f \u0441 \u0412\u0430\u043c\u0438 \u0432 \u0431\u043b\u0438\u0436\u0430\u0439\u0448\u0435\u0435 \u0432\u0440\u0435\u043c\u044f"]}';

		echo $json;
	} else if ($_POST['act'] == 'tovar-4') {
		$msg = 'Имя: '.$_POST['name']."\n".'Адрес: ' .$_POST['address77']."\n".'Телефон: ' .$_POST['tell'] ."\n".'Мейл: '.$_POST['mail']."\n".'Пожелания: '.$_POST['poj']."\n".'Товар: ' .$_POST['tovar'];
		mail('info@xn----etbglkxdiddinfh.xn--p1ai', 'Mail from site', $msg);
		mail('giroskyteropt@gmail.com', 'Mail from site', $msg);

		$json = '{"ok":1,"infos":["\u0411\u043b\u0430\u0433\u043e\u0434\u0430\u0440\u0438\u043c \u0437\u0430 \u0437\u0430\u043a\u0430\u0437"]}';

		echo $json;
	}
	} else if ($_POST['act'] == 'tovar-3') {
		$msg = 'Имя: '.$_POST['name']."\n".'Адрес: ' .$_POST['address77']."\n".'Телефон: ' .$_POST['tell'] ."\n".'Мейл: '.$_POST['mail']."\n".'Пожелания: '.$_POST['poj']."\n".'Товар: ' .$_POST['tovar'];
		mail('info@xn----etbglkxdiddinfh.xn--p1ai', 'Mail from site', $msg);
		mail('giroskyteropt@gmail.com', 'Mail from site', $msg);

		$json = '{"ok":1,"infos":["\u0411\u043b\u0430\u0433\u043e\u0434\u0430\u0440\u0438\u043c \u0437\u0430 \u0437\u0430\u043a\u0430\u0437"]}';

		echo $json;
	}
	} else if ($_POST['act'] == 'tovar-2') {
		$msg = 'Имя: '.$_POST['name']."\n".'Адрес: ' .$_POST['address77']."\n".'Телефон: ' .$_POST['tell'] ."\n".'Мейл: '.$_POST['mail']."\n".'Пожелания: '.$_POST['poj']."\n".'Товар: ' .$_POST['tovar'];
		mail('info@xn----etbglkxdiddinfh.xn--p1ai', 'Mail from site', $msg);
		mail('giroskyteropt@gmail.com', 'Mail from site', $msg);

		$json = '{"ok":1,"infos":["\u0411\u043b\u0430\u0433\u043e\u0434\u0430\u0440\u0438\u043c \u0437\u0430 \u0437\u0430\u043a\u0430\u0437"]}';

		echo $json;
	}
	} else if ($_POST['act'] == 'tovar-1') {
		$msg = 'Имя: '.$_POST['name']."\n".'Адрес: ' .$_POST['address77']."\n".'Телефон: ' .$_POST['tell'] ."\n".'Мейл: '.$_POST['mail']."\n".'Пожелания: '.$_POST['poj']."\n".'Товар: ' .$_POST['tovar'];
		mail('info@xn----etbglkxdiddinfh.xn--p1ai', 'Mail from site', $msg);
		mail('giroskyteropt@gmail.com', 'Mail from site', $msg);

		$json = '{"ok":1,"infos":["\u0411\u043b\u0430\u0433\u043e\u0434\u0430\u0440\u0438\u043c \u0437\u0430 \u0437\u0430\u043a\u0430\u0437"]}';

		echo $json;
	}
}
?>
