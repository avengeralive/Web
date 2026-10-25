<?php

class ExportController {

    
    protected $_validKeys = array(
        'cpad' => array(
            'de5fd6afc5ad8635d56958afecefe16a'
        ),
        'ats'=>[
            '349340wiiuwed97sdd7239234973247a'
        ],
    );

    

    protected function isValidKey($network, $apiKey) {
        if (!isset($this->_validKeys[$network])) {
            return false;
        }
        return in_array($apiKey, $this->_validKeys[$network]);
    }

  

    public function export($network = false, $apikey = false) {
        if (!$this->isValidKey($network, $apikey)) {
            return;
        }
        try {
            $exporter = Export::factory($network);
            echo $exporter->getExported();
        } catch (Exception $ex) {
            echo "Unable to load";
        }

        return true;
    }

}
