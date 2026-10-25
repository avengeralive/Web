<?php

class browser_detect {

    public $CutBuild = false; // обрезать ли версию браузера // Trim if the browser version //
    private $browser, $version, $platform;
    
    function __construct($agent) {
        $result = $this->get($agent);
        $this->browser=$result['browser'];
        $this->version=$result['version'];
        $this->platform=$result['platform'];
    }

    public function getBrowser() {
        return $this->browser;
    }

    public function getVersion() {
        return $this->version;
    }
    
    public function getPlatform() {
        return $this->platform;
    }    

    private function cut_ver($ver) {
        if ($this->CutBuild) {
            if (substr_count($ver, '.') > 1) {
                $pos = strpos($ver, '.', strpos($ver, '.') + 1);
                $ver = substr($ver, 0, $pos);
            }
        }
        return $ver;
    }

    private function get($agent) {    
        if (preg_match('/android/i', $agent)) {
            $platform = 'Android';
        }          
        elseif (preg_match('/linux/i', $agent)) {
            $platform = 'Linux';
        }
        elseif (preg_match('/iPhone.*Mobile|iPod|iPad/i', $agent)) {
            $platform = 'iOS';
        }        
        elseif (preg_match('/macintosh|mac os x/i', $agent)) {
            $platform = 'Mac';
        }
        elseif (preg_match('/windows|win32/i', $agent)) {
            $platform = 'Windows';
        }
        else {
            $platform = 'N/A';
        }
        
        preg_match("/(Trident|MSIE|Firefox|Version|Opera|OPR|Chrome| Mini|Netscape|Konqueror|SeaMonkey|Camino|Minefield|Iceweasel|K-Meleon|Maxthon)(?:\/| )([0-9.]+)/", $agent, $browser_info);

        if(empty($browser_info))
            return array('browser' => '', 'version'=> '', 'platform' => $platform);
        
        list(, $browser, $version) = $browser_info;

        if (preg_match("/Opera ([0-9.]+)/i", $agent, $opera))
            return array('browser' => 'Opera', 'version' => $this->cut_ver($opera[1]), 'platform' => $platform);

        if (preg_match("/(OPR)\/([0-9.]+)/", $agent, $opera))
            return array('browser' => 'Opera', 'version' => $this->cut_ver($opera[2]), 'platform' => $platform);

        if ($browser == 'MSIE') {

            preg_match("/(Maxthon|Avant Browser|MyIE2)/i", $agent, $ie);

            if ($ie)
                return array('browser' => $ie[1] . ', IE based', 'version' => $this->cut_ver($version), 'platform' => $platform);

            return array('browser' => 'IE', 'version' => $this->cut_ver($version), 'platform' => $platform);
        }

        if ($browser == 'Firefox') {

            preg_match("/(Flock|Navigator|Epiphany)\/([0-9.]+)/", $agent, $ff);

            if ($ff)
                return array('browser' => $ff[1], 'version' => $this->cut_ver($ff[2]), 'platform' => $platform);
        }

        if ($browser == 'Opera' && $version == '9.80')
            return array('browser' => 'Opera', 'version' => substr($agent, -5), 'platform' => $platform);

        if ($browser == 'Version')
            return array('browser' => 'Safari', 'version' => $this->cut_ver($version), 'platform' => $platform);

        if ($browser == 'Trident') {
            if (preg_match("/(rv)\:([0-9.]+)/", $agent, $ie) or
                    preg_match("/(rv)\ ([0-9.]+)/", $agent, $ie) or
                    preg_match("/(rv)([0-9.]+)/", $agent, $ie))
                return array('browser' => 'IE', 'version' => $this->cut_ver($ie[2]), 'platform' => $platform);
        }

        if (!$browser && strpos($agent, 'Gecko'))
            return array('browser' => 'Gecko based', 'version' => '', 'platform' => $platform);
        


        return array('browser' => $browser, 'version' => $this->cut_ver($version), 'platform' => $platform);
    }

}

