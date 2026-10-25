<?

if ($_POST['password'] == 'zapbrs@180564') {

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


$sql = "UPDATE oc_product SET status = 0 WHERE quantity = 0";
$q = $pdo->prepare($sql);
$q->execute();

$sql = "UPDATE oc_product SET status = 1 WHERE quantity > 0";
$q = $pdo->prepare($sql);
$q->execute();

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