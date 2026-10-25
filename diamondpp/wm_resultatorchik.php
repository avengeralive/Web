<?php

// Подключаем файл конфигурации
// Connect configuration file
include './includes/config.php';

// Подключаем файл защиты от инжекта для передаваемых переменных
// Connect the protection of Injection file transmitted variables
include './includes/antiinject/index.php';

// Подключаем файл с настройками системы
// Connect the file system settings
include './includes/settings/index.php';

// Подключаем файл с определением того, какую версию дизайна выводить
// Connect file with the definition of what type of design output version
include './includes/otladka/index.php';

$module = new wm_result(DB::getInstance());

// Параметры Webmoney
// Options Webmoney
$module->wm_wmr = $settings_webmoney_wmr;
$module->wm_secret = $settings_webmoney_key;

file_put_contents('_l.txt', var_export($_REQUEST, 1), FILE_APPEND);
$module->init($_REQUEST);

class wm_result {

    protected $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function init($req) {
        if (isset($req['LMI_PREREQUEST']) and $req['LMI_PREREQUEST'] == 1) {
            echo "YES";
            exit;
        }
        $chkstring = $this->wm_wmr . $req['LMI_PAYMENT_AMOUNT'] . $req['LMI_PAYMENT_NO'] . $req['LMI_MODE'] . $req['LMI_SYS_INVS_NO'] . $req['LMI_SYS_TRANS_NO'] . $req['LMI_SYS_TRANS_DATE'] . $this->wm_secret . $req['LMI_PAYER_PURSE'] . $req['LMI_PAYER_WM'];
        $md5sum = strtoupper(hash('sha256', $chkstring));
        if ($req['LMI_HASH'] != $md5sum) {
            exit;
        }
        if (isset($req['LMI_PAYMENT_NO']) && $req['LMI_PAYEE_PURSE'] == $this->wm_wmr && isset($req['LMI_PAYMENT_AMOUNT']) && isset($req['LMI_MODE'])) {
            $invoice_id = intval($req['LMI_PAYMENT_NO']);
            $sql = "SELECT * FROM finances_log WHERE id={$invoice_id}";
            $stmt = $this->db->query($sql);

            if ($stmt->rowCount() == 0) {
                exit();
            }
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row['status'] != 1) {
                exit();
            }
            $row_user_id = htmlentities($row['user_id']);
            $u = User::getById($row_user_id);
            if (!$u) {
                exit();
            }

            $new_balance = $u->balance + intval($req['LMI_PAYMENT_AMOUNT']);
            $u->update(['balance' => $new_balance, 'sendsms_balance' => 0]);

            Events::trigger(Events::EVENT_MONEY_IN, $invoice_id, ['added'=>intval($req['LMI_PAYMENT_AMOUNT']),'balance'=>$new_balance]);

            $this->db->query("UPDATE finances_log SET `status`='2', `balance`={$new_balance} WHERE `id`={$invoice_id}");
        }
    }

}

?>