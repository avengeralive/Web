<?php
namespace lib;

class Pikassa {
    const apiKey = "615cb31e-3da4-4abb-bfde-f07470a39e92";
    const secret = "fe5ffbb5d5cd4213bd101564a55ca32b";
    
    // const apiKey = "21eb0e42-6a6e-494a-8702-4a76dacb88b1";
    // const secret = "ee7897c9492d4806b2f70d5257b5107c";

    public function CreatePayment($data = array()){
        // if(empty($data)) $data = $_GET;

        $ch = curl_init("https://pikassa.io/merchant-api/api/v2/invoices");
        $id = $data['id'];
        $date = date("Y-m-d H:i:s.uP", strtotime("+1 days"));
        $description = "Оплата заказа от ".$data['name'];
        $payload = json_encode(array(
            // "externalId" => uniqid(),
            "externalId" => $data['id'],
            "amount" => 100,
            "currency" => "RUB",
            "description" => $description,
            "customerPhone" => "+".$data['phone'],
            "customerEmail" => $data['email'],
            "customData" => array("ids" => $data['id']),
            "successUrl" => "https://mysite.com/successUrl",
            "failUrl" => "https://mysite.com/failUrl",
            "deliveryMethod" => "URL",
            "expirationDate" => $date,
            "ofdData" => null,
            "preAuth" => false
            ), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

            $sign = base64_encode(md5($payload . self::secret, true));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type:application/json",
                "X-Api-Key:" . self::apiKey,
                "X-Sign:" . $sign
            ));

            $res = curl_exec($ch);
            curl_close($ch);
            $data = explode(PHP_EOL,$res);
            foreach ($data as $v) {
                $res = $v;
            }
            $res = json_decode($res,true);

            return $res;
    }

    public function CheackPaymentStatus($data = array()) {
        $post = (!empty($_POST)) ? $_POST : $_GET;
        if(empty($data)) $data['paymentUuid'] = $post['uuid'];
        $uuid = $data['paymentUuid'];
        $ch = curl_init("https://pikassa.io/merchant-api/api/v2/invoices/".$uuid);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type:application/json",
            "X-Api-Key:" . self::apiKey
        ));
        $data = curl_exec($ch);
        curl_close($ch); 
        $data = explode(PHP_EOL,$data);
        foreach ($data as $v) {
            $result = $v;
        }
    
        $r = json_decode($r,true);
        return $result;
    }

    function test() {
        $post = (!empty($_POST)) ? $_POST : $_GET;
        $uuid = $post['uuid'];

        $ch = curl_init("https://pikassa.io/merchant-api/api/v2/invoices/".$uuid);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type:application/json",
            "X-Api-Key:" . self::apiKey
        ));
        $data = curl_exec($ch);
        curl_close($ch); 
        $data = explode(PHP_EOL,$data);
        foreach ($data as $v) {
            $result = $v;
        }
    
        $r = json_decode($r,true);
        return $result;
       
    }
}
?>