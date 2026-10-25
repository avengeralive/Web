<?php

function selectDateFormatAndCount($args = array()){
    global $mysqli, $recs;
    $args_st = array(
        'select' => array(
            'DATE_FORMAT(date, "%Y-%m-%d") as d,',
            'COUNT(DISTINCT(ip)) as hosts'
        ),
        'from' => '',
        'where' => '',
        'group_by' => '',
        'field' => 'hosts'
    );
    $args = array_merge($args_st, $args);
    $args = (object)$args;

    $count = count($args->where);

    $n=1;

    foreach($args->where as $key => $value)
    {
        if($n == $count){
            $args->where[$key] = substr(end($args->where), 0, -4);
        }
        $n++;
    }

    $sql = 'SELECT ';

    if(count($args->select) != 0){
        foreach($args->select as $select)
        {
            $sql .= $select.' ';
        }
    } else die($loc['stats.php']['t28']);

    if($args->from != ''){
        $sql .= 'FROM `'.$args->from.'` ';
    } else die($loc['stats.php']['t29']);

    if(count($args->where) != 0){
        $sql .= 'WHERE ';
        foreach($args->where as $key => $value)
        {
            $sql .= $key.' '.$value;
        }
    } else die($loc['stats.php']['t30']);

    if($args->group_by != '')
    {
        $sql .= ' GROUP BY `'.$args->group_by.'`';
    }


    $q = $mysqli -> query( $sql );
    while ( $r = mysqli_fetch_assoc( $q ) ) {
        $recs[$r['d']][$args->field] = $r[$args->field];
    }
}

// Массив аргументов для функции
// An array of arguments for the function
$args = array();

// Селекторы для хостов
// Selectors for hosts
$args['select'][] = 'DATE_FORMAT(date, "%Y-%m-%d") as d, ';
$args['select'][] = 'COUNT(DISTINCT(ip)) as hosts';
$args['from'] = 'clients_log';

// Дата
// Date
$args['where'] = array(
    '`date` BETWEEN ' => '"'.$dat1.' '.$DT.'" AND ',
    '"'.$dat2 => ' '.$NT.'" AND ',
);

$args['group_by'] = 'd';

if((isset($_POST['webmaster']) && $_POST['webmaster'] != 0) or isset($_GET['webmaster']) && $_GET['webmaster'] != 0)
{
    $webmaster_id = (isset($_GET['webmaster']) && $_GET['webmaster'] != 0) ? htmlentities($_GET['webmaster']) : htmlentities($_POST['webmaster']);
    $args['where']['`user_id`'] = ' = '.$webmaster_id.' AND ';
}
// Если указан оффер
// If you specify offer
if(isset($_POST['offer']) && $_POST['offer'] != 0)
{
    $args['where']['`offer_id`'] = ' = '.$_POST["offer"].' AND ';
}

// Хосты
// Hosts
selectDateFormatAndCount($args);

// Визиты
// Visits
$args['select'][1] = 'COUNT(id) as visits';
$args['from'] = 'clients_log';
$args['field'] = 'visits';

selectDateFormatAndCount($args);

// Заказ принят
// Order is accepted
$args['select'][1] = 'COUNT(id) as zakaz_ok';
$args['from'] = 'zakaz';
$args['field'] = 'zakaz_ok';
$args['where']['`status`'] = ' = 3 AND';

selectDateFormatAndCount($args);

// Заказ в холде
// Order is hold
$args['select'][1] = 'COUNT(id) as zakaz_hold';
$args['from'] = 'zakaz';
$args['field'] = 'zakaz_hold';
$args['where']['`status`'] = ' = 2 AND';

selectDateFormatAndCount($args);

// Заказ ожидает
// Order is expect
$args['select'][1] = 'COUNT(id) as zakaz_wait';
$args['from'] = 'zakaz';
$args['field'] = 'zakaz_wait';
$args['where']['`status`'] = ' = 1 AND';

selectDateFormatAndCount($args);

// Заказ отклонен
// Order rejected
$args['select'][1] = 'COUNT(id) as zakaz_cancel';
$args['from'] = 'zakaz';
$args['field'] = 'zakaz_cancel';
$args['where']['`status`'] = ' = 0 AND';

selectDateFormatAndCount($args);

// Заказ отклонен
// Order rejected
$args['select'][1] = 'COUNT(id) as zakaz_trash';
$args['from'] = 'zakaz';
$args['field'] = 'zakaz_trash';
$args['where']['`status`'] = ' = 5 AND';

selectDateFormatAndCount($args);

// Комиссия CPA-сети (принято)
// CPA-network commission (accepted)
$args['select'][1] = 'SUM(comission_cpa)*kolvo as comission_cpa_ok';
$args['from'] = 'zakaz';
$args['field'] = 'comission_cpa_ok';
$args['where']['`status`'] = ' = 3 AND';

selectDateFormatAndCount($args);

// Комиссия CPA-сети (холд)
// CPA-network commission (hold)
$args['select'][1] = 'SUM(comission_cpa)*kolvo as comission_cpa_hold';
$args['from'] = 'zakaz';
$args['field'] = 'comission_cpa_hold';
$args['where']['`status`'] = ' = 2 AND';

selectDateFormatAndCount($args);

// Комиссия CPA-сети (ожидает)
// CPA-network commission (expects)
$args['select'][1] = 'SUM(comission_cpa)*kolvo as comission_cpa_wait';
$args['from'] = 'zakaz';
$args['field'] = 'comission_cpa_wait';
$args['where']['`status`'] = ' = 1 AND';

selectDateFormatAndCount($args);

// Комиссия CPA-сети (отклонена)
// CPA-network commission (rejected)
$args['select'][1] = 'SUM(comission_cpa)*kolvo as comission_cpa_cancel';
$args['from'] = 'zakaz';
$args['field'] = 'comission_cpa_cancel';
$args['where']['`status`'] = ' = 0 AND';

selectDateFormatAndCount($args);

// Комиссия CPA-сети (отклонена)
// CPA-network commission (rejected)
$args['select'][1] = 'SUM(comission_cpa)*kolvo as comission_cpa_trash';
$args['from'] = 'zakaz';
$args['field'] = 'comission_cpa_trash';
$args['where']['`status`'] = ' = 5 AND';

selectDateFormatAndCount($args);
?>
