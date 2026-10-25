<?php
########################################################
#	constants.lambda.php
#
#	Шаблоны лямбда-функций
#
#	Автор: Ашмарин Илья, mail[at]harduino.com
#
#	История:
#			2017.11.01 - файл создан
#
########################################################
$GLOBALS['LISTS']['lambda'] = array(

	'time' => array(
		'lambda_exists'	=>	true,
		'lambda_params'	=>	'&$value',
		'lambda_body'	=>	'
			if( !empty($value) ) {
				list($hours,$minutes) = explode(":",$value);
				$value = $hours*60+$minutes;
			} else {
				$value = 0;
			}
		',

		'lambda_reverse_exists'	=>	true,
		'lambda_reverse_params'	=>	'&$value,$ACT',
		'lambda_reverse_body'	=>	'
			if( $ACT == "edit" ) {
				$hours = floor( $value/60 );
				$minutes = $value - $hours*60;
				$value = fill_zero($hours,2).":".fill_zero($minutes,2);
			}
		'
	),
	'datetime' => array(
		'lambda_exists'	=>	true,
		'lambda_params'	=>	'&$value',
		'lambda_body'	=>	'$value = mysql_timestampToUnix($value);',

		'lambda_reverse_exists'	=>	true,
		'lambda_reverse_params'	=>	'&$value,$ACT',
		'lambda_reverse_body'	=>	'
			if( $ACT == "edit" ) {
				$value = mysql_unixToTimestamp($value);
			}

			if( $ACT == "insert" ) {
				$value = mysql_unixToTimestamp( NOW + ONE_DAY*31 );
			}
		'
	),
	'float_cast' => array(
		'lambda_exists'	=> true,
		'lambda_params'	=> '&$value',
		'lambda_body'	=> '$value = str_replace( ",", ".", $value );',

		'lambda_reverse_exists'	=> true,
		'lambda_reverse_params'	=> '&$value,$ACT',
		'lambda_reverse_body'	=> '$value = str_replace( ",", ".", $value );'
	),
	'birthday' => array(
		'lambda_exists'	=>	true,
		'lambda_params'	=>	'&$value',
		'lambda_body'	=>	'
			list( $day, $month, $year ) = explode( "/", $value );
			$value = mysql_unixToTimestamp(mktime2(array(
				"day"	=> $day,
				"month"	=> $month,
				"year"	=> $year,
				"hour"	=> 12
			)));
		',

		'lambda_reverse_exists'	=> true,
		'lambda_reverse_params'	=> '&$value,$ACT',
		'lambda_reverse_body'	=> '
			if( $ACT == "edit" ) {
				list( $date, $time ) = explode( " ", $value );
				list( $year, $month, $day ) = explode( "-", $date );
				$value = "$day/$month/$year";
			}
		'
	),

);

#
########################################################
?>
