<?php

// namespace lib;
// class ConsoleLog {
		function cl_print_r ($var, $label = '')
		{
			$str = json_encode(print_r ($var, true));
			echo "<script>console.group('".$label."');console.log('".$str."');console.groupEnd();</script>";
		}
		function cl_var_dump ($var, $label = '')
		{
			ob_start();
			var_dump($var);
			$result = json_encode(ob_get_clean());
			echo "<script>console.group('".$label."');console.log('".$result."');console.groupEnd();</script>";
		}
		//пример использования:
		// $mas = array ("1", "2", "3", array("key"=>"value"));
		// cl_print_r($mas, '$mas log cl_print_r');
		// cl_var_dump($mas, '$mas log cl_var_dump');
		
	// }
	?>