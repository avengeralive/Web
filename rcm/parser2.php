<?php

error_reporting(E_ALL);
ini_set('log_errors', 'On');
ini_set('error_log', 'php_errors.log');

$ARRAY = array();

//$json = file_get_contents('result.json'); 
//$json = json_decode($json, true);

for ($i=2; $i <= 105; $i++) {
	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, "https://unirock.ru/catalog-stone/page/".$i."/"); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$head = curl_exec($ch); 
	curl_close($ch);
	//var_dump($head);
	$q = explode('<div id="content-products-view-list" class="products-view list">', $head)[1];
	$x = explode('<div class="products-view-block"', $q);
	//var_dump($x);
	foreach ($x as $key => $value) {
		$elem = array();
		$im = explode('img src="', $value)[1];
		$img = explode('"', $im)[0];
		$elem['image'] = $img;
		$nm = explode('class="modal_catalog_filter_name">', $value)[1];
		$name = explode('</div>', $nm)[0];
		$elem['name'] = $name;
		$value = explode('class="modal-body"', $value)[1];
		$mat = explode('class="products-view-properties-item-value">', $value)[1];
		$material = explode('</div>', $mat)[0];
		$elem['material'] = $material;

		$pro = explode('class="products-view-properties-item-value">', $value)[2];
		$proizvoditel = explode('</div>', $pro)[0];
		$elem['proizvoditel'] = $proizvoditel;

		$coll = explode('class="products-view-properties-item-value">', $value)[3];
		$collection = explode('</div>', $coll)[0];
		$elem['collection'] = $collection;

		$cnt = explode('class="products-view-properties-item-value">', $value)[4];
		$country = explode('</div>', $cnt)[0];
		$elem['country'] = $country;

		$ARRAY[] = $elem;
		var_dump($elem);
	}

	
}

file_put_contents('result2.json', json_encode($ARRAY));

echo "All data transfered";
