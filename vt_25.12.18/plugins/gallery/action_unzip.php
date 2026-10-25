<?php
include_once('common_bo.php');
require_once( __DIR__.'/pclzip.lib.php');

$res = array(
    'success' => false,
);

$path_parts = pathinfo($_POST['file']);
$path_parts['dirname'] .= '/'.date('Ymd').'/'.date('His');  

$zip = new PclZip(WWWROOT.$_POST['file']);
$number = 1;
$path = WWWROOT.$path_parts['dirname'];
$content = $zip->extract(PCLZIP_OPT_PATH, WWWROOT.$path_parts['dirname'], PCLZIP_CB_PRE_EXTRACT, 'pre_extract_callback');
if ($content<=0) throw new Exception( 'Ошибка при распаковке архива.');

unlink(WWWROOT.$_POST['file']);     

$od = new Cetera\ObjectDefinition($_POST['mat_type']);
$table = $od->alias;
$publish = MATH_ADDED | MATH_PUBLISHED;

$res['files'] = array();	    
foreach($content as $file) {
    if ($file['folder']) continue;
    $file['stored_filename'] = htmlentities( (string) $file['stored_filename'], ENT_QUOTES, 'utf-8', FALSE);
	$data = pathinfo($file['filename']);	
	if (!$file['stored_filename']) $file['stored_filename'] = $data['basename'];
    fssql_query('INSERT INTO '.$table.' SET name="'.mysql_escape_string(basename($file['stored_filename'])).'",idcat='.CATALOG_VIRTUAL_HIDDEN.',dat=NOW(),dat_update=NOW(), alias="hidden",type='.$publish.',tag=0,autor='.$user->id.',file="'.mysql_escape_string($path_parts['dirname'].'/'.$file['stored_filename']).'"');
    $res['files'][] = array(
      'id'   => mysql_insert_id(),
      'file' => $path_parts['dirname'].'/'.$data['basename'],
      'name' => basename($file['stored_filename']),
	  //'raw'  => $file,
    );
}
$res['success'] = true;

echo json_encode($res);

function pre_extract_callback($info, &$res) {
	global $number, $path;
	
	$data = pathinfo($res['filename']);	
	if (!$data['extension']) return 0;
	//file_put_contents(WWWROOT.'log.txt', $res['filename']."\n" , FILE_APPEND );	
	$res['filename'] = $path.'/'.$number++.'.'.$data['extension'];
	return 1;
	
}