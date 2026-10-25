<?php

// Функция определения текущего имени файла
// Function to determine the current file name
function curr_file()
	{
	$curr_file = basename($_SERVER['PHP_SELF']);	
	return $curr_file;
	}
	
?>