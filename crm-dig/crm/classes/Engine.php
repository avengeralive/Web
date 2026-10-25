<?php

class Engine
{

    /** @var mysqli */
    public static $db = null;

    public static $settings = [
        "subdomain" => "digital-shop",
        "key" => "BrwZQ7VjvttAjzLPV3lmwa23LtqRSbAB",
        "proxyUrl" => "http://digital-shop.su/crm/api.php",
        "proxyToken" => "12345",
    ];

    public static $image_folder = '/var/www/www-root/data/www/digital-shop.su/images/';

    const COURIER_ADDRESS = 'Объездное шоссе, вл1/2 квартал Западная Промзона, Балашиха, Московская область';


    public static function action_login($req)
    {
        $login = !empty($req['login']) ? $req['login'] : '';
        $password = !empty($req['password']) ? $req['password'] : '';

        $login = self::$db->real_escape_string($login);

        $user = self::$db->query("select * from users where login='$login'")->fetch_assoc();

        if ($user) if ($user['password'] == $password) {

            $_SESSION['user'] = $user;

        }
        else {

            unset($_SESSION['user']);

        }

        return 'index.php';

    }


    public static function action_logout($req)
    {

        unset($_SESSION['user']);
        session_destroy();
        return 'index.php';

    }


    public static function render_login($req)
    {

        $html = <<<html
<style>
form {
    width: 400px; margin: auto; text-align: center;
}
    label {
        display: inline-block;
        width: 150px;
        text-align: right;
        padding-right: 10px;
    }
    
    input {
        border: 1px solid gray;
        margin-bottom: 10px;
    }
</style>

<form action="" method="post">
    Вход в панель управления<br/><br/>
    <input type="hidden" name="action" value="login"/>
    <label>Пользователь: </label><input type="text" name="login"/><br/>
    <label>Пароль: </label><input type="password" name="password"/><br/>
    <input type="submit" value="Войти"/>
</form>

html;

        return $html;

    }


