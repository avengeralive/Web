<?php
$CONNECT = mysqli_connect('localhost','root','5JTLc75A5JTLc75A','cpa') or die('Не удалось подключиться к базе');
$sql_stream = "SELECT * FROM stream WHERE id = ".$_GET['stream'];
$result_stream = mysqli_query($CONNECT, $sql_stream);
$res_stream = mysqli_fetch_assoc($result_stream);

$sql_user = "SELECT * FROM users WHERE id = ".$res_stream['user_id'];
$result_user = mysqli_query($CONNECT, $sql_user);
$res_user = mysqli_fetch_assoc($result_user);

$sql_landing = "SELECT * FROM landings WHERE id = ".$_GET['landing'];
$result_landing = mysqli_query($CONNECT, $sql_landing);
$res_landing = mysqli_fetch_assoc($result_landing);

$name = explode('/', explode('http://offers.avaleads.pro/', $res_landing['url'])[1])[0];
$type = explode('/', explode('http://offers.avaleads.pro/', $res_landing['url'])[1])[1];

$rootsource = dirname(__FILE__);
$rootsource = str_replace('\\', DIRECTORY_SEPARATOR, realpath($rootsource));
$rootsource = str_replace('/', DIRECTORY_SEPARATOR, $rootsource);
$source = $rootsource.'/'.$name.'/'.$type;
$mktime = mktime();
$tmpsource = $rootsource.'/_tmp/'.$name.'_'.$mktime;
$zipsource = $rootsource.'/_tmp/'.$name.'_'.$mktime.'.zip';

if (is_dir($source) === true) {
    copy_folder($source, $tmpsource);
    $key = $res_user['apikey'];
    $thankyou = file_get_contents($rootsource.'/thank_you.txt');
    $thankyou = str_replace('{key}', $key, $thankyou);
    $thankyou = str_replace('{stream}', $_GET['stream'], $thankyou);
    file_put_contents($rootsource.'/_succcess/index.php', $thankyou);

    $zip = new ZipArchive();
    $zip->open($zipsource, ZipArchive::CREATE | ZipArchive::OVERWRITE);
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($tmpsource),
        RecursiveIteratorIterator::LEAVES_ONLY
    );
    foreach ($files as $name => $file)
    {
        if (!$file->isDir())
        {
            $filePath = $file->getRealPath();
            //var_dump($filePath);
            $relativePath = substr($filePath, strlen($rootsource.'/_tmp') + 1);
            $zip->addFile($filePath, $relativePath);
        }
    }
    $zip->close();
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($zipsource));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($zipsource));
    readfile($zipsource);
}

function copy_folder($d1, $d2, $upd = true, $force = true) {
    if ( is_dir( $d1 ) ) {
        $d2 = mkdir_safe( $d2, $force );
        if (!$d2) {fs_log("!!fail $d2"); return;}
        $d = dir( $d1 );
        while ( false !== ( $entry = $d->read() ) ) {
            if ( $entry != '.' && $entry != '..' ) 
                copy_folder( "$d1/$entry", "$d2/$entry", $upd, $force );
        }
        $d->close();
    }
    else {
        $ok = copy_safe( $d1, $d2, $upd );
        $ok = ($ok) ? "ok-- " : " -- ";
        fs_log("{$ok} $d1 || $d2"); 
    }
}
function fs_log($str) { 
    $log = fopen("./fs_log.txt", "a"); 
    $time = date("Y-m-d H:i:s"); 
    fwrite($log, "$str ($time)\n"); 
    fclose($log); 
} 
function mkdir_safe( $dir, $force ) { 
    if (file_exists($dir)) { 
        if (is_dir($dir)) return $dir; 
        else if (!$force) return false; 
        unlink($dir); 
    } 
    return (mkdir($dir, 0777, true)) ? $dir : false; 
}
function copy_safe ($f1, $f2, $upd) { 
    $time1 = filemtime($f1); 
    if (file_exists($f2)) { 
        $time2 = filemtime($f2); 
        if ($time2 >= $time1 && $upd) return false; 
    } 
    $ok = copy($f1, $f2); 
    if ($ok) touch($f2, $time1); 
    return $ok; 
}