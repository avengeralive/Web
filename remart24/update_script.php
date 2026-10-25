<?php

    ini_set('memory_limit', '-1');
    ini_set('max_execution_time', 300);

    if(file_exists($_SERVER['DOCUMENT_ROOT'].'/qbit/test')){
    	echo "file exist";
    	return;
    }
	$last_commit = "340b346";
	$new_commit  = "82a02c9";

	$url = "http://78.47.95.4/qbit/server_script.php";


	$ch= curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt($ch, CURLOPT_POSTFIELDS,"last_commit=".$last_commit."&new_commit=".$new_commit);

	$response = curl_exec($ch);
	curl_close($ch);

	$url = json_decode($response, true);
	print_r($url);
	
	// get diffs between commits
	$url = "https://api.bitbucket.org/2.0/repositories/bitep/qbit/diff/".$new_commit."..".$last_commit;

	$diff = file_get_contents($url);
	if(!empty($diff)){
		

	//create folder , download and unzip
	    $oldmask = umask(0);
		mkdir("test", 0777);
		umask($oldmask);

		$zip_src = "http://78.47.95.4/qbit_update/diff_".$new_commit."_".$last_commit.".zip";

		file_put_contents($_SERVER['DOCUMENT_ROOT'].'/qbit/test/updates.zip', file_get_contents($zip_src));

		$zip = new ZipArchive;

	    $res = $zip->open($_SERVER['DOCUMENT_ROOT'].'/qbit/test/updates.zip');

	    if ($res) {
	        $zip->extractTo($_SERVER['DOCUMENT_ROOT'].'/qbit/test');
	        $zip->close();
	        echo 'woot!';
	    } else {
	        echo 'doh!';
	    }

    $diffs = explode("diff", $diff);
		if(!empty($diffs)){
			foreach ($diffs as $value) {
				if(!empty($value)){
					$parsed = get_string_between($value, '--git a/', ' b');
					echo $parsed;
					echo "<br/>";

					// copy($_SERVER['DOCUMENT_ROOT'].'/qbit/test/bitep-qbit-ee5d79123f47/'.$parsed, $_SERVER['DOCUMENT_ROOT'].'/qbit/'.$parsed);break;
				}
			}

			// deleteDirectory($_SERVER['DOCUMENT_ROOT'].'/qbit/test');
		}
	}

	function deleteDirectory($dir) { 
        if (!file_exists($dir)) { return true; }
        if (!is_dir($dir) || is_link($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) { 
            if ($item == '.' || $item == '..') { continue; }
            if (!deleteDirectory($dir . "/" . $item, false)) { 
                chmod($dir . "/" . $item, 0777); 
                if (!deleteDirectory($dir . "/" . $item, false)) return false; 
            }; 
        } 
        return rmdir($dir); 
    }

	function get_string_between($string, $start, $end){
	    $string = ' ' . $string;
	    $ini = strpos($string, $start);
	    if ($ini == 0) return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;
	    return substr($string, $ini, $len);
	}
   