    public static function render_index($req)
    {

        $html = <<<html
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body p-0">

            </div>
        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function action_rp_create_batch($req)
    {

        $rp_account_id = intval($req['rp_account_id']);
        $date_shipment = (string)($req['date_shipment']);

        // Получаем авторизационный данные аккаунта Почты России для создаваемой пачки
        $account = self::$db->query("select * from rp_accounts where id='$rp_account_id'")->fetch_assoc();
        $data = json_decode($account['data'], true);

        $orders = [];

        $res = self::$db->query("select * from rp_orders where state=1 and rp_account_id='$rp_account_id' and date_shipment='$date_shipment' limit 500");

        while($row = $res->fetch_assoc()) { $orders[] = $row['delivery_id']; }
        $count = count($orders);

        $batch = RP::createBatch($date_shipment, $orders, $data['auth'], $data['user']);

        $batch_name = !empty($batch['batches'][0]['batch-name']) ? $batch['batches'][0]['batch-name'] : '';

        if ($batch_name) {

            $datetime_created = self::$db->real_escape_string(date('Y-m-d H:i:s'));

            // Сохраняем созданную партию в базу
            self::$db->query('insert into rp_batches (retail_account_id, rp_account_id, batch_name, batch_date, status, orders, datetime_created, state)'.
                "values ('$account[account]', '$rp_account_id', '$batch_name', '$date_shipment', 'Новая', '$count', '$datetime_created', 0)");
            $batch_id = self::$db->insert_id;

            // Проставляем статус у всех успешно обработанных заказов
            if (!empty($batch['result-ids'])) foreach ($batch['result-ids'] as $deliveryId) {

                self::$db->query("update rp_orders set state=2, batch_id='$batch_id' where delivery_id='$deliveryId'");

            }

            return "?section=rp_batch&id=".$batch_id;

        }
        else {

            $error = 'Ошибка создания партии';

            // Попробуем вытащить из ответа Почты сообщение об ошибке
            if (isset($batch['errors'][0]['error-description'])) $error = (string)$batch['errors'][0]['error-description'];

            $_SESSION['rp.create.batch.message'] = $error;

            return "?section=rp_shipment";

        }

    }


    public static function action_rp_checkin_batch($req)
    {

        $id = intval($req['id']);

        $batch = self::$db->query("select * from rp_batches where id='$id'")->fetch_assoc();
        $account = self::$db->query("select * from rp_accounts where id='$batch[rp_account_id]'")->fetch_assoc();
        $data = json_decode($account['data'], true);

        $result = RP::checkinBatch($batch['batch_name'], $data['auth'], $data['user'], ($account['useOnlineBalance'] == 1));

        // Если была ошибка - вытащим ошибку и сохраним для отображения
        if (isset($result['errors'][0]['error-description'])) {
            $_SESSION['rp.batch.error.message'] = strval($result['errors'][0]['error-description']);
        }
        else {

            self::$db->query("update rp_batches set state='1' where id='$id'");

        }

        return "?section=rp_batch&id=".$id;

    }


    public static function action_rp_finish_batch_courier($req)
    {

        $id = intval($req['id']);

        $batch = self::$db->query("select * from rp_batches where id='$id'")->fetch_assoc();
        if (!$batch) return '';

        $account = self::$db->query("select * from rp_accounts where id='$batch[rp_account_id]'")->fetch_assoc();
        $data = json_decode($account['data'], true);

        // Сначала найдём в списке адресов требуемый адрес
        $address_id = 0;
        $addresses = RP::courierFindAddresses('COURIER_CALL', $data['auth'], $data['user']);
        if ($addresses) foreach ($addresses as $address) {
            if ($address['address'] == self::COURIER_ADDRESS) {
                $address_id = $address['address-id'];
                break;
            }
        }
        if (!$address_id) {
            $_SESSION['rp.batch.error.message'] = 'Ошибка: в списке доступных адресов отсутствует адрес '.self::COURIER_ADDRESS;
            return "?section=rp_batch&id=".$id;
        }

        $post = RP::getBatch($batch['batch_name'], $data['auth'], $data['user']);

        $courier = [
            'address' => self::COURIER_ADDRESS,
            'address-id' => $address_id,
            'batch-name' => $batch['batch_name'],
            'contact-name' => 'Константин',
            'contact-phone' => '+79684599302',
            'country-to-code' => 1,
            'order-date' => $post['list-number-date'],
            'time-interval-id' => 2, // после 14:00
            'order-comment' => 'около 500 заказов',
            'shipments-count' => $post['shipment-count'],
            'transport-pass' => false,
            'courier-pass' => false,
        ];

        $result = RP::courierOrder($courier, $data['auth'], $data['user']);

        if (!isset($result['order-number'])) {
            // Произошла ошибка, вытащим сообщение об ошибки из ответа ПР
            $error = 'Ошибка вызова курьера';

            // Попробуем вытащить из ответа Почты сообщение об ошибке
            if (isset($result['errors'][0]['error-description'])) $error = strval($result['errors'][0]['error-description']);

            $_SESSION['rp.batch.error.message'] = $error;
        }
        else {

            self::$db->query("update rp_batches set state=2 where id='$id'");

        }

        return "?section=rp_batch&id=".$id;

    }


    public static function action_rp_finish_batch_no_courier($req)
    {

        $id = intval($req['id']);

        self::$db->query("update rp_batches set state=3 where id='$id'");

        return "?section=rp_batch&id=".$id;


    }


    public static function action_rp_batch_error_test($req)
    {

        $id = intval($req['id']);

        $_SESSION['rp.batch.error.message'] = 'Тест отображения ошибки';

        return "?section=rp_batch&id=".$id;

    }


    public static function action_rp_print_f103($req)
    {

        $id = intval($req['id']);

        $batch = self::$db->query("select * from rp_batches where id='$id'")->fetch_assoc();
        $account = self::$db->query("select * from rp_accounts where id='$batch[rp_account_id]'")->fetch_assoc();
        $data = json_decode($account['data'], true);

        $pdf = RP::getF103($batch['batch_name'], $data['auth'], $data['user']);

        // Если требуется сделать чекин - сделаем его и снова запросим ф103
        if (strpos($pdf, 'checkin')) {
            RP::checkinBatch($batch['batch_name'], $data['auth'], $data['user'], ($account['useOnlineBalance'] == 1));
            $pdf = RP::getF103($batch['batch_name'], $data['auth'], $data['user']);
        }

        // Если в полученных данных нет строки 'PDF-', это значит ф103 не сформировалась, попробуем вытащить данные из базы
        if (!strpos($pdf, 'PDF-')) {
            $pdf = $batch['f103'];
        }

        // Если к данному моменту на выходе нет валидного pdf - выдадим сообщение об ошибке
        if (!strpos($pdf, 'PDF-')) {
            header('HTTP/1.1 404 Not Found');
            echo "Отсутствуют данные для печати ф103";
            exit;
        }

        // Сохраним .pdf формы 102 на случай, если аккаунт Почты будет заблокирован - но возникнет необходимость её распечатать
        $f103 = self::$db->real_escape_string($pdf);
        self::$db->query("update rp_batches set status='ф103 распечатаны', f103='$f103' where id='$id'");

        header('Content-Description: File Transfer');
        header('Content-Disposition: attachment; filename="f103_'.$batch['batch_name'].'.pdf"');
        header('Content-Type: application/pdf');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        echo $pdf;
        exit;

    }


    public static function render_rp_shipment($req)
    {

        if (isset($_SESSION['rp.create.batch.message'])) {
            $message = $_SESSION['rp.create.batch.message'];
            $error_div = "<p style='color: red;'>$message</p>";
            unset($_SESSION['rp.create.batch.message']);
        }
        else $error_div = '';

        $tbody = '';

        $query = "select rp_account_id, date_shipment, count(*) as cnt from rp_orders where state=1 group by rp_account_id, date_shipment order by date_shipment, rp_account_id";

        $res = self::$db->query($query);

        while($row = $res->fetch_assoc()) {

            $acc = self::$db->query("select * from rp_accounts where id='$row[rp_account_id]'")->fetch_assoc();

            $cod_receiver = RP::$cod_receivers[$acc['cod_receiver']];
            $account = $acc['account'];

            $tbody .= <<<html
<tr>
    <td>$account</td>
    <td>$cod_receiver</td>
    <td>$row[date_shipment]</td>
    <td>$row[cnt]</td>
    <td><form>
        <input type="hidden" name="action" value="rp_create_batch"/>
        <input type="hidden" name="rp_account_id" value="$row[rp_account_id]"/>
        <input type="hidden" name="date_shipment" value="$row[date_shipment]"/>
        <button class="">Сформировать партию...</button>
        </form>
        </td>
</tr>
html;


        }


        $html = <<<html

    <h3>Почта России - Отгрузка</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                $error_div
            
                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>
                            <th>Аккаунт RetailCRM</th>
                            <th>Получатель наложенного платежа</th>
                            <th>Дата отгрузки</th>
                            <th>Количество подготовленных заказов</th>
                            <th><br/></th>
                        </tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>
            
            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function render_rp_orders($req)
    {

        $html = <<<html

    <h3>Почта России - Заказы</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function render_rp_batches($req)
    {

        $batches = self::$db->query('select * from rp_batches where archived=0 order by id desc limit 20')->fetch_all(MYSQLI_ASSOC);

        $tbody = '';

        foreach ($batches as $batch) {
            $number = $batch['batch_name'];
            $date = $batch['batch_date'];
            $state = RP::$batchStates[intval($batch['state'])];
            $retail = $batch['retail_account_id'];
            $orders = $batch['orders'];

            $tbody .= <<<html
<tr>
    <td>$number</td>
    <td>$date</td>
    <td>$state</td>
    <td>$retail</td>
    <td>$batch[status]</td>
    <td>$orders</td>
    <td><a href="?section=rp_batch&id=$batch[id]">Детали...</a></td>
</tr>
html;

        }

        $html = <<<html

    <h3>Почта России - Партии</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>
                            <th>Номер партии</th>
                            <th>Дата партии</th>
                            <th>Статус партии</th>
                            <th>Аккаунт RetailCRM</th>
                            <th>Статус ф103</th>
                            <th>Количество заказов</th>
                        </tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>
            
            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function render_rp_batch($req)
    {

        if (isset($_SESSION['rp.batch.error.message'])) {
            $message = $_SESSION['rp.batch.error.message'];
            $div_error = "<p style='color: red;'>$message</p>";
            unset($_SESSION['rp.batch.error.message']);
        }
        else $div_error = '';

        $id = intval($req['id']);

        $batch = self::$db->query("select * from rp_batches where id='$id'")->fetch_assoc();
        if (!$batch) return '';

        $account = self::$db->query("select * from rp_accounts where id='$batch[rp_account_id]'")->fetch_assoc();
        $data = json_decode($account['data'], true);

        $post = RP::getBatch($batch['batch_name'], $data['auth'], $data['user']);

        $orders = RP::getBatchOrders($batch['batch_name'], $data['auth'], $data['user']);

        $tbody = '';
        $num = 0;
        foreach ($orders as $order)
        {
            $num++;
            $order_number = $order['order-num'];
            $barcode = $order['barcode'];
            $mail_type = empty(RP::$tariffs[$order['mail-type']]) ? $order['mail-type'] : RP::$tariffs[$order['mail-type']];
            $mass = $order['mass'];
            $ins = $order['insr-value'] / 100.0;
            $cod = $order['payment'] / 100.0;


            $tbody .= <<<html
    <tr>
        <td>$num</td>
        <td>$order_number</td>
        <td>$barcode</td>
        <td>$mail_type</td>
        <td>$mass</td>
        <td>$ins</td>
        <td>$cod</td>
    </tr>
html;

        }

        $batch_status_rp = $post['batch-status'];
        $batch_status_rp_date = $post['batch-status-date'];
        $f103_number = isset($post['list-number']) ? $post['list-number'] : '-';
        $f103_date = $post['list-number-date'];
        $shipment_count = $post['shipment-count'];
        $batch_status = RP::$batchStates[intval($batch['state'])];

        switch ($batch['state']) {
            case RP::BATCH_NEW:
                $actions = <<<html
                <form>
                    <input type="hidden" name="action" value="rp_checkin_batch"/>
                    <input type="hidden" name="id" value="$id"/>
                    <button>Финализировать партию</button>
                </form>
html;

                break;

            case RP::BATCH_CHECKED:
                $actions = <<<html
                <form style="display: inline-block">
                    <input type="hidden" name="action" value="rp_finish_batch_courier"/>
                    <input type="hidden" name="id" value="$id"/>
                    <button>Завершить с вызовом курьера</button>
                </form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <form style="display: inline-block">
                    <input type="hidden" name="action" value="rp_finish_batch_no_courier"/>
                    <input type="hidden" name="id" value="$id"/>
                    <button>Завершить без вызова курьера</button>
                </form>
html;
                break;

            case RP::BATCH_COURIER:
            case RP::BATCH_NO_COURIER:
            $actions = <<<html
                <form target="_blank">
                    <input type="hidden" name="action" value="rp_print_f103"/>
                    <input type="hidden" name="id" value="$id"/>
                    <button>Напечатать ф103</button>
                </form>
html;
            break;

            default:
                $actions = '';

        }

        $html = <<<html

    <h3>Почта России - <a href="?section=rp_batches">Партии</a> - Партия $batch[batch_name]</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                $div_error
            
            
                <p><strong>Аккаунт RetailCRM: </strong>$batch[retail_account_id]</p>
                <p><strong>Статус партии: </strong>$batch_status</p>
                <p><strong>Количество заказов: </strong>$shipment_count</p>
                <p><strong>Статус Почты России: </strong>$batch_status_rp</p>
                <p><strong>Дата статуса Почты России: </strong>$batch_status_rp_date</p>
                <p><strong>Номер ф103: </strong>$f103_number</p>
                <p><strong>Дата ф103: </strong>$f103_date</p>
                
                $actions

            </div>
            <hr/>
            <h4>Заказы в партии</h4>
            <div class="table-responsive">
                <table class="table table-hover" id="table_schedule">
                    <thead>
                    <tr>
                        <th>№ п/п</th>
                        <th>Номер заказа</th>
                        <th>ШПИ</th>
                        <th>Вид отправления</th>
                        <th>Вес</th>
                        <th>Оценочная стоимость</th>
                        <th>Наложенный платеж</th>
                    </tr>
                    </thead>
                    <tbody>
                    $tbody
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function action_rp_account_update($req)
    {

        $id = intval($req['id']);

        $parcel_types = [];
        if (!empty($req['parcel_types'])) foreach ($req['parcel_types'] as $type) $parcel_types[] = $type;
        $parcel_types = self::$db->real_escape_string(','.implode(',', $parcel_types).',');

        $data = [
            'auth' => !empty($req['auth']) ? $req['auth'] : '',
            'user' => !empty($req['user']) ? $req['user'] : '',
            'sender' => !empty($req['sender']) ? $req['sender'] : '',
            'ops' => !empty($req['ops']) ? $req['ops'] : '',
            'from' => !empty($req['from']) ? $req['from'] : '',
            'espp' => !empty($req['espp']) ? $req['espp'] : '',
            'client' => !empty($req['client']) ? $req['client'] : '',
            'bank' => !empty($req['bank']) ? $req['bank'] : '',
            'inn' => !empty($req['inn']) ? $req['inn'] : '',
            'acc' => !empty($req['acc']) ? $req['acc'] : '',
            'kor' => !empty($req['kor']) ? $req['kor'] : '',
            'bik' => !empty($req['bik']) ? $req['bik'] : '',
            'processing' => !empty($req['processing']) ? $req['processing'] : '',
        ];
        $data = self::$db->real_escape_string(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $useOnline = intval(!empty($req['online']) ? $req['online'] : 0);
        $noReturn = intval(!empty($req['noreturn']) ? $req['noreturn'] : 0);

        if ($id == 0) {
            // Создание нового аккаунта
            $account = self::$db->real_escape_string($req['account']);
            $cod_receiver = intval($req['cod_receiver']);
            self::$db->query("insert into rp_accounts (account, cod_receiver, parcel_types, data, useOnlineBalance, noReturnSign) values ('$account', '$cod_receiver', '$parcel_types', '$data', '$useOnline', '$noReturn')");
            $id = self::$db->insert_id;
        }
        else {
            // Изменение существующего
            self::$db->query("update rp_accounts set parcel_types='$parcel_types', data='$data', useOnlineBalance='$useOnline', noReturnSign='$noReturn' where id='$id'");
        }

//        print_r($req); exit;

        return '?section=rp_account&id='.$id;

    }


    public static function render_rp_account($req)
    {

        $id = intval($req['id']);

        if ($id == 0) {
            // Создаётся новый аккаунт
            $account = [
                'account' => $req['account'],
                'cod_receiver' => $req['cod_receiver'],
                'parcel_types' => '',
                'data' => ''
            ];
        }
        else {
            // Редактируется существующий аккаунт
            $account = self::$db->query("select * from rp_accounts where id='$id'")->fetch_assoc();
            if (!$account) return '';
        }

        // Соберем все уже активные виды отправлений из других записей с тем же аккаунтом и тем же получателем н/п
        $other_types = [];
        $accs = self::$db->query("select * from rp_accounts where account='$account[account]' and cod_receiver='$account[cod_receiver]' and id<>'$id'")->fetch_all(MYSQLI_ASSOC);
        foreach ($accs as $acc) $other_types = array_merge($other_types, array_filter(explode(',', $acc['parcel_types'])));

        $cod_receiver = RP::$cod_receivers[$account['cod_receiver']];

        $parcel_types = '';
        $types = array_filter(explode(',', $account['parcel_types']));
        foreach (RP::$tariffs as $key => $value) {
            $checked = in_array($key, $types) ? ' checked' : '';
            $disabled = in_array($key, $other_types) ? ' disabled' : '';
            $parcel_types .= "<div class='option'><input type='checkbox' name='parcel_types[]' value='$key' $checked $disabled/><span> $value</span><br/></div>\n";
        }

        $data = json_decode($account['data'], true);

        $account_id = ($id == 0) ? 'Новый' :  $id;

        $client = htmlentities($data['client']);
        $bank = htmlentities($data['bank']);
        $sender = htmlentities($data['sender']);
        $from = htmlentities($data['from']);
        if (empty($data['processing'])) $data['processing'] = '';

        $onlineChecked = ($account['useOnlineBalance'] == 1) ? ' checked' : '';
        $noreturn1 = ($account['noReturnSign'] == 1) ? ' checked': '';
        $noreturn2 = ($account['noReturnSign'] == 2) ? ' checked': '';

        $html = <<<html

<style>
    label {display: inline-block; width: 300px; text-align: right; vertical-align: top; padding-right: 5px;}
    input[type=text] {width: 500px;}
</style>

<h3>Почта России - <a href="?section=rp_accounts">Аккаунты</a> - Аккаунт $account_id</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
                <p><label>Аккаунт RetailCRM: </label>$account[account]</p>
                <p><label>Получатель н/п: </label>$cod_receiver</p>
                
                <form class="form" method="post">
                    <input type="hidden" name="action" value="rp_account_update"/>
                    <input type="hidden" name="id" value="$id"/>
                    <input type="hidden" name="account" value="$account[account]"/>
                    <input type="hidden" name="cod_receiver" value="$account[cod_receiver]"/>
                    <label>Виды отправлений: </label>
                    <div style="border: 0 solid lightgrey; width: 500px; display: inline-block;">
                        $parcel_types
                    </div><br/><br/>
                    <label>Токен авторизации: </label><input type="text" name="auth" value="$data[auth]"/><br/>
                    <label>Ключ авторизации: </label><input type="text" name="user" value="$data[user]" /><br/>
                    <label>Отправитель: </label><input type="text" name="sender" value="$sender" /><br/>
                    <label>Адрес отправителя: </label><input type="text" name="from" value="$from" /><br/>
                    <label>ОПС сдачи отправления: </label><input type="text" name="ops" value="$data[ops]" /><br/>
                    <label>ЕСПП код: </label><input type="text" name="espp" value="$data[espp]" /><br/>
                    <label>Клиент: </label><input type="text" name="client" value="$client" /><br/>
                    <label>Наименование банка: </label><input type="text" name="bank" value="$bank" /><br/>
                    <label>ИНН банка: </label><input type="text" name="inn" value="$data[inn]" /><br/>
                    <label>Счет: </label><input type="text" name="acc" value="$data[acc]" /><br/>
                    <label>Кор. счет: </label><input type="text" name="kor" value="$data[kor]" /><br/>
                    <label>БИК: </label><input type="text" name="bik" value="$data[bik]" /><br/>
                    <label>Индекс проц. центра: </label><input type="text" name="processing" value="$data[processing]" /><br/>
                    <label>Онлайн-баланс: </label><input type="checkbox" name="online" value="1" $onlineChecked/><br/>
                    <label>Надпись о невозврате: </label><input type="radio" name="noreturn" value="1" $noreturn1> Ярко<br/>
                    <label>&nbsp;</label><input type="radio" name="noreturn" value="2" $noreturn2> Тускло<br/>
                    <br/>
                    <button class="button btn-success">Сохранить изменения</button>
                
                </form>
                
            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function render_rp_accounts($req)
    {

        $condition = ($_SESSION['user'] == 'developer') ? '' : 'where active=1';

        $accounts = self::$db->query("select * from rp_accounts $condition order by id")->fetch_all(MYSQLI_ASSOC);

        $tbody = '';

        foreach ($accounts as $account) {

            $types = implode(', ', array_map(
                                    function($val) { return empty(RP::$tariffs[$val]) ? '-' : RP::$tariffs[$val]; },
                                    array_filter(explode(',', $account['parcel_types']))
                                    ));
            $cod_receiver_code = $account['cod_receiver'];
            $cod_receiver = RP::$cod_receivers[$cod_receiver_code];
            $espp = json_decode($account['data'], true);

            $tbody .= <<<html
<tr>
    <td>$account[id]</td>
    <td>$account[account]</td>
    <td>$espp[sender]</td>
    <td>$cod_receiver ($cod_receiver_code)</td>
    <td>$types</td>
    <td><a href="?section=rp_account&id=$account[id]">Детали...</a></td>
</tr>
html;

        }

        $html = <<<html

    <h3>Почта России - Аккаунты</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Аккаунт в RetailCRM</th>
                            <th>Отправитель</th>
                            <th>Получатель н/п</th>
                            <th>Виды отправлений</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>
                <br/>
<!--                <form class="form" method="post" action="?section=rp_account&id=0">-->
<!--                    Добавить новый аккаунт:<br/>-->
<!--                    Аккаунт в RetailCRM:-->
<!--                    <select name="account">-->
<!--                        <option value="ava24">ava-med24</option>-->
<!--                        <option value="digital">digital-shop</option>-->
<!--                    </select>-->
<!--                    Получатель н/п:-->
<!--                    <select name="cod_receiver">-->
<!--                        <option value="1">PIMPAY</option>-->
<!--                        <option value="2">Mobi деньги</option>-->
<!--                    </select>-->
<!--                    <input type="submit" value="Добавить"/>-->
<!--                </form>-->
            
            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function action_cod_file_clear($req)
    {

        self::$db->query('delete from cod_file');

        $_SESSION['cod_file_message'] = '<p style="color: green;">Файл платежей очищен</p>';

        return '?section=cod_file';

    }


    // Действие загрузки нового файла платежей в систему
    public static function action_cod_file_upload($req)
    {

        $fin = $_FILES['cod']['tmp_name'];

        if (is_uploaded_file($fin)) {

            $file = PhpOffice\PhpSpreadsheet\IOFactory::load($fin);

            $countOfSheet = $file->getSheetCount();
            $sheet = $file->getSheet($countOfSheet - 1);

            $highestRow = $sheet->getHighestRow();

            self::$db->query('begin');
            self::$db->query('delete from cod_file');

            for ($row = 2; $row <=$highestRow; $row++) {

                // Данные из Эксель
                $sum = floatval(trim($sheet->getCellByColumnAndRow(1, $row)->getCalculatedValue()));
                $barcode = trim($sheet->getCellByColumnAndRow(3, $row)->getCalculatedValue());
//                $date = trim($sheet->getCellByColumnAndRow(4, $row)->getCalculatedValue());
                $date_str = trim($sheet->getCellByColumnAndRow(4, $row)->getFormattedValue());

                if ($barcode == '') continue; // Пропускаем строки с незаполненным штрихкодом

                // Попробуем найти в базе заказ с данным штрихкодом
                $order = self::$db->query("select * from cod where barcode='$barcode'")->fetch_assoc();
                if ($order) {

                    // Заказ нашли, проверим на соответствие суммы
                    $current = floatval($order['sum_payed']);
                    $cod = floatval($order['cod']);
                    if ($cod == $current+$sum) {
                        $status = 0;
                        $comment = '';
                    }
                    else {
                        $status = 2;
                        $comment = 'общая сумма оплат по заказу не совпадает с наложенным платежом';
                    }
                    $order_number = $order['number'];

                }
                else {
                    $status = 1;
                    $comment = 'Штрихкод не найден';
                    $order_number = '';
                }

//                $comment = self::$db->real_escape_string("'$barcode', '$sum', '$date', '$date_str'");
//                echo "$barcode, $sum, $date\n<br/>";

                $date = date('Y-m-d', strtotime($date_str));
                self::$db->query("insert into cod_file (barcode, order_number, payment_date, payment_sum, status, comment) values ('$barcode', '$order_number', '$date', $sum, $status, '$comment')");

            }

            self::$db->query('commit');

            $message = '<p style="color: green">Файл платежей загружен</p>';


        }
        else $message = '<p style="color: red">Не получилось открыть загруженный файл</p>';

        $_SESSION['cod_file_message'] = $message;

        return '?section=cod_file';


    }


    // Действие разнесения платежей из текущего файла платежей и его очистка
    public static function action_cod_file_process($req)
    {

        self::$db->query('begin');

        $res = self::$db->query("select * from cod_file order by id");

        while($row = $res->fetch_assoc()) {

            $barcode = $row['barcode'];

            $order = self::$db->query("select * from cod where barcode='$barcode'")->fetch_assoc();
            if ($order) {

                // Нашли заказ в базе - установим ему статус "Оплачен" и разнесем поступившую оплату
                self::$db->query("insert into cod_payments (order_id, date_payment, sum_payment) values ('$order[id]', '$row[payment_date]', '$row[payment_sum]')");
                $sum_payed = floatval($order['sum_payed']) + $row['payment_sum'];
                $comment = self::$db->real_escape_string(($sum_payed != $order['cod']) ? 'Сумма оплаты не совпадает с н/п' : '');
                self::$db->query("update cod set status=2, date_payed='$row[payment_date]', sum_payed=$sum_payed, comment='$comment' where id='$order[id]'");

            }

        }

        self::$db->query('delete from cod_file');

        self::$db->query('commit');

        $_SESSION['cod_file_message'] = '<p style="color: green;">Файл платежей разнесен по заказам</p>';

        return '?section=cod_file';

    }


    // Действие выгрузки в эксель текущего файла платежей для отчета
    public static function action_cod_file_download($req)
    {

        $errorOnly = intval(!empty($req['error_only']) ? $req['error_only'] : 0);

        $file = new PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $file->setActiveSheetIndex(0);

        // Создаем заголовки столбцов
        $sheet->setCellValueByColumnAndRow(1, 1, 'Штрихкод');
        $sheet->setCellValueByColumnAndRow(2, 1, 'Номер заказа');
        $sheet->setCellValueByColumnAndRow(3, 1, 'Дата оплаты');
        $sheet->setCellValueByColumnAndRow(4, 1, 'Сумма оплаты');
        $sheet->setCellValueByColumnAndRow(5, 1, 'Статус');
        $sheet->setCellValueByColumnAndRow(6, 1, 'Комментарий');

        $row_num = 1;
        $res = self::$db->query("select * from cod_file order by id");

        while($row = $res->fetch_assoc()) {

            $row_num++;

            $sheet->setCellValueExplicitByColumnAndRow(1, $row_num, $row['barcode'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(2, $row_num, $row['order_number'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(3, $row_num, $row['payment_date'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(4, $row_num, $row['payment_sum'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow(5, $row_num, $row['status'] = 0 ? 'ОК' : 'Ошибка', PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(6, $row_num, $row['comment'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

        }


        $writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, 'Xls');

        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false); // required for certain browsers
        header("Content-Type: application/vnd.ms-excel"); // I always use this
        header("Content-Disposition: attachment; filename=Платежи.xls");
        $writer->save('php://output');
        exit;


    }


    // Действие выгрузки в эксель текущего файла платежей для отчета
    public static function action_cod_orders_excel($req)
    {

        $errorOnly = intval(!empty($req['error_only']) ? $req['error_only'] : 0);


        $file = new PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $file->setActiveSheetIndex(0);

        // Создаем заголовки столбцов
        $sheet->setCellValueByColumnAndRow(1, 1, 'Штрихкод');
        $sheet->setCellValueByColumnAndRow(2, 1, 'Номер заказа');
        $sheet->setCellValueByColumnAndRow(3, 1, 'Дата оплаты');
        $sheet->setCellValueByColumnAndRow(4, 1, 'Сумма оплаты');
        $sheet->setCellValueByColumnAndRow(5, 1, 'Статус');
        $sheet->setCellValueByColumnAndRow(6, 1, 'Комментарий');

        $row_num = 1;
        $res = self::$db->query("select * from cod_file order by id");

        while($row = $res->fetch_assoc()) {

            if ($errorOnly) if ($row['status'] == 0) continue; // Пропускаем успешный строки, если такой фильтр установлен

            $row_num++;

            $sheet->setCellValueExplicitByColumnAndRow(1, $row_num, $row['barcode'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(2, $row_num, $row['order_number'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(3, $row_num, $row['payment_date'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(4, $row_num, $row['payment_sum'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
            $sheet->setCellValueExplicitByColumnAndRow(5, $row_num, $row['status'] = 0 ? 'ОК' : 'Ошибка', PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicitByColumnAndRow(6, $row_num, $row['comment'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

        }


        $writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, 'Xls');

        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false); // required for certain browsers
        header("Content-Type: application/vnd.ms-excel"); // I always use this
        header("Content-Disposition: attachment; filename=Платежи.xls");
        $writer->save('php://output');
        exit;


    }


    public static function render_cod_file($req)
    {

        if (isset($_SESSION['cod_file_message'])) {
            $message = $_SESSION['cod_file_message'];
            unset($_SESSION['cod_file_message']);
        }
        else $message = '';


        $rows = self::$db->query("select * from cod_file order by id")->fetch_all(MYSQLI_ASSOC);


        // Если присутствует текущий загруженный файл платежей
        if ($rows) {

            $errorOnly = intval(!empty($req['error_only']) ? $req['error_only'] : 0);
            $errorOnlyChecked = ($errorOnly == 1) ? ' checked' : '';

            $tbody = '';
            foreach ($rows as $row) {

                if ($errorOnly) if ($row['status'] == 0) continue; // Пропускаем успешный строки, если такой фильтр установлен

                switch ($row['status']) {
                  case 1:
                    case 2:
                        $style= 'style="color: red;"';
                        break;
                    default: $style= 'style=""';
                }

                $payment_date = date('d.m.Y', strtotime($row['payment_date']));

                $tbody .= <<<html
<tr $style>
    <td>$row[barcode]</td>
    <td>$row[order_number]</td>
    <td>$payment_date</td>
    <td>$row[payment_sum]</td>
    <td>$row[comment]</td>
</tr>
html;

            }

            $html = <<<html

                <form class="form" method="post" target="_blank" style="float: right;">
                    <input type="hidden" name="action" value="cod_file_download"/>
                    <input type="hidden" name="error_only" value="$errorOnly"/>
                    <input type="submit" value="Выгрузить в excel"/>
                </form>

                <form class="form" method="get">
                    <input type="hidden" name="section" value="cod_file"/>
                    <input type="checkbox" name="error_only" value="1" $errorOnlyChecked/> Отображать только ошибки &nbsp;&nbsp;&nbsp;
                    <input type="submit" value="Применить"/>
                </form>


                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>
                            <th>Штрихкод</th>
                            <th>Номер заказа</th>
                            <th>Дата оплаты</th>
                            <th>Сумма оплаты</th>
                            <th>Комментарий</th>
                      </tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>
                <br/>

                <form class="forms" method="post" style="float: right">
                    <input type="hidden" name="action" value="cod_file_clear"/>
                    <button class="btn btn-danger">Очистить без обработки</button>
                </form>

                <form class="forms" method="post">
                    <input type="hidden" name="action" value="cod_file_process"/>
                    <button class="btn btn-success">Обработать платежи и очистить</button>
                </form>


html;

        }
        else {

            $html = <<<html

                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    Загрузить файл платежей из excel
                    <input type="hidden" name="action" value="cod_file_upload"/>
                    <input type="file" name="cod"/>
                    <input type="submit" value="Загрузить"/>
                </form>

html;



        }


        $html = <<<html

    <h3>Наложенный платеж - файл платежей</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
            $message
            
            $html
            
           
            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }

    private static $codOrderStates = [
        0 => 'Отгружен',
        1 => 'Доставлен, ожидается оплата',
        2 => 'Оплачен',
    ];

    public static function action_cod_orders_clear_payments($req)
    {

        $number = strval(!empty($req['number']) ? $req['number'] : '');
        $barcode = strval(!empty($req['barcode']) ? $req['barcode'] : '');
        $date_shipped_from = strval(!empty($req['date_shipped_from']) ? $req['date_shipped_from'] : '');
        $date_shipped_to = strval(!empty($req['date_shipped_to']) ? $req['date_shipped_to'] : '');
        $date_delivered_from = strval(!empty($req['date_delivered_from']) ? $req['date_delivered_from'] : '');
        $date_delivered_to = strval(!empty($req['date_delivered_to']) ? $req['date_delivered_to'] : '');
        $date_payed_from = strval(!empty($req['date_payed_from']) ? $req['date_payed_from'] : '');
        $date_payed_to = strval(!empty($req['date_payed_to']) ? $req['date_payed_to'] : '');
        $shipped = intval(!empty($req['shipped']) ? $req['shipped'] : 0);
        $delivered = intval(!empty($req['delivered']) ? $req['delivered'] : 0);
        $payed = intval(!empty($req['payed']) ? $req['payed'] : 0);

        $condition = ' status=2 ';
        if ($number) $condition .= " and number='".self::$db->real_escape_string($number)."'";
        if ($barcode) $condition .= " and barcode='".self::$db->real_escape_string($barcode)."'";
        if ($date_shipped_from) $condition .= " and date_shipped>='".self::$db->real_escape_string($date_shipped_from)."'";
        if ($date_shipped_to) $condition .= " and date_shipped<='".self::$db->real_escape_string($date_shipped_to)."'";
        if ($date_delivered_from) $condition .= " and date_delivered>='".self::$db->real_escape_string($date_delivered_from)."'";
        if ($date_delivered_to) $condition .= " and date_delivered<='".self::$db->real_escape_string($date_delivered_to)."'";
        if ($date_payed_from) $condition .= " and date_payed>='".self::$db->real_escape_string($date_payed_from)."'";
        if ($date_payed_to) $condition .= " and date_payed<='".self::$db->real_escape_string($date_payed_to)."'";
        $states = [-1];
        if ($shipped == 1) $states[] = 0;
        if ($delivered == 1) $states[] = 1;
        if ($payed == 1) $states[] = 2;
        if ($states) $condition .= ' and status in ('.implode(',', $states).')';

        self::$db->query("update cod set status=1, sum_payed=null, date_payed=null where $condition");

        $_SESSION['cod_orders_message'] = '<p style="color: green;">Данные о платежах очищены</p>';

        return "index.php?section=cod_orders&number=$number&barcode=$barcode&date_shipped_from=$date_shipped_from&date_shipped_to=$date_shipped_to&date_delivered_from=$date_delivered_from&date_delivered_to=$date_delivered_to&date_payed_from=$date_payed_from&date_payed_to=$date_payed_to&shipped=$shipped&delivered=$delivered&payed=$payed";


    }


    public static function render_cod_orders($req)
    {

        $number = strval(!empty($req['number']) ? $req['number'] : '');
        $barcode = strval(!empty($req['barcode']) ? $req['barcode'] : '');
        $date_shipped_from = strval(!empty($req['date_shipped_from']) ? $req['date_shipped_from'] : '');
        $date_shipped_to = strval(!empty($req['date_shipped_to']) ? $req['date_shipped_to'] : '');
        $date_delivered_from = strval(!empty($req['date_delivered_from']) ? $req['date_delivered_from'] : '');
        $date_delivered_to = strval(!empty($req['date_delivered_to']) ? $req['date_delivered_to'] : '');
        $date_payed_from = strval(!empty($req['date_payed_from']) ? $req['date_payed_from'] : '');
        $date_payed_to = strval(!empty($req['date_payed_to']) ? $req['date_payed_to'] : '');
        $shipped = intval(!empty($req['shipped']) ? $req['shipped'] : 0);
        $delivered = intval(!empty($req['delivered']) ? $req['delivered'] : 0);
        $payed = intval(!empty($req['payed']) ? $req['payed'] : 0);

        $condition = 'where true';
        if ($number) $condition .= " and number='".self::$db->real_escape_string($number)."'";
        if ($barcode) $condition .= " and barcode='".self::$db->real_escape_string($barcode)."'";
        if ($date_shipped_from) $condition .= " and date_shipped>='".self::$db->real_escape_string($date_shipped_from)."'";
        if ($date_shipped_to) $condition .= " and date_shipped<='".self::$db->real_escape_string($date_shipped_to)."'";
        if ($date_delivered_from) $condition .= " and date_delivered>='".self::$db->real_escape_string($date_delivered_from)."'";
        if ($date_delivered_to) $condition .= " and date_delivered<='".self::$db->real_escape_string($date_delivered_to)."'";
        if ($date_payed_from) $condition .= " and date_payed>='".self::$db->real_escape_string($date_payed_from)."'";
        if ($date_payed_to) $condition .= " and date_payed<='".self::$db->real_escape_string($date_payed_to)."'";
        $states = [-1];
        if ($shipped == 1) $states[] = 0;
        if ($delivered == 1) $states[] = 1;
        if ($payed == 1) $states[] = 2;
        if ($states) $condition .= ' and status in ('.implode(',', $states).')';

        $excel = strval(!empty($req['excel']) ? $req['excel'] : '');

        if ($excel == 'yes') {

            $file = new PhpOffice\PhpSpreadsheet\Spreadsheet();
            $sheet = $file->setActiveSheetIndex(0);

            // Создаем заголовки столбцов
            $sheet->setCellValueByColumnAndRow(1, 1, 'Штрихкод');
            $sheet->setCellValueByColumnAndRow(2, 1, 'Номер заказа');
            $sheet->setCellValueByColumnAndRow(3, 1, 'Сумма н/п');
            $sheet->setCellValueByColumnAndRow(4, 1, 'Бланк н/п');
            $sheet->setCellValueByColumnAndRow(5, 1, 'Статус');
            $sheet->setCellValueByColumnAndRow(6, 1, 'Дата отгрузки');
            $sheet->setCellValueByColumnAndRow(7, 1, 'Дата доставки');
            $sheet->setCellValueByColumnAndRow(8, 1, 'Дата оплаты');
            $sheet->setCellValueByColumnAndRow(9, 1, 'Дней до оплаты');
            $sheet->setCellValueByColumnAndRow(10, 1, 'Сумма оплаты');
            $sheet->setCellValueByColumnAndRow(11, 1, 'Комментарий');

            $row_num = 1;
            $res = self::$db->query("select * from cod $condition order by id desc");

            while($row = $res->fetch_assoc()) {

                if ($row['date_delivered']) {
                    // Если у заказа есть дата доставки, то проверим - не просрочено ли поступление наложенного платежа
                    // Если у заказа есть дата оплаты, то для сравнения возьмём её. Если нет - то проверяем по текущей дате
                    $date = $row['date_payed'] ? $row['date_payed'] : date('Y-m-d');
                    $days = date_diff(date_create($row['date_delivered']), date_create($date))->d;

                }
                else $days = 0;
                if ($days == 0) $days = '';

                $row_num++;

                $sheet->setCellValueExplicitByColumnAndRow(1, $row_num, $row['barcode'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicitByColumnAndRow(2, $row_num, $row['number'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicitByColumnAndRow(3, $row_num, $row['cod'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicitByColumnAndRow(4, $row_num, $row['cod_receiver'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicitByColumnAndRow(5, $row_num, self::$codOrderStates[$row['status']], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicitByColumnAndRow(6, $row_num, $row['date_shipped'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicitByColumnAndRow(7, $row_num, $row['date_delivered'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicitByColumnAndRow(8, $row_num, $row['date_payed'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicitByColumnAndRow(9, $row_num, $days, PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicitByColumnAndRow(10, $row_num, $row['sum_payed'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $sheet->setCellValueExplicitByColumnAndRow(11, $row_num, $row['comment'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

            }

            $writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, 'Xls');

            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Cache-Control: private', false); // required for certain browsers
            header("Content-Type: application/vnd.ms-excel"); // I always use this
            header("Content-Disposition: attachment; filename=Заказы.xls");
            $writer->save('php://output');
            exit;

        }

        if (isset($_SESSION['cod_orders_message'])) {
            $message = $_SESSION['cod_orders_message'];
            unset($_SESSION['cod_orders_message']);
        }
        else $message = '';

        $shippedChecked = ($shipped == 1) ? ' checked' : '';
        $deliveredChecked = ($delivered == 1) ? ' checked' : '';
        $payedChecked = ($payed == 1) ? ' checked' : '';

        // Подсчитаем количество отфильтрованных заказов
        $row = self::$db->query("select count(*) as cnt from cod $condition")->fetch_assoc();
        $total = $row['cnt'];
        $page_size = 20;
        $pages = floor($total/$page_size)+1;

        $page = intval(!empty($req['page']) ? $req['page'] : 0);
        if ($page < 1) $page = 1;
        if ($page > $pages) $page = $pages;
        $base_url = "index.php?section=cod_orders&number=$number&barcode=$barcode&date_shipped_from=$date_shipped_from&date_shipped_to=$date_shipped_to&date_delivered_from=$date_delivered_from&date_delivered_to=$date_delivered_to&date_payed_from=$date_payed_from&date_payed_to=$date_payed_to&shipped=$shipped&delivered=$delivered&payed=$payed";

        $href_first = ($page > 1) ? "<a href='$base_url&page=1' title='Первая страница'>&lt;&lt;&lt;</a>&nbsp;" : '';
        $href_prev = ($page > 1) ? "<a href='$base_url&page=".($page-1)."' title='Предыдущая страница'>&lt;</a>&nbsp;" : '';
        $href_next = ($page < $pages) ? "<a href='$base_url&page=".($page+1)."' title='Следующая страница'>&gt;</a>&nbsp;" : '';
        $href_last = ($page < $pages) ? "<a href='$base_url&page=$pages' title='Последняя страница'>&gt;&gt;&gt;</a>&nbsp;" : '';

        $offset = ($page - 1) * $page_size;

        $res = self::$db->query("select * from cod $condition order by number desc limit $page_size offset $offset");

        $tbody = '';

        while ($row = $res->fetch_assoc()) {

            $date_shipped = date('d.m.Y', strtotime($row['date_shipped']));
            $date_delivered = $row['date_delivered'] ? date('d.m.Y', strtotime($row['date_delivered'])) : '-';
            $date_payed = $row['date_payed'] ? date('d.m.Y', strtotime($row['date_payed'])) : '-';

            $status = self::$codOrderStates[$row['status']];

            if ($row['date_delivered']) {

                // Если у заказа есть дата доставки, то проверим - не просрочено ли поступление наложенного платежа

                // Если у заказа есть дата оплаты, то для сравнения возьмём её. Если нет - то проверяем по текущей дате
                $date = $row['date_payed'] ? $row['date_payed'] : date('Y-m-d');

                $days = date_diff(date_create($row['date_delivered']), date_create($date))->d;

                $style = ($days > 5) ? 'style="color: red;"' : '';

            }
            else {
                $style = '';
                $days = '';
            }
            if ($days == 0) $days = '';

            $tbody .= <<<html
<tr $style>
    <td>$row[barcode]</td>
    <td>$row[number]</td>
    <td>$row[cod]</td>
    <td>$row[cod_receiver]</td>
    <td>$status</td>
    <td>$date_shipped</td>
    <td>$date_delivered</td>
    <td>$date_payed</td>
    <td>$days</td>
    <td>$row[sum_payed]</td>
    <td>$row[comment]</td>
</tr>
html;

        }

        $html = <<<html

<style>
    label {display: inline-block; width: 200px; text-align: right; vertical-align: baseline; padding-right: 5px;}
</style>

    <h3>Наложенный платеж - заказы</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                $message
           
                <form action="" method="get" style="">
                    <input type="hidden" name="section" value="cod_orders"/>
                    <label>Номер заказа </label><input name="number" value="$number"/>
                    <label>Штрихкод</label> <input name="barcode" value="$barcode"/><br/>
                    <label>Дата отгрузки</label>
                    <input type="date" name="date_shipped_from" value="$date_shipped_from"/> по <input type="date" name="date_shimpent_to" value="$date_shipped_to"/><br/>
                    <label>Дата доставки</label>
                    <input type="date" name="date_delivered_from" value="$date_delivered_from"/> по <input type="date" name="date_delivered_to" value="$date_delivered_to"/><br>
                    <label>Дата оплаты</label>
                    <input type="date" name="date_payed_from" value="$date_payed_from"/> по <input type="date" name="date_payed_to" value="$date_payed_to"/><br/>
                    <label>&nbsp;</label><input type="checkbox" name="shipped" value="1" $shippedChecked/> Отображать заказы в статусе "Отгружен"<br/>
                    <label>&nbsp;</label><input type="checkbox" name="delivered" value="1" $deliveredChecked/> Отображать заказы в статусе "Доставлен, ожидается оплата"<br/>
                    <label>&nbsp;</label><input type="checkbox" name="payed" value="1" $payedChecked/> Отображать заказы в статусе "Оплачен"<br/>
                    <input type="submit" value="Применить"/>
                </form>

                <form action="" method="get" style="">
                    <input type="hidden" name="section" value="cod_orders"/>
                    <input type="hidden" name="delivered" value="1"/>
                    <input type="submit" value="Сбросить фильтр"/>
                </form>

                <form class="forms-sample" method="post" target="_blank" style="float: right;">
                    <input type="hidden" name="section" value="cod_orders"/>
                    <input type="hidden" name="excel" value="yes"/>
                    <input type="hidden" name="number" value="$number"/>
                    <input type="hidden" name="barcode" value="$barcode"/>
                    <input type="hidden" name="date_shipped_from" value="$date_shipped_from"/>
                    <input type="hidden" name="date_shimpent_to" value="$date_shipped_to"/>
                    <input type="hidden" name="date_delivered_from" value="$date_delivered_from"/>
                    <input type="hidden" name="date_delivered_to" value="$date_delivered_to"/>
                    <input type="hidden" name="date_payed_from" value="$date_payed_from"/>
                    <input type="hidden" name="date_payed_to" value="$date_payed_to"/>
                    <input type="hidden" name="shipped" value="$shipped"/>
                    <input type="hidden" name="delivered" value="$delivered"/>
                    <input type="hidden" name="payed" value="$payed"/>
                    <input type="submit" value="Выгрузить в Excel"/>
                </form>
                <form class="forms-sample" method="post" style="float: right;" id="form-payment-clear">
                    <input type="hidden" name="section" value="cod_orders"/>
                    <input type="hidden" name="action" value="cod_orders_clear_payments"/>
                    <input type="hidden" name="number" value="$number"/>
                    <input type="hidden" name="barcode" value="$barcode"/>
                    <input type="hidden" name="date_shipped_from" value="$date_shipped_from"/>
                    <input type="hidden" name="date_shimpent_to" value="$date_shipped_to"/>
                    <input type="hidden" name="date_delivered_from" value="$date_delivered_from"/>
                    <input type="hidden" name="date_delivered_to" value="$date_delivered_to"/>
                    <input type="hidden" name="date_payed_from" value="$date_payed_from"/>
                    <input type="hidden" name="date_payed_to" value="$date_payed_to"/>
                    <input type="hidden" name="shipped" value="$shipped"/>
                    <input type="hidden" name="delivered" value="$delivered"/>
                    <input type="hidden" name="payed" value="$payed"/>
                </form>

                <p>&nbsp;</p>
            
                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>
                            <th>Штрихкод</th>
                            <th>Номер заказа</th>
                            <th>Сумма н/п</th>
                            <th>Бланк н/п</th>
                            <th>Статус</th>
                            <th>Дата отгрузки</th>
                            <th>Дата доставки</th>
                            <th>Дата оплаты</th>
                            <th>Дней до оплаты</th>
                            <th>Сумма оплаты</th>
                            <th>Комментарий</th>
                      </tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>
                <br/>
                <div style="float: right">
                $href_first
                $href_prev
                Страница $page из $pages (всего заказов $total)
                $href_next
                $href_last
                </div>
           
<div id="dialog-confirm" title="Удалить данные об оплатах?">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>Действительно удалить данные об оплатах $total заказов?<br/>Эта операция не может быть отменена!</p>
</div>
<script>
  $( function() {
    $( "#dialog-confirm" ).dialog({
      autoOpen: false,
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Удалить оплаты": function() {
          $('#form-payment-clear').submit();
        },
        "Отмена": function() {
          $( this ).dialog( "close" );
        }
      }
    });
  });
</script>
            <button onclick="$('#dialog-confirm').dialog('open');">Удалить данные об оплатах $total заказов...</button>                
           
            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function action_stock_update($req)
    {

        $account_id = empty($req['account_id']) ? 0 : intval($req['account_id']);

        if ($account_id == 2) {

//            $url ="https://ava-med24.retailcrm.ru/api/v5/store/products?apiKey=TQwhbjHRuglJBQt2SgIITsczK28bSbjz";
            $url ="https://ava-med24.retailcrm.ru/api/v5/store/products?apiKey=KN0tFJ2PnowNqQWsuIY0fbVPG05EhKYa";

            $result = self::httpRequestDirect($url);

            foreach ($result['products'] as $product) {

                $offer = $product['offers'][0];
                $sku = self::$db->real_escape_string($offer['id']);
                $name = self::$db->real_escape_string($offer['name']);

                $good = self::$db->query("select * from goods where sku='$sku' and account_id='$account_id'")->fetch_assoc();

                if ($good)
                    self::$db->query("update goods set name='$name' where sku='$sku' and account_id='$account_id'");
                else
                    self::$db->query("insert into goods (account_id, sku, name) values ('$account_id', '$sku', '$name')");

            }

        }

        return '?section=stock&account_id='.$account_id;

    }


    public static function action_stock_correction($req)
    {

        $account_id = empty($req['account_id']) ? 0 : intval($req['account_id']);
        $from = empty($req['from']) ? 0 : intval($req['from']);
        $sku = empty($req['sku']) ? '' : self::$db->real_escape_string($req['sku']);
        $reason = empty($req['reason']) ? '' : self::$db->real_escape_string($req['reason']);
        $quantity = empty($req['quantity']) ? '' : intval($req['quantity']);
        $date = date('Y-m-d H:i:s');

        self::$db->query("insert into goods_transactions (account_id, date, reason, sku, quantity) values ('$account_id', '$date', '$reason', '$sku', '$quantity')");

        $section = ($from == 1) ? 'stock_good&sku='.$sku : 'stock';

        return '?section='.$section.'&account_id='.$account_id;

    }


    public static function action_stock_movement_excel($req)
    {

        $account_id = empty($req['account_id']) ? 0 : intval($req['account_id']);
        $account = self::$db->query("select * from accounts where id='$account_id'")->fetch_assoc();
        $date_from = empty($req['date_from']) ? '' : self::$db->real_escape_string($req['date_from']);
        $date_to = empty($req['date_to']) ? '' : self::$db->real_escape_string($req['date_to']);

        $file = new PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $file->setActiveSheetIndex(0);

        // Создаем заголовки столбцов
        $sheet->setCellValueByColumnAndRow(1, 1, 'Дата');
        $sheet->setCellValueByColumnAndRow(2, 1, 'Основание');
        $sheet->setCellValueByColumnAndRow(3, 1, 'Артикул');
        $sheet->setCellValueByColumnAndRow(4, 1, 'Наименование');
        $sheet->setCellValueByColumnAndRow(5, 1, 'Количество');


        if ($date_from && $date_to) {

            $row_num = 1;

            $res = self::$db->query("select *, trans.sku as sku_ from goods_transactions trans 
left join goods on (goods.account_id = trans.account_id and goods.sku=trans.sku) 
where trans.account_id='$account_id' and date between '$date_from 00:00:00' and '$date_to 23:59:59' order by date");

            while($row = $res->fetch_assoc()) {

                $row_num++;

                $sheet->setCellValueByColumnAndRow(1, $row_num, $row['date']);
                $sheet->setCellValueExplicitByColumnAndRow(2, $row_num, $row['reason'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicitByColumnAndRow(3, $row_num, $row['sku_'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueExplicitByColumnAndRow(4, $row_num, $row['name'], PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $sheet->setCellValueByColumnAndRow(5, $row_num, $row['quantity']);

            }

        }

        $writer = PhpOffice\PhpSpreadsheet\IOFactory::createWriter($file, 'Xls');

        header('Pragma: public');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Cache-Control: private', false); // required for certain browsers
        header("Content-Type: application/vnd.ms-excel"); // I always use this
        header("Content-Disposition: attachment; filename=Движение с $date_from по $date_to.xls");
        $writer->save('php://output');
        exit;


    }


    public static function render_stock($req)
    {

        $account_id = empty($req['account_id']) ? 0 : intval($req['account_id']);
        $account = self::$db->query("select * from accounts where id='$account_id'")->fetch_assoc();

        $tbody = '';
        $res = self::$db->query("select *, coalesce(stock_, 0) as stock from goods
left join stock on (goods.account_id = acc_id and goods.sku = sku_)
where sku_convert is null and account_id='$account_id' order by sku");
        while($row = $res->fetch_assoc()) {

            $tbody .= <<<html
<tr>
    <td><a href="?section=stock_good&account_id=$account_id&sku=$row[sku]">$row[sku]</a></td>
    <td>$row[name]</td>
    <td>$row[stock]</td>
</tr>

html;

        }

        $html = <<<html

    <h3>Товарные остатки: $account[name]</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <form action="" method="post" style="float: right;" id="form_stock_update">
                    <input type="hidden" name="action" value="stock_update"/>
                    <input type="hidden" name="account_id" value="$account_id"/>
                    <button class="btn btn-success" id="btn_schedule_save">Синхронизировать артикулы с RetailCRM</button>
                </form>
                
                <div style="clear: both">&nbsp;</div>
                <br/>
            
                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>
                            <th>Артикул</th>
                            <th>Наименование</th>
                            <th>Текущий остаток</th>
                        </tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>

                <br/>
                <form action="" method="get" style="float: right">
                    <input type="hidden" name="section" value="stock_reports"/>
                    <input type="hidden" name="account_id" value="$account_id"/>
                    <button class="btn btn-info">Отчет по движению товаров</button>
                </form>
                
                <form action="" method="get" style="">
                    <input type="hidden" name="section" value="stock_correction"/>
                    <input type="hidden" name="account_id" value="$account_id"/>
                    <button class="btn btn-success">Добавить приход/коррекцию</button>
                </form>

            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function render_stock_reports($req)
    {

        $account_id = empty($req['account_id']) ? 0 : intval($req['account_id']);
        $account = self::$db->query("select * from accounts where id='$account_id'")->fetch_assoc();
        $date_from = empty($req['date_from']) ? '' : self::$db->real_escape_string($req['date_from']);
        $date_to = empty($req['date_to']) ? '' : self::$db->real_escape_string($req['date_to']);

        $tbody = '';
        if ($date_from && $date_to) {
            $res = self::$db->query("select *, trans.sku as sku_ from goods_transactions trans 
left join goods on (goods.account_id = trans.account_id and goods.sku=trans.sku) 
where trans.account_id='$account_id' and date between '$date_from 00:00:00' and '$date_to 23:59:59' order by date");
            while($row = $res->fetch_assoc()) {

                $tbody .= <<<html
<tr>
    <td>$row[date]</td>
    <td>$row[reason]</td>
    <td>$row[sku_]</td>
    <td>$row[name]</td>
    <td>$row[quantity]</td>
</tr>

html;

            }
        }

        $html = <<<html

    <h3><a href="?section=stock&account_id=$account_id">Товарные остатки: $account[name]</a> - Отчет по движение товаров</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <form action="" method="get" style="">
                    <input type="hidden" name="section" value="stock_reports"/>
                    <input type="hidden" name="account_id" value="$account_id"/>
                    Дата отчета
                    с <input type="date" name="date_from" value="$date_from"/>
                    по <input type="date" name="date_to" value="$date_to"/>
                    <button class="btn btn-success">Сгенерировать</button>
                </form>
                
                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Основание</th>
                            <th>Артикул</th>
                            <th>Наименование</th>
                            <th>Количество</th>
                        </tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>
                
                <form action="" method="post" style="" target="_blank">
                    <input type="hidden" name="action" value="stock_movement_excel"/>
                    <input type="hidden" name="account_id" value="$account_id"/>
                    <input type="hidden" name="date_from" value="$date_from"/>
                    <input type="hidden" name="date_to" value="$date_to"/>
                    <button class="btn btn-success">Выгрузить в Excel</button>
                </form>
                

            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function render_stock_good($req)
    {

        $account_id = empty($req['account_id']) ? 0 : intval($req['account_id']);
        $account = self::$db->query("select * from accounts where id='$account_id'")->fetch_assoc();
        $sku = empty($req['sku']) ? '' : self::$db->real_escape_string($req['sku']);

        $tbody = '';
        $res = self::$db->query("select * from goods_transactions where account_id='$account_id' and sku='$sku' order by date");
        while($row = $res->fetch_assoc()) {

            $tbody .= <<<html
<tr>
    <td>$row[date]</td>
    <td>$row[reason]</td>
    <td>$row[quantity]</td>
</tr>

html;

        }

        $html = <<<html

    <h3><a href="?section=stock&account_id=$account_id">Товарные остатки: $account[name]</a> - Движение товара $sku</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>
                            <th>Дата</th>
                            <th>Основание</th>
                            <th>Количество</th>
                        </tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>

                <br/>
                <form action="" method="get" style="">
                    <input type="hidden" name="action" value="stock_correction"/>
                    <input type="hidden" name="from" value="1"/>
                    <input type="hidden" name="account_id" value="$account_id"/>
                    <input type="hidden" name="sku" value="$sku"/>
                    Добавить оприходование/коррекцию<br/>
                    Основание: <input name="reason"/> количество <input name="quantity"/>
                    <button class="btn btn-success">Добавить</button>
                </form>

            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function render_stock_correction($req)
    {

        $account_id = empty($req['account_id']) ? 0 : intval($req['account_id']);
        $account = self::$db->query("select * from accounts where id='$account_id'")->fetch_assoc();

        $goods = '';
        $res = self::$db->query("select * from goods where account_id='$account_id' order by sku");
        while($row = $res->fetch_assoc()) {
            $goods .= "<option value=\"$row[sku]\">$row[sku] - $row[name]</option>";
        }

        $html = <<<html

    <h3><a href="?section=stock&account_id=$account_id">Товарные остатки: $account[name]</a> - Добавить оприходование/коррекцию</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <br/>
                <form action="" method="post">
                    <input type="hidden" name="action" value="stock_correction"/>
                    <input type="hidden" name="account_id" value="$account_id"/>
                    Онование: <input name="reason"/><br/>
                    Товар: <select name="sku">$goods</select> количество: <input name="quantity"/><br/><br/>
                    <button class="btn btn-success"">Добавить</button>
                </form>
                
            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function render_managers($req)
    {

        $users = self::retailGetUsers();

        $tbody = '';
        foreach ($users as $user_id => $user) {
            $manager = ($user['isManager'] == 1) ? 'Да' : '';
            $tbody .= "<tr><td>$user_id</td><td>$user[fullName]</td><td>$user[email]</td><td>$manager</td></tr>\n";
        }

        $html = <<<html

    <h3>Менеджеры</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>ФИО</th>
                            <th>email</th>
                            <th>Менеджер?</th>
                        </tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function action_load($req)
    {

        $fin = $_FILES['schedule']['tmp_name'];

        if (is_uploaded_file($fin)) {

            $file = PhpOffice\PhpSpreadsheet\IOFactory::load($fin);

            $countOfSheet = $file->getSheetCount();
            $sheet = $file->getSheet($countOfSheet - 1);

            $highestRow = $sheet->getHighestRow();
            $highestColumn = $sheet->getHighestColumn();

            $schedule = [];

            $error = '';

            // Загружаем пользователей из CRM
            $users = self::retailGetUsers(false);

            for ($kk = 2; $kk <=$highestRow; $kk++) {

                $rowFio = trim($sheet->getCellByColumnAndRow(1, $kk)->getCalculatedValue());
                if ($rowFio == '') break;

                // Сначала определим id пользователя по его ФИО из первого столбца
                $managerId = 0;
                foreach ($users as $user_id => $user) if ($rowFio == $user['fullName']) {
                    $managerId = $user_id;
                    break;
                }

                if ($managerId == 0) {
                    $error = "Ошибка загрузки файла: Неизвестное ФИО менеджера в файле: $rowFio";
                    break;
                }

                $days = array_fill(1, 31, []);
                // Теперь по всем дням месяца собираем данные
                for ($day = 1; $day <= 31; $day++) {
                    $hours_day = intval($sheet->getCellByColumnAndRow(2*$day, $kk)->getCalculatedValue());
                    $hours_night = intval($sheet->getCellByColumnAndRow(2*$day+1, $kk)->getCalculatedValue());
                    if (($hours_day > 0) || ($hours_night > 0)) $days[$day] = [$hours_day, $hours_night];
                }

                $schedule[$managerId] = [
                    'name' => $rowFio,
                    'schedule' => $days,
                ];

            }

            if (!$schedule && !$error) $error = 'Ошибка загрузки файла: пустой файл!';

            file_put_contents('schedule.excel.log', date('Y-m-d H:i:s')." ================\n", FILE_APPEND);
            file_put_contents('schedule.excel.log', "Error: $error\n", FILE_APPEND);
            file_put_contents('schedule.excel.log', print_r($schedule, true)."\n\n\n\n\n", FILE_APPEND);

            if ($error) {
                $_SESSION['schedule.load.message'] = $error;
            }
            else self::scheduleSave($schedule);

        }

        return '?section=schedule';

    }


    public static function action_schedule_save($req)
    {

        $managers = !empty($req['managers']) ? $req['managers'] : '';
        $hours = !empty($req['hours']) ? $req['hours'] : '';

        if ($managers && $hours) {
            $managers = explode(',', $managers);
            array_shift($managers);
            $hours = explode(',', $hours);
            array_shift($hours);

            $schedule = [];

            $error = '';

            // Загружаем пользователей из CRM
            $users = self::retailGetUsers(false);

            foreach ($managers as $manager) {

                // Определяем id пользователя
                $managerId = 0;
                foreach ($users as $user_id => $user) {
                    if (trim($manager) == trim($user['fullName'])) {
                        $managerId = $user_id;
                        break;
                    }
                }

                if ($managerId == 0) {
                    $_SESSION['schedule.load.message'] = "Расписание не сохранено: Неизвестное ФИО менеджера в графике: $manager";
                    break;
                }

                $days = array_fill(1, 31, []);
                // Теперь по всем дням месяца собираем данные
                for ($day = 1; $day <= 31; $day++) {
                    $hours_day = array_shift($hours);
                    $hours_night = array_shift($hours);
                    if (($hours_day > 0) || ($hours_night > 0)) $days[$day] = [$hours_day, $hours_night];
                }

                $schedule[$managerId] = [
                    'name' => $manager,
                    'schedule' => $days,
                ];

            }

            if ($error) {
                $_SESSION['schedule.load.message'] = $error;
            }
            else self::scheduleSave($schedule);

        }

        return '?section=schedule';

    }


    public static function action_schedule_add_manager($req)
    {
        $manager_id = intval(!empty($req['manager_id']) ? $req['manager_id'] : 0);

        $users = self::retailGetUsers(false);

        if (isset($users[$manager_id])) {

            $schedule = self::scheduleLoad();

            $schedule[$manager_id] = [
                'name' => $users[$manager_id]['fullName'],
                'schedule' => array_fill(1, 31, []),
            ];

            self::scheduleSave($schedule);

        }
        else $_SESSION['schedule.load.message'] = "Ошибка: Неизвестное ID менеджера: $manager_id";

        return '?section=schedule';

    }


    public static function action_schedule_remove_manager($req)
    {

        $manager_id = intval(!empty($req['manager_id']) ? $req['manager_id'] : 0);

        $schedule = self::scheduleLoad();

        unset($schedule[$manager_id]);

        self::scheduleSave($schedule);

        return '?section=schedule';

    }


    public static function render_schedule($req)
    {

        $schedule = self::scheduleLoad();

        $trth = '';
        for($day=1; $day<=31; $day++) {
            $trth .= "<th colspan='2'>$day</th>";
        }

        $users = self::retailGetUsers(false);

        $tbody = '';
        foreach ($schedule as $manager_id => $manager) {
            $days = '';
            for($day=1; $day<=31; $day++) {
                $schedule = !empty($manager['schedule'][$day]) ? $manager['schedule'][$day] : [0,0];
                $days .= '<td class="cell day">'.(($schedule[0] > 0)?$schedule[0]:'&nbsp;').'</td><td class="cell night">'.(($schedule[1] > 0)?$schedule[1]:'&nbsp;').'</td>';
            }
            $tbody .= "<tr><td class='col-fixed'>$manager[name]</td>$days<td><form action=\"\" method=\"post\" onsubmit=\"return confirm('Действительно убрать менеджера из графика?');\"><input type=\"hidden\" name='action' value='schedule_remove_manager'/><input type='hidden' name='manager_id' value='$manager_id'/><input type='submit' value='Убрать'/></form></td></tr>";
            unset($users[$manager_id]);
        }

        // Опции для выпадающего списка менеджеров для добавления в график
        $options = '';
        foreach ($users as $user_id => $user) {
            $options .= "<option value=\"$user_id\">($user_id) $user[fullName]</option>";
        }

        if (isset($_SESSION['schedule.load.message'])) {
            $message = $_SESSION['schedule.load.message'];
            $error_div = "<p style='color: red;'>$message</p>";
            unset($_SESSION['schedule.load.message']);
        }
        else $error_div = '';

        $html = <<<html

    <h3>График</h3>
    
<style>
div.fixed-table {
  overflow-x: scroll;
  margin-left: 300px;
  overflow-y: visible;
  padding: 0;
}
#table_schedule td.col-fixed {
  position: absolute;
  width: 300px;
  left: 0;
  top: auto;
  padding-top: 16px;
  border-top: none;
}
#table_schedule th.col-fixed {
  position: absolute;
  width: 300px;
  left: 0;
  top: auto;
  padding-top: 9px;
}
</style>    

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                $error_div
            
                <div>
                <div class="fixed-table">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr><th class="col-fixed">Менеджер</th>$trth<th>&nbsp;</th></tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>
                </div>
                
                <br/>
                
                <form action="" method="post" class="forms-sample">
                    <input type="hidden" name="action" value="schedule_add_manager"/>
                    Добавить менеджера в график
                    <select name="manager_id">$options</select>
                    <input type="submit" value="Добавить"/>
                
                </form>
                
                <br/>
                <form action="" method="post" style="display: none" id="form_schedule_save">
                    <input type="hidden" name="action" value="schedule_save"/>
                    <input type="hidden" name="managers"/>
                    <input type="hidden" name="hours"/>
                </form>
                
                <button class="btn btn-success" id="btn_schedule_save">Сохранить изменения</button>

            </div>

        </div>
    </div>

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            
                <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                    Загрузить расписание
                    <input type="hidden" name="action" value="load"/>
                    <input type="file" name="schedule"/>
                    <input type="submit" value="Загрузить"/>
                </form>
                
                <br/><br/><a href="template.schedule.xlsx">Шаблон файла графика работы</a>

            </div>

        </div>
    </div>

</div>

<style>
    td.cell.active {
        background-color: #0ac282;
    }
    td.cell.changed {
        background-color: #ccadad;
    }
    td.cell.active.changed {
        background-color: #0ac282;
    }
</style>

<script>

let active_cell = null;
let overwrite = false;

function parseIntDef(value, def = 0) {
    value = parseInt(value);
    if (isNaN(value)) value = def;
    return value;
}

$(document).ready(function() {
    
    $('td.cell').click(function() {
        let cell = $(this);
        if (cell === active_cell) return;
        if (active_cell) {
            validateCell(active_cell);
            $(active_cell).removeClass('active');
        }
        active_cell = cell;
        overwrite = true;
        $(active_cell).addClass('active');
    });

    $(document).keypress(function (e) {
        if (!active_cell) return;
        let code = e.which;
//        console.log(code);
        if (code == 13) { // Enter
            // TODO: move next cell
            validateCell(active_cell);
            $(active_cell).next().click();
        }
        else if ((code>=48) && (code<=57)) {
            let char = String.fromCharCode(code);
            $(active_cell).html((overwrite ? '' : $(active_cell).html())+char);
            $(active_cell).addClass('changed');
            overwrite = false;
        }

    });
    
    
    $('#btn_schedule_save').click(function() {
        let managers = '';
        let hours = '';
        $('#table_schedule tbody tr').each(function() {
            let tr = $(this);
            managers = managers+','+$(tr).find('td:first-child').html();
            $('td.cell', this).each(function() {
                let value = parseIntDef($(this).html(), 0);
                hours = hours+','+value;
            })
        });
        $('#form_schedule_save input[name=managers]').val(managers);
        $('#form_schedule_save input[name=hours]').val(hours);
        $('#form_schedule_save').submit();
    });
   
});

function validateCell(cell) {
    let value = parseIntDef($(cell).html(), 0);
    let max_value = $(cell).hasClass('day') ? 13 : ($(cell).hasClass('night') ? 11 : 0);
    if ((value < 1) || (value > max_value)) value = '';
    $(cell).html(value);
}

</script>

html;

        return $html;

    }


    public static function render_orders($req)
    {

        $users = self::retailGetUsers(false);

        $tbody = '';
        $res = self::$db->query('select * from orders order by id desc, datetime desc limit 100');
        while($row = $res->fetch_assoc()) {
            $manager_id = $row['manager_id'];
            $manager = !empty($users[$manager_id]) ? $users[$manager_id]['fullName'] : '-';
            $phone = $row['phone'];
            $phone = substr($phone, 0, 3).'***'.substr($phone, -2);

            $tbody .= <<<html
<tr>
    <td>$row[datetime]</td>
    <td>$row[site]</td>
    <td>$row[recipient]</td>
    <td>$phone</td>
    <td>$manager</td>
    <td>$row[retail_id]</td>
    <td>$row[retail_message]</td>
</tr>
html;

        }

        $html = <<<html

    <h3>Заказы</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>
                            <th>Дата/время</th>
                            <th>Магазин</th>
                            <th>ФИО покупателя</th>
                            <th>Телефон покупателя</th>
                            <th>Менеджер</th>
                            <th>Номер в RetailCRM</th>
                            <th>Ошибка в RetailCRM</th>
                        </tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>
                

            </div>

        </div>
    </div>

</div>

html;

        return $html;

    }


    public static function action_shop_image_load($req)
    {

        $fin = $_FILES['image']['tmp_name'];

        if (is_uploaded_file($fin)) {

            $name = $_FILES['image']['name'];

            move_uploaded_file($fin, self::$image_folder.$name);

            $image_url = self::$db->real_escape_string('http://digital-shop.su/images/'.$name);

            $shop_code = self::$db->real_escape_string(!empty($req['shop_code']) ? $req['shop_code'] : '');

            $row = self::$db->query("select * from shops_images where shop_code='$shop_code'")->fetch_assoc();

            $number = intval(!empty($req['number']) ? $req['number'] : 0);

            if ($number == 1) $field = 'image_url';
            elseif ($number == 2) $field = 'image2_url';
            else $field = '';

            if ($row)
                self::$db->query("update shops_images set $field='$image_url' where shop_code='$shop_code'");
            else
                self::$db->query("insert into shops_images (shop_code, $field) values ('$shop_code', '$image_url')");

        }


        return '?section=whatsapp_shops';

    }


    public static function action_shop_image_clear($req)
    {

        $shop_code = self::$db->real_escape_string(!empty($req['shop_code']) ? $req['shop_code'] : '');
        $number = intval(!empty($req['number']) ? $req['number'] : 0);

        if ($number == 1) self::$db->query("update shops_images set image_url=null where shop_code='$shop_code'");
        elseif ($number == 2) self::$db->query("update shops_images set image2_url=null where shop_code='$shop_code'");

//        self::$db->query("delete from shops_images where shop_code='$shop_code'");

        return '?section=whatsapp_shops';

    }


    public static function action_wazzup_settings($req)
    {

        $settings = json_decode(file_get_contents('./settings.json'), true);

        $settings['wazzup_number'] = $req['wazzup_number'];

        file_put_contents('./settings.json', json_encode($settings, JSON_UNESCAPED_UNICODE));

        return '?section=whatsapp_settings';

    }


    public static function render_whatsapp_shops($req)
    {

        $shops = self::retailGetShops();
        $tbody_shops = '';
//        $tbody_shops .= print_r($shops, true);
        foreach ($shops['sites'] as $code => $site) {

            $row = self::$db->query("select * from shops_images where shop_code='$code'")->fetch_assoc();

            $url1 = !empty($row['image_url']) ? $row['image_url'] : '';
            if ($url1) $url1 = "<a href=\"$url1\" target=\"_blank\">$url1</a>";
            $delete1 = ($url1) ? '<form class="forms-sample" action="" method="post"><input type="hidden" name="shop_code" value="'.$code.'"><input type="hidden" name="action" value="shop_image_clear"/><input type="hidden" name="number" value="1"/><input type="submit" value="Очистить"/></form>' : '';

            $url2 = !empty($row['image2_url']) ? $row['image2_url'] : '';
            if ($url2) $url2 = "<a href=\"$url2\" target=\"_blank\">$url2</a>";
            $delete2 = ($url2) ? '<form class="forms-sample" action="" method="post"><input type="hidden" name="shop_code" value="'.$code.'"><input type="hidden" name="action" value="shop_image_clear"/><input type="hidden" name="number" value="2"/><input type="submit" value="Очистить"/></form>' : '';

            $tbody_shops .= <<<html
<tr>
    <td rowspan="2">$code</td>
    <td>$url1</td>
    <td>
        <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="shop_image_load"/>
            <input type="hidden" name="shop_code" value="$code"/>
            <input type="hidden" name="number" value="1"/>
            <input type="file" name="image"/>
            <input type="submit" value="Загрузить"/>
        </form>
    </td>
    <td>$delete1</td>
</tr>
<tr>    
    <td>$url2</td>
    <td>
        <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="action" value="shop_image_load"/>
            <input type="hidden" name="shop_code" value="$code"/>
            <input type="hidden" name="number" value="2"/>
            <input type="file" name="image"/>
            <input type="submit" value="Загрузить"/>
        </form>
    </td>
    <td>$delete2</td>
</tr>

                

html;

        }


        $html = <<<html

    <h3>WhatsApp магазины</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>
                            <th>Код магазина</th>
                            <th>URL изображения</th>
                            <th>Загрузить изображение</th>
                            <th>Очистить изображение</th>
                        </tr>
                        </thead>
                        <tbody>
                            $tbody_shops
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function render_whatsapp_messages($req)
    {

        $tbody_messages = '';
        $res = self::$db->query('select * from wazzup order by id desc limit 30');
        while($row = $res->fetch_assoc()) {

            $message = $row['content'] ? "Content: <a href=\"$row[content]\" target=\"_blank\">$row[content]</a>" : $row['message'];

            $tbody_messages .= <<<html
<tr>
    <td>$row[id]</td>
    <td>$row[datetime]</td>
    <td>$row[from]</td>
    <td>$row[to]</td>
    <td>$message</td>
    <td>$row[response]</td>
</tr>
html;

        }

        $html = <<<html

    <h3>WhatsApp сообщения</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Дата/время</th>
                            <th>От</th>
                            <th>Получатель</th>
                            <th>Сообщение</th>
                            <th>Ответ</th>
                        </tr>
                        </thead>
                        <tbody>
                        $tbody_messages
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function render_whatsapp_settings($req)
    {

        $settings = json_decode(file_get_contents('settings.json'), true);

        $html = <<<html

    <h3>WhatsApp настройки</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <form action="" method="post" class="forms-sample">
                    <input type="hidden" name="action" value="wazzup_settings"/>
                    <label>Номер канала (телефона) wazzup</label>
                    <input type="text" name="wazzup_number" value="$settings[wazzup_number]"/>
                    <br/>
                    <input type="submit" value="Сохранить изменения"/>
                
                </form>

            </div>

        </div>
    </div>
</div>

html;

        return $html;

    }


    public static function action_settings_leads_cost_add($req)
    {

        $site_id = self::$db->real_escape_string($req['site_id']);
        $price = self::$db->real_escape_string($req['price']);

        self::$db->query("insert into leads_prices (site_id, price) values ('$site_id', '$price')");

        return '?section=settings_leads_costs';

    }


    public static function action_settings_leads_cost_edit($req)
    {

        return '?section=settings_leads_costs';

    }


    public static function action_settings_leads_cost_delete($req)
    {

        $site_id = self::$db->real_escape_string($req['site_id']);

        self::$db->query("delete from leads_prices where site_id='$site_id'");

        return '?section=settings_leads_costs';

    }


    public static function action_settings_leads_cost_from_excel($req)
    {

        $fin = $_FILES['prices']['tmp_name'];

        $error = '';

        if (is_uploaded_file($fin)) {

            $file = PhpOffice\PhpSpreadsheet\IOFactory::load($fin);

            $countOfSheet = $file->getSheetCount();
            $sheet = $file->getSheet($countOfSheet - 1);

            $highestRow = $sheet->getHighestRow();

            $sites = self::retailGetShops()['sites'];

            self::$db->query('begin');
            self::$db->query('delete from leads_prices');

            for ($row = 2; $row <=$highestRow; $row++) {

                // Данные из Эксель
                $site_name = trim($sheet->getCellByColumnAndRow(1, $row)->getCalculatedValue());
                $price = trim($sheet->getCellByColumnAndRow(2, $row)->getCalculatedValue());

                if ($site_name == '') continue; // Пропускаем строки с пустой первой ячейкой

                $site_id = '';

                foreach ($sites as $key => $site)
                    if ($site['name'] == $site_name) { $site_id = $key; break; }

                if ($site_id) {
                    $site_id = self::$db->real_escape_string($site_id);
                    $site_name = self::$db->real_escape_string($site_name);
                    $price = self::$db->real_escape_string($price);
                    self::$db->query("insert into leads_prices (site_id, site_name, price) values ('$site_id', '$site_name', '$price')");
                }
                else {
                    if ($error == '') $error = 'Не получилось найти лид(ы) с наименованием:<br/>';
                    $error = $error.$site_name.'<br/>';
                }

            }

            self::$db->query('commit');


        }
        else $error = 'Не получилось открыть загруженный файл';

        if ($error) $_SESSION['settings_leads_costs_msg'] = 'Ошибка при загрузке файла:<br/>'.$error;

        return '?section=settings_leads_costs';

    }


    public static function render_settings_leads_costs($req)
    {

        $sites = self::retailGetShops()['sites'];

        $tbody = '';
        $res = self::$db->query('select * from leads_prices order by site_id');
        while($row = $res->fetch_assoc()) {

            $lead = empty($sites[$row['site_id']]) ? '-' : $sites[$row['site_id']]['name'];

            $actions = "<form method='post' onsubmit=\"return confirm('Действительно удалить оффер из списка?');\"><input type='hidden' name='action' value='settings_leads_cost_delete'/><input type='hidden' name='site_id' value='$row[site_id]'/><input type='submit' value='Удалить'/></form>";

            $tbody .= <<<html
<tr>
    <td>$row[site_id]</td>
    <td>$lead</td>
    <td>$row[price]</td>
    <td>$actions</td>
</tr>
html;
            if (!empty($sites[$row['site_id']])) unset($sites[$row['site_id']]);

        }

        // Опции для выпадающего списка сайтов для добавления записи
        $options = '';
        foreach ($sites as $site_id => $site) {
//            $options .= "<option value=\"$site_id\">($site_id) $site[name]</option>";
            $options .= "<option value=\"$site_id\">$site[name]</option>";
        }

        // Сообщение об ошибке
        if (isset($_SESSION['settings_leads_costs_msg'])) {
            $msg =$_SESSION['settings_leads_costs_msg'];
            $error = <<<html
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body" style="color: red;">
            $msg
            </div>
        </div>
    </div>
html;
            unset($_SESSION['settings_leads_costs_msg']);

        }
        else $error = '';

        $html = <<<html

    <h3>Стоимость лидов</h3>

<div class="row">

    $error

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                Фильтр: <input type="text" id="filter-sites">
                <div class="table-responsive">
                    <table class="table table-hover" id="table-sites">
                        <thead>
                        <tr>
                            <th>id сайта</th>
                            <th>Наименование лида</th>
                            <th>Цена</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>
                <br/>
                
                <form action="" method="post" class="forms-sample">
                    <input type="hidden" name="action" value="settings_leads_cost_add"/>
                    Добавить новую запись:<br/>
                    Сайт: <select name="site_id">$options</select> Цена: <input name="price"/>
                    <input type="submit" value="Добавить"/>
                </form>

            </div>

        </div>
    </div>
    
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
            
                <form class="forms-sample" method="post" enctype="multipart/form-data">
                    Загрузить стоимость из excel
                    <input type="hidden" name="action" value="settings_leads_cost_from_excel"/>
                    <input type="file" name="prices"/>
                    <input type="submit" value="Загрузить"/>
                </form>
                
<!--                <br/><br/><a href="template.schedule.xlsx">Шаблон файла графика работы</a>-->

            </div>

        </div>
    </div>
    
</div>

<script>
$(document).ready(function() {
    
    $('#filter-sites').keyup(function() {
        let filter = $('#filter-sites').val().toString().toUpperCase();
        if (filter === '') $('#table-sites tbody tr').show();
        else {
            $('#table-sites tbody tr').each(function() {
                let cell0 = $(this).find('td:eq(0)').text().toString().toUpperCase();
                let cell1 = $(this).find('td:eq(1)').text().toString().toUpperCase();
                if (cell0.includes(filter) || cell1.includes(filter)) $(this).show(); else $(this).hide();
            })
        }
    });
});
</script>


html;

        return $html;



    }


    private static $reportTypes = [
        1 => 'Подсчет аппрува',
        11 => 'Подсчет аппрува (общий)',
        2 => 'Подсчет конверсии скрипта',
        21 => 'Подсчет конверсии скрипта (общий)',
        3 => 'Подсчет спама',
        4 => 'Подсчет % выкупа',
        41 => 'Подсчет % выкупа (общий)',
        5 => 'Средний чек',
        51 => 'Средний чек (общий)',
        6 => 'Средний чек итоговый',
        61 => 'Средний чек итоговый (общий)',
    ];
    private static $reportResultColumnHeaders = [
        1 => '% аппрува',
        11 => '% аппрува',
        2 => '% конверсии',
        21 => '% конверсии',
        3 => '% спама',
        4 => '% выкупа',
        41 => '% выкупа',
        5 => 'Средний чек',
        51 => 'Средний чек',
        6 => 'Средний чек',
        61 => 'Средний чек',
    ];
    private static $reportResultPostfix = [
        1 => '%',
        11 => '%',
        2 => '% ',
        21 => '% ',
        3 => '%',
        4 => '%',
        41 => '%',
        5 => 'руб.',
        51 => 'руб.',
        6 => 'руб.',
        61 => 'руб.',
    ];

    private static function do_report($req)
    {

        $date_from = $req['date_from'];
        $date_to = $req['date_to'];
        $by_manager = ($req['by_manager'] == 1);
        $report_type = $req['report_type'];
        $managers = !empty($req['managers']) ? $req['managers'] : [];
        $shops = !empty($req['shops']) ? $req['shops'] : [];

        switch ($report_type) {
            case 1: $report = self::reportApprove($date_from, $date_to, $by_manager, false, $managers, $shops); break;
            case 11: $report = self::reportApprove($date_from, $date_to, $by_manager, true, $managers, $shops); break;

            case 2: $report = self::reportConversion($date_from, $date_to, false, $by_manager, $managers, $shops); break;
            case 21: $report = self::reportConversion($date_from, $date_to, true, $by_manager, $managers, $shops); break;

            case 3: $report = self::reportSpam($date_from, $date_to, $by_manager, $managers, $shops); break;

            case 4: $report = self::reportDelivery($date_from, $date_to, $by_manager, false, $managers, $shops); break;
            case 41: $report = self::reportDelivery($date_from, $date_to, $by_manager, true, $managers, $shops); break;

            case 5: $report = self::reportAverageSumm($date_from, $date_to, $by_manager, false, $managers, $shops); break;
            case 51: $report = self::reportAverageSumm($date_from, $date_to, $by_manager, true, $managers, $shops); break;

            case 6: $report = self::reportAverageSummFinal($date_from, $date_to, $by_manager, false, $managers, $shops); break;
            case 61: $report = self::reportAverageSummFinal($date_from, $date_to, $by_manager, true, $managers, $shops); break;
            default:
                $html = <<<html
    <h3><a href="index.php?section=reports">Отчеты</a> -> Ошибка</h3>
html;
                return $html;

        }

//        return print_r($report, true);

        $caption = self::$reportTypes[$report_type];
        $header = self::$reportResultColumnHeaders[$report_type];
        $postfix = self::$reportResultPostfix[$report_type];
        $dates = date('d.m.Y', strtotime($date_from)).' - '.date('d.m.Y', strtotime($date_to));
        $users = self::retailGetUsers();

        if ($by_manager) {
            $columns = "<th>Менеджер</th><th>Дата оформления заказа</th><th>Оффер</th><th>$header</th>";
            $tbody = '';
            foreach ($report as $manager_id => $manager) foreach ($manager as $site_id => $site) {
                $fullName = $users[$manager_id]['fullName'];
                $tbody .= <<<html
<tr><td>$fullName ($manager_id)</td><td>$dates</td><td>$site_id</td><td>$site[result] $postfix</td></tr>
html;
            }

        }
        else {
            $columns = "<th>Дата оформления заказа</th><th>Оффер</th><th>$header</th>";
            $tbody = '';
            foreach ($report as $id => $site) $tbody .= <<<html
<tr><td>$dates</td><td>$id</td><td>$site[result] $postfix</td></tr>
html;



        }

        $html = <<<html
    <h3><a href="?section=reports">Отчеты</a> - $caption</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <div class="table-responsive">
                    <table class="table table-hover" id="table_schedule">
                        <thead>
                        <tr>$columns</tr>
                        </thead>
                        <tbody>
                        $tbody
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

html;

        return $html;



    }


    public static function render_reports($req)
    {

        if (!empty($req['date_from']) && !empty($req['date_to'])) {

//            $html = print_r($req, true);
            $html = self::do_report($req);

            return $html;

        }

        $date_from = empty($req['date_from']) ? date('Y-m-d') : $req['date_from'];
        $date_to = empty($req['date_to']) ? date('Y-m-d') : $req['date_to'];


        $option_managers = '';
        $users = self::retailGetUsers();
        foreach ($users as $user_id => $user)
            $option_managers .= "<div class=\"option\"><input type=\"checkbox\" name=\"managers[]\" value=\"$user_id\"/><span> $user[fullName]</span><br/></div>";

        $option_shops = '';
        $shops = self::retailGetShops();
        foreach ($shops['sites'] as $id => $shop)
            $option_shops .= "<div class=\"option\"><input type=\"checkbox\" name=\"shops[]\" value=\"$id\"/><span> $shop[name]</span><br/></div>";

        $html = <<<html

    <h3>Отчеты</h3>

<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
                <div class="card-header">Заполните данные для формирования отчета</div>
            
                <form action="" method="get" style="" target="_blank">
                <br/>
                    <input type="hidden" name="section" value="reports"/>
                    Дата отчета
                    с <input type="date" name="date_from" value="$date_from"/>
                    по <input type="date" name="date_to" value="$date_to"/>

                    <br/><br/>
                    Вид отчета:<br/>
                    <input type="radio" name="report_type" value="1" checked> Подсчет аппрува<br/>
                    <input type="radio" name="report_type" value="11"> Подсчет аппрува (общий)<br/>
                    <input type="radio" name="report_type" value="2"> Подсчет конверсии скрипта<br/>
                    <input type="radio" name="report_type" value="21"> Подсчет конверсии скрипта (общий)<br/>
                    <input type="radio" name="report_type" value="3"> Подсчет спама<br/>
                    <input type="radio" name="report_type" value="4"> Подсчет % выкупа<br/>
                    <input type="radio" name="report_type" value="41"> Подсчет % выкупа (общий)<br/>
                    <input type="radio" name="report_type" value="5"> Средний чек<br/>
                    <input type="radio" name="report_type" value="51"> Средний чек (общий)<br/>
                    <input type="radio" name="report_type" value="6"> Средний чек итоговый<br/>
                    <input type="radio" name="report_type" value="61"> Средний чек итоговый (общий)<br/>

                    <br/><br/>
                    Построение отчета:<br/>
                    <input type="radio" name="by_manager" value="1" id="radio-by-manager"> По менеджеру<br/>
                    <input type="radio" name="by_manager" value="0" id="radio-by-shop"> По магазину<br/>
                    <br/>
                    
<div id="div-managers" style="display: none;">
Фильтр по менеджерам: <input type="text" id="filter-managers">
<div id="list-managers" style="height: 200px; overflow-y: scroll; border: 1px solid lightgrey;">
$option_managers
</div>
</div>

<div id="div-shops" style="display: none;">
Фильтр по магазинам: <input type="text" id="filter-shops">
<div id="list-shops" style="height: 200px; overflow-y: scroll; border: 1px solid lightgrey;">
$option_shops
</div>
</div>
                    
                    <br/>
                    <button class="btn btn-success" style="display: none;" id="btn-submit">Сгенерировать</button>
                    
                </form>
                
            </div>

        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    
    $('#radio-by-manager').click(function() {
        $('#div-shops').hide();
        $('#div-managers').show();
        $('#btn-submit').show();
    });
    
    $('#radio-by-shop').click(function() {
        $('#div-managers').hide();
        $('#div-shops').show();
        $('#btn-submit').show();
    });
    
    $('#filter-managers').keyup(function() {
        let filter = $('#filter-managers').val().toString().toUpperCase();
        if (filter === '') $('#list-managers div.option').show();
        else {
            $('#list-managers div.option').each(function() {
                let label = $(this).find('span').text().toString().toUpperCase();
                if (label.includes(filter)) $(this).show(); else $(this).hide();
            })
        }
    });

    $('#filter-shops').keyup(function() {
        let filter = $('#filter-shops').val().toString().toUpperCase();
        if (filter === '') $('#list-shops div.option').show();
        else {
            $('#list-shops div.option').each(function() {
                let label = $(this).find('span').text().toString().toUpperCase();
                if (label.includes(filter)) $(this).show(); else $(this).hide();
            })
        }
    });
    
});
</script>


html;

        return $html;

    }



    public static function action_excel($req)
    {

        $fin = $_FILES['orders']['tmp_name'];

        $manager_id = intval($req['manager_id']);

        if (is_uploaded_file($fin)) {

            $file = PhpOffice\PhpSpreadsheet\IOFactory::load($fin);

            $countOfSheet = $file->getSheetCount();
            $sheet = $file->getSheet($countOfSheet - 1);

            $highestRow = $sheet->getHighestRow();

            for ($row = 2; $row <=$highestRow; $row++) {

                // Данные о получателе
                $surname = trim($sheet->getCellByColumnAndRow(1, $row)->getCalculatedValue());
                $name = trim($sheet->getCellByColumnAndRow(2, $row)->getCalculatedValue());
                $patronymic = trim($sheet->getCellByColumnAndRow(3, $row)->getCalculatedValue());

                $phone = trim($sheet->getCellByColumnAndRow(15, $row)->getCalculatedValue());

                // Адрес для доставки
                $region = trim($sheet->getCellByColumnAndRow(4, $row)->getCalculatedValue());
                $city = trim($sheet->getCellByColumnAndRow(5, $row)->getCalculatedValue());
                $street = trim($sheet->getCellByColumnAndRow(6, $row)->getCalculatedValue());
                $house = trim($sheet->getCellByColumnAndRow(7, $row)->getCalculatedValue());
                $apt = trim($sheet->getCellByColumnAndRow(8, $row)->getCalculatedValue());
                $zip = trim($sheet->getCellByColumnAndRow(9, $row)->getCalculatedValue());

                $skus = trim($sheet->getCellByColumnAndRow(10, $row)->getCalculatedValue());
                $shop = trim($sheet->getCellByColumnAndRow(11, $row)->getCalculatedValue());

                $delivery_type = trim($sheet->getCellByColumnAndRow(12, $row)->getCalculatedValue());
                $price = floatval(trim($sheet->getCellByColumnAndRow(13, $row)->getCalculatedValue()));

                $shipment_date = (string)trim($sheet->getCellByColumnAndRow(14, $row)->getCalculatedValue());

                // Подготавливаем массив с id товаров
                $skus = explode(',', $skus);
                $items = array_map(function($sku) { return ["offer" => ["externalId" => trim($sku)]]; }, $skus);

                // Создаем сведения о заказе в формате API RetailCRM
                $order = [
                    'site' => str_replace('.', '-', $shop),
                    'order' => json_encode(
                        [
                            'delivery' => [
                                'code' => 'beta-pro',
                                'cost' => $price,
                                'service' => ['deliveryType' => $delivery_type],
                                'address' => [
                                    'index' => $zip,
                                    'region' => $region,
                                    'city' => $city,
                                    'street' => $street,
                                    'building' => $house,
                                    'flat' => $apt,
                                ],
                            ],
                            'lastName' => $name,
                            'firstName' => $surname,
                            'patronymic' => $patronymic,
                            'phone' => $phone,
                            'items' => $items,

                            'shipmentDate' => $shipment_date,

                            'managerId' => $manager_id,
                            'customFields' => ['current_order_manager' => $manager_id],
                        ]
                    )
                ];

                // Отправляем запрос в RetailCRM через шлюз
                $subdomain = self::$settings['subdomain'];
                $key = self::$settings['key'];
                $url = "https://$subdomain.retailcrm.ru/api/v5/orders/create?apiKey=$key";
                try {
                    self::httpRequest($url, 'POST', json_encode($order));
                }
                catch (Exception $e) {

                }

            }

        }

        return '?section=excel';

    }


    // Страница загрузки заказов из файла с назначением им указанного менеджера
    public static function render_excel($req)
    {

        // Получаем список менеджеров в ретейле
        $users = self::retailGetUsers(false);

        // Опции для выпадающего списка менеджеров для назначением к загружаемым заказам
        $options = '';
        foreach ($users as $user_id => $user) {
            $options .= "<option value=\"$user_id\">$user[fullName]</option>";
        }

        $html = <<<html

    <h3>Загрузка заказов из файла</h3>
    
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            
            <div class="card-body">
            
                <form action="" method="post" class="forms-sample" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="excel"/>
                    Выберите менеджера
                    <select name="manager_id">$options</select>
                    Выберите файл
                    <input type="file" name="orders"/>
                    <input type="submit" value="Загрузить"/>
                </form>
                
                <br/><br/><a href="template.orders.xlsx">Шаблон файла загрузки заказов</a>

            </div>

        </div>
    </div>

</div>

html;

        return $html;

    }


    public static function scheduleLoad()
    {

        $schedule = [];
        $res = self::$db->query("select * from schedule order by manager_id");
        while ($row = $res->fetch_assoc()) {
            $hours = explode(',', $row['hours']);
            $days = [];
            for($k=1;$k<=31;$k++) $days[$k] = [
                intval(!empty($hours[($k-1)*2]) ? $hours[($k-1)*2] : 0),
                intval(!empty($hours[($k-1)*2+1]) ? $hours[($k-1)*2+1] : 0)
            ];
            $schedule[$row['manager_id']] = [
                'name' => $row['manager_name'],
                'schedule' => $days,
            ];
        }

        return $schedule;

    }


    public static function scheduleSave($schedule)
    {
        self::$db->query('delete from schedule');

        foreach($schedule as $manager_id => $manager) {
            $manager_name = self::$db->real_escape_string($manager['name']);
            $hours = [];
            for($k=1;$k<=31;$k++) {
                $hours[] = !empty($manager['schedule'][$k][0]) ? $manager['schedule'][$k][0] : 0;
                $hours[] = !empty($manager['schedule'][$k][1]) ? $manager['schedule'][$k][1] : 0;
            }
            $hours = implode(',', $hours);
            self::$db->query("insert into schedule (manager_id, manager_name, hours) values ($manager_id, '$manager_name', '$hours')");
        }

    }


    public static function retailGetOrder($external_id)
    {
        $subdomain = self::$settings['subdomain'];
        $key = self::$settings['key'];

        $url = "https://$subdomain.retailcrm.ru/api/v5/orders/$external_id?apiKey=$key";

        $response = self::httpRequest($url, "GET");

        return $response;

    }


    public static function retailGetOrderById($id)
    {
        $subdomain = self::$settings['subdomain'];
        $key = self::$settings['key'];

        $url = "https://$subdomain.retailcrm.ru/api/v5/orders/$id?apiKey=$key&by=id";

        $response = self::httpRequest($url, "GET");

        return $response;

    }


    public static function retailGetShops()
    {

        $shops = [];

        $subdomain = self::$settings['subdomain'];
        $key = self::$settings['key'];

        $url = "https://$subdomain.retailcrm.ru/api/v5/reference/sites?apiKey=$key";

        $response = self::httpRequest($url, "GET");

        ksort($response['sites']);

        return $response;


    }


    public static function retailGetStatuses()
    {
        $subdomain = self::$settings['subdomain'];
        $key = self::$settings['key'];

        $url = "https://$subdomain.retailcrm.ru/api/v5/reference/statuses?apiKey=$key";

        $response = self::httpRequest($url, "GET");

        return $response;

    }


    public static function retailGetProducts()
    {
        $subdomain = self::$settings['subdomain'];
        $key = self::$settings['key'];

        $url = "https://$subdomain.retailcrm.ru/api/v5/store/products?apiKey=$key";

        $response = self::httpRequest($url, "GET", json_encode(['limit' => 100]));

        return $response;

    }


    public static function retailGetUsers($filter_managers = false)
    {

        $result = [];

        $subdomain = self::$settings['subdomain'];
        $key = self::$settings['key'];

        $url = "https://$subdomain.retailcrm.ru/api/v5/users?apiKey=$key";

        $page = 0;

        while (true) {

            $page++;
            $portion = self::httpRequest($url, "GET", json_encode(['page' => $page, 'limit' => 100]));

            foreach ($portion['users'] as $user) {

                if ($filter_managers && ($user['isManager'] != 1)) continue;

                $firstName = !empty($user['firstName']) ? $user['firstName'] : '';
                $lastName = !empty($user['lastName']) ? $user['lastName'] : '';
                $patronymic = !empty($user['patronymic']) ? $user['patronymic'] : '';
                $result[$user['id']] = [
                    'fullName' => implode(' ', array_filter([$lastName, $firstName, $patronymic])),
                    'isManager' => intval($user['isManager']),
                    'email' => !empty($user['email']) ? $user['email'] : '',
                ];
            }

            if ($portion['pagination']['currentPage'] >= $portion['pagination']['totalPageCount']) break;

        }


//        usort($result, function($a, $b) { return $a['fullName'] > $b['fullName'] ? 1 : 0; });

        return $result;

    }


    public static function retailGetOrders($date_from, $date_to, $managers = [], $sites = [], $statuses = [])
    {

        $subdomain = self::$settings['subdomain'];
        $key = self::$settings['key'];

        $url = "https://$subdomain.retailcrm.ru/api/v5/orders?apiKey=$key";

        $orders = [];

        $page = 0;

        while (true) {

            $page++;

            $params = [
                'page' => $page,
                'limit' => 100,
                'filter' => [
                    'createdAtFrom' => $date_from,
                    'createdAtTo' => $date_to,
                ],
            ];

            if ($managers) $params['filter']['managers'] = $managers;
            if ($sites) $params['filter']['sites'] = $sites;
            if ($statuses) $params['filter']['extendedStatus'] = $statuses;

            $portion = self::httpRequest($url, "GET", json_encode($params));

            foreach ($portion['orders'] as $order) {

                $orders[] = [
                    'id' => $order['id'],
                    'createdAt' => $order['createdAt'],
                    'summ' => $order['summ'],
                    'totalSumm' => $order['totalSumm'],
                    'status' => $order['status'],
                    'managerId' => $order['managerId'],
                    'site' => $order['site'],
                    'offer' => !empty($order['customFields']['shop_text']) ? $order['customFields']['shop_text'] : $order['site'],
                ];
            }
            if ($portion['pagination']['currentPage'] >= $portion['pagination']['totalPageCount']) break;

        }

        return $orders;

    }


    public static function retailGetOrdersByShipmentDate($date_from, $date_to, $managers = [], $sites = [], $statuses = [])
    {

        $subdomain = self::$settings['subdomain'];
        $key = self::$settings['key'];

        $url = "https://$subdomain.retailcrm.ru/api/v5/orders?apiKey=$key";

        $orders = [];

        $page = 0;

        while (true) {

            $page++;

            $params = [
                'page' => $page,
                'limit' => 100,
                'filter' => [
                    'shipmentDateFrom' => $date_from,
                    'shipmentDateTo' => $date_to,
                ],
            ];

            if ($managers) $params['filter']['managers'] = $managers;
            if ($sites) $params['filter']['sites'] = $sites;
            if ($statuses) $params['filter']['extendedStatus'] = $statuses;

            $portion = self::httpRequest($url, "GET", json_encode($params));

            foreach ($portion['orders'] as $order) {

                $orders[] = [
                    'id' => $order['id'],
                    'createdAt' => $order['createdAt'],
                    'summ' => $order['summ'],
                    'totalSumm' => $order['totalSumm'],
                    'status' => $order['status'],
                    'managerId' => $order['managerId'],
                    'site' => $order['site'],
                    'offer' => !empty($order['customFields']['shop_text']) ? $order['customFields']['shop_text'] : $order['site'],
                    'raw' => $order,
                ];
            }
            if ($portion['pagination']['currentPage'] >= $portion['pagination']['totalPageCount']) break;

        }

        return $orders;

    }


    public static function retailGetOrdersByStates($date_from, $date_to, $managers = [], $sites = [], $statuses = [])
    {

        $orders = self::retailGetOrders($date_from, $date_to, $managers, $sites, $statuses);

        $result = [];

        foreach ($orders as $order) {
            $status = $order['status'];
            if (empty($result[$status])) $result[$status] = 0;
            $result[$status]++;
        }
        ksort($result);

        return $result;

    }


    public static function retailGetOrdersRaw($date_from, $date_to, $managers = [], $sites = [], $statuses = [])
    {

        $subdomain = self::$settings['subdomain'];
        $key = self::$settings['key'];

        $url = "https://$subdomain.retailcrm.ru/api/v5/orders?apiKey=$key";

        $page = 1;

        $params = [
            'page' => $page,
            'limit' => 100,
            'filter' => [
                'createdAtFrom' => $date_from,
                'createdAtTo' => $date_to,
            ],
        ];

        if ($managers) $params['filter']['managers'] = $managers;
        if ($sites) $params['filter']['sites'] = $sites;
        if ($statuses) $params['filter']['extendedStatus'] = $statuses;

        $portion = self::httpRequest($url, "GET", json_encode($params));

        return $portion;

    }


    // Отчеты

    // Отчет аппрува
    // Если $by_manager = true, то отчет строится по менеджерам, используется массив $managers для фильтра заказов
    // иначе отчет строится по магазинам и используется $sites для фильтра заказов
    // Если отчет строится по менеджерам и $total=true, то считается общий выкуп и разбивки по офферам не производится
    public static function reportApprove($date_from, $date_to, $by_manager, $total, $managers = [], $sites = [])
    {

        // Список статусов, считающихся аппрувом
        $approved_states = [
            'availability-confirmed', // Заказ подтверждён ДЕНЬ ,
            'complete', // Выполнен,
            'availability-confirmed-night', // Заказ подтверждён НОЧЬ ,
            'transferred-bp', // Передан в БетаПро,
            'readytotransfer-bp', // Готов к передаче  бета про ,
            'temporary-storage', // временное хранение ,
            // Передан в бета про ,- double
            'temporary-storage-dop', // Доп.временное хранение ,
            'dop2-vrem-hran', // Доп2 временное хранение ,
            'transfererror-bp', // ошибка при передаче в бета про ,
            'delivering', // доставляется ,
            // доставка , ???
            'pvz', // В ПВЗ.

        ];

        $report = [];

        $orders = self::retailGetOrders($date_from, $date_to, $by_manager ? $managers : [], $by_manager ? [] : $sites);

        foreach ($orders as $order) {

            $status = $order['status'];

            if ($status == 'dublicat-na-udalenie') continue; // Не обрабатываем заказы-дубликаты

            $approved = in_array($status, $approved_states);
            $manager = $order['managerId'];
            $site = ($by_manager && $total) ? 'по всем офферам' : $order['offer'];

            if ($by_manager) {
                if (empty($report[$manager][$site])) $report[$manager][$site] = ['total' => 0, 'approved' => 0];
                $report[$manager][$site]['total']++;
                if ($approved) $report[$manager][$site]['approved']++;
            }
            else {
                if (empty($report[$site])) $report[$site] = ['total' => 0, 'approved' => 0];
                $report[$site]['total']++;
                if ($approved) $report[$site]['approved']++;
            }

        }

        if ($by_manager)
            foreach ($report as &$manager) foreach ($manager as &$site) $site['result'] = round($site['approved'] / $site['total'] * 100, 2);
        else
            foreach ($report as &$site) $site['result'] = round($site['approved'] / $site['total'] * 100, 2);

        return $report;

    }


    // Отчет конверсии
    // Если $by_manager = true, то отчет строится по менеджерам, используется массив $managers для фильтра заказов
    // иначе отчет строится по магазинам и используется $sites для фильтра заказов
    // Если отчет строится по менеджерам и $total = true, то данные по офферам не разбиваются
    public static function reportConversion($date_from, $date_to, $by_manager, $total, $managers = [], $sites = [])
    {

        // Список статусов, считающихся подтвержденными
        $approved_states = [
            'availability-confirmed', // Заказ подтверждён ДЕНЬ ,
            'complete', // Выполнен,
            'availability-confirmed-night', // Заказ подтверждён НОЧЬ ,
            'transferred-bp', // Передан в БетаПро,
            'readytotransfer-bp', // Готов к передаче  бета про ,
            'temporary-storage', // временное хранение ,
            // Передан в бета про ,- double
            'temporary-storage-dop', // Доп.временное хранение ,
            'dop2-vrem-hran', // Доп2 временное хранение ,
            'transfererror-bp', // ошибка при передаче в бета про ,
            'delivering', // доставляется ,
            // доставка , ???
            'pvz', // В ПВЗ.
            'return', // возврат (ADDED 2020.06.15),
        ];
        $canceled_states = [
            'no-product', // не оставлял заявку ,
            'already-buyed', // купил в другом месте ,
            'delyvery-did-not-suit', // не устроила доставка ,
            'podumaet', // отказ от звонка ,
            'prochee', // прочее,
            'ne-original', // не оригинал ,
            'otzivi', // отзывы ,
            'cancel-other', // отменен ,
            'opis', // опись ,
//            'return', // возврат  (REMOVED 2020.06.15),
            'kurier', // нужен курьер
            'prices-did-not-suit', // Не устроила цена (ADDED 2020.06.18)
        ];
        $processing_states = [
            'wait', // ожидание ,
            'perezvoniy-pozge', // перезвонить позже ,
            'address-search', // поиск адреса
        ];
        $total_states = array_merge($approved_states, $canceled_states, $processing_states);

        $report = [];

        $orders = self::retailGetOrders($date_from, $date_to, $by_manager ? $managers : [], $by_manager ? [] : $sites);

        foreach ($orders as $order) {

            $status = $order['status'];

            if (!in_array($status, $total_states)) continue;

            $converted = in_array($status, $approved_states);
            $manager = $order['managerId'];
            $site = ($by_manager && $total) ? 'по всем офферам' : $order['offer'];

            if ($by_manager) {
                if (empty($report[$manager][$site])) $report[$manager][$site] = ['total' => 0, 'converted' => 0];
                $report[$manager][$site]['total']++;
                if ($converted) $report[$manager][$site]['converted']++;
                if (empty($report[$manager][$site][$status])) $report[$manager][$site][$status] = 0;
                $report[$manager][$site][$status]++;
            }
            else {
                if (empty($report[$site])) $report[$site] = ['total' => 0, 'converted' => 0];
                $report[$site]['total']++;
                if ($converted) $report[$site]['converted']++;
                if (empty($report[$site][$status])) $report[$site][$status] = 0;
                $report[$site][$status]++;
            }

        }

        if ($by_manager)
            foreach ($report as &$manager) foreach ($manager as &$site) $site['result'] = round($site['converted'] / $site['total'] * 100, 2);
        else
            foreach ($report as &$site) $site['result'] = round($site['converted'] / $site['total'] * 100, 2);

        return $report;

    }


    // Отчет спама
    // Если $by_manager = true, то отчет строится по менеджерам, используется массив $managers для фильтра заказов
    // иначе отчет строится по магазинам и используется $sites для фильтра заказов
    public static function reportSpam($date_from, $date_to, $by_manager, $managers = [], $sites = [])
    {

        // Список статусов, считающихся спамом
        $spam_states = [
            'spam',
            'auto-spam',
        ];

        $report = [];

        $orders = self::retailGetOrders($date_from, $date_to, $by_manager ? $managers : [], $by_manager ? [] : $sites);

        foreach ($orders as $order) {

            $status = $order['status'];

            if ($status == 'dublicat-na-udalenie') continue; // Не обрабатываем заказы-дубликаты

            $spam = in_array($status, $spam_states);
            $manager = $order['managerId'];
//            $site = $order['site'];
            $site = $order['offer'];

            if ($by_manager) {
                if (empty($report[$manager][$site])) $report[$manager][$site] = ['total' => 0, 'spam' => 0];
                $report[$manager][$site]['total']++;
                if ($spam) $report[$manager][$site]['spam']++;
            }
            else {
                if (empty($report[$site])) $report[$site] = ['total' => 0, 'spam' => 0];
                $report[$site]['total']++;
                if ($spam) $report[$site]['spam']++;
            }

        }

        if ($by_manager)
            foreach ($report as &$manager) foreach ($manager as &$site) $site['result'] = round($site['spam'] / $site['total'] * 100, 2);
        else
            foreach ($report as &$site) $site['result'] = round($site['spam'] / $site['total'] * 100, 2);

        return $report;

    }


    // Отчет выкупа
    // Если $by_manager = true, то отчет строится по менеджерам, используется массив $managers для фильтра заказов
    // иначе отчет строится по магазинам и используется $sites для фильтра заказов
    // Если отчет строится по менеджерам и $total=true, то считается общий выкуп и разбивки по офферам не производится
    public static function reportDelivery($date_from, $date_to, $by_manager, $total, $managers = [], $sites = [])
    {
        $delivered_states = [
            'complete',
        ];
        $total_states = [
            'complete',
            'pvz',
            'return'
        ];

        $report = [];

        $orders = self::retailGetOrdersByShipmentDate($date_from, $date_to, $by_manager ? $managers : [], $by_manager ? [] : $sites, $total_states);

        foreach ($orders as $order) {

            $status = $order['status'];

            if (!in_array($status, $total_states)) continue;

            $delivered = in_array($status, $delivered_states);
            $manager = $order['managerId'];
            $site = ($by_manager && $total) ? 'по всем офферам' : $order['offer'];

            if ($by_manager) {
                if (empty($report[$manager][$site])) $report[$manager][$site] = ['total' => 0, 'delivered' => 0];
                $report[$manager][$site]['total']++;
                if ($delivered) $report[$manager][$site]['delivered']++;
            }
            else {
                if (empty($report[$site])) $report[$site] = ['total' => 0, 'delivered' => 0];
                $report[$site]['total']++;
                if ($delivered) $report[$site]['delivered']++;
            }

        }

        if ($by_manager)
            foreach ($report as &$manager) foreach ($manager as &$site) $site['result'] = round($site['delivered'] / $site['total'] * 100, 2);
        else
            foreach ($report as &$site) $site['result'] = round($site['delivered'] / $site['total'] * 100, 2);

        return $report;

    }


    // Отчет Среднего чека
    // Если $by_manager = true, то отчет строится по менеджерам, используется массив $managers для фильтра заказов
    // иначе отчет строится по магазинам и используется $sites для фильтра заказов
    // Если отчет строится по менеджерам и $total=true, то разбивки по офферам не производится
    public static function reportAverageSumm($date_from, $date_to, $by_manager, $total, $managers = [], $sites = [])
    {

        $approved_states = [
            'availability-confirmed', // Заказ подтверждён ДЕНЬ ,
            'complete', // Выполнен,
            'availability-confirmed-night', // Заказ подтверждён НОЧЬ ,
            'transferred-bp', // Передан в БетаПро,
            'readytotransfer-bp', // Готов к передаче  бета про ,
            'temporary-storage', // временное хранение ,
            // Передан в бета про ,- double
            'temporary-storage-dop', // Доп.временное хранение ,
            'dop2-vrem-hran', // Доп2 временное хранение ,
            'transfererror-bp', // ошибка при передаче в бета про ,
            'delivering', // доставляется ,
            // доставка , ???
            'pvz', // В ПВЗ.
        ];

        $total_states = array_merge($approved_states, ['return']);

        $report = [];

        $orders = self::retailGetOrders($date_from, $date_to, $by_manager ? $managers : [], $by_manager ? [] : $sites, $total_states);

        foreach ($orders as $order) {

            $status = $order['status'];

            if (!in_array($status, $total_states)) continue;

            $manager = $order['managerId'];
            $site = ($by_manager && $total) ? 'по всем офферам' : $order['offer'];

            if ($by_manager) {
                if (empty($report[$manager][$site])) $report[$manager][$site] = ['total' => 0, 'summ' => 0];
                $report[$manager][$site]['total']++;
                $report[$manager][$site]['summ'] += $order['totalSumm'];
            }
            else {
                if (empty($report[$site])) $report[$site] = ['total' => 0, 'summ' => 0];
                $report[$site]['total']++;
                $report[$site]['summ'] += $order['totalSumm'];
            }

        }

        if ($by_manager)
            foreach ($report as &$manager) foreach ($manager as &$site) $site['result'] = round($site['summ'] / $site['total'], 2);
        else
            foreach ($report as &$site) $site['result'] = round($site['summ'] / $site['total'], 2);

        return $report;

    }


    // Отчет Среднего чека итогового
    // Если $by_manager = true, то отчет строится по менеджерам, используется массив $managers для фильтра заказов
    // иначе отчет строится по магазинам и используется $sites для фильтра заказов
    // Если отчет строится по менеджерам и $total=true, то разбивки по офферам не производится
    public static function reportAverageSummFinal($date_from, $date_to, $by_manager, $total, $managers = [], $sites = [])
    {

        $total_states = ['complete'];

        $report = [];

        $orders = self::retailGetOrders($date_from, $date_to, $by_manager ? $managers : [], $by_manager ? [] : $sites, $total_states);

        foreach ($orders as $order) {

            $status = $order['status'];

            if (!in_array($status, $total_states)) continue;

            $manager = $order['managerId'];
            $site = ($by_manager && $total) ? 'по всем офферам' : $order['offer'];

            if ($by_manager) {
                if (empty($report[$manager][$site])) $report[$manager][$site] = ['total' => 0, 'summ' => 0];
                $report[$manager][$site]['total']++;
                $report[$manager][$site]['summ'] += $order['totalSumm'];
            }
            else {
                if (empty($report[$site])) $report[$site] = ['total' => 0, 'summ' => 0];
                $report[$site]['total']++;
                $report[$site]['summ'] += $order['totalSumm'];
            }

        }

        if ($by_manager)
            foreach ($report as &$manager) foreach ($manager as &$site) $site['result'] = round($site['summ'] / $site['total'], 2);
        else
            foreach ($report as &$site) $site['result'] = round($site['summ'] / $site['total'], 2);

        return $report;

    }


    public static function getSavedOrderByBarcode($barcode)
    {

        $barcode = self::$db->real_escape_string($barcode);

        return self::$db->query("select * from rp_orders where barcode='$barcode'")->fetch_assoc();


    }


    public static function normalizePhone($phone)
    {
        // Удаляем все нецифровые символы
        $phone = preg_replace('/[^0-9]/', '', $phone);


        // Если длина равна 10 символов - то добавляем 7 в начало
        if (strlen($phone) == 10) $phone = '7'.$phone;

        // Если длина 11 символов и первый символ 8 - заменяем на 7
        elseif ((strlen($phone) == 11) && (substr($phone, 0, 1) == '8')) $phone = '7'.substr($phone, 1);

        // Теперь если имеем валидный телефон с 7 в начале - то добавляем + в начала номера
        if ((strlen($phone) == 11) && (substr($phone, 0, 1) == '7')) $phone = '+'.$phone;

        return $phone;

    }


    public static function getSettings()
    {

        $rows = self::$db->query('select * from sets')->fetch_all(MYSQLI_ASSOC);

        $settings = [];
        if ($rows) foreach ($rows as $row) $settings[$row['key']] = $row['value'];

        return $settings;

    }


    public static function updateSettings($settings)
    {

        foreach ($settings as $key => $value) {

            $key = self::$db->real_escape_string($key);
            $value = self::$db->real_escape_string($value);

            $row = self::$db->query("select * from sets where `key`='$key'")->fetch_assoc();
            if ($row)
                self::$db->query("update sets set value='$value' where `key`='$key'");
            else
                self::$db->query("insert into sets (`key`, value) values ('$key', '$value')");

        }


    }


    public static function httpRequest($url, $method = 'GET', $data = null)
    {
        $payload = [
            'token' => self::$settings['proxyToken'],
            'url' => $url,
            'method' => $method,
        ];
        if ($data) $payload['data'] = $data;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => self::$settings['proxyUrl'],
            CURLOPT_POST           => 1,
            CURLOPT_HTTPHEADER     => ['Content-Encoding: UTF-8', 'Connection: close'],
            CURLOPT_POSTFIELDS     => $payload,
            CURLOPT_HEADER         => false,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);

        $response = curl_exec($curl);

        $responseStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($response === false || $responseStatus > 499) {
            sleep(rand(3, 6));
            $response = curl_exec($curl);
            $responseStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        }

        if ($response === false) {
            throw new Exception("httpRequest failed: curl " . curl_error($curl));
        }

        $responseBody = json_decode($response, true);
        curl_close($curl);

        if ($responseStatus > 299) {
            throw new Exception("httpRequest failed: " . print_r($responseBody, true));
        }

        return $responseBody;

    }


    public static function httpRequestDirect($url, $method = "GET", $data = NULL)
    {
        $curl = curl_init();
        $headers = [];
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_USERAGENT, "PHP API Client");
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        if ($data) {
            if ($method == "POST") {
                $headers [] = "Content-Type: application/x-www-form-urlencoded";
                curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
            } else {
                curl_setopt($curl, CURLOPT_URL, $url . "?" . http_build_query($data));
            }
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($curl);
        $responseStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($result === false || $responseStatus > 499) {
            sleep(rand(3, 6));
            $result = curl_exec($curl);
            $responseStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        }
        if ($result === false) {
            throw new Exception("httpRequest failed: curl " . curl_error($curl));
        }
        $responseBody = json_decode($result, true);
        curl_close($curl);
        if ($responseStatus > 299) {
            throw new Exception("httpRequest failed: " . print_r($responseBody, true));
        }
        return $responseBody;
    }

}