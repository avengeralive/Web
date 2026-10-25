<?php
/*
Calculate Age

With this function you can calculate the age of a person

Example:
echo "Age is: " . birthday ("1984-07-05");

Result will be (23 Feb 2005) = "Age is: 20"

calculate years of age (input string: YYYY-MM-DD)

*/
function smarty_modifier_age( $birthday )
{
	list( $date, $time ) = explode( ' ', $birthday );
	list($year,$month,$day) = explode("-",$date);
	$year_diff = date("Y") - $year;
	$month_diff = date("m") - $month;
	$day_diff = date("d") - $day;
	if ($month_diff < 0) $year_diff--;
	elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
	return $year_diff;
}

?>
