<?php

function selectDateFormatAndCount($args = array()){
    global $mysqli, $recs, $user_id;
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
    } else die('Не указаны селекторы!');

    if($args->from != ''){
        $sql .= 'FROM `'.$args->from.'` ';
    } else die('Не указана таблица!');

    if(count($args->where) != 0){
        $sql .= 'WHERE ';
        foreach($args->where as $key => $value)
        {
            $sql .= $key.' '.$value;
        }
    } else die('Не указаны условия!');

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
$args = array();

// Селекторы для хостов
$args['select'][] = 'DATE_FORMAT(date, "%Y-%m-%d") as d, ';
$args['select'][] = 'COUNT(DISTINCT(ip)) as hosts';
$args['from'] = 'clients_log';

// Дата
$args['where'] = array(
    '`date` BETWEEN ' => '"'.$dat1.' '.$DT.'" AND ',
    '"'.$dat2 => ' '.$NT.'" AND ',
    '`owner_id`' => ' = "'.$user_id.'" AND '	
);

$args['group_by'] = 'd';

// Если указан юзер
// If you specify offer
if((isset($_POST['webmaster']) && $_POST['webmaster'] != 0) or isset($_GET['webmaster']) && $_GET['webmaster'] != 0)
{
    $webmaster_id = (isset($_GET['webmaster']) && $_GET['webmaster'] != 0) ? htmlentities($_GET['webmaster']) : htmlentities($_POST['webmaster']);
    $args['where']['`user_id`'] = ' = '.$webmaster_id.' AND ';
}

// Если указан оффер
if(isset($_POST['offer']) && $_POST['offer'] != 0)
{
    $args['where']['`offer_id`'] = ' = '.$_POST["offer"].' AND ';
}

// Хосты
selectDateFormatAndCount($args);

// Визиты
$args['select'][1] = 'COUNT(id) as visits';
$args['from'] = 'clients_log';
$args['field'] = 'visits';

selectDateFormatAndCount($args);

// Заказ принят
$args['select'][1] = 'COUNT(id) as zakaz_ok';
$args['from'] = 'zakaz';
$args['field'] = 'zakaz_ok';
$args['where']['`status`'] = ' = 3 AND';

selectDateFormatAndCount($args);

// Заказ холд
$args['select'][1] = 'COUNT(id) as zakaz_hold';
$args['from'] = 'zakaz';
$args['field'] = 'zakaz_hold';
$args['where']['`status`'] = ' = 2 AND';

selectDateFormatAndCount($args);

// Заказ ожидает
$args['select'][1] = 'COUNT(id) as zakaz_wait';
$args['from'] = 'zakaz';
$args['field'] = 'zakaz_wait';
$args['where']['`status`'] = ' = 1 AND';

selectDateFormatAndCount($args);

// Заказ отклонен
$args['select'][1] = 'COUNT(id) as zakaz_cancel';
$args['from'] = 'zakaz';
$args['field'] = 'zakaz_cancel';
$args['where']['`status`'] = ' = 0 AND';

selectDateFormatAndCount($args);

// Заказ отклонен
$args['select'][1] = 'COUNT(id) as zakaz_trash';
$args['from'] = 'zakaz';
$args['field'] = 'zakaz_trash';
$args['where']['`status`'] = ' = 5 AND';

selectDateFormatAndCount($args);

// Прибыль рекла (ЗАКАЗ ПРИНЯТ)
$args['select'][1] = '(SUM(comission)+SUM(comission_cpa))*kolvo as cena_ok';
$args['from'] = 'zakaz';
$args['field'] = 'cena_ok';
$args['where']['`status`'] = ' = 3 AND';

selectDateFormatAndCount($args);

// Прибыль рекла (ЗАКАЗ В ХОЛДЕ)
$args['select'][1] = '(SUM(comission)+SUM(comission_cpa))*kolvo as cena_hold';
$args['from'] = 'zakaz';
$args['field'] = 'cena_hold';
$args['where']['`status`'] = ' = 2 AND';

selectDateFormatAndCount($args);

// Прибыль рекла (ЗАКАЗ ОЖИДАЕТ)
$args['select'][1] = '(SUM(comission)+SUM(comission_cpa))*kolvo as cena_wait';
$args['from'] = 'zakaz';
$args['field'] = 'cena_wait';
$args['where']['`status`'] = ' = 1 AND';

selectDateFormatAndCount($args);

// Прибыль рекла (ЗАКАЗ ОТКЛОНЕН)
$args['select'][1] = '(SUM(comission)+SUM(comission_cpa))*kolvo as cena_cancel';
$args['from'] = 'zakaz';
$args['field'] = 'cena_cancel';
$args['where']['`status`'] = ' = 0 AND';

selectDateFormatAndCount($args);

// Прибыль рекла (ЗАКАЗ ОТКЛОНЕН)
$args['select'][1] = '(SUM(comission)+SUM(comission_cpa))*kolvo as cena_trash';
$args['from'] = 'zakaz';
$args['field'] = 'cena_trash';
$args['where']['`status`'] = ' = 5 AND';

selectDateFormatAndCount($args);


?>
