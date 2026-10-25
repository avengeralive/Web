<?php
require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/header.php');
require_once('navigation.php');
echo '<h1>'.Translations::gi()->layouts.'</h1>';
echo '<hr/>';
echo $crud_layouts;

require_once(Backstage::gi()->ADMIN_TEMPLATE_DIR.'views/footer.php');
?>