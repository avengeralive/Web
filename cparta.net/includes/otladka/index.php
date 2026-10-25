<?php

// Если наш IP совпадает с отладочным IP, то выводить дизайн из папки "test_design"
// Это нужно для тестирования нововведений при рабочей CPA-сети

// If our IP matches the IP debugging, the design of the output folder "test_design"
// This is to test innovations at the operating CPA-network

/*if ($_SERVER["REMOTE_ADDR"]==$settings_ip_otladka) 
	{
	$template = 'veliyev';
	}
else
	{*/
	if ($user_tip == 10) $template = 'veliyev';
	else 
		$template = 'default';
	
	//}
	//zvar_dump($template);
?>