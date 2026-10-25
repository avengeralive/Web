<?php

/**
 * @package    MVC
 *
 * @copyright  Copyright (C) 2014  Rinat Gazikhanov, Vusal Khalilov, BITEP LLC. All rights reserved.
 * @license    GNU General Public License version 3 or later; see LICENSE.txt
 */
class cUpdates extends controller
{
    public function form(){

        $errors = false;
        $this->data['current_version'] = Loader::gi()->getModel($this->data);

        if(isset($this->data['request']->parameters['last_commit']) && !empty($this->data['request']->parameters['last_commit']) && isset($this->data['request']->parameters['new_commit']) && !empty($this->data['request']->parameters['new_commit'])){


            ini_set('memory_limit', '-1');
            ini_set('max_execution_time', 900);
            if(file_exists($_SERVER['DOCUMENT_ROOT'].'/qbit/updateSubFolder')){
                $this->data['error'] = "ERROR: Update in process";
                $this->data['body'] = Loader::gi()->getView($this->data);
                return $this->data;
            }
            $last_commit = $this->data['request']->parameters['last_commit'];
            $new_commit  = substr($this->data['request']->parameters['new_commit'], 0, 7);

            $url = "http://78.47.95.4/qbit/server_script.php";


            $ch= curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt($ch, CURLOPT_POSTFIELDS,"last_commit=".$last_commit."&new_commit=".$new_commit);

            $response = curl_exec($ch);
            curl_close($ch);

            // get diffs between commits
            $url = "https://api.bitbucket.org/2.0/repositories/bitep/qbit/diff/".$new_commit."..".$last_commit;

            $diff = file_get_contents($url);
            if(!empty($diff)){
                

            //create folder , download and unzip
                $oldmask = umask(0);
                mkdir("updateSubFolder", 0777);
                umask($oldmask);

                $zip_src = "http://78.47.95.4/qbit_update/diff_".$new_commit."_".$last_commit.".zip";
                if(@file_get_contents($zip_src) !== false){
                    file_put_contents($_SERVER['DOCUMENT_ROOT'].'/qbit/updateSubFolder/updates.zip', file_get_contents($zip_src));

                    $zip = new ZipArchive;

                    $res = $zip->open($_SERVER['DOCUMENT_ROOT'].'/qbit/updateSubFolder/updates.zip');

                    if ($res) {
                        $zip->extractTo($_SERVER['DOCUMENT_ROOT'].'/qbit/updateSubFolder');
                        $zip->close();
                        
                    

                        $diffs = explode("diff", $diff);
                        if(!empty($diffs)){
                            foreach ($diffs as $value) {
                                if(!empty($value)){
                                    $parsed = $this->get_string_between($value, '--git a/', ' b');
                                    copy($_SERVER['DOCUMENT_ROOT'].'/qbit/updateSubFolder/'.$parsed, $_SERVER['DOCUMENT_ROOT'].'/qbit/'.$parsed);
                                }
                            }

                            $this->deleteDirectory($_SERVER['DOCUMENT_ROOT'].'/qbit/updateSubFolder');

                            $cur_version = $this->data['current_version']->version;
                            $dir    = $_SERVER['DOCUMENT_ROOT'].'/qbit/dbupdates';
                            $dbupdates = scandir($dir);
                            if(!empty($dbupdates)){
                                foreach ($dbupdates as $value){ 
                                    if (!in_array($value,array(".",".."))) {
                                        $file_version = explode("db_", $value);
                                        $file_version = explode(".sql", $file_version[1]);

                                        if ((version_compare($cur_version , str_replace('_', '.', $file_version[0])) < 0)) {
                                            $last_alters = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/qbit/dbupdates/'.$value);
                                                if(!empty($last_alters)){
                                                    $alters['sql'] = $last_alters;
                                                    Loader::gi()->callModule("GET", 'updates/alters', $alters);

                                                }
                                        }
                                    }
                                }
                            }
                        }
                    }else {
                        echo "cannot unzip file";
                        $this->data['error'] = "ERROR";
                        $errors = true;
                    }
                }else{
                    echo "cannot take zip file from server";
                    $this->data['error'] = "ERROR";
                    $errors = true;
                }
            }   

            
            if(!$errors){
                $this->data['success'] = "SUCCESS: System updated";

                $updateQbitParam['version'] = $this->data['request']->parameters['name'];
                $updateQbitParam['hash'] = substr($this->data['request']->parameters['new_commit'], 0, 7);
                $updateQbitParam['type'] = 'f';

                Loader::gi()->callModule("GET", 'updates/updateQbitVersion', $updateQbitParam);
            }else{
                $this->deleteDirectory($_SERVER['DOCUMENT_ROOT'].'/qbit/updateSubFolder');
            }
        }

        $this->data['current_version'] = Loader::gi()->getModel($this->data);

        $url = "https://api.bitbucket.org/2.0/repositories/bitep/qbit/refs/tags";

        $ch= curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );                                                                      
        $response = curl_exec($ch);
        curl_close($ch);

        $tags = json_decode($response, true);

        $i = 0;
        if(isset($tags['values']) && !empty($tags['values'])){
            foreach ($tags['values'] as $value) {
               $versions[$i]['name'] = $value['name'];
               $versions[$i]['hash'] = $value['target']['hash'];
               $i++;
            } 
        }

        $this->data['versions'] = $versions;

        $this->data['body'] = Loader::gi()->getView($this->data);
        return $this->data;
    }


    public function updateQbitVersion(){
        Loader::gi()->getModel($this->data);
        $this->data['body'] = '';
        return $this->data;
    }

    public function alters(){
        Loader::gi()->getModel($this->data);
        $this->data['body'] = '';
        return $this->data;
    }

    public function deleteDirectory($dir) { 
        if (!file_exists($dir)) { return true; }
        if (!is_dir($dir) || is_link($dir)) {
            return unlink($dir);
        }
        foreach (scandir($dir) as $item) { 
            if ($item == '.' || $item == '..') { continue; }
            if (!$this->deleteDirectory($dir . "/" . $item, false)) { 
                chmod($dir . "/" . $item, 0777); 
                if (!$this->deleteDirectory($dir . "/" . $item, false)) return false; 
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
    
}