<?php
namespace lib;

class Betapro {
    static $host    = '212.5.64.195';
    static $port    = '8084';
    static $login   = '201';
    static $pass    = 'test';
    static $id;
    static $phone;
    static $name;
    static $total;
    static $address;
    static $zip;

    public static function get() {
		
		$post = (!empty($_POST)) ? $_POST : $_GET;
		if (!empty($post) && !empty($post['ids']))
			return self::start($post['ids']);
		
	}

    public function start($id){
        $request = JBase::Get_Data('list18', '*', ['id' => $id]);
        $result = $request->fetch_assoc(); 
        if($result){
            self::$id       = $id;
            self::$phone    = $result['phone'];
            self::$name     = $result['name'];
            self::$total    = $result['total'];
            self::$address  = $result['region'].' '.$result['city'].' '.$result['address'].' '.$result['house'].' '.$result['flat'];
            self::$zip      = $result['postIndex'];

            $xml            = self::XMLconstructor($result);
            $answer         = (array)self::request($xml);
            $answer         = $answer[0];
            $answerApi      = [];

            if($result['answerApi'] != '' && $result['answerApi'] != '0'){
                $answerApi = json_decode($result['answerApi'],true);
                $answerApi[] = array(
                    'func' => 'Betapro',
                    'answer' => $answer
                );
            }else{
                $answerApi[] = array(
                    'func' => 'Betapro',
                    'answer' => $answer
                );
            }
            $answerApi = json_encode($answerApi,JSON_UNESCAPED_UNICODE);
            JBase::Query("UPDATE list18 SET `answerApi` = '$answerApi' WHERE `id` = '$id'");

            return $answer;
        }
    }

    public function XMLconstructor($order){
        $goods_names = json_decode($order['goods_names']);
        $betapro = [];
        $cnt = 0;
        $xml = '<request request_type="101" partner_id="'.self::$login.'" password="'.self::$pass.'">
        <doc doc_type="5" zdoc_id="'.self::$id.'" doc_txt="Тест задания на отгрузку клиентам">
        <order order_id="'.self::$id.'" delivery_type="1" zip="'.self::$zip.'" clnt_price="'.self::$total.'" clnt_phone="'.self::$phone.'" clnt_name="'.self::$name.'" post_addr="'.self::$address.'"/>';
        
        foreach ($goods_names as $key => $value) {
            $request = JBase::Get_Data('list22', '*', ['id' => $key]);
            $result = $request->fetch_assoc();
            $good_id = $result['betapro'];
            $price = $result['price'];
            $ordrow_id = self::$id*10+$cnt;
            $xml .= '<order_row ordrow_id="'.$ordrow_id.'" order_id="'.self::$id.'" good_id="'.$good_id.'" clnt_price="'.$price.'" price="'.$price.'"/>';
            $cnt++;
        }
        
        $xml .= '</doc></request>';
        return $xml;
    }

    private function request($request){
        define('CFG_REQUEST_POST',               1);
        define('CFG_REQUEST_HTTP',               'https://');
        define('CFG_REQUEST_HOST',               self::$host);
        define('CFG_REQUEST_PORT',               self::$port);
        define('CFG_REQUEST_URL',                '/wsrv');
        define('CFG_REQUEST_FULLURL',            CFG_REQUEST_HTTP . CFG_REQUEST_HOST . ':' . CFG_REQUEST_PORT . CFG_REQUEST_URL);
        define('CFG_REQUEST_TIMEOUT',            5);
        define('CFG_CONTENT_TYPE',               'text/xml');
        define('CFG_TEST_XMLBODY',               $request);
        $o_Curl = curl_init();

        curl_setopt($o_Curl, CURLOPT_URL,               CFG_REQUEST_FULLURL);
        curl_setopt($o_Curl, CURLOPT_POST,              CFG_REQUEST_POST);
        curl_setopt($o_Curl, CURLOPT_CONNECTTIMEOUT,    CFG_REQUEST_TIMEOUT);
        curl_setopt($o_Curl, CURLOPT_HTTPHEADER,        array(
              'Content-Type: ' . CFG_CONTENT_TYPE, 
              'Content-Length: ' . strlen(CFG_TEST_XMLBODY),
              'Connection: close'
            ));
        curl_setopt($o_Curl, CURLOPT_POSTFIELDS,        CFG_TEST_XMLBODY);
        curl_setopt($o_Curl, CURLOPT_HEADER,            0);
        curl_setopt($o_Curl, CURLOPT_RETURNTRANSFER,    1);
        curl_setopt($o_Curl, CURLOPT_SSL_VERIFYHOST,    0);
        curl_setopt($o_Curl, CURLOPT_SSL_VERIFYPEER,    0);
        $s_Response=curl_exec($o_Curl);
        curl_close($o_Curl);

        $object = @new \SimpleXMLElement($s_Response);

        if($object['state'] == 0){
            $answer = $object['state'];
            return $answer;
        }else{
            $answer = $object->error['msg'];
            return $answer;
        }
    }
}
?>