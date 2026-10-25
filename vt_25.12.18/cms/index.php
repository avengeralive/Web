<?php
error_reporting(0);
include('include/common.php');

if (isset($_POST['token'])) {
    $_s = \Cetera\Util::curlGet('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST']);
    $u = json_decode($_s, true);
    if ($u && $u['uid']) {
    
        $application->connectDb();
        $application->initSession();
        $application->getAuth()->authenticate(new Cetera\UserAuthAdapterULogin($u, false));
        $user = $application->getUser();        
        
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php echo APP_NAME; ?></title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="/<?php echo LIBRARY_PATH; ?>/cropper/cropper.min.css">
	
    <link rel="stylesheet" type="text/css" href="/<?php echo LIBRARY_PATH; ?>/extjs4/resources/css/ext-all.css"> 
    <script type="text/javascript" src="/<?php echo LIBRARY_PATH; ?>/extjs4/ext-all-debug.js"></script>
    <script type="text/javascript" src="/<?php echo LIBRARY_PATH; ?>/extjs4/compatibility/ext3-core-compat.js"></script>
    <script type="text/javascript" src="/<?php echo LIBRARY_PATH; ?>/extjs4/compatibility/ext3-compat.js"></script>	
	
	<script type="text/javascript" src="/<?php echo LIBRARY_PATH; ?>/ace/ace.js"></script>
	<script type="text/javascript" src="/<?php echo LIBRARY_PATH; ?>/beautify/beautify-css.js"></script>
	<script type="text/javascript" src="/<?php echo LIBRARY_PATH; ?>/beautify/beautify-html.js"></script>
	<script type="text/javascript" src="/<?php echo LIBRARY_PATH; ?>/beautify/beautify.js"></script>
	<script type="text/javascript" src="/<?php echo LIBRARY_PATH; ?>/minify/htmlminifier.min.js"></script>
	<script type="text/javascript" src="/<?php echo LIBRARY_PATH; ?>/ace/ace.js"></script>
	<script type="text/javascript" src="/<?php echo LIBRARY_PATH; ?>/cropper/cropper.min.js"></script>	
    <script src="//ulogin.ru/js/ulogin.js"></script>
    
<?php if ($application->getVar('setup_done')) : ?>    
    
    <script type="text/javascript" src="config.php"></script>
    <script type="text/javascript" src="app.js"></script>
    <script type="text/javascript">
    <?php if ($user && !$user->allowBackOffice()) : ?>
    var userMessage = '<?=$application->getTranslator()->_('Недостаточно полномочий')?>';
    <?php else : ?> 
    var userMessage = '';
    <?php endif ?> 
		
    </script>  
    
<?php else : ?> 

    <link rel="stylesheet" type="text/css" href="css/setup.css">
    <?php include('setup.php'); ?>     
    
<?php endif ?> 
     
</head>
<body id="main_body" class="body-backoffice">
</body>
</html>
