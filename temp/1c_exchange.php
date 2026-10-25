<?

if ($_POST['password'] == 'zapbrs@180564') {

ini_set('max_execution_time', 0);

$data_string = file_get_contents('exp.json');

$data = json_decode($data_string, true, JSON_UNESCAPED_UNICODE);


$host = 'brs77ru.mysql';
$db   = 'brs77ru_zap';
$user = 'brs77ru_zap';
$pass = 'ZqWU9cj:';
$charset = 'utf8';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
$pdo->exec("SET NAMES utf8");


foreach ($data['export'][0]['manufacturers'] as $manufacturer)
{
	$stmt = $pdo->query('SELECT * FROM oc_1c_manufacturers WHERE uid = "'.$manufacturer['uid'].'"');
	$rows = $stmt->fetchAll();
	if (!$rows)
	{
		$stmt = $pdo->query('INSERT INTO oc_1c_manufacturers(uid) VALUES ("'.$manufacturer['uid'].'")');
		$manufacturer1c = $pdo->lastInsertId();

		$sql = 'INSERT INTO oc_manufacturer(name, sort_order, country) VALUES (:name, 0, :country)';
		$q = $pdo->prepare($sql);
		$q->execute(array(':name'=> $manufacturer['name'], ':country'=> $manufacturer['country']));

		$manufactureroc = $pdo->lastInsertId();

		$stmt = $pdo->query('INSERT INTO oc_manufacturer_to_store(manufacturer_id, store_id) VALUES ("'.$manufactureroc.'", 0)');
		$stmt = $pdo->query('UPDATE oc_1c_manufacturers SET manufacturer_id = '.$manufactureroc.' WHERE id = '.$manufacturer1c);
	}
	else
	{
		$sql = "UPDATE oc_manufacturer SET name = :name WHERE manufacturer_id = :id";
   		$q = $pdo->prepare($sql);
   		$q->execute(array(':name'=> $manufacturer['name'], ':id'=> $rows[0]['manufacturer_id']));
	}
}

foreach ($data['export'][1]['stores'] as $store)
{
	$stmt = $pdo->query('SELECT * FROM oc_1c_stores WHERE uid = "'.$store['uid'].'"');
	$rows = $stmt->fetchAll();
	if (!$rows)
	{
		$sql = 'INSERT INTO oc_1c_stores(uid, name) VALUES (:uid, :name)';
		$q = $pdo->prepare($sql);
		$q->execute(array(':uid'=> $store['uid'], ':name'=> $store['name']));
	}
}

foreach ($data['export'][2]['groups'] as $category)
{
	$stmt = $pdo->query('SELECT * FROM oc_1c_groups WHERE uid = "'.$category['uid'].'"');
	$rows = $stmt->fetchAll();
	if (!$rows)
	{
		$stmt = $pdo->query('INSERT INTO oc_1c_groups(uid) VALUES ("'.$category['uid'].'")');
		$category1c = $pdo->lastInsertId();

		$sql = 'INSERT INTO oc_category(status) VALUES (1)';
		$q = $pdo->prepare($sql);
		$q->execute();

		$categoryid = $pdo->lastInsertId();

		$sql = 'INSERT INTO oc_category_path(category_id, path_id) VALUES ('.$categoryid.', '.$categoryid.')';
		$q = $pdo->prepare($sql);
		$q->execute();

		$sql = 'INSERT INTO oc_category_to_store(category_id, store_id) VALUES ('.$categoryid.', 0)';
		$q = $pdo->prepare($sql);
		$q->execute();

		$sql = 'INSERT INTO oc_category_description(category_id, language_id, name, meta_title) VALUES ('.$categoryid.', 1, :name, :meta_title)';
		$q = $pdo->prepare($sql);
		$q->execute(array(':name'=>$category['name'], ':meta_title'=>$category['name']));

		$stmt = $pdo->query('UPDATE oc_1c_groups SET category_id = '.$categoryid.' WHERE id = '.$category1c);
	}
	else
	{
		$sql = "UPDATE oc_category_description SET name = :name, meta_title = :meta_title WHERE category_id = :id";
   		$q = $pdo->prepare($sql);
   		$q->execute(array(':name'=> $category['name'], ':meta_title'=> $category['meta_title'], ':id'=> $rows[0]['category_id']));
	}
}

foreach ($data['export'][3]['parts'] as $part)
{
	$stmt = $pdo->query('SELECT * FROM oc_1c_parts WHERE uid = "'.$part['uid'].'"');
	$rows = $stmt->fetchAll();
	if (!$rows)
	{
		$stmt = $pdo->query('INSERT INTO oc_1c_parts(uid) VALUES ("'.$part['uid'].'")');
		$part1c = $pdo->lastInsertId();

		$stmt = $pdo->query('SELECT * FROM oc_1c_manufacturers WHERE uid = "'.$part['uid_manufacturer'].'"');
		$manufacturer = $stmt->fetchAll();

		$stmt = $pdo->query('SELECT * FROM oc_1c_groups WHERE uid = "'.$part['uid_group'].'"');
		$category = $stmt->fetchAll();

		if (!$manufacturer[0]['manufacturer_id']) $manu = 0;
		else $manu = $manufacturer[0]['manufacturer_id'];


		if (is_array($part['quantity']))
		{
			$quantity = 0;
			foreach ($part['quantity'] as $key => $value) {
				$quantity += $value['quantity'];
			}
		}
		else $quantity = $part['quantity'];

		$sql = 'INSERT INTO oc_product(model, sku, price, quantity, manufacturer_id, status, country) VALUES (:model, :sku, :price, :quantity, :manufacturer_id, 1, :country)';
		$q = $pdo->prepare($sql);
		$q->execute(array(':model'=> $part['part_number'], ':sku'=>$part['part_number'], ':price'=>$part['price'], ':quantity'=>$quantity, ':manufacturer_id' => $manu, ':country'=> $part['country']));

		$product = $pdo->lastInsertId();

		if (is_array($part['quantity']))
		{
			foreach ($part['quantity'] as $key => $value) {
				$stmt = $pdo->query('SELECT * FROM oc_1c_stores WHERE uid = "'.$value['uid_store'].'"');
				$qty = $stmt->fetchAll();
				
				$sql = 'INSERT INTO oc_product_in_stock(product_id, store_id, quantity) VALUES (:product_id, :store_id, :quantity)';
				$q = $pdo->prepare($sql);
				$q->execute(array(':product_id'=> $product, ':store_id'=>$qty[0]['id'], ':quantity'=>$value['quantity']));
			}
		}

		$sql = 'INSERT INTO oc_product_to_store(product_id, store_id) VALUES ('.$product.', 0)';
		$q = $pdo->prepare($sql);
		$q->execute();

		if ($category) {
			$sql = 'INSERT INTO oc_product_to_category(product_id, category_id) VALUES ('.$product.', '.$category[0]['category_id'].')';
			$q = $pdo->prepare($sql);
			$q->execute();
		}

		$sql = 'INSERT INTO oc_product_description(product_id, language_id, name, meta_title) VALUES ('.$product.', 1, :name , :meta_name)';
		$q = $pdo->prepare($sql);
		$q->execute(array(':name'=> $part['name_local'], ':meta_name' => $part['name_local']));

		$stmt = $pdo->query('UPDATE oc_1c_parts SET product_id = '.$product.' WHERE id = '.$part1c);

		foreach ($part['prices'] as $key => $value) {
			$stmt = $pdo->query('SELECT * FROM oc_option_value_description WHERE name = "'.$value['supplier'].'"');
			$prc = $stmt->fetchAll();

			if (!$prc)
			{
				$sql = 'INSERT INTO oc_option_value(option_id) VALUES (1)';
				$q = $pdo->prepare($sql);
				$q->execute();
				$option = $pdo->lastInsertId();

				$sql = 'INSERT INTO oc_option_value_description(option_value_id, language_id, option_id, name) VALUES ('.$option.', 1, 1, "'.$value['supplier'].'")';
				$q = $pdo->prepare($sql);
				$q->execute();
			}
			else $option = $prc[0]['option_value_id'];

			$stmt = $pdo->query('SELECT * FROM oc_product_option WHERE product_id = '.$product.' AND option_id = 1');
			$po = $stmt->fetchAll();

			if (!$po) {
				$sql = 'INSERT INTO oc_product_option(product_id, option_id, required) VALUES ('.$product.', 1, 0)';
				$q = $pdo->prepare($sql);
				$q->execute();
				$poid = $pdo->lastInsertId();
			}
			else $poid = $po[0]['product_option_id'];

			$stmt = $pdo->query('SELECT * FROM oc_product_option_value WHERE product_id = '.$product.' AND option_value_id = '.$option);
			$po = $stmt->fetchAll();

			if (!$po) {
				$price = $value['price'] - $part['price'];
				if ($price >= 0) $pp = "+";
				else {
					$pp = "-";
					$price = $part['price'] - $value['price'];
				}
				$sql = 'INSERT INTO oc_product_option_value(product_option_id, product_id, option_id, option_value_id, quantity, subtract, price, price_prefix, points, points_prefix, weight, weight_prefix) VALUES ('.$poid.', '.$product.', 1, '.$option.', '.$value['quantity'].', 0, '.$price.', "'.$pp.'" ,0, "+", 0, "+")';
				$q = $pdo->prepare($sql);
				$q->execute();
				$poid = $pdo->lastInsertId();
			}
			else {
				$price = $value['price'] - $part['price'];
				if ($price >= 0) $pp = "+";
				else {
					$pp = "-";
					$price = $part['price'] - $value['price'];
				}
				$sql = 'UPDATE oc_product_option_value SET quantity = '.$value['quantity'].', price = '.$price.', price_prefix = "'.$pp.'" WHERE product_option_value_id = '.$po[0]['product_option_value_id'];
				$q = $pdo->prepare($sql);
				$q->execute();
			}

		}
		
	}
	else
	{
		if (is_array($part['quantity']))
		{
			$quantity = 0;
			foreach ($part['quantity'] as $key => $value) {
				$quantity += $value['quantity'];
			}
		}
		else $quantity = $part['quantity'];

		$sql = "UPDATE oc_product_description SET name = :name WHERE product_id = :id";
   		$q = $pdo->prepare($sql);
   		$q->execute(array(':name'=> $part['name_local'], ':id'=> $rows[0]['product_id']));

   		$sql = "UPDATE oc_product SET quantity = :quantity WHERE product_id = :id";
   		$q = $pdo->prepare($sql);
   		$q->execute(array(':quantity'=> $quantity, ':id'=> $rows[0]['product_id']));

   		if (is_array($part['quantity']))
		{
			foreach ($part['quantity'] as $key => $value) {
				$stmt = $pdo->query('SELECT * FROM oc_1c_stores WHERE uid = "'.$value['uid_store'].'"');
				$qty = $stmt->fetchAll();

				$stmt = $pdo->query('SELECT * FROM oc_product_in_stock WHERE product_id = '.$rows[0]['product_id'].' AND store_id = '.$qty[0]['id']);
				$zty = $stmt->fetchAll();

				if (!$zty)
				{
					$sql = 'INSERT INTO oc_product_in_stock(product_id, store_id, quantity) VALUES (:product_id, :store_id, :quantity)';
					$q = $pdo->prepare($sql);
					$q->execute(array(':product_id'=> $product, ':store_id'=>$qty[0]['id'], ':quantity'=>$value['quantity']));
				}
				else
				{
					$sql = 'UPDATE oc_product_in_stock SET quantity = :quantity WHERE product_id = '.$rows[0]['product_id'].' AND store_id = '.$qty[0]['id'];
   					$q = $pdo->prepare($sql);
   					$q->execute(array(':quantity'=> $value['quantity']));
				}
				
				
			}
		}

		$product = $rows[0]['product_id'];

		foreach ($part['prices'] as $key => $value) {
			$stmt = $pdo->query('SELECT * FROM oc_option_value_description WHERE name = "'.$value['supplier'].'"');
			$prc = $stmt->fetchAll();

			if (!$prc)
			{
				$sql = 'INSERT INTO oc_option_value(option_id) VALUES (1)';
				$q = $pdo->prepare($sql);
				$q->execute();
				$option = $pdo->lastInsertId();

				$sql = 'INSERT INTO oc_option_value_description(option_value_id, language_id, option_id, name) VALUES ('.$option.', 1, 1, "'.$value['supplier'].'")';
				$q = $pdo->prepare($sql);
				$q->execute();
			}
			else $option = $prc[0]['option_value_id'];

			$stmt = $pdo->query('SELECT * FROM oc_product_option WHERE product_id = '.$product.' AND option_id = 1');
			$po = $stmt->fetchAll();

			if (!$po) {
				$sql = 'INSERT INTO oc_product_option(product_id, option_id, required) VALUES ('.$product.', 1, 0)';
				$q = $pdo->prepare($sql);
				$q->execute();
				$poid = $pdo->lastInsertId();
			}
			else $poid = $po[0]['product_option_id'];

			$stmt = $pdo->query('SELECT * FROM oc_product_option_value WHERE product_id = '.$product.' AND option_value_id = '.$option);
			$po = $stmt->fetchAll();

			if (!$po) {
				$price = $value['price'] - $part['price'];
				if ($price >= 0) $pp = "+";
				else {
					$pp = "-";
					$price = $part['price'] - $value['price'];
				}
				$sql = 'INSERT INTO oc_product_option_value(product_option_id, product_id, option_id, option_value_id, quantity, subtract, price, price_prefix, points, points_prefix, weight, weight_prefix) VALUES ('.$poid.', '.$product.', 1, '.$option.', '.$value['quantity'].', 0, '.$price.', "'.$pp.'" ,0, "+", 0, "+")';
				$q = $pdo->prepare($sql);
				$q->execute();
				$poid = $pdo->lastInsertId();
			}
			else {
				$price = $value['price'] - $part['price'];
				if ($price >= 0) $pp = "+";
				else {
					$pp = "-";
					$price = $part['price'] - $value['price'];
				}
				$sql = 'UPDATE oc_product_option_value SET quantity = '.$value['quantity'].', price = '.$price.', price_prefix = "'.$pp.'" WHERE product_option_value_id = '.$po[0]['product_option_value_id'];
				$q = $pdo->prepare($sql);
				$q->execute();
			}
		}
	}
}

foreach ($data['export'][4]['analogs'] as $analog_group)
{
	$analog_arr = array();
	foreach($analog_group['parts'] as $analogs)
	{
		$stmt = $pdo->query('SELECT p.* FROM oc_product p, oc_1c_manufacturers m WHERE p.manufacturer_id = m.manufacturer_id AND m.uid = "'.$analogs['uid_manufacturer'].'" AND p.sku = "'.$analogs['part_number'].'"');
		$rows = $stmt->fetchAll();
		if ($rows) {
			$analog_arr[] = $rows[0]['product_id'];
		}
		else {
			$stmt = $pdo->query('SELECT * FROM oc_1c_manufacturers WHERE uid = "'.$analogs['uid_manufacturer'].'"');
			$manufacturer = $stmt->fetchAll();

			if (!$manufacturer[0]['manufacturer_id']) $manu = 0;
			else $manu = $manufacturer[0]['manufacturer_id'];

			$sql = 'INSERT INTO oc_product(model, sku, price, quantity, manufacturer_id, status) VALUES (:model, :sku, :price, :quantity, :manufacturer_id, 1)';
			$q = $pdo->prepare($sql);
			$q->execute(array(':model'=> $analogs['part_number'], ':sku'=>$analogs['part_number'], ':price'=>0, ':quantity'=>0, ':manufacturer_id' => $manu));

			

			$product = $pdo->lastInsertId();

			$sql = 'INSERT INTO oc_product_to_store(product_id, store_id) VALUES ('.$product.', 0)';
			$q = $pdo->prepare($sql);
			$q->execute();

			$sql = 'INSERT INTO oc_product_description(product_id, language_id, name, meta_title) VALUES ('.$product.', 1, :name , :meta)';
			$q = $pdo->prepare($sql);
			$q->execute(array(':name'=>$analogs['part_name'], ':meta'=>$analogs['part_name']));

			$analog_arr[] = $product;
		}
	}
	for ($i = 0; $i < count($analog_arr); $i++) {
		for ($j = 0; $j < count($analog_arr); $j++) {
			if ($i != $j) {
				$stmt = $pdo->query('SELECT * FROM oc_product_related WHERE product_id = '.$analog_arr[$i].' AND related_id = '.$analog_arr[$j]);
				$related = $stmt->fetchAll();
				if (!$related) {
					$sql = 'INSERT INTO oc_product_related(product_id, related_id) VALUES ('.$analog_arr[$i].', '.$analog_arr[$j].')';
					$q = $pdo->prepare($sql);
					$q->execute();
				}
			}
		}
	}
}

}


