<?php

require_once 'include.config.php';

Engine::$db = $db;

$user = !empty($_SESSION['user']) ? $_SESSION['user'] : null;
$action = !empty($_REQUEST['action']) ? $_REQUEST['action'] : '';
$section = !empty($_REQUEST['section']) ? $_REQUEST['section'] : '';

$redirect = method_exists('Engine', "action_$action") ? call_user_func(['Engine', "action_$action"], $_REQUEST) : '';

//session_write_close(); // Close session - so all changes should be performed in actions only!

if ($redirect) {
    header('Location: '.$redirect);
    exit;
}

if (!$user) {
    $html = Engine::render_login($_REQUEST);
    echo $html;
    exit;
}

$html = method_exists('Engine', "render_$section") ? call_user_func(['Engine', "render_$section"], $_REQUEST) : call_user_func(['Engine', "render_index"], $_REQUEST);

require_once 'tpls/header.php';
echo $html;
require_once 'tpls/footer.php';
