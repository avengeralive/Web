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
$pdo->exec("TRUNCATE `oc_1c_analogs`");
$pdo->exec("TRUNCATE `oc_1c_groups`");
$pdo->exec("TRUNCATE `oc_1c_manufacturers`");
$pdo->exec("TRUNCATE `oc_1c_parts`");
$pdo->exec("TRUNCATE `oc_1c_stores`");
$pdo->exec("TRUNCATE `oc_category`");
$pdo->exec("TRUNCATE `oc_category_description`");
$pdo->exec("TRUNCATE `oc_category_filter`");
$pdo->exec("TRUNCATE `oc_category_path`");
$pdo->exec("TRUNCATE `oc_category_to_layout`");
$pdo->exec("TRUNCATE `oc_category_to_store`");
$pdo->exec("TRUNCATE `oc_manufacturer`");
$pdo->exec("TRUNCATE `oc_manufacturer_to_store`");
$pdo->exec("TRUNCATE `oc_product`");
$pdo->exec("TRUNCATE `oc_product_attribute`");
$pdo->exec("TRUNCATE `oc_product_description`");
$pdo->exec("TRUNCATE `oc_product_discount`");
$pdo->exec("TRUNCATE `oc_product_filter`");
$pdo->exec("TRUNCATE `oc_product_image`");
$pdo->exec("TRUNCATE `oc_product_option`");
$pdo->exec("TRUNCATE `oc_product_option_value`");
$pdo->exec("TRUNCATE `oc_product_recurring`");
$pdo->exec("TRUNCATE `oc_product_related`");
$pdo->exec("TRUNCATE `oc_product_reward`");
$pdo->exec("TRUNCATE `oc_product_special`");
$pdo->exec("TRUNCATE `oc_product_to_category`");
$pdo->exec("TRUNCATE `oc_product_to_download`");
$pdo->exec("TRUNCATE `oc_product_to_layout`");
$pdo->exec("TRUNCATE `oc_product_to_store`");
$pdo->exec("TRUNCATE `oc_product_in_stock`");


$pdo->exec("TRUNCATE `oc_option_value`");
$pdo->exec("TRUNCATE `oc_option_value_description`");
$pdo->exec("TRUNCATE `oc_product_option`");
$pdo->exec("TRUNCATE `oc_product_option_value`");
$pdo->exec("SET NAMES utf8");
$pdo->exec("INSERT INTO oc_option_value(option_id) VALUES (1)");
$pdo->exec("INSERT INTO oc_option_value_description(option_value_id, language_id, option_id, name) VALUES (1, 1, 1, 'Склад')");



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