/*

TRUNCATE `oc_1c_analogs`;
TRUNCATE `oc_1c_groups`;
TRUNCATE `oc_1c_manufacturers`;
TRUNCATE `oc_1c_parts`;
TRUNCATE `oc_1c_stores`;
TRUNCATE `oc_category`;
TRUNCATE `oc_category_description`;
TRUNCATE `oc_category_filter`;
TRUNCATE `oc_category_path`;
TRUNCATE `oc_category_to_layout`;
TRUNCATE `oc_category_to_store`;
TRUNCATE `oc_manufacturer`;
TRUNCATE `oc_manufacturer_to_store`;
TRUNCATE `oc_product`;
TRUNCATE `oc_product_attribute`;
TRUNCATE `oc_product_description`;
TRUNCATE `oc_product_discount`;
TRUNCATE `oc_product_filter`;
TRUNCATE `oc_product_image`;
TRUNCATE `oc_product_option`;
TRUNCATE `oc_product_option_value`;
TRUNCATE `oc_product_recurring`;
TRUNCATE `oc_product_related`;
TRUNCATE `oc_product_reward`;
TRUNCATE `oc_product_special`;
TRUNCATE `oc_product_to_category`;
TRUNCATE `oc_product_to_download`;
TRUNCATE `oc_product_to_layout`;
TRUNCATE `oc_product_to_store`;
TRUNCATE `oc_product_in_stock`;


TRUNCATE `oc_option_value`;
TRUNCATE `oc_option_value_description`;
TRUNCATE `oc_product_option`;
TRUNCATE `oc_product_option_value`;
*/

?>