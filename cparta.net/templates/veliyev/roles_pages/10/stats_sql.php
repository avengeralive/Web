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
    '`user_id`' => ' = "'.$user_id.'" AND '	
);

$args['group_by'] = 'd';


// Если указан оффер
// If you specify offer
if(isset($_POST['offer']) && $_POST['offer'] != 0)
{
    $args['where']['`offer_id`'] = ' = '.$_POST["offer"].' AND ';
}

// Если указан subid2
// If you specify subid2
if(isset($_POST['subid2']) && !empty($_POST['subid2']))
{
    $args['where']['`subid2`'] = ' = "'.$_POST["subid2"].'" AND ';
}

// Если указан subid1
// If you specify subid1
if(isset($_POST['subid1']) && !empty($_POST['subid1']))
{
    $args['where']['`subid1`'] = ' = "'.$_POST["subid1"].'" AND ';
}

// Если указан subid3
// If you specify subid3
if(isset($_POST['subid3']) && !empty($_POST['subid3']))
{
    $args['where']['`subid3`'] = ' = "'.$_POST["subid3"].'" AND ';
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

// Заказ холд
// Order Hold
$args['select'][1] = 'COUNT(id) as zakaz_hold';
$args['from'] = 'zakaz';
$args['field'] = 'zakaz_hold';
$args['where']['`status`'] = ' = 2 AND';

selectDateFormatAndCount($args);

// Заказ ожидает
// Check to expect
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

// Комиссия принято
// The Commission accepted
$args['select'][1] = 'SUM(comission)*kolvo as comission_ok';
$args['from'] = 'zakaz';
$args['field'] = 'comission_ok';
$args['where']['`status`'] = ' = 3 AND';

selectDateFormatAndCount($args);

// Комиссия холд
// Hold the Commission
$args['select'][1] = 'SUM(comission)*kolvo as comission_hold';
$args['from'] = 'zakaz';
$args['field'] = 'comission_hold';
$args['where']['`status`'] = ' = 2 AND';

selectDateFormatAndCount($args);

// Комиссия ожидает
// The Commission expects
$args['select'][1] = 'SUM(comission)*kolvo as comission_wait';
$args['from'] = 'zakaz';
$args['field'] = 'comission_wait';
$args['where']['`status`'] = ' = 1 AND';

selectDateFormatAndCount($args);

// Комиссия отклонена
// The Commission rejected
$args['select'][1] = 'SUM(comission)*kolvo as comission_cancel';
$args['from'] = 'zakaz';
$args['field'] = 'comission_cancel';
$args['where']['`status`'] = ' = 0 AND';

selectDateFormatAndCount($args);

// Комиссия отклонена
// The Commission rejected
$args['select'][1] = 'SUM(comission)*kolvo as comission_trash';
$args['from'] = 'zakaz';
$args['field'] = 'comission_trash';
$args['where']['`status`'] = ' = 5 AND';

selectDateFormatAndCount($args);

?>
