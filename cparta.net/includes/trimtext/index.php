<?php

// Функция обрезания строки
// Line cutting function
function TrimText($string,$count)
	{
	$your_desired_width = $count;
	$string = substr($string, 0, $your_desired_width+1);
	if (strlen($string) > $your_desired_width)
		{
		$string = wordwrap($string, $your_desired_width);
		$i = strpos($string, "\n");
		if ($i) 
			{
			$string = substr($string, 0, $i).' ...';
			}
		}
	return $string;
	}
	
?>
