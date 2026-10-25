<?php


class Pimpay
{

    private static $token = 'd21d15df-d2b6-42b5-b8aa-c61373823c57';
    private static $signature = '44b535da0e520511bff59b9741383845';


    public static function uploadOrders($barcodes)
    {

        $orders = [];

        $settings = Engine::getSettings();

        foreach ($barcodes as $barcode) {

            $post = RP::getOrderByBarcode($barcode);
            $base = Engine::getSavedOrderByBarcode($barcode);

            if ($post && $base) {

                $post = $post[0];

                $batch_name = $post['batch-name'];
                $batch = RP::getBatch($batch_name);

                $order = [
                    "postId" => $post['barcode'],
                    "shopExternalId" => $post['order-num'],
                    "paymentFromRecipient" => floatval($post['payment'] / 100.0),
                    "declaredOrderCost" => floatval($post['insr-value'] / 100.0),
                    "destinationAddress" => [
//                        "full" => "600035, Россия, Владимирская область, г. Владимир, ул. Мира, д. 7, кв. 77",
                        "zipcode" => $post['index-to'],
                        "city" => $post['place-to'],
                        "street" => $post['street-to'],
                        "building" => $post['index-to']
                    ],
                    "recipient" => [
                        "fio" => $post['recipient-name'],
//                        "phone" => "+79999999999",
//                        "email" => "user@example.com"
                    ],
                    "moneyRecipient" => "pimpay",
                    "f103" => [
                        "number" => $batch['list-number'],
                        "date" => $batch['list-number-date'],
//                        "contractPartyName" => "ООО &quot;Служба Почтовой Доставки&quot;",
//                        "contractNumber" => "№2584",
//                        "contractDate" => "18.10.2016 г."
                    ],
                    "claim" => [
//                        "uniformPimpayDeliveryStatus" => "delivered",
                        "returnUtilization" => in_array('NO_RETURN', $post['postmarks'])
                    ],

                ];

                $request = [
                    "russianPostOrders" => [$order]
                ];

                $response = json_decode(RP::sendPostRequest(
                    'https://api.pimpay.ru//eshop/v1_0/upsertRussianPostOrders',
                    json_encode($request),
                    [
                        'X-Pimpay-Eshop-Api-Token: '.$settings['pimpay_token'],
                        'X-Pimpay-Eshop-Api-Signature: '.$settings['pimpay_signature'],
                    ]
                ), true);

                file_put_contents('pimpay.log', date('Y-m-d d.m.Y H:i:s').PHP_EOL.RP::json_print($request).PHP_EOL.'---'.RP::json_print($response).PHP_EOL.PHP_EOL.PHP_EOL, FILE_APPEND);

                if (isset($response['data'])) foreach ($response['data'] as $data) {
                    $barcode = Engine::$db->real_escape_string($data['id']);
                    $status = $data['status'];
                    if ($status == 'error') $status .= ': '.$data['errorMessage'];
                    $status = Engine::$db->real_escape_string($status);
                    $qry = "update rp_orders set pimpay='$status' where barcode='$barcode'";
                    Engine::$db->query($qry);
                }


            }


        }


    }


}