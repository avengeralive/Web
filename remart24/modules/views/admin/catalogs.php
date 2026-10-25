<?php
require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/header.php');
require_once('navigation.php');
echo '<h1>'.Translations::gi()->catalogs.'</h1>';
echo '<hr/>';
echo $crud_catalogs;

require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/footer.php');
?>