<?php

error_reporting(E_ALL);
ini_set('log_errors', 'On');
ini_set('error_log', 'php_errors.log');

$THE_GLOBAL_ARRAY = array();

$arr = json_decode(file_get_contents('res1.json'), true);
//var_dump($arr);
foreach($arr as $key=>$value)
{
	var_dump($value['Web']);
	$x = explode('">', $value['Web'])[1]; var_dump($x);
	$y = explode('</a>', $x)[0]; var_dump($y);
	$arr[$key]['Web'] = $y;
	//$THE_GLOBAL_ARRAY[$key]['num'] = $value;
	//$THE_GLOBAL_ARRAY[$key]['name'] = "";
	/*if ($value['web'] == '') {
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, "http://www.legpromexpo.ru/catalog/50/".$value['num'].'/'); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$head = curl_exec($ch); 
		curl_close($ch); 
		$x = explode('<h2 itemprop="name">', $head);
		$arr[$key]['name'] = trim(explode('</h2>', $x[1])[0]);
		$y = explode('class="char"', $head);
		//var_dump($y); 
		var_dump(count($y));
		for ($i = 1; $i < count($y); $i++) { //var_dump("!!!");
			$q1 = explode('class="char_name"', $y[$i])[1];
			$q2 = explode('<span>', $q1)[1];
			$q3 = explode('</span>', $q2)[0];


			$w1 = explode('class="char_value"', $y[$i])[1];
			$w2 = explode('<span>', $w1)[1];
			$w3 = explode('</span>', $w2)[0];

			$arr[$key][$q3] = trim($w3);

		}
		
		sleep(0.5);
	}*/

	/*$cat = $y[0];

	$a = explode('<div class="catalog_item_title">', $cat);
	unset($a[0]);
	foreach($a as $b) 
	{
		$arr = array();
		$c = explode('<div class="catalog_item_title_wrap"', $b);
		$d = explode('"/', $c[0]);
		$e = explode('/"', $d[1]);
		$url = "http://voltag.ru/".$e[0];
		
		$ch1 = curl_init(); 
		curl_setopt($ch1, CURLOPT_URL, $url); 
		curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1);
		$head = curl_exec($ch1); 
		curl_close($ch1);
		
		$a1 = explode('<div class="catalog_group two_plus_one_photo no_aggregates">', $head);
		$b1 = explode('<div class="catalog_group_wrap_right">', $a1[1]);
		$b2 = explode('<div class="catalog_group_title">', $b1[0]);
		$b3 = explode('<div class="catalog_group_newold">', $b2[1]);
		$arr[] = $b3[0];
		
		$c1 = explode("div class='catalog_group_param_important'>", $b3[1]);
		$c2 = explode("</div>", $c1[1]);
		$c3 = explode("</div>", $c1[2]);
		$arr[] = $c2[0];
		$arr[] = $c3[0];
		
		
		$d1 = explode("catalog_group_params", $b3[1]);
		$d2 = explode("catalog_group_photos", $d1[1]);
		$d3 = explode("<tr>", $d2[0]);
		unset($d3[0]);
		unset($d3[1]);
		unset($d3[2]);
		unset($d3[3]);
		foreach ($d3 as $e) 
		{
			$e1 = explode("<td>", $e);
			$e2 = explode("</td>", $e1[3]);
			$arr[] = $e2[0];
			//
		}
		
		$d4 = explode('catalog_group_crosslist_info', $d2[1]);
		$d5 = explode('</table>', $d4[1]);
		$d6 = explode('<tr>', $d5[0]);
		unset($d6[0]);
		foreach ($d6 as $e) 
		{
			$e1 = explode('<td>', $e);
			$e2 = explode("</td>", $e1[1]);
			
			$arr[] = $e2[0];
			//
		}
		
		$d7 = explode('catalog_group_application_info', $d5[1]);
		$d8 = explode('catalog_group_wrap_right', $d7[1]);
		$d9 = explode('<p>', $d8[0]);
		$d0 = explode('</p>', $d9[1]);
		$arr[] = $d0[0];
		//echo htmlspecialchars($d0[0])."<br>";
		//var_dump($arr);
		//<div class="catalog_group_params">
		
		/*$b4 = $c1 = explode("<div class='catalog_group_wrap_right'>", $b3[1]);
		$c1 = explode("<tr>", $b4[0]);
		unset($c1[0]);
		unset($c1[1]);
		unset($c1[2]);
		unset($c1[3]);
		foreach ($c1 as $d)
		{
			echo htmlspecialchars($d)."<br>";
		}*/
		//$THE_GLOBAL_ARRAY[] = $arr;
	//}

}

file_put_contents('res1.json', json_encode($arr));

/*$fp = fopen('file.csv', 'w', '*');
$i=0;
foreach ($THE_GLOBAL_ARRAY as $fields) {
    fputcsv($fp, $fields);
	echo $i." "; $i++;
}*/

echo "All data transfered";

//var_dump($THE_GLOBAL_ARRAY);