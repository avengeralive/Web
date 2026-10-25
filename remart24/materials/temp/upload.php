<?php
$session_id = $_GET['session_id'];
//$verifyToken = md5('unique_salt' . $_POST['timestamp']);
if (!empty($_FILES)) 
{
	$out = '';
//&& $_POST['token'] == $verifyToken) {	
	if (!is_dir(dirname(__FILE__).'/files/'.$session_id))
	{
		mkdir(dirname(__FILE__).'/files/'.$session_id, 0755);
	}
	$targetFolder = dirname(__FILE__).'/files/'.$session_id; // Relative to the root
	$targetPath = $targetFolder;
	
	foreach ($_FILES['files']['tmp_name'] as $index => $value) {
		$tempFile = $value;
		$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['files']['name'][$index];
		
			// Validate the file type
		$fileTypes = $_POST['fileTypeExts']; // File extensions		
		$fileParts = pathinfo($_FILES['files']['name'][$index]);
		
		if ($fileTypes == '.' || preg_match('/^'.$fileTypes.'$/i', strtolower($fileParts['extension']))) {
			move_uploaded_file($tempFile, $targetFile);
		} else {
			$out .= 'Invalid file type for the file: '.$_FILES['files']['name'][$index].'; ';
		}		
	}
	return $out;
}

?>