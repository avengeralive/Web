<?php

class RPostApi {
    
    private $url = '';
    protected $client = null;
    private $config = array(
        'login' => '',
        'password' => '',
        'package' => '',
    );
    
    function __construct($config)
    {
        if($this->config['package']) {
            $this->url = 'https://tracking.russianpost.ru/fc?wsdl';
        } else {
            $this->url = 'https://tracking.russianpost.ru/rtm34?wsdl';
        }
        $this->client = new SoapClient($this->url,  array(
                'trace' => 1,
                'soap_version' => SOAP_1_1
            )
        );
        $this->config = $config;
    }
    
    function getTicketSingle($code, $html = false)
    {
        $request = 
            '<?xml version="1.0" encoding="UTF-8"?>
            <soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:oper="http://russianpost.org/operationhistory" xmlns:data="http://russianpost.org/operationhistory/data" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/">
            <soap:Header/>
            <soap:Body>
               <oper:getOperationHistory>
                  <data:OperationHistoryRequest>
                     <data:Barcode>'.$code.'</data:Barcode>  
                     <data:MessageType>0</data:MessageType>
                     <data:Language>RUS</data:Language>
                  </data:OperationHistoryRequest>
                  <data:AuthorizationHeader soapenv:mustUnderstand="1">
                     <data:login>'.$this->config['login'].'</data:login>
                     <data:password>'.$this->config['password'].'</data:password>
                  </data:AuthorizationHeader>
               </oper:getOperationHistory>
            </soap:Body>
         </soap:Envelope>';
        
        $ticket = $this->parseSingleRequest($this->call($request, 'https://tracking.russianpost.ru/rtm34', 'getOperationHistory', SOAP_1_2));
        
        if(!$html) {
            return $ticket;
        }
        
        return $this->renderHTML($ticket, $code);
    }
    
    private function parseSingleRequest($request)
    {
        if(strpos($request, 'Fault') !== false) {
            return false;
        }
        
        $simple = $request;
        $simple = preg_replace("/ns\d:/", '', $simple);
        $simple = preg_replace("/:ns\d/", '', $simple);
        $simple = preg_replace("/S:/", '', $simple);
        $simple = preg_replace("/:S/", '', $simple);
        $simple = preg_replace("/xmlns=\".*\"/", '', $simple);
        $simple = str_replace("<OperationHistoryData>", '<Body><getOperationHistoryResponse><OperationHistoryData>', $simple);
        
        try {
            $xml = @new SimpleXMLElement($simple);
        } catch(Exception $e) {
            return false;
        }
        
        $history = $xml->Body->getOperationHistoryResponse->OperationHistoryData;
        $result = array();
        
        foreach($history->historyRecord as $record) {
            $data = $this->parseOperationSingle($record);
            $result[] = $data;
        }
        
        return $result;
    }
    
    private function parseOperationSingle($record)
    {
        return array(
            'code' => (string)$record->ItemParameters->Barcode,
            'address' => array(
                'name' => (string)$record->AddressParameters->OperationAddress->Description,
                'index' => isset($record->AddressParameters->OperationAddress->Index) ? (string)$record->AddressParameters->OperationAddress->Index : false,
            ),
            'date' => strtotime((string)$record->OperationParameters->OperDate),
            'operation' => array(
                'name' => (string)$record->OperationParameters->OperType->Name,
                'attribute' => (string)$record->OperationParameters->OperAttr->Id != 0 ? (string)$record->OperationParameters->OperAttr->Name : false,
            ),
            'send' => array(
                'name' => isset($record->AddressParameters->DestinationAddress) ? (string)$record->AddressParameters->DestinationAddress->Description : false,
                'index' => isset($record->AddressParameters->DestinationAddress->Index) ? (string)$record->AddressParameters->DestinationAddress->Index : false,
            ),
            'weight' => isset($record->ItemParameters->Mass) ? ((int)$record->ItemParameters->Mass)/1000 : false,
            'payment' => (int)$record->FinanceParameters->Payment,
            'price' => (int)$record->FinanceParameters->Value,
        );
    }
    
    public function renderHTML($ticket, $code)
    {
        ob_start();
        include('./modules/russianpost/templates/template.php');
        $html = ob_get_contents();
        ob_end_clean();
        
        return $html;
    }
    
    function getTicketPackage($code)
    {
        $request = 
            '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:pos="http://fclient.russianpost.org/postserver" xmlns:fcl="http://fclient.russianpost.org">
             <soapenv:Header/>
             <soapenv:Body>
                <pos:ticketRequest>
                   <request>
                      <fcl:Item Barcode="'.$code.'"/>
                   </request>
                   <login>'.$this->config['login'].'</login>
                   <password>'.$this->config['password'].'</password>
                   <language>RUS</language>
                </pos:ticketRequest>
             </soapenv:Body>
           </soapenv:Envelope>';
        
        $this->call($request);
    }
    
    function call($request, $url, $action, $soap = SOAP_1_1)
    {
        return $this->client->__doRequest($request, $url, $action, $soap);
    }
    
}