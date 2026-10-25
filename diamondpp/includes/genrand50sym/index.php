<?php

// Функция генерации строки (50 символов)
// Function to generate a string (50 characters)
function generatestring($length = 50)
	{
	$chars = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
	$numChars = strlen($chars);
	$string = '';
	for ($i = 0; $i < $length; $i++) 
		{
		$string .= substr($chars, rand(1, $numChars) - 1, 1);
		} 
	return $string;
	}
	
